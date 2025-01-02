<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <header class="w-full pt-20 pb-10 bg-[url({{ asset('images/backgrounds/hero-image.png') }})] bg-cover bg-no-repeat bg-center relative z-0">
        <div class="container max-w-[1130px] mx-auto flex flex-col items-center justify-center gap-8 z-10">
            <div class="flex flex-col gap-2 text-center w-fit mt-20 z-10">
                <h1 class="font-semibold text-4xl md:text-5xl lg:text-4xl leading-tight">Semua Agenda   </h1>
            </div>
        </div>
        <div class="w-full h-full absolute top-0 bg-gradient-to-b from-belibang-black/70 to-belibang-black z-0"></div>
    </header>


    <!-- Daftar Produk dari Tabel Product -->
    <section id="NewProduct" class="container max-w-[1130px] mx-auto mb-24 mt-5">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 px-3">
            @foreach ($products as $product)
                <a href="{{ route('product.detail', $product->slug) }}">
                    <div class="product-card flex flex-col rounded-lg bg-[#181818] overflow-hidden shadow-lg transition-transform transform hover:scale-105">
                        <div class="thumbnail w-full h-40 flex shrink-0 overflow-hidden relative">
                            <img src="{{ Storage::url($product->image) }}" class="w-full h-full object-cover" alt="thumbnail">
                        </div>
                        <div class="p-4 flex flex-col justify-between h-full">
                            <div class="flex flex-col gap-2">
                                <p class="font-semibold text-base line-clamp-2 hover:line-clamp-none">{{ $product->name }}</p>
                                <p class="bg-[#6525CE] font-semibold text-xs text-white rounded-md py-1 px-2 w-fit">{{ ucwords($product->category) }}</p>
                                <div class="relative py-2 flex items-center">
                                    <!-- Harga coret dengan ikon -->
                                    <p class="line-through text-red-500 text-sm mr-4 blink">
                                        <i class="fas fa-tag mr-1"></i> <!-- Ikon tag dari Font Awesome -->
                                        Rp {{ number_format($product->price * 4, 0, ',', '.') }}
                                    </p>
                                    <!-- Harga asli -->
                                    <p class="font-semibold text-base">
                                        <i class="fas fa-money-bill-wave mr-1"></i> <!-- Ikon uang dari Font Awesome -->
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                </div>
                                <!-- Produk Terjual -->
                                <p class="text-xs text-gray-400">
                                    <i class="fas fa-shopping-cart mr-1"></i> <!-- Ikon cart dari Font Awesome -->
                                    Terjual: {{ $product->sold }} kali
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
    
    <style>
        .active-tab {
            border-bottom: 2px solid #6525CE; /* Warna untuk underline tab aktif */
            color: #6525CE; /* Warna teks untuk tab aktif */
            transition: border-bottom 0.3s ease, color 0.3s ease; /* Animasi */
        }
        @keyframes blink {
            0% {
                opacity: 1;
            }
            50% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        .blink {
            animation: blink 1s infinite;
        }

    </style>
</div>

<script>
    const showCustomProductFormBtn = document.getElementById('showCustomProductFormBtn');
    const showAllProductsBtn = document.getElementById('showAllProductsBtn');
    const customProductForm = document.getElementById('customProductForm');
    const newProductSection = document.getElementById('NewProduct');

    showCustomProductFormBtn.addEventListener('click', function() {
        customProductForm.classList.remove('hidden');
        newProductSection.classList.add('hidden');
        
        // Menambahkan kelas active-tab pada tab Custom Produk dan menghapusnya dari tab lain
        showCustomProductFormBtn.classList.add('active-tab');
        showAllProductsBtn.classList.remove('active-tab');
    });

    showAllProductsBtn.addEventListener('click', function() {
        customProductForm.classList.add('hidden');
        newProductSection.classList.remove('hidden');
        
        // Menambahkan kelas active-tab pada tab Produk Tersedia dan menghapusnya dari tab lain
        showAllProductsBtn.classList.add('active-tab');
        showCustomProductFormBtn.classList.remove('active-tab');
    });
</script>

