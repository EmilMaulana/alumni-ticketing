<?php

namespace App\Livewire\Statistic;

use Livewire\Component;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class Statistic extends Component
{
    public $totalPosts;
    public $totalCategories;
    public $totalUsers;

    public function mount()
    {
        // Menghitung total posts, categories, dan users
        $this->totalPosts = Post::count();
        $this->totalCategories = Category::count();
        $this->totalUsers = User::count();
    }

    public function render()
    {
        return view('livewire.statistic.statistic', [
            'totalPosts' => $this->totalPosts,
            'totalCategories' => $this->totalCategories,
            'totalUsers' => $this->totalUsers,
        ]);
    }
}
