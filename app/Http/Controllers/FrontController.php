<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Testimonial;
use App\Models\User;

class FrontController extends Controller
{
    public function index()
    {   
        $posts = Post::with(['user', 'category'])->where('status', 'approved')->latest()->paginate(10);
        $latestPost = Post::latest()->with('user', 'category')->first();

        return view('front.index', [
            'title' => 'TEKNIK REKAYASA',
            'meta_desc' => "Teknik Informatika, UNSIKA, Mahasiswa Informatika, SMKN 1 KAWALI, Programming, Emil Maulana, Kursus Laravel, Kursus PHP, Kursus VueJS, Kursus Git, Kursus Pemrograman, Kursus Koding, Kursus Membuat Web, Kursus Web Development, Training Laravel, Training PHP, Training VueJS, Training Git, Kursus Koding Karawang, Kursus Koding Cikarang, Kursus Koding Bekasi, Kursus Laravel Karawang, Kursus Laravel Cikarang, Kursus Laravel Bekasi, Kursus VueJS Karawang, Kursus VueJS Surabaya, Kursus VueJS Bekasi, Kursus Programming Karawang, Kursus Programming Surabaya, Kursus Android Karawang, Kursus Android Surabaya, Kursus Web Karawang, Kursus Web Surabaya, Kursus Web Bekasi, Kursus PHP Karawang, Kursus PHP Surabaya, Kursus PHP Bekasi, Kursus Website Karawang, Kursus Website Surabaya, Kursus Website Bekasi, Kursus Laravel Murah, Kursus PHP Murah, Kursus VueJS Murah",
            'posts' => $posts,
            'image' => $latestPost->image,
            'testimonials' => Testimonial::latest()->get()
        ]);
    }


    


    public function show(Post $post)
    {   
        // Cek apakah status post adalah 'approved'
        if ($post->status !== 'approved') {
            abort(404); // Atau redirect ke halaman lain jika status bukan 'approved'
        }
        
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
    
        
    public function post()
    {
        $title = 'Semua Postingan'; // Inisialisasi judul dengan default

        // Cek jika ada kategori dan dapatkan namanya
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            if ($category) {
                $title .= ' di ' . $category->name; // Tambahkan nama kategori ke judul
            }
        }

        // Cek jika ada pengguna dan dapatkan namanya
        if (request('user')) {
            $user = User::firstWhere('name', request('user'));
            if ($user) {
                $title .= ' oleh ' . $user->name; // Tambahkan nama pengguna ke judul
            }
        }

        // Ambil postingan terbaru untuk meta desc dan gambar
        $latestPost = Post::latest()->first();

        return view('front.posts', [
            'title' => $title, // Judul yang sudah dibangun
            'active' => 'blog',
            'meta_desc' => $latestPost ? $latestPost->excerpt : "Deskripsi default jika tidak ada post",
            'image' => $latestPost ? $latestPost->image : '', // Pastikan ini tidak menyebabkan error
            'posts' => Post::where('status', 'approved')
                ->latest()
                ->filter(request(['search', 'category', 'user'])) // Menambahkan filter pencarian ke query string
                ->paginate(12)
                ->withQueryString(),
        ]);
    }


    

}
