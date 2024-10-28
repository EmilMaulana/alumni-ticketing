<?php

namespace App\Livewire\Product;

use App\Models\CustomProduct;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class CustomProductList extends Component
{
    use WithPagination;

    // Metode untuk memperbarui status produk
    public function updateStatus($productId, $newStatus)
    {
        // Cari produk berdasarkan ID dan pastikan produk milik user yang sedang login
        $product = CustomProduct::where('id', $productId)
            ->where('user_id', Auth::id())
            ->first();

        if ($product) {
            $product->status = $newStatus; // Update status
            $product->save(); // Simpan perubahan
        }
    }

    public function render()
    {
        // Ambil produk kustom untuk user yang sedang login dengan eager loading
        $customProducts = CustomProduct::with('user')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(5); // Mengatur jumlah produk per halaman

        return view('livewire.product.custom-product-list', [
            'customProducts' => $customProducts,
        ]);
    }
}
