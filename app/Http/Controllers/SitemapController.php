<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $post = Post::latest()->get(); 
        $category = Category::latest()->get();

        return response()->view('front.sitemap',[
            'posts' => $post,
            'categories' => $category
        ])->header('Content-Type', 'text/xml');
    }
}
