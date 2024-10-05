@extends('layouts.dashboard')
@section('content')
    @livewire('posts.posts-update', ['post' => $post])
@endsection