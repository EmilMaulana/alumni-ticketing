<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;

class UserList extends Component
{
    public $queryUsers;
    public $queryPosts;
    public $postCount;
    public $userCount;

    public function render()
    {   
        $this->postCount = Post::count();
        $this->userCount = User::count();
        $queryUsers = User::latest()->paginate(10);
        $queryPosts = Post::latest()->paginate(10);
        return view('livewire.user.user-list', [
            'users' => $queryUsers,
            'posts' => $queryPosts,
            'postCount' => $this->postCount,
            'userCount' => $this->userCount,

        ]);
    }

    public function updateStatus($postId, $status)
    {
        $post = Post::find($postId);
        if ($post) {
            $post->status = $status;
            $post->save();
        }
    }

}
