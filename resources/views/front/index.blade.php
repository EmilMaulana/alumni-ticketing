@extends('layouts.main')
@section('content')

<header
    class="w-full pt-[74px] pb-[34px] bg-[url('{{asset('images/backgrounds/technology.jpg')}}')] bg-cover bg-no-repeat bg-center relative z-0">
    <div class="container max-w-[1130px] mx-auto flex flex-col items-center justify-center gap-[34px] z-10 px-3">
        <div class="flex flex-col gap-2 text-center w-fit mt-20 z-10">
            <h1 class="font-semibold text-[45px] leading-[130%]">Platform
                belajar coding online <br> yang dirancang untuk pemula.</h1>
            <p class="text-lg text-belibang-grey">Pelajari HTML,
                CSS, JavaScript, PHP dan bahasa pemrograman lainnya dengan tutorial interaktif dan berbasis projek.</p>
        </div>
        <div class="flex w-full justify-center mb-[34px] z-10">
            <form action="" method="GET"
                class="group/search-bar p-[14px_18px] bg-belibang-darker-grey ring-1 ring-[#414141] hover:ring-[#888888] max-w-[560px] w-full rounded-full transition-all duration-300">
                <div class="relative text-left">
                    <button class="absolute inset-y-0 left-0 flex items-center">
                        <img src="{{asset('images/icons/search-normal.svg')}}" alt="icon">
                    </button>
                    <input name="keyword" type="text" id="searchInput"
                        class="bg-belibang-darker-grey w-full pl-[36px] focus:outline-none placeholder:text-[#595959] pr-9"
                        placeholder="Type anything to search..." />
                    <input name="keyword" type="reset" id="resetButton"
                        class="close-button hidden w-[38px] h-[38px] flex shrink-0 bg-[url('{{asset('images/icons/close.svg')}}')] hover:bg-[url('{{asset('images/icons/close-white.svg')}}')] transition-all duration-300 appearance-none transform -translate-x-1/2 -translate-y-1/2 absolute top-1/2 -right-5"
                        value="">
                </div>
            </form>
        </div>
    </div>
    <div class="w-full h-full absolute top-0 bg-gradient-to-b from-belibang-black/70 to-belibang-black z-0"></div>
</header>

<x-category/>

<section id="Testimonial" class="mb-[102px] flex flex-col gap-8">
    <div class="container max-w-[1130px] mx-auto flex justify-between items-center px-3">
        <h2 class="font-semibold text-[20px] ">Postingan Terbaru <br></h2>
        <div class="flex gap-[14px] items-center">
            <button class="btn-prev w-10 h-10 shrink-0 rounded-full overflow-hidden rotate-180">
                <img src="{{asset('/images/icons/circle-arrow-r.svg')}}" alt="icon">
            </button>
            <button class="btn-next w-10 h-10 shrink-0 rounded-full overflow-hidden">
                <img src="{{asset('/images/icons/circle-arrow-r.svg')}}" alt="icon">
            </button>
        </div>
    </div>
    <div class="w-full overflow-x-hidden no-scrollbar px-3">
        <div class="testi-carousel" data-flickity>
            <div class="flex w-[calc((100vw-1130px-20px)/2)] shrink-0"></div>
            {{-- card post --}}
            @foreach ($posts as $post)
                <a href="{{ route('front.post', $post->slug) }}">
                    <div
                        class="testimonial-card bg-[#181818] rounded-[20px] flex mr-5 w-[420px] h-[460px] shrink-0  mb-10">
                        <div
                            class="p-5 flex flex-col w-full gap-[42px] shrink-0 bg-[url('{{asset('/images/backgrounds/Testimonials-image.png')}}')] bg-contain bg-no-repeat bg-top">
                            <div class="flex flex-col gap-4">
                                <img class="w-full rounded-lg" src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}"/>
                                <div class="flex items-center ga-[6px]">
                                    <span class="bg-violet-700 text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded ">{{ $post->category->name }}</span>
                                    <span class="text-white text-sm"><i class="fas fa-eye"></i> {{ $post->views }} Views</span>
                                </div>
                                <p class="leading-[26px]">{{ $post->title }}</p>
                            </div>
                            <div class="flex gap-[10px] items-center">
                                <div class="w-12 h-12 flex shrink-0 rounded-full">
                                    <img src="{{ asset('storage/' . $post->user->profile_photo_path) }}" class="w-full h-full object-cover rounded-full"
                                        alt="photo">
                                </div>
                                <div class="flex flex-col justify-center-center">
                                    <p
                                        class="font-semibold text-left leading-[170%] bg-clip-text text-transparent bg-gradient-to-r from-[#B05CB0] to-[#FCB16B]">
                                        {{ $post->user->name }}
                                    </p>
                                    <p class="font-semibold text-left text-xs text-belibang-grey">
                                        {{ $post->created_at->isoFormat('D MMMM Y') }}
                                    </p>    
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@push('after-script')
<script>
    $('.testi-carousel').flickity({
        // options
        cellAlign: 'left',
        contain: true,
        pageDots: false,
        prevNextButtons: false,
    });

    // previous
    $('.btn-prev').on('click', function () {
        $('.testi-carousel').flickity('previous', true);
    });

    // next
    $('.btn-next').on('click', function () {
        $('.testi-carousel').flickity('next', true);
    });
</script>


@endpush