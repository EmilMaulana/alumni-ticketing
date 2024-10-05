<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
USE Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class CategoryList extends Component
{
    public $categories;
    public $slug;
    public $name;
    public $oldImage;
    public $image;
    public $categoryId;

    use WithFileUploads;

    // Validation rules for creating a new category
    protected $createRules = [
        'name' => 'required|string|max:255',
        'slug' => 'required|unique:categories,slug|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];

    // Validation rules for updating an existing category
    protected function getUpdateRules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|unique:categories,slug,' . $this->categoryId . '|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image can be nullable
        ];
    }

    // Method to load category data into form fields
    public function loadCategory($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug; 
        // Only store the path for display, but don't treat this as an upload
        $this->image = null; // Reset image because you want to upload a new one
        $this->oldImage = $category->image;
    }

    // Update category method
    public function update()
    {
        // Use update validation rules
        $this->validate($this->getUpdateRules());

        $category = Category::findOrFail($this->categoryId);
        $category->name = $this->name;
        $category->slug = $this->slug;

        // Handle image upload if a new one is provided
        if ($this->image) {
            // Delete old image if exists
            if ($category->image) {
                Storage::delete('public/' . $category->image);
            }
            // Store new image
            $path = $this->image->store('categories', 'public');
            $category->image = $path;
        }

        $category->save();

        session()->flash('success', 'Category has been updated successfully.');
    }

    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function store()
    {
        // Use create validation rules
        $this->validate($this->createRules);
        
        // Logika untuk menyimpan kategori
        Category::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'image' => $this->image ? $this->image->store('categories', 'public') : null,
        ]);

        session()->flash('success', 'Category has been added successfully.');
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->slug = ''; // Slug direset
        $this->image = null;
    }

    public function render()
    {
        $categories = Category::latest()->paginate(5);
        return view('livewire.category.category-list', [
            'categoriess' => $categories
        ]);
    }

}
