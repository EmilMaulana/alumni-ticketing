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

        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $this->snapToken = $this->createSnapToken($product);
        if (!$this->snapToken) {
            Log::error('Snap Token tidak tersedia. Mohon periksa konfigurasi Midtrans.');
        }
    }

    public function createSnapToken($product)
    {
        $orderId = Str::uuid();
        
        $transactionDetails = [
            'order_id' => $orderId,
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
            $snapToken = Snap::getSnapToken($transaction);

            // Simpan transaksi dengan detail lengkap
            Transaction::create([
                'order_id' => $orderId,
                'product_id' => $product->id,
                'user_id' => Auth::id(),
                'amount' => $product->price,
                'status' => 'pending',
                'payment_type' => null,
                'payment_details' => [
                    'customer_details' => $customerDetails,
                    'item_details' => $itemDetails,
                    'snap_token' => $snapToken
                ]
            ]);

            return $snapToken;
        } catch (\Exception $e) {
            Log::error('Error mendapatkan Snap Token: ' . $e->getMessage());
            return null;
        }
    }

    public function handlePaymentResponse($response)
    {
        Log::info('Payment Response:', ['response' => $response]);
        
        $order_id = $response['order_id'] ?? null;
        
        if ($order_id) {
            $transaction = Transaction::where('order_id', $order_id)->first();
            
            if ($transaction) {
                try {
                    // Extract data from response
                    $payment_type = $response['payment_type'] ?? null;
                    $transaction_status = $response['transaction_status'] ?? null;
                    $fraud_status = $response['fraud_status'] ?? null;
                    
                    // Determine status
                    $status = 'pending';
                    if ($transaction_status === 'settlement' || $transaction_status === 'capture') {
                        $status = 'success';
                    } elseif (in_array($transaction_status, ['deny', 'expire', 'cancel'])) {
                        $status = 'failed';
                    }

                    // Handle QRIS specific data
                    $qr_code_url = null;
                    if ($payment_type === 'qris') {
                        $qr_code_url = $response['actions'][0]['url'] ?? null;
                    }

                    // Handle VA Numbers
                    $va_number = null;
                    if (isset($response['va_numbers'][0]['va_number'])) {
                        $va_number = $response['va_numbers'][0]['va_number'];
                    } elseif (isset($response['permata_va_number'])) {
                        $va_number = $response['permata_va_number'];
                    }

                    // Prepare payment details
                    $paymentDetails = [
                        'transaction_id' => $response['transaction_id'] ?? null,
                        'transaction_time' => $response['transaction_time'] ?? null,
                        'transaction_status' => $transaction_status,
                        'payment_type' => $payment_type,
                        'gross_amount' => $response['gross_amount'] ?? null,
                        'va_numbers' => $response['va_numbers'] ?? null,
                        'qr_code' => $qr_code_url,
                        'actions' => $response['actions'] ?? null,
                        'payment_code' => $response['payment_code'] ?? null,
                        'bill_key' => $response['bill_key'] ?? null,
                        'biller_code' => $response['biller_code'] ?? null
                    ];

                    // Update transaction
                    $transaction->update([
                        'status' => $status,
                        'payment_type' => $payment_type,
                        'va_number' => $va_number,
                        'qr_code_url' => $qr_code_url,
                        'payment_details' => $paymentDetails
                    ]);

                    Log::info('Transaction updated successfully', [
                        'order_id' => $order_id,
                        'status' => $status,
                        'payment_type' => $payment_type,
                        'qr_code_url' => $qr_code_url
                    ]);

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
            }
        }
    }

    public function handlePaymentNotification(Request $request)
    {
        Log::info('Payment Notification Received', ['notification' => $request->all()]);

        $orderId = $request->order_id;
        $transactionStatus = $request->transaction_status;
        $paymentType = $request->payment_type;
        $fraudStatus = $request->fraud_status;

        $transaction = Transaction::where('order_id', $orderId)->first();

        if ($transaction) {
            try {
                // Determine status
                $status = 'pending';
                if ($transactionStatus === 'settlement' || $transactionStatus === 'capture') {
                    $status = 'success';
                } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
                    $status = 'failed';
                }

                // Update payment details
                $paymentDetails = $transaction->payment_details ?? [];
                $paymentDetails['notification_received'] = $request->all();
                $paymentDetails['transaction_status'] = $transactionStatus;
                $paymentDetails['payment_type'] = $paymentType;

                $transaction->update([
                    'status' => $status,
                    'payment_type' => $paymentType,
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

    public function render()
    {
        return view('livewire.product.checkout');
    }
}