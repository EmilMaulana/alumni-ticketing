<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    public function index()
    {
        return view('dashboard.posts.posts-list', [
            'title' => 'Posts List'
        ]); // Mengembalikan view untuk posts
    }
    
    public function create()
    {
        return view('dashboard.posts.posts-create', [
            'title' => 'Posts Create'
        ]); // Mengembalikan view untuk posts
    }

    public function edit(Post $post)
    {
        return view('dashboard.posts.posts-update', [
            'title' => $post->title,
            'post' => $post,
        ]); // Mengembalikan view untuk posts
    }
}
