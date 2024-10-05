<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryManager extends Component
{
    use WithFileUploads;

    public $categories;
    public $name;
    public $slug;
    public $image;// Untuk menyimpan ID kategori yang sedang diedit
    public $categoryId = null; // Menambahkan default null

    public function mount()
    {
        $this->categories = Category::all(); // Ambil semua kategori
        $this->resetInputFields(); // Reset input fields
    }

    public function createCategory()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048', // Validasi untuk gambar
        ]);

        $category = new Category();
        $category->name = $this->name;
        $category->slug = Str::slug($this->name); // Menghasilkan slug dari nama

        // Upload gambar jika ada
        if ($this->image) {
            $path = $this->image->store('category-images', 'public');
            $category->image = $path;
        }

        $category->save();
        $this->resetInputFields();
        $this->emit('categoryAdded');
    }

    public function editCategory($id)
    {
        $category = Category::find($id);
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->image = $category->image; // Menyimpan path gambar
        $this->categoryId = $category->id; // Menyimpan ID kategori yang akan diedit
    }

    public function updateCategory()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048', // Validasi untuk gambar
        ]);
    
        $category = Category::find($this->categoryId);
        $category->name = $this->name;
        $category->slug = Str::slug($this->name); // Menghasilkan slug dari nama
    
        // Upload gambar baru jika ada
        if ($this->image) {
            if ($category->image) {
                Storage::delete('public/' . $category->image); // Hapus gambar lama
            }
            $path = $this->image->store('category-images', 'public');
            $category->image = $path;
        }
    
        $category->save();
        $this->resetInputFields();
        $this->emit('categoryUpdated');
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        if ($category->image) {
            Storage::delete('public/' . $category->image); // Hapus gambar dari storage
        }
        $category->delete();
        $this->emit('categoryDeleted');
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->slug = ''; // Slug direset
        $this->image = null;
        $this->categoryId = null; // Reset ID kategori
    }


    public function render()
    {
        return view('livewire.category-manager', [
            'categories' => $this->categories,
            'categoryId' => $this->categories->id
        ]);
    }
}

