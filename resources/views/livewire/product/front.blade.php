<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <header class="w-full pt-20 pb-10 bg-[url({{ asset('images/backgrounds/hero-image.png') }})] bg-cover bg-no-repeat bg-center relative z-0">
        <div class="container max-w-[1130px] mx-auto flex flex-col items-center justify-center gap-8 z-10">
            <div class="flex flex-col gap-2 text-center w-fit mt-20 z-10">
                <h1 class="font-semibold text-4xl md:text-5xl lg:text-4xl leading-tight">Semua Produk</h1>
            </div>
        </div>
        <div class="w-full h-full absolute top-0 bg-gradient-to-b from-belibang-black/70 to-belibang-black z-0"></div>
    </header>
    <section id="NewProduct" class="container max-w-[1130px] mx-auto mb-24 mt-5 flex flex-col gap-8">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 px-3">
            @foreach ($products as $product)
                <a href="{{ route('product.detail', $product->slug) }}">
                    <div class="product-card flex flex-col rounded-lg bg-[#181818] overflow-hidden shadow-lg transition-transform transform hover:scale-105">
                        <div class="thumbnail w-full h-40 flex shrink-0 overflow-hidden relative">
                            <img src="{{ Storage::url($product->image) }}" class="w-full h-full object-cover" alt="thumbnail">
                        </div>
                        <div class="p-4 flex flex-col justify-between h-full">
                            <div class="flex flex-col gap-2">
                                <p class="font-semibold text-base line-clamp-2 hover:line-clamp-none">{{ $product->name }}</p>
                                <p class="bg-[#6525CE] font-semibold text-xs text-white rounded-md p-1 w-fit">{{ ucwords($product->category) }}</p>
                                <div class="relative py-2">
                                    <!-- Harga coret dengan ikon -->
                                    <p class="line-through text-red-500 text-sm flex items-center">
                                        <i class="fas fa-tag mr-1"></i> <!-- Ikon tag dari Font Awesome -->
                                        Rp {{ number_format($product->price * 4, 0, ',', '.') }}
                                    </p>
                                    <!-- Harga asli -->
                                    <p class="font-semibold text-base">
                                        <i class="fas fa-money-bill-wave mr-1"></i> <!-- Ikon uang dari Font Awesome -->
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
</div>
