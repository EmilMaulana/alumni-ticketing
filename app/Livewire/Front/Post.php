<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Post as ModelPost;

class Post extends Component
{
    public $post;
    public $postCount; // Tambahkan properti untuk postCount
    public $relatedPosts;

    public function mount($post, $postCount)
    {
        $this->post = $post;
        $this->postCount = $postCount; // Set nilai postCount
        $category = $post->category;

        // Ambil postingan lain dalam kategori yang sama
        $this->relatedPosts = ModelPost::where('category_id', $category->id)
            ->where('id', '!=', $post->id) // Mengecualikan postingan saat ini
            ->limit(3) // Batasi jumlah postingan terkait yang ditampilkan
            ->latest()
            ->get();
    }

    public function render()
    {   
        return view('livewire.front.post', [
            'relatedPosts' => $this->relatedPosts,
        ]);
    }
}
