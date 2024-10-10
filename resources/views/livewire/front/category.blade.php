<div>
    <header class="w-full pb-[34px] bg-[url('{{asset('images/backgrounds/technology.jpg')}}')] bg-cover bg-center relative z-0">
        <div class="container max-w-[1130px] mx-auto flex flex-col items-center justify-center gap-[34px] z-10 px-3">
            <div class="flex flex-col gap-2 text-center w-fit mt-20 z-10">
                <h1 class="font-semibold text-[32px] md:text-[45px] leading-[130%]">Semua Kategori</h1>
            </div>
            <div class="flex w-full justify-center z-10">
                <form action="{{ route('search.index') }}"
                    class="group/search-bar p-[14px_18px] bg-belibang-darker-grey ring-1 ring-[#414141] hover:ring-[#888888] max-w-[560px] w-full rounded-full transition-all duration-300">
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if (request('user'))
                        <input type="hidden" name="user" value="{{ request('user') }}">
                    @endif
                    <div class="relative text-left">
                        <button type="submit" class="absolute inset-y-0 left-0 flex items-center">
                            <img src="{{asset('images/icons/search-normal.svg')}}" alt="icon">
                        </button>
                        <input name="search" value="{{ request('search') }}" type="text" id="search"
                            class="bg-belibang-darker-grey w-full pl-[36px] focus:outline-none placeholder:text-[#595959] pr-9"
                            placeholder="Type anything to search..." />
                        <input name="keyword" type="reset" id="resetButton"
                            class="close-button hidden w-[38px] h-[38px] flex shrink-0 bg-[url('{{asset('images/icons/close.svg')}}')] hover:bg-[url('{{asset('images/icons/close-white.svg')}}')] transition-all duration-300 appearance-none transform -translate-x-1/2 -translate-y-1/2 absolute top-1/2 -right-5">
                    </div>
                </form>
            </div>
        </div>
        <div class="w-full h-full absolute top-0 bg-gradient-to-b from-belibang-black/70 to-belibang-black z-0"></div>
    </header>
    
    <section id="NewProduct" class="container max-w-[1130px] mx-auto my-[50px] md:my-[102px] flex flex-col gap-8 px-5">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse($categoriess as $category)
                <div class="product-card flex flex-col rounded-[18px] bg-[#181818] overflow-hidden shadow-lg transition-all duration-300 hover:scale-105">
                    <a href="/posts?category={{ $category->slug }}" class="thumbnail w-full flex shrink-0 overflow-hidden relative">
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
