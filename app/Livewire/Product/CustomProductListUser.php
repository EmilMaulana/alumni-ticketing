<?php

namespace App\Livewire\Product;

use Livewire\Component;
use App\Models\CustomProduct;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class CustomProductListUser extends Component
{
    use WithPagination;

    public function render()
    {
        // Mengambil custom product sesuai user yang login
        $customProducts = CustomProduct::with('user')
            ->where('user_id', Auth::id()) // Filter sesuai user yang login
            ->latest()
            ->paginate(5);

        return view('livewire.product.custom-product-list-user', [
            'customProducts' => $customProducts,
        ]);
    }
}
