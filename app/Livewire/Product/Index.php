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
            'overview' => 'required',
            'file_product' => 'required',
        ];

        // Jika tidak sedang update, image diperlukan (untuk create)
        if (!$isUpdate) {
            $rules['image'] = 'required|image|max:1024'; // image required only for create
        } else {
            $rules['image'] = 'nullable|image|max:1024'; // image optional for update
        }

        $this->validate($rules);
    }

    // Method untuk store produk baru
    public function store()
    {
        // Validasi dengan isUpdate = false (karena ini create)
        $this->validateProduct(false);

        // Membuat slug dari name untuk digunakan sebagai nama file
        $slug = Str::slug($this->name);

        // Upload image dengan nama acak
        $imagePath = $this->image->store('products', 'public');


        // Simpan data ke database
        Product::create([
            'name' => $this->name,
            'slug' => $slug,
            'image' => $imagePath,
            'file_product' => $this->file_product, // Simpan nama file produk yang baru
            'category' => $this->category,
            'price' => $this->price,
            'overview' => $this->overview,
            'user_id' => Auth::id(), // Ambil user_id dari user yang login
        ]);

        // Reset form
        $this->resetForm();

        // Flash message
        session()->flash('success', 'Product has been successfully created.');

        // Redirect ke halaman yang sama (merefresh halaman)
        return redirect()->back();
    }


    public function loadProduct($id)
    {
        // Cari produk berdasarkan ID atau gagal jika tidak ditemukan
        $product = Product::findOrFail($id);

        // Set ID produk untuk referensi update nanti
        $this->product_id = $product->id;

        // Set nilai form dari data produk yang ditemukan
        $this->name = $product->name;
        $this->category = $product->category;
        $this->price = $product->price;
        $this->overview = $product->overview;

        // Reset input image karena kamu ingin mengupload gambar baru saat update
        $this->image = null; 
        $this->file_product = null; 

        // Simpan path gambar lama untuk ditampilkan
        $this->oldImage = $product->image; 
        $this->oldProductFile = $product->file_product; 
    }

    public function update()
    {
        // Validasi menggunakan method validateProduct() khusus untuk update
        $this->validateProduct(true);

        $product = Product::findOrFail($this->product_id);

        // Jika ada gambar baru yang diunggah
        if ($this->newImage) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            // Simpan gambar baru
            $imagePath = $this->newImage->store('products', 'public');
            $product->image = $imagePath;
        }

        // Update data produk lainnya
        $product->name = $this->name;
        $product->file_product = $this->file_product;
        $product->category = $this->category;
        $product->price = $this->price;
        $product->overview = $this->overview;

        // Simpan perubahan
        $product->save();

        // Beri pesan sukses
        session()->flash('success', 'Product updated successfully.');

        // Reset form dan tutup modal
        $this->resetForm();
        // Redirect ke halaman yang sama (merefresh halaman)
        return redirect()->back();
    }

    public function confirmDelete($id)
    {
        // Set the product ID to be deleted
        $this->deleteProductId = $id;

    }

    public function deleteProduct()
    {
        if ($this->deleteProductId) {
            $product = Product::findOrFail($this->deleteProductId);

            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }


            // Hapus produk dari database
            $product->delete();

            // Reset form
            $this->resetForm();

            session()->flash('success', 'Product and image deleted successfully.');
            // Redirect ke halaman yang sama (merefresh halaman)
            return redirect()->back();
        }
    }

    
    public function resetForm()
    {
        // Reset field input dan deleteProductId
        $this->reset([
            'name',     // Field nama produk
            'file_product',     // Field nama produk
            'image',    // Field gambar produk
            'price',    // Field harga produk
            'overview', // Field overview produk
            'category', // Field kategori produk
            'deleteProductId' // Field untuk ID produk yang ingin dihapus
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
