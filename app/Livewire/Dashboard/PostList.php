<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class PostList extends Component
{
    use WithPagination;
    public function render()
    {
        return view('livewire.dashboard.post-list', [
            'posts' => Post::with(['user', 'category'])->latest()->paginate(5)
        ]);
        
    }
}
