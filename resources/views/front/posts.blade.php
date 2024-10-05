@extends('layouts.main')

@section('content')
<section class="pt-[100px] pb-[20px]">
    <div class="container max-w-[1130px] mx-auto flex flex-col items-center justify-center gap-[34px] z-10 px-3">
        <header class="w-screen pb-[34px] bg-[url('{{asset('images/backgrounds/technology.jpg')}}')] bg-cover bg-no-repeat bg-center relative z-0">
            <div class="container max-w-[1130px] mx-auto flex flex-col items-center justify-center gap-[34px] z-10 px-3">
                <div class="flex flex-col gap-2 text-center w-fit mt-20 z-10">
                    <h1 class="font-semibold text-[45px] leading-[130%]">{{ $title }}</h1>
                </div>
            </div>
            <div class="w-full h-full absolute top-0 bg-gradient-to-b from-belibang-black/70 to-belibang-black z-0"></div>
        </header>
        <section id="NewProduct" class="container max-w-[1130px] mx-auto my-[102px] flex flex-col gap-8">
            {{-- <h2 class="font-semibold text-[22px]">Kategori Baru</h2> --}}
            <div class="grid grid-cols-3 gap-[22px]">
                @if($posts->count())
                    @foreach($posts as $post)
                        <div class="product-card flex flex-col rounded-[18px] bg-[#181818] overflow-hidden">
                            <a href="{{ route('front.post', $post->slug) }}" class="thumbnail w-full flex shrink-0 overflow-hidden relative">
                                <img src="{{Storage::url($post->image)}}" class="w-full h-full object-cover" alt="thumbnail">
                            </a>
                            <div class="p-[10px_14px_12px] h-full flex flex-col justify-between gap-[14px]">
                                <div class="flex flex-col gap-1">
                                    <a href="{{ route('front.post', $post->slug) }}" class="font-semibold line-clamp-2 hover:line-clamp-none">{{$post->title}}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-4">
                        {{ $posts->links() }}
                    </div>
                @else
                    <p>Tidak ada artikel yang ditemukan.</p>
                @endif
            </div>
        </section>
    </div>
</section>
@endsection
