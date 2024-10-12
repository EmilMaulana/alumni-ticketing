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
    {{-- icon --}}
    <link rel="icon" href="{{ asset('images/logos/logo_1.png') }}" width="250px;" type="image/png">
    
    @stack('before-style')
    <link href="{{asset('css/output.css')}}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    @stack('after-style')
    <title>{{ $title ?? 'TEKNIK REKAYASA' }}</title>
</head>

<body class="bg-belibang-black font-poppins text-white">
    {{-- navbar --}}
    <nav class="w-full fixed top-0 bg-[#00000010] backdrop-blur-lg z-10">
        <div class="container max-w-[1130px] mx-auto flex items-center justify-between h-[74px] px-3">
            <a href="/" class="flex items-center gap-2">
                <img src="{{asset('images/logos/logo_1.png')}}" alt="logo" class="w-[40px] h-auto">
                <span class="font-semibold">TEKNIK REKAYASA</span>
            </a>
            <div class="flex items-center gap-[26px]">
                <!-- Menu -->
                <ul id="menu" class="hidden lg:flex gap-6 items-center">
                    <li class="text-belibang-grey hover:text-belibang-light-grey transition-all duration-300">
                        <a href="/">Beranda</a>
                    </li>
                    <li class="text-belibang-grey hover:text-belibang-light-grey transition-all duration-300">
                        <a href="/posts">Artikel</a>
                    </li>
                    <li class="relative">
                        <button id="menu-button" class="text-belibang-grey hover:text-belibang-light-grey transition-all duration-300 flex items-center gap-1">
                            <span>Kelas</span>
                            <img src="{{asset('images/icons/arrow-down.svg')}}" alt="icon">
                        </button>
                        <div class="dropdown-menu hidden absolute top-[52px] w-[526px] rounded-[20px] bg-[#1E1E1E] p-4 gap-[10px] grid grid-cols-2 z-10">
                            <!-- Dropdown items -->
                            <div class="flex justify-between items-center rounded-2xl p-[12px_16px] border border-[#414141] hover:bg-[#2A2A2A] transition-all duration-300">
                                <a href="/" class="flex items-center">
                                    <img src="{{asset('images/ic_course.svg')}}" alt="icon" class="w-[58px]">
                                    <span>SEGERA HADIR</span>
                                </a>
                            </div>
                            <!-- Repeat for other Kelas -->
                        </div>
                    </li>
                    <li class="w-full">
                        <a href="{{ route('front.category') }}" class="block w-full text-left text-belibang-grey hover:text-white py-2">Kategori</a>
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
            <li class="text-belibang-grey hover:text-belibang-light-grey transition-all duration-300 pb-1">
                <a href="/posts">Artikel</a>
            </li>
            <hr class="py-2">
            <li class="w-full relative pb-1">
                <button id="menu-kelas-btn" class="text-belibang-grey hover:text-belibang-light-grey transition-all duration-300 flex items-center gap-1">
                    <span>Kelas</span>
                    <img src="{{asset('images/icons/arrow-down.svg')}}" alt="icon">
                </button>
                <div id="menu-kelas-dropdown" class="dropdown-menu hidden absolute top-[52px] w-[526px] rounded-[20px] bg-[#1E1E1E] p-4 gap-[10px] grid grid-cols-2 z-10">
                    <!-- Dropdown items -->
                    <div class="flex justify-between items-center rounded-2xl p-[12px_16px] border border-[#414141] hover:bg-[#2A2A2A] transition-all duration-300">
                        <a href="/" class="flex items-center">
                            <img src="{{asset('images/ic_course.svg')}}" alt="icon" class="w-[48px]">
                            <span>SEGERA HADIR</span>
                        </a>
                    </div>
                    <!-- Repeat for other Kelas -->
                </div>
            </li>
            <hr class="py-2">
            <li class="w-full pb-1">
                <a href="{{ route('front.category') }}" class="block w-full text-left text-belibang-grey hover:text-white py-2">Kategori</a>
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
        document.getElementById('menu-kelas-btn').addEventListener('click', function() {
            const dropdownMenu = document.getElementById('menu-kelas-dropdown');
            dropdownMenu.classList.toggle('hidden');
        });

        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
    
        menuToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    
    </script>
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
        document.addEventListener('DOMContentLoaded', function () {
            const menuButton = document.getElementById('menu-button');
            const dropdownMenu = document.querySelector('.dropdown-menu');
    
            menuButton.addEventListener('click', function () {
                dropdownMenu.classList.toggle('hidden');
            });
    
            // Close the dropdown menu when clicking outside of it
            document.addEventListener('click', function (event) {
                const isClickInside = menuButton.contains(event.target) || dropdownMenu.contains(event.target);
                if (!isClickInside) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        });
    </script>
    <script src="https://kit.fontawesome.com/f1ecbb1f89.js" crossorigin="anonymous"></script>
</body>
</html>