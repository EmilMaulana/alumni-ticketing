<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostsList extends Component
{   
    public $posts;

    public function render()
    {   
        $posts = Post::where('user_id', Auth::user()->id)->latest()->paginate(5);
        return view('livewire.posts.posts-list', [
            'postss' => $posts
        ]);
    }

    public function delete(Post $post)
    {   
        // Jika post memiliki gambar, hapus gambar dari storage
        if ($post->image) {
            Storage::delete($post->image);
        }

        // Hapus post dari database
        $post->delete();

        // Flash message success
        session()->flash('success', 'Post has been deleted.');

        // Redirect atau refresh
        return redirect()->route('posts.list');
    }

}
