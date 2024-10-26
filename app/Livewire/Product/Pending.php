<?php

namespace App\Livewire\Product;

use Livewire\Component;

class Pending extends Component
{
    public $product; // Untuk menyimpan detail produk
    public $paymentType; // Untuk menyimpan jenis pembayaran
    public $amount; // Untuk menyimpan jumlah pembayaran

    public function mount($productId)
    {
        // Ambil detail produk berdasarkan ID
        $this->product = \App\Models\Product::find($productId);
        
        // Misalkan Anda mendapatkan informasi pembayaran dari sumber lain
        $this->paymentType = 'Kartu Kredit'; // Contoh: Anda bisa mengganti dengan logika yang sesuai
        $this->amount = $this->product->price; // Menggunakan harga produk sebagai jumlah pembayaran
    }

    public function render()
    {
        return view('livewire.product.pending');
    }
}