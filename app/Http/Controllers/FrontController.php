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
        $latestPost = Post::latest()->first();
        return view('front.index', [
            'title' => 'TEKNIK REKAYASA',
            'meta_desc' => "Teknik Informatika, UNSIKA, Mahasiswa Informatika, SMKN 1 KAWALI ,Programming, Emil Maulana ,Kursus Laravel, Kursus PHP, Kursus VueJS, Kursus Git, Kursus Pemrograman, Kursus Koding, Kursus Membuat Web, Kursus Web Development, Training Laravel, Training PHP, Training VueJS, Training Git, Kursus Koding Karawang, Kursus Koding Cikarang, Kursus Koding Bekasi, Kursus Laravel Karawang, Kursus Laravel Cikarang, Kursus Laravel Bekasi, Kursus VueJS Karawang, Kursus VueJS Surabaya, Kursus VueJS Bekasi, Kursus Programming Karawang, Kursus Programming Surabaya, Kursus Android Karawang, Kursus Android Surabaya, Kursus Web Karawang, Kursus Web Surabaya, Kursus Web Bekasi, Kursus PHP Karawang, Kursus PHP Surabaya, Kursus PHP Bekasi, Kursus Website Karawang, Kursus Website Surabaya, Kursus Website Bekasi, Kursus Laravel Murah, Kursus PHP Murah, Kursus VueJS Murah",
            'posts' => $posts,
            'image' => $latestPost->image,
        ]);
    }

    


    public function show(Post $post)
    {   
        $postCount = $post->user->posts()->count(); // Pastikan relasi 'user' sudah didefinisikan di model Post
        $post->increment('views');
        
        return view('front.post', [
            'title' => $post->title,
            'post' => $post,
            'image' => $post->image,
            'meta_desc' => $post->excerpt,
            'postCount' => $postCount
        ]);
    }

    public function category()
    {   
        $latestPost = Post::latest()->first();
        return view('front.category', [
            'title' => 'TEKNIK REKAYASA',
            'meta_desc' => $latestPost ? $latestPost->excerpt : "Deskripsi default jika tidak ada post",
            'image' => $latestPost->image,
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
        // Ambil postingan terbaru
        $latestPost = Post::latest()->first();

        return view('front.posts', [
            'title' => $title,
            'active' => 'blog',
            'meta_desc' => $latestPost ? $latestPost->excerpt : "Deskripsi default jika tidak ada post",
            'image' => $latestPost->image,
            'posts' => $posts,
        ]);
    }

    

}
