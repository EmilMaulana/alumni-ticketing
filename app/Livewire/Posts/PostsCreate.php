<?php

namespace App\Livewire\Posts;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Post;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsCreate extends Component
{
    use WithFileUploads;

    public $title, $body, $category_id, $image, $video_url;

    protected $rules = [
        'title' => 'required|string|max:255',
        'body' => 'required',
        'category_id' => 'required|exists:categories,id',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'video_url' => 'nullable', // Tambahkan validasi untuk image
    ];

    public function store(Request $request)
    {   
        $validatedData = $request->validate([
            'title' => 'unique:posts|required|max:255',
            'category_id' => 'required',
            'body' => 'required',
            'video_url' => 'nullable',
        ]);
        
        
        if ($request->file('image')) {
            // Menyimpan gambar di folder 'public/post-images'
            $validatedData['image'] = $request->file('image')->store('post-images', 'public');
        }
        
        $validatedData['slug'] = Str::slug($request->title);
        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 90);
        

        Post::create($validatedData);

        // Tampilkan pesan sukses
        session()->flash('success', 'Post created successfully!');

        return redirect()->route('posts.list');

        // Reset field form
        $this->reset(['title', 'body', 'category_id', 'image', 'video_url']);
    }

    public function render()
    {   
        $categories = Category::all();
        return view('livewire.posts.posts-create',[
            'categories' => $categories
        ]);
    }

}
