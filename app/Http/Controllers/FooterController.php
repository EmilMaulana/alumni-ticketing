<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class FooterController extends Controller
{
    public function index()
    {   
        $latestPost = Post::latest()->first();
        return view('front.about', [
            'title' => 'TEKNIK REKAYASA - ABOUT',
            'meta_desc' => "Teknik Informatika, UNSIKA, Mahasiswa Informatika, SMKN 1 KAWALI ,Programming, Emil Maulana ,Kursus Laravel, Kursus PHP, Kursus VueJS, Kursus Git, Kursus Pemrograman, Kursus Koding, Kursus Membuat Web, Kursus Web Development, Training Laravel, Training PHP, Training VueJS, Training Git, Kursus Koding Karawang, Kursus Koding Cikarang, Kursus Koding Bekasi, Kursus Laravel Karawang, Kursus Laravel Cikarang, Kursus Laravel Bekasi, Kursus VueJS Karawang, Kursus VueJS Surabaya, Kursus VueJS Bekasi, Kursus Programming Karawang, Kursus Programming Surabaya, Kursus Android Karawang, Kursus Android Surabaya, Kursus Web Karawang, Kursus Web Surabaya, Kursus Web Bekasi, Kursus PHP Karawang, Kursus PHP Surabaya, Kursus PHP Bekasi, Kursus Website Karawang, Kursus Website Surabaya, Kursus Website Bekasi, Kursus Laravel Murah, Kursus PHP Murah, Kursus VueJS Murah",
            'image' => $latestPost->image,

        ]);
    }
}
