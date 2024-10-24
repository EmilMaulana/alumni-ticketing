<?php

namespace App\Livewire\Product;

use Livewire\Component;
use App\Models\Product;

class Detail extends Component
{
    public $product, $name, $price, $image, $overview, $category, $sold, $file_product, $userProductCount;
    public function mount(Product $product)
    {
        // Mengisi properti dengan data post yang dikirim dari controller
        $this->product = $product;
        $this->name = $product->name;
        $this->image = $product->image;
        $this->price = $product->price;
        $this->category = $product->category;
        $this->file_product = $product->file_product;
        $this->sold = $product->sold;
        $this->overview = $product->overview;

        // Menghitung jumlah produk yang dimiliki oleh pengguna
        $this->userProductCount = $product->user->products()->count();
    }

    public function render()
    {
        return view('livewire.product.detail', [
            'userProductCount' => $this->userProductCount,
        ]);
    }
}
