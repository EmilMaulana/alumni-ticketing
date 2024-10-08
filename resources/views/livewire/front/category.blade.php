<div>
    <header class="w-full pb-[34px] bg-[url('{{asset('images/backgrounds/technology.jpg')}}')] bg-cover bg-center relative z-0">
        <div class="container max-w-[1130px] mx-auto flex flex-col items-center justify-center gap-[34px] z-10 px-3">
            <div class="flex flex-col gap-2 text-center w-fit mt-20 z-10">
                <h1 class="font-semibold text-[32px] md:text-[45px] leading-[130%]">Semua Kategori</h1>
            </div>
        </div>
        <div class="w-full h-full absolute top-0 bg-gradient-to-b from-belibang-black/70 to-belibang-black z-0"></div>
    </header>
    
    <section id="NewProduct" class="container max-w-[1130px] mx-auto my-[50px] md:my-[102px] flex flex-col gap-8 px-5">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse($categoriess as $category)
                <div class="product-card flex flex-col rounded-[18px] bg-[#181818] overflow-hidden shadow-lg transition-all duration-300 hover:scale-105">
                    <a href="/artikel?category={{ $category->slug }}" class="thumbnail w-full flex shrink-0 overflow-hidden relative">
                        <img src="{{Storage::url($category->image)}}" class="w-full h-full object-cover" alt="thumbnail">
                    </a>
                    <div class="p-4 h-full flex flex-col justify-between gap-3">
                        <div class="flex flex-col gap-1">
                            <a href="/artikel?category={{ $category->slug }}" class="font-semibold text-white hover:text-blue-500 line-clamp-2 hover:line-clamp-none">{{$category->name}}</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center col-span-full text-white">Belum ada kategori tersedia.</p>
            @endforelse
        </div>
    </section>    
        
</div>
