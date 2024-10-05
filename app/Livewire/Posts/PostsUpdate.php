<?php

namespace App\Livewire\Posts;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostsUpdate extends Component
{
    use WithFileUploads;

    public $post; // Menyimpan data post yang akan diedit
    public $title;
    public $body;
    public $category_id;
    public $oldImage; // Untuk menyimpan gambar jika ada
    public $video_url;

    public function mount(Post $post)
    {
        // Mengisi properti dengan data post yang dikirim dari controller
        $this->post = $post;
        $this->title = $post->title;
        $this->category_id = $post->category_id;
        $this->body = $post->body;
        $this->oldImage = $post->image;
        $this->video_url = $post->video_url;
    }

    public function update(Request $request, $slug)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required',
            'body' => 'required',
            'image' => 'nullable|image|',
            'video_url' => 'nullable', 
        ]);

        // Ambil post berdasarkan slug
        $post = Post::where('slug', $slug)->firstOrFail();

        // Jika ada file gambar yang diupload
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($post->image) {
                Storage::delete($post->image);
            }
            $validatedData['image'] = $request->file('image')->store('post-images', 'public');
        } else {
            // Jika tidak ada file baru, tetap gunakan gambar yang ada
            $validatedData['image'] = $post->image;
        }

        // Slug dan excerpt baru
        $validatedData['slug'] = Str::slug($request->title);
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 90);
        $validatedData['user_id'] = Auth::user()->id;

        // Update post
        $post->update($validatedData);

        // Flash message success
        session()->flash('success', 'Post has been updated successfully..');

        // Redirect atau refresh
        return redirect()->route('posts.list');
    }

    public function render()
    {   
        $categories = Category::all();
        return view('livewire.posts.posts-update', [
            'categories' => $categories,
        ]);
    }
}
