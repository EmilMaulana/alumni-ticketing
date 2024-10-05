<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\User;
use App\Models\Post;
use App\Models\Category as ModelCategory;
use Livewire\WithPagination;

class Category extends Component
{
    use WithPagination;

    public $categories;
    public $title = '';
    public $posts;

    public function render()
    {
        $title = '';
        if (request('category')) {
            $category = ModelCategory::firstWhere('slug', request('category'));
            $title = ' in ' . $category->name;
        }

        if (request('user')) {
            $user = User::firstWhere('name', request('user'));
            $title = ' by ' . $user->name;
        }

        return view('livewire.front.category', [
            "title" => "All Posts" . $title,
            "active" => "blog",
            "categoriess" => ModelCategory::latest()->paginate(8)
        ]);
    }

    // public function render()
    // {   
    //     $categories = ModelCategory::latest()->paginate(8);
    //     return view('livewire.front.category', [
    //         'categoriess' => $categories 
    //     ]);
    // }
}
