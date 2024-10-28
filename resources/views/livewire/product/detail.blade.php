<div>
    {{-- Do your work, then step back. --}}
    <header class="w-full pt-[74px] pb-[103px] relative z-0">
        <div class="container max-w-[1130px] mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center justify-center z-10">
            <div class="flex flex-col gap-4 mt-7 z-10">
                <p class="bg-[#2A2A2A] font-semibold text-belibang-grey rounded-[4px] p-[8px_16px] w-fit">{{ ucwords($product->category) }}</p>
                <h1 class="font-semibold text-[55px]">{{ $product->name }}</h1>
            </div>
        </div>        
        <div class="background-image w-full h-full absolute top-0 overflow-hidden z-0">
            <img src="{{ Storage::url($product->image) }}" class="w-full h-full object-cover" alt="hero image">
        </div>
        <div class="w-full h-1/3 absolute bottom-0 bg-gradient-to-b from-belibang-black/0 to-belibang-black z-0"></div>
        <div class="w-full h-full absolute top-0 bg-belibang-black/95 z-0"></div>
    </header>

    <section id="DetailsContent" class="container max-w-[1130px] mx-auto mb-[32px] relative -top-[70px] px-5">
        <div class="flex flex-col gap-8">
            <div class="w-full max-w-[1130px] h-auto md:h-[500px] flex shrink-0 rounded-[20px] overflow-hidden">
                <img src="{{ Storage::url($product->image) }}" class="w-full h-full object-cover" alt="hero image">
            </div>            
            <div class="flex flex-col md:flex-row gap-8 relative -mt-[93px]">
                <div class="flex flex-col p-[30px] gap-5 bg-[#181818] rounded-[20px] w-full md:w-[700px] shrink-0 mt-[90px] h-fit">
                    <div class="flex flex-col gap-4">
                        <p class="font-semibold text-xl">Overview</p>
                        <p class="text-belibang-grey leading-[30px]">{!! $product->overview !!}</p>
                    </div>
                </div>
                <div class="flex flex-col w-full md:w-[366px] gap-[30px] flex-nowrap overflow-y-visible pe-4">
                    <div class="p-[2px] bg-img-purple-to-orange rounded-[20px] flex w-full h-fit">
                        <div class="w-full p-[28px] bg-[#181818] rounded-[20px] flex flex-col gap-[26px]">
                            <div class="flex flex-col gap-3">
                                <div class="relative">
                                    <p class="font-semibold text-sm bg-clip-text line-through text-red-500 absolute top-0 right-0 z-10">
                                        Rp. {{ number_format($product->price * 4, 0, ',', '.') }}
                                    </p>
                                    <p class="font-semibold text-4xl bg-clip-text text-transparent bg-gradient-to-r from-[#B05CB0] to-[#FCB16B]">
                                        Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                                </div>
                                <div class="flex flex-col gap-[10px]">
                                    <div class="flex items-center gap-[10px]">
                                        <div class="w-4 h-4 flex shrink-0">
                                            <img src="{{ asset('images/icons/check.svg') }}" alt="icon">
                                        </div>
                                        <p class="text-belibang-grey">100% Original Content</p>
                                    </div>
                                    <div class="flex items-center gap-[10px]">
                                        <div class="w-4 h-4 flex shrink-0">
                                            <img src="{{ asset('images/icons/check.svg') }}" alt="icon">
                                        </div>
                                        <p class="text-belibang-grey">Lifetime Support</p>
                                    </div>
                                    <div class="flex items-center gap-[10px]">
                                        <div class="w-4 h-4 flex shrink-0">
                                            <img src="{{ asset('images/icons/check.svg') }}" alt="icon">
                                        </div>
                                        <p class="text-belibang-grey">High-Performance Code</p>
                                    </div>
                                    <div class="flex items-center gap-[10px]">
                                        <div class="w-4 h-4 flex shrink-0">
                                            <img src="{{ asset('images/icons/check.svg') }}" alt="icon">
                                        </div>
                                        <p class="text-belibang-grey">Customizable Themes</p>
                                    </div>
                                    <div class="flex items-center gap-[10px]">
                                        <div class="w-4 h-4 flex shrink-0">
                                            <img src="{{ asset('images/icons/check.svg') }}" alt="icon">
                                        </div>
                                        <p class="text-belibang-grey">Responsive Design</p>
                                    </div>
                                    <div class="flex items-center gap-[10px]">
                                        <div class="w-4 h-4 flex shrink-0">
                                            <img src="{{ asset('images/icons/check.svg') }}" alt="icon">
                                        </div>
                                        <p class="text-belibang-grey">Comprehensive Documentation</p>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('product.checkout', $product->slug) }}"
                                class="bg-[#2D68F8] text-center font-semibold p-[12px_20px] rounded-full hover:bg-[#083297] active:bg-[#062162] transition-all duration-300">Checkout</a>
                        </div>
                    </div>
                    <div class="w-full p-[30px] bg-[#181818] rounded-[20px] flex flex-col gap-4 h-fit">
                        <div class="flex justify-between items-center">
                            <div class="flex gap-3 items-center">
                                <div class="w-12 h-12 rounded-full overflow-hidden flex shrink-0">
                                    <img src="{{ Storage::url($product->user->profile_photo_path) }}" alt="icon">
                                </div>
                                <div class="flex flex-col gap-[2px]">
                                    <p class="font-semibold">{{ $product->user->name }}</p>
                                    <p class="text-[#595959] text-sm leading-[18px]">
                                        <span class="font-semibold mr-1">{{ $userProductCount }}</span>
                                        Product
                                    </p>
                                </div>
                            </div>
                        </div>
                        <p class="text-sm leading-[24px] text-belibang-grey">{{ $product->user->about_me}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
