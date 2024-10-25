<?php

namespace App\Livewire\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Checkout extends Component
{
    public $product;
    public $customerName, $customerEmail, $snapToken;

    public function mount(Product $product)
    {
        $this->product = $product;

        if (Auth::check()) {
            $this->customerName = Auth::user()->name;
            $this->customerEmail = Auth::user()->email;
        }

        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Generate Snap Token
        $this->snapToken = $this->createSnapToken($product);
    }

    public function createSnapToken($product)
    {
        $transactionDetails = [
            'order_id' => Str::uuid(),
            'gross_amount' => $product->price,
        ];

        $itemDetails = [
            [
                'id' => $product->id,
                'price' => $product->price,
                'quantity' => 1,
                'name' => $product->name,
            ]
        ];

        $customerDetails = [
            'first_name' => $this->customerName,
            'email' => $this->customerEmail,
        ];

        $transaction = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
            'item_details' => $itemDetails,
        ];

        try {
            return Snap::getSnapToken($transaction);
        } catch (\Exception $e) {
            Log::error('Error mendapatkan Snap Token: ' . $e->getMessage());
            return null;
        }
    }

    public function storeTransaction($orderId, $amount, $paymentType, $status)
    {
        try {
            Transaction::create([
                'user_id' => Auth::id(),
                'product_id' => $this->product->id,
                'order_id' => $orderId,
                'amount' => $amount,
                'payment_type' => $paymentType,
                'status' => $status,
            ]);
            Log::info('Transaksi berhasil disimpan ke database');
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan transaksi: ' . $e->getMessage());
        }
    }

    public function handlePayment()
    {
        // Simpan data transaksi ke database
        $orderId = Str::uuid(); // Menggunakan UUID untuk order_id
        $amount = $this->product->price;

        // Simpan transaksi dengan status awal 'pending'
        $this->storeTransaction($orderId, $amount, 'credit_card', 'pending');

        // Menggunakan Snap Token untuk melakukan pembayaran
        $snapToken = $this->snapToken;

        if (!$snapToken) {
            return response()->json(['error' => 'Snap Token tidak tersedia.'], 400);
        }

        return response()->json(['snapToken' => $snapToken, 'orderId' => $orderId]);
    }

    public function render()
    {
        return view('livewire.product.checkout');
    }
}
