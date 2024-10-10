@extends('layouts.main')
@section('content')

<section class="pt-[120px] pb-[20px]">
    <div class="container max-w-[1130px] mx-auto flex flex-col items-center justify-center gap-[34px] z-10 px-3">
        @livewire('front.post', [ 'post' => $post, 'postCount' => $postCount])
    </div>
</section>

@endsection