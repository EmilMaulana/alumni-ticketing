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
use Illuminate\Http\Request;

class Checkout extends Component
{
    public $product, $snapToken, $status, $orderId, $paymentType, $amount;
    public $customerName, $customerEmail;

    public function mount(Product $product)
    {
        Log::info('Metode mount dipanggil', ['product_id' => $product->id]);

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

        // Inisialisasi snapToken dengan metode pembayaran yang ditentukan
        $this->paymentType = 'qris'; // Set default payment type, bisa diubah sesuai input pengguna
        $this->snapToken = $this->createSnapToken($product, $this->paymentType);

        if (!$this->snapToken) {
            Log::error('Snap Token tidak tersedia. Mohon periksa konfigurasi Midtrans.');
        }
    }

    public function createSnapToken($product, $paymentType)
    {
        $orderId = 'ALUMNI-' . rand(1000, 9999);

        // Tambahkan service fee sebesar 9000 ke dalam total
        $serviceFee = 1900;
        $totalAmount = $product->price + $serviceFee;

        $transactionDetails = [
            'order_id' => $orderId,
            'gross_amount' => $totalAmount, // Total termasuk service fee
        ];

        $itemDetails = [
            [
                'id' => $product->id,
                'price' => $product->price,
                'quantity' => 1,
                'name' => $product->name,
            ],
            [
                'id' => 'service_fee',
                'price' => $serviceFee,
                'quantity' => 1,
                'name' => 'Service Fee',
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
            'payment_type' => $paymentType,
        ];

        try {
            $snapToken = Snap::getSnapToken($transaction);

            // Simpan transaksi dengan detail lengkap
            Transaction::create([
                'order_id' => $orderId,
                'product_id' => $product->id,
                'user_id' => Auth::id(),
                'amount' => $totalAmount, // Simpan total amount termasuk service fee
                'status' => 'pending',
                'payment_type' => $paymentType,
                // 'size' => $this->ukuranKaos, // Simpan ukuran kaos  
                // 'shipping_method' => $this->metodePengiriman, // Simpan metode pengiriman  
                // 'shipping_address' => $this->alamat, // Simpan alamat jika diantar  
                'payment_details' => [
                    'customer_details' => $customerDetails,
                    'item_details' => $itemDetails,
                    'snap_token' => $snapToken,
                ]
            ]);

            return $snapToken;
        } catch (\Exception $e) {
            Log::error('Error mendapatkan Snap Token: ' . $e->getMessage());
            return null;
        }
    }


    public function handlePaymentNotification(Request $request)
    {
        Log::info('Payment Notification Received', ['notification' => $request->all()]);

        $orderId = $request->order_id;
        $transactionStatus = $request->transaction_status;
        $paymentType = $request->payment_type;

        $transaction = Transaction::where('order_id', $orderId)->first();

        if ($transaction) {
            try {
                // Tentukan status berdasarkan notifikasi
                $status = 'pending';
                if (in_array($transactionStatus, ['settlement', 'capture'])) {
                    $status = 'success';
                    // Update field sold di tabel product
                    $this->updateProductSold($transaction->product_id);
                } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
                    $status = 'failed';
                }

                // Ambil VA number dari notifikasi jika tersedia
                $vaNumber = $request->va_numbers[0]['va_number'] ?? $request->permata_va_number ?? null;

                // Ambil qr_code_url dari notifikasi
                $qrCodeUrl = $request->qr_code_url ?? null;

                // Perbarui transaksi dengan status, va_number, dan qr_code_url
                $paymentDetails = array_merge($transaction->payment_details ?? [], [
                    'notification_received' => $request->all(),
                    'transaction_status' => $transactionStatus,
                    'payment_type' => $paymentType,
                    'va_number' => $vaNumber,
                    'qr_code_url' => $qrCodeUrl // Simpan qr_code_url
                ]);

                $transaction->update([
                    'status' => $status,
                    'payment_type' => $paymentType,
                    'va_number' => $vaNumber,
                    'payment_details' => $paymentDetails
                ]);

                Log::info('Transaction notification processed', [
                    'order_id' => $orderId,
                    'status' => $status
                ]);

                return response()->json(['status' => 'success']);

            } catch (\Exception $e) {
                Log::error('Error processing notification: ' . $e->getMessage(), [
                    'order_id' => $orderId
                ]);
                return response()->json(['status' => 'error'], 500);
            }
        }

        return response()->json(['status' => 'not found'], 404);
    }

    public function handlePaymentResponse($response)
    {
        Log::info('Payment Response Received:', ['response' => $response]);
        
        $order_id = $response['order_id'] ?? null;
        
        if ($order_id) {
            $transaction = Transaction::where('order_id', $order_id)->first();
            
            if ($transaction) {
                try {
                    $payment_type = $response['payment_type'] ?? null;
                    $transaction_status = $response['transaction_status'] ?? null;
                    
                    // Tentukan status
                    $status = 'pending';
                    if (in_array($transaction_status, ['settlement', 'capture'])) {
                        $status = 'success';
                        // Update field sold di tabel product
                        $this->updateProductSold($transaction->product_id);
                    } elseif (in_array($transaction_status, ['deny', 'expire', 'cancel'])) {
                        $status = 'failed';
                    }

                    // Ambil VA Numbers
                    $va_number = null;
                    if (isset($response['va_numbers'][0]['va_number'])) {
                        $va_number = $response['va_numbers'][0]['va_number'];
                    } elseif (isset($response['permata_va_number'])) {
                        $va_number = $response['permata_va_number'];
                    }

                    // Ambil qr_code_url dari respons jika ada
                    $qr_code_url = $response['qr_code_url'] ?? null;

                    // Perbarui detail pembayaran
                    $paymentDetails = array_merge($transaction->payment_details ?? [], [
                        'transaction_id' => $response['transaction_id'] ?? null,
                        'transaction_time' => $response['transaction_time'] ?? null,
                        'transaction _status' => $transaction_status,
                        'payment_type' => $payment_type,
                        'va_number' => $va_number,
                        'qr_code_url' => $qr_code_url, // Simpan qr_code_url
                    ]);

                    // Update transaction
                    $transaction->update([
                        'status' => $status,
                        'payment_type' => $payment_type,
                        'va_number' => $va_number,
                        'payment_details' => $paymentDetails
                    ]);

                    Log::info('Transaction updated successfully', [
                        'order_id' => $order_id,
                        'status' => $status,
                        'payment_type' => $payment_type
                    ]);

                    // Dispatch event atau kirim response
                    $this->dispatch('paymentStatusUpdated', [
                        'status' => $status,
                        'paymentType' => $payment_type,
                        'paymentDetails' => $paymentDetails
                    ]);

                } catch (\Exception $e) {
                    Log::error('Error updating transaction: ' . $e->getMessage(), [
                        'order_id' => $order_id,
                        'response' => $response
                    ]);
                }
            } else {
                Log::warning('Transaction not found for order_id: ' . $order_id);
            }
        } else {
            Log::warning('Order ID not found in response');
        }
    }

    private function updateProductSold($productId)
    {
        $product = Product::find($productId);
        if ($product) {
            // Increment field sold
            $product->increment('sold');
        }
    }


    public function render()
    {
        return view('livewire.product.checkout');
    }
}
