<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\Transaction;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;
    public $queryUsers;

    public function render()
    {   
        $queryUsers = User::latest()->paginate(5);
        return view('livewire.user.user-list', [
            'users' => $queryUsers,

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
