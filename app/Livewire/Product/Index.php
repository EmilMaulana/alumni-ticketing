<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithFileUploads;

    public $name, $image, $category, $price, $overview, $product_id, $oldImage, $oldProductFile, $deleteProductId, $newImage, $file_product;

    // Method untuk validasi umum
    public function validateProduct($isUpdate = false)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'overview' => 'required|string', // Validasi overview
            // 'file_product' => 'required',
        ];

        // Jika tidak sedang update, image diperlukan (untuk create)
        if (!$isUpdate) {
            $rules['image'] = 'required|image'; // image required only for create
        } else {
            $rules['image'] = 'nullable|image'; // image optional for update
        }

        $this->validate($rules);
    }

    // Method untuk store produk baru
    public function store()
    {
        $this->validateProduct(false); // Validasi semua field yang diperlukan

        // Buat slug dari name
        $slug = Str::slug($this->name);

        // Cek apakah slug sudah ada, dan tambahkan angka jika diperlukan
        $originalSlug = $slug;
        $count = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        // Pastikan image ada sebelum menyimpannya
        $imagePath = $this->image ? $this->image->store('products', 'public') : null;

        // Simpan data ke database
        Product::create([
            'name' => $this->name,
            'slug' => $slug,
            'image' => $imagePath,
            'file_product' => $this->file_product,
            'category' => $this->category,
            'price' => $this->price,
            'overview' => $this->overview,
            'user_id' => Auth::id(),
        ]);

        // Reset form
        $this->resetForm();

        // Flash message
        session()->flash('success', 'Agenda has been successfully created.');

        // Redirect ke halaman yang sama (merefresh halaman)
        return redirect()->route('product.list');
    }


    public function loadProduct($id)
    {
        $product = Product::findOrFail($id);
        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->category = $product->category;
        $this->price = $product->price;
        $this->overview = $product->overview;
        $this->image = null; 
        // $this->file_product = $product->file_product;
        $this->oldImage = $product->image; 
        $this->oldProductFile = $product->file_product; 
    }

    public function update()
    {
        $this->validateProduct(true);

        $product = Product::findOrFail($this->product_id);

        if ($this->newImage) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $this->newImage->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->name = $this->name;
        // $product->file_product = $this->file_product;
        $product->category = $this->category;
        $product->price = $this->price;
        $product->overview = $this->overview;

        $product->save();

        session()->flash('success', 'Product updated successfully.');
        $this->resetForm();
        return redirect()->back();
    }

    public function confirmDelete($id)
    {
        $this->deleteProductId = $id;
    }

    public function deleteProduct()
    {
        if ($this->deleteProductId) {
            $product = Product::findOrFail($this->deleteProductId);

            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $product->delete();

            $this->resetForm();
            session()->flash('success', 'Product and image deleted successfully.');
            return redirect()->back();
        }
    }

    public function resetForm()
    {
        $this->reset([
            'name',
            // 'file_product',
            'image',
            'price',
            'overview',
            'category',
            'overview',
            'deleteProductId'
        ]);
    }

    public function render()
    {
        $product = Product::latest()->paginate(5);
        return view('livewire.product.index', [
            'products' => $product
        ]);
    }
}