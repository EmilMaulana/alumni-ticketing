<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class FrontController extends Controller
{
    public function index()
    {   
        $posts = Post::latest()->paginate(10);
        return view('front.index', [
            'title' => 'TEKNIK REKAYASA',
            'posts' => $posts
        ]);
    }

    


    public function show(Post $post)
    {   
        $postCount = $post->user->posts()->count(); // Pastikan relasi 'user' sudah didefinisikan di model Post
        $post->increment('views');
        
        return view('front.post', [
            'title' => $post->title,
            'post' => $post,
            'postCount' => $postCount
        ]);
    }

    public function category()
    {   
        return view('front.category', [
            'title' => 'TEKNIK REKAYASA',
        ]);
    }

    public function post(Request $request)
    {   
        $title = 'Semua postingan'; // Judul default

        // Menangani kategori
        if ($request->has('category')) {
            $category = Category::firstWhere('slug', $request->category);
            $title .= $category ? ' di ' . $category->name : '';
        }

        // Menangani pengguna
        if ($request->has('user')) {
            $user = User::firstWhere('name', $request->user);
            if ($user) {
                $title .= ' by ' . $user->name;
            }
        }

        // Mengambil posts dengan filter
        $posts = Post::latest()->filter($request->only(['search', 'category', 'user']))->paginate(7);

        return view('front.posts', [
            'title' => $title,
            'active' => 'blog',
            'posts' => $posts,
        ]);
    }

    

}
