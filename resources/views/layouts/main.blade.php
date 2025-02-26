<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="belajar pemrograman, kursus pemrograman, bootcamp pemrograman, belajar coding, tutorial pemrograman, kelas online pemrograman, pemrograman web, belajar coding online, belajar HTML, belajar CSS, belajar JavaScript, belajar Python, belajar PHP, belajar Laravel, kursus Python, kursus JavaScript, kursus HTML, kursus CSS, belajar framework, tutorial Laravel, tutorial React, tutorial Vue, belajar full-stack development, kelas coding, kursus front-end, kursus back-end, kelas pemrograman online, programming bootcamp, kursus IT, belajar pemrograman dari nol, belajar web development, belajar mobile development, kursus aplikasi mobile, tutorial membuat website, kursus coding untuk pemula">
    <meta name="description" content="{{ $meta_desc ?? 'TEKNIK REKAYASA' }}">
    <meta property="og:title" content="{{ $title ?? 'TEKNIK REKAYASA' }}">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:description" content="{{ $meta_desc ?? 'TEKNIK REKAYASA' }}">
    <meta property="og:image" content="{{ $image ?? asset('images/logos/logo_1.png') }}">
    <meta name="google-site-verification" content="MTVEfS0FoMrmc-lB0X5F3ks_DcbFnlK0-NWLjNs01dg" />
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
    </script>
    

    {{-- icon --}}
    <link rel="icon" href="{{ asset('images/logos/logo_1.png') }}" width="250px;" type="image/png">
    
    @stack('before-style')
    <link href="{{asset('css/output.css')}}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    @stack('after-style')
    <title>{{ $title ?? 'WeOne' }}</title>
</head>

<body class="bg-belibang-black font-poppins text-white">
    {{-- navbar --}}
    <nav class="w-full fixed top-0 bg-[#00000010] backdrop-blur-lg z-10">
        <div class="container max-w-[1130px] mx-auto flex items-center justify-between h-[74px] px-3">
            <a href="/" class="flex items-center gap-2">
                <img src="{{asset('images/weone-light.png')}}" alt="logo" class="w-[180px] h-auto">
                {{-- <span class="font-semibold">TEKNIK REKAYASA</span> --}}
            </a>
            <div class="flex items-center gap-[26px]">
                <!-- Menu -->
                <ul id="menu" class="hidden lg:flex gap-6 items-center">
                    <li class="{{ request()->routeIs('index') ? 'text-white' : 'text-belibang-grey' }} hover:text-belibang-light-grey transition-all duration-300">
                        <a href="/">Beranda</a>
                    </li>
                    <li class="w-full">
                        <a href="{{ route('front.product') }}" class="block w-full text-left {{ request()->routeIs('front.product', 'product.detail', 'product.checkout') ? 'text-white' : 'text-belibang-grey' }} hover:text-white py-2">Agenda</a>
                    </li>
                </ul>
            </div>
            <!-- Mobile Menu Button (Hamburger) -->
            <button class="block lg:hidden" id="menu-toggle">
                <img src="{{asset('images/icons/hamburger.svg')}}" alt="Menu" class="w-6 h-6">
            </button>
            <!-- Desktop Auth Links -->
            <div class="hidden lg:flex gap-6 items-center">
                @guest
                <a href="{{ route('login') }}" class="text-belibang-grey hover:text-belibang-light-grey transition-all duration-300">Sign In</a>
                <a href="{{ route('register') }}" class="p-[8px_16px] text-white rounded-[12px] hover:bg-[#2A2A2A] hover:text-white transition-all duration-300 bg-violet-700">Sign up</a>
                @endguest
                @auth
                    <a href="{{ route('dashboard') }}" class="p-[8px_16px] text-white rounded-[12px] hover:bg-[#2A2A2A] hover:text-white transition-all duration-300 bg-violet-700">My Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="p-[8px_16px] border border-belibang-dark-grey text-belibang-grey rounded-[12px] hover:bg-[#2A2A2A] hover:text-white transition-all duration-300">Logout</button>
                    </form>
                @endauth
            </div>
        </div>
    
        <!-- Mobile Menu (Toggle Visibility) -->
        <ul id="mobile-menu" class="lg:hidden hidden flex-col items-start gap-4 p-6 bg-[#1E1E1E] text-white absolute top-[74px] w-full z-10 shadow-lg">
            <li class="w-full">
                <a href="/" class="block w-full text-left text-belibang-grey hover:text-white py-2 border-b border-belibang-dark-grey">Beranda</a>
            </li>
            <hr class="py-2">
            <li class="w-full pb-1">
                <a href="{{ route('front.product') }}" class="block w-full text-left text-belibang-grey hover:text-white py-2">Agenda</a>
            </li>
            <hr class="py-2">
            @guest
            <li class="mt-3">
                <a href="{{ route('login') }}" class="p-[8px_16px] text-white rounded-[12px] hover:bg-[#2A2A2A] hover:text-white transition-all duration-300 bg-violet-700">Sign In</a>
            </li>
            <li class="mt-6">
                <a href="{{ route('register') }}" class="p-[8px_16px] text-white rounded-[12px] hover:bg-[#2A2A2A] hover:text-white transition-all duration-300 bg-violet-700">Sign up</a>
            </li>
            @endguest
            @auth
            <li class="mt-3">
                <a href="{{ route('dashboard') }}" class="p-[8px_16px] text-white rounded-[12px] hover:bg-[#2A2A2A] hover:text-white transition-all duration-300 bg-violet-700">My Dashboard</a>
            </li>
            @endauth
        </ul>
    </nav>
    
    
    {{-- navbar --}}
    @yield('content')

    <x-footer/>

    
    @stack('before-script')
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    @stack('after-script')
    <script>
        const searchInput = document.getElementById('searchInput');
        const resetButton = document.getElementById('resetButton');
    
        searchInput.addEventListener('input', function () {
            if (this.value.trim() !== '') {
                resetButton.classList.remove('hidden');
            } else {
                resetButton.classList.add('hidden');
            }
        });
    
        resetButton.addEventListener('click', function () {
            resetButton.classList.add('hidden');
        });
    </script>
    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
    
        menuToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
    <script src="https://kit.fontawesome.com/f1ecbb1f89.js" crossorigin="anonymous"></script>
</body>
</html>