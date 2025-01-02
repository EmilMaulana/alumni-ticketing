<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Livewire\Product\Checkout;
use Midtrans\Config;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Midtrans\Transaction as MidtransTransaction;

class ProductController extends Controller
{
    public function handleMidtransCallback(Request $request)
    {
        $checkout = new Checkout();
        
        // Log untuk memastikan callback diterima
        Log::info('Callback diterima dari Midtrans');

        $response = json_decode($request->getContent());

        if ($response) {
            Log::info('Data callback valid, memproses status transaksi');
            $checkout->handlePaymentResponse($response);
            return response()->json(['status' => 'success'], 200);
        } else {
            Log::error('Callback Midtrans gagal, data tidak valid');
            return response()->json(['status' => 'error', 'message' => 'Invalid data'], 400);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.product.index', [
            'title' => 'Daftar Agenda'
        ]);
    }

    public function kehadiran()
    {
        return view('dashboard.product.kehadiran', [
            'title' => 'Daftar Kehadiran Peserta'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function frontProduct()
    {
        return view('front.product.product', [
            'title' => 'Semua Agenda'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function detail(Product $product)
    {
        return view('front.product.detail', [
            'title' => $product->name,
            'product' => $product
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function checkout(Product $product)
    {
        return view('front.product.checkout', [
            'title' => $product->name,
            'product' => $product
        ]);
    }

    public function success(Product $product)
    {
        return view('front.product.success', [
            'title' => $product->name,
        ]);
    }

    public function pending($order_id)
    {
        // Ambil transaksi berdasarkan order_id dan user yang sedang login
        $transaction = Transaction::where('user_id', Auth::id())
                                ->where('order_id', $order_id)
                                ->firstOrFail();

        // Ambil data produk terkait
        $product = $transaction->product;

        return view('front.product.pending', [
            'title' => $product->name,
            'transaction' => $transaction,
            'product' => $product,
            'paymentType' => $transaction->payment_type,
            'amount' => $transaction->amount
        ]);
    }

    


    /**
     * Show the form for editing the specified resource.
     */
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
