<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;

class Front extends Component
{
    public function render()
    {
        $products = Product::latest()->get();
        return view('livewire.product.front', [
            'products' => $products
        ]);
    }
}
