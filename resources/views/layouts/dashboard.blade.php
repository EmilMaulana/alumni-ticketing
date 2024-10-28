<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/f1ecbb1f89.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
    {{-- icon --}}
    <link rel="icon" href="{{ asset('images/logos/logo_1.png') }}" width="250px;" type="image/png">
    @livewireStyles
</head> 

<body class="font-['Poppins'] bg-[#f5f5f5]">

    <!-- menu on navbar mobile view -->
    <div class="flex flex-row justify-between lg:hidden bg-white p-5">
        <div class="logo flex flex-row justify-center items-center gap-x-2">
            <svg id="logo-85" width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="ccustom" fill-rule="evenodd" clip-rule="evenodd"
                    d="M10 0C15.5228 0 20 4.47715 20 10V0H30C35.5228 0 40 4.47715 40 10C40 15.5228 35.5228 20 30 20C35.5228 20 40 24.4772 40 30C40 32.7423 38.8961 35.2268 37.1085 37.0334L37.0711 37.0711L37.0379 37.1041C35.2309 38.8943 32.7446 40 30 40C27.2741 40 24.8029 38.9093 22.999 37.1405C22.9756 37.1175 22.9522 37.0943 22.9289 37.0711C22.907 37.0492 22.8852 37.0272 22.8635 37.0051C21.0924 35.2009 20 32.728 20 30C20 35.5228 15.5228 40 10 40C4.47715 40 0 35.5228 0 30V20H10C4.47715 20 0 15.5228 0 10C0 4.47715 4.47715 0 10 0ZM18 10C18 14.4183 14.4183 18 10 18V2C14.4183 2 18 5.58172 18 10ZM38 30C38 25.5817 34.4183 22 30 22C25.5817 22 22 25.5817 22 30H38ZM2 22V30C2 34.4183 5.58172 38 10 38C14.4183 38 18 34.4183 18 30V22H2ZM22 18V2L30 2C34.4183 2 38 5.58172 38 10C38 14.4183 34.4183 18 30 18H22Z"
                    fill="#5417D7"></path>
            </svg>
            <a href="/" class="font-bold logo text-2xl text-indigo-950">
                Teknik Rekayasa
            </a>
        </div>
        <a href="#" id="btn-dropdown" class="flex flex-row items-center p-2 border border-gray-300 rounded-full">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 7H21" stroke="#292D32" stroke-width="2" stroke-linecap="round" />
                <path d="M3 12H21" stroke="#292D32" stroke-width="2" stroke-linecap="round" />
                <path d="M3 17H21" stroke="#292D32" stroke-width="2" stroke-linecap="round" />
            </svg>



        </a>
    </div>
    <!-- end menu mobile -->

    <!-- floating menu navigation on mobile -->
    <div id="dropdown-menu"
        class="lg:hidden hidden flex fixed  flex-col gap-y-16 absolute left-0 top-[160px] bg-white w-screen h-screen p-10 z-20">
        <div class="flex flex-col md:flex-row gap-x-24 gap-y-10">
            <div class="flex flex-col gap-y-4 ">
                <h6 class="text-sm text-gray-400 font-semibold">
                    GENERAL
                </h6>
                <ul class="flex flex-col gap-y-7">
                    <li>
                        <a href="{{ route('dashboard') }}" class="flex flex-row gap-x-2 font-semibold text-base {{ request()->routeIs('dashboard') ? 'text-violet-700' : 'text-indigo-950' }}">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z"
                                    stroke="#6d28d9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path opacity="0.44"
                                    d="M7.33008 14.4898L9.71008 11.3998C10.0501 10.9598 10.6801 10.8798 11.1201 11.2198L12.9501 12.6598C13.3901 12.9998 14.0201 12.9198 14.3601 12.4898L16.6701 9.50977"
                                    stroke="#6d28d9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            My Overview
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('posts.list') }}" class="flex flex-row gap-x-2 font-semibold text-base text-indigo-950 {{ request()->routeIs('posts.list', 'posts.create', 'posts.edit') ? 'text-violet-700' : 'text-indigo-950' }}">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16.6992 18.9799H7.29922C6.87922 18.9799 6.40922 18.6499 6.26922 18.2499L2.12922 6.66986C1.53922 5.00986 2.22922 4.49986 3.64922 5.51986L7.54922 8.30986C8.19922 8.75986 8.93922 8.52986 9.21922 7.79986L10.9792 3.10986C11.5392 1.60986 12.4692 1.60986 13.0292 3.10986L14.7892 7.79986C15.0692 8.52986 15.8092 8.75986 16.4492 8.30986L20.1092 5.69986C21.6692 4.57986 22.4192 5.14986 21.7792 6.95986L17.7392 18.2699C17.5892 18.6499 17.1192 18.9799 16.6992 18.9799Z"
                                    stroke="#292D32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path opacity="0.34" d="M6.5 22H17.5" stroke="#292D32" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path opacity="0.34" d="M9.5 14H14.5" stroke="#292D32" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                            Posts
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('transactions.list') }}" class="flex flex-row gap-x-2 font-semibold text-base text-indigo-950 {{ request()->routeIs('transactions.list') ? 'text-violet-700' : 'text-indigo-950' }}">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16.6992 18.9799H7.29922C6.87922 18.9799 6.40922 18.6499 6.26922 18.2499L2.12922 6.66986C1.53922 5.00986 2.22922 4.49986 3.64922 5.51986L7.54922 8.30986C8.19922 8.75986 8.93922 8.52986 9.21922 7.79986L10.9792 3.10986C11.5392 1.60986 12.4692 1.60986 13.0292 3.10986L14.7892 7.79986C15.0692 8.52986 15.8092 8.75986 16.4492 8.30986L20.1092 5.69986C21.6692 4.57986 22.4192 5.14986 21.7792 6.95986L17.7392 18.2699C17.5892 18.6499 17.1192 18.9799 16.6992 18.9799Z"
                                    stroke="#292D32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path opacity="0.34" d="M6.5 22H17.5" stroke="#292D32" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path opacity="0.34" d="M9.5 14H14.5" stroke="#292D32" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                            Transactions
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('order.list') }}" class="flex flex-row gap-x-2 font-semibold text-base text-indigo-950 {{ request()->routeIs('order.listt') ? 'text-violet-700' : 'text-indigo-950' }}">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16.6992 18.9799H7.29922C6.87922 18.9799 6.40922 18.6499 6.26922 18.2499L2.12922 6.66986C1.53922 5.00986 2.22922 4.49986 3.64922 5.51986L7.54922 8.30986C8.19922 8.75986 8.93922 8.52986 9.21922 7.79986L10.9792 3.10986C11.5392 1.60986 12.4692 1.60986 13.0292 3.10986L14.7892 7.79986C15.0692 8.52986 15.8092 8.75986 16.4492 8.30986L20.1092 5.69986C21.6692 4.57986 22.4192 5.14986 21.7792 6.95986L17.7392 18.2699C17.5892 18.6499 17.1192 18.9799 16.6992 18.9799Z"
                                    stroke="#292D32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path opacity="0.34" d="M6.5 22H17.5" stroke="#292D32" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path opacity="0.34" d="M9.5 14H14.5" stroke="#292D32" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                            My Order
                        </a>
                    </li>
                    @if ( Auth::user()->role_id == 3 )
                    <li>
                        <a href="{{ route('categories.list') }}" class="flex flex-row gap-x-2 font-semibold text-base {{ request()->routeIs('categories.list') ? 'text-violet-700' : 'text-indigo-950' }}">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.0008 22H16.0008C20.0208 22 20.7408 20.39 20.9508 18.43L21.7008 10.43C21.9708 7.99 21.2708 6 17.0008 6H7.0008C2.7308 6 2.0308 7.99 2.3008 10.43L3.0508 18.43C3.2608 20.39 3.9808 22 8.0008 22Z"
                                    stroke="#292D32" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path opacity="0.4" d="M8 6V5.2C8 3.43 8 2 11.2 2H12.8C16 2 16 3.43 16 5.2V6"
                                    stroke="#292D32" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <g opacity="0.4">
                                    <path
                                        d="M14 13V14C14 14.01 14 14.01 14 14.02C14 15.11 13.99 16 12 16C10.02 16 10 15.12 10 14.03V13C10 12 10 12 11 12H13C14 12 14 12 14 13Z"
                                        stroke="#292D32" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M21.65 11C19.34 12.68 16.7 13.68 14 14.02" stroke="#292D32"
                                        stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M2.61914 11.2695C4.86914 12.8095 7.40914 13.7395 9.99914 14.0295"
                                        stroke="#292D32" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </g>
                            </svg>
                            Post Category
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('product.list') }}" class="flex flex-row gap-x-2 font-semibold text-base {{ request()->routeIs('product.list') ? 'text-violet-700' : 'text-indigo-950' }}">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.0008 22H16.0008C20.0208 22 20.7408 20.39 20.9508 18.43L21.7008 10.43C21.9708 7.99 21.2708 6 17.0008 6H7.0008C2.7308 6 2.0308 7.99 2.3008 10.43L3.0508 18.43C3.2608 20.39 3.9808 22 8.0008 22Z"
                                    stroke="#292D32" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path opacity="0.4" d="M8 6V5.2C8 3.43 8 2 11.2 2H12.8C16 2 16 3.43 16 5.2V6"
                                    stroke="#292D32" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <g opacity="0.4">
                                    <path
                                        d="M14 13V14C14 14.01 14 14.01 14 14.02C14 15.11 13.99 16 12 16C10.02 16 10 15.12 10 14.03V13C10 12 10 12 11 12H13C14 12 14 12 14 13Z"
                                        stroke="#292D32" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M21.65 11C19.34 12.68 16.7 13.68 14 14.02" stroke="#292D32"
                                        stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M2.61914 11.2695C4.86914 12.8095 7.40914 13.7395 9.99914 14.0295"
                                        stroke="#292D32" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </g>
                            </svg>
                            Product
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="flex flex-col gap-y-4">
                <h6 class="text-sm text-gray-400 font-semibold">
                    OTHERS
                </h6>
                <ul class="flex flex-col gap-y-7">
                    <li>
                        <a href="{{ route('profile') }}" class="flex flex-row gap-x-2 font-semibold text-base text-indigo-950">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.34"
                                    d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                    stroke="#292D32" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M2 12.8799V11.1199C2 10.0799 2.85 9.21994 3.9 9.21994C5.71 9.21994 6.45 7.93994 5.54 6.36994C5.02 5.46994 5.33 4.29994 6.24 3.77994L7.97 2.78994C8.76 2.31994 9.78 2.59994 10.25 3.38994L10.36 3.57994C11.26 5.14994 12.74 5.14994 13.65 3.57994L13.76 3.38994C14.23 2.59994 15.25 2.31994 16.04 2.78994L17.77 3.77994C18.68 4.29994 18.99 5.46994 18.47 6.36994C17.56 7.93994 18.3 9.21994 20.11 9.21994C21.15 9.21994 22.01 10.0699 22.01 11.1199V12.8799C22.01 13.9199 21.16 14.7799 20.11 14.7799C18.3 14.7799 17.56 16.0599 18.47 17.6299C18.99 18.5399 18.68 19.6999 17.77 20.2199L16.04 21.2099C15.25 21.6799 14.23 21.3999 13.76 20.6099L13.65 20.4199C12.75 18.8499 11.27 18.8499 10.36 20.4199L10.25 20.6099C9.78 21.3999 8.76 21.6799 7.97 21.2099L6.24 20.2199C5.33 19.6999 5.02 18.5299 5.54 17.6299C6.45 16.0599 5.71 14.7799 3.9 14.7799C2.85 14.7799 2 13.9199 2 12.8799Z"
                                    stroke="#292D32" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            Profile
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="promotion-box w-fit">
            <div class="relative p-5 rounded-2xl bg-indigo-950 flex flex-col gap-y-5">
                <div class="bg-violet-700 rounded-full -top-5 w-fit absolute z-10 p-3">
                    <i class="fa-solid fa-gear text-white px-1"></i>
                </div>
                <div class="pt-5">
                    <h3 class="text-white text-lg font-semibold mb-2">Akhiri Sesi</h3>
                    <p class="text-gray-300 text-sm leading-relaxed">
                        Sampai Jumpa, {{ Auth::user()->name }}
                    </p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-center font-semibold px-5 bg-violet-700 text-white rounded-full py-2 text-base hover:bg-red-700"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
                </form>
            </div>
        </div>
    </div>
    <!-- end menu navigation -->

    <div class="flex flex-row justify-start">
        <div class="h-screen fixed left-sidebar flex-none bg-white py-6 px-4 w-[250px] lg:block hidden">
            <div class="flex flex-col justify-between h-full">
                <div class="logo flex flex-row justify-center items-center gap-x-2">
                    <svg id="logo-85" width="40" height="40" viewBox="0 0 40 40" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path class="ccustom" fill-rule="evenodd" clip-rule="evenodd"
                            d="M10 0C15.5228 0 20 4.47715 20 10V0H30C35.5228 0 40 4.47715 40 10C40 15.5228 35.5228 20 30 20C35.5228 20 40 24.4772 40 30C40 32.7423 38.8961 35.2268 37.1085 37.0334L37.0711 37.0711L37.0379 37.1041C35.2309 38.8943 32.7446 40 30 40C27.2741 40 24.8029 38.9093 22.999 37.1405C22.9756 37.1175 22.9522 37.0943 22.9289 37.0711C22.907 37.0492 22.8852 37.0272 22.8635 37.0051C21.0924 35.2009 20 32.728 20 30C20 35.5228 15.5228 40 10 40C4.47715 40 0 35.5228 0 30V20H10C4.47715 20 0 15.5228 0 10C0 4.47715 4.47715 0 10 0ZM18 10C18 14.4183 14.4183 18 10 18V2C14.4183 2 18 5.58172 18 10ZM38 30C38 25.5817 34.4183 22 30 22C25.5817 22 22 25.5817 22 30H38ZM2 22V30C2 34.4183 5.58172 38 10 38C14.4183 38 18 34.4183 18 30V22H2ZM22 18V2L30 2C34.4183 2 38 5.58172 38 10C38 14.4183 34.4183 18 30 18H22Z"
                            fill="#5417D7"></path>
                    </svg>
                    <a href="/" class="font-bold logo text-2xl text-indigo-950">
                        Teknik Rekayasa
                    </a>
                </div>
                <div class="flex flex-col gap-y-10">
                    <div class="flex flex-col gap-y-4">
                        <h6 class="text-sm text-gray-400 font-semibold">
                            GENERAL
                        </h6>
                        <ul class="flex flex-col gap-y-7">
                            <li>
                                <a href="{{ route('dashboard') }}" class="flex flex-row gap-x-2 font-semibold text-base {{ request()->routeIs('dashboard') ? 'text-violet-700' : 'text-indigo-950' }}">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z"
                                            stroke="#6d28d9" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path opacity="0.44"
                                            d="M7.33008 14.4898L9.71008 11.3998C10.0501 10.9598 10.6801 10.8798 11.1201 11.2198L12.9501 12.6598C13.3901 12.9998 14.0201 12.9198 14.3601 12.4898L16.6701 9.50977"
                                            stroke="#6d28d9" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    My Overview
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('posts.list') }}" class="flex flex-row gap-x-2 font-semibold text-base text-indigo-950 {{ request()->routeIs('posts.list', 'posts.create', 'posts.edit') ? 'text-violet-700' : 'text-indigo-950' }}">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.6992 18.9799H7.29922C6.87922 18.9799 6.40922 18.6499 6.26922 18.2499L2.12922 6.66986C1.53922 5.00986 2.22922 4.49986 3.64922 5.51986L7.54922 8.30986C8.19922 8.75986 8.93922 8.52986 9.21922 7.79986L10.9792 3.10986C11.5392 1.60986 12.4692 1.60986 13.0292 3.10986L14.7892 7.79986C15.0692 8.52986 15.8092 8.75986 16.4492 8.30986L20.1092 5.69986C21.6692 4.57986 22.4192 5.14986 21.7792 6.95986L17.7392 18.2699C17.5892 18.6499 17.1192 18.9799 16.6992 18.9799Z"
                                            stroke="#292D32" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path opacity="0.34" d="M6.5 22H17.5" stroke="#292D32" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path opacity="0.34" d="M9.5 14H14.5" stroke="#292D32" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                    Posts
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('transactions.list') }}" class="flex flex-row gap-x-2 font-semibold text-base text-indigo-950 {{ request()->routeIs('transactions.list') ? 'text-violet-700' : 'text-indigo-950' }}">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.6992 18.9799H7.29922C6.87922 18.9799 6.40922 18.6499 6.26922 18.2499L2.12922 6.66986C1.53922 5.00986 2.22922 4.49986 3.64922 5.51986L7.54922 8.30986C8.19922 8.75986 8.93922 8.52986 9.21922 7.79986L10.9792 3.10986C11.5392 1.60986 12.4692 1.60986 13.0292 3.10986L14.7892 7.79986C15.0692 8.52986 15.8092 8.75986 16.4492 8.30986L20.1092 5.69986C21.6692 4.57986 22.4192 5.14986 21.7792 6.95986L17.7392 18.2699C17.5892 18.6499 17.1192 18.9799 16.6992 18.9799Z"
                                            stroke="#292D32" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path opacity="0.34" d="M6.5 22H17.5" stroke="#292D32" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path opacity="0.34" d="M9.5 14H14.5" stroke="#292D32" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                    Transactions
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('order.list') }}" class="flex flex-row gap-x-2 font-semibold text-base text-indigo-950 {{ request()->routeIs('order.list') ? 'text-violet-700' : 'text-indigo-950' }}">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.6992 18.9799H7.29922C6.87922 18.9799 6.40922 18.6499 6.26922 18.2499L2.12922 6.66986C1.53922 5.00986 2.22922 4.49986 3.64922 5.51986L7.54922 8.30986C8.19922 8.75986 8.93922 8.52986 9.21922 7.79986L10.9792 3.10986C11.5392 1.60986 12.4692 1.60986 13.0292 3.10986L14.7892 7.79986C15.0692 8.52986 15.8092 8.75986 16.4492 8.30986L20.1092 5.69986C21.6692 4.57986 22.4192 5.14986 21.7792 6.95986L17.7392 18.2699C17.5892 18.6499 17.1192 18.9799 16.6992 18.9799Z"
                                            stroke="#292D32" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path opacity="0.34" d="M6.5 22H17.5" stroke="#292D32" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path opacity="0.34" d="M9.5 14H14.5" stroke="#292D32" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                    My Order
                                </a>
                            </li>
                            @if ( Auth::user()->role_id == 3 )
                            <li>
                                <a href="{{ route('categories.list') }}" class="flex flex-row gap-x-2 font-semibold text-base {{ request()->routeIs('categories.list') ? 'text-violet-700' : 'text-indigo-950' }}">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.0008 22H16.0008C20.0208 22 20.7408 20.39 20.9508 18.43L21.7008 10.43C21.9708 7.99 21.2708 6 17.0008 6H7.0008C2.7308 6 2.0308 7.99 2.3008 10.43L3.0508 18.43C3.2608 20.39 3.9808 22 8.0008 22Z"
                                            stroke="#292D32" stroke-width="2" stroke-miterlimit="10"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path opacity="0.4" d="M8 6V5.2C8 3.43 8 2 11.2 2H12.8C16 2 16 3.43 16 5.2V6"
                                            stroke="#292D32" stroke-width="2" stroke-miterlimit="10"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <g opacity="0.4">
                                            <path
                                                d="M14 13V14C14 14.01 14 14.01 14 14.02C14 15.11 13.99 16 12 16C10.02 16 10 15.12 10 14.03V13C10 12 10 12 11 12H13C14 12 14 12 14 13Z"
                                                stroke="#292D32" stroke-width="2" stroke-miterlimit="10"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M21.65 11C19.34 12.68 16.7 13.68 14 14.02" stroke="#292D32"
                                                stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M2.61914 11.2695C4.86914 12.8095 7.40914 13.7395 9.99914 14.0295"
                                                stroke="#292D32" stroke-width="2" stroke-miterlimit="10"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </g>
                                    </svg>
                                    Post Category
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('product.list') }}" class="flex flex-row gap-x-2 font-semibold text-base {{ request()->routeIs('product.list') ? 'text-violet-700' : 'text-indigo-950' }}">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.0008 22H16.0008C20.0208 22 20.7408 20.39 20.9508 18.43L21.7008 10.43C21.9708 7.99 21.2708 6 17.0008 6H7.0008C2.7308 6 2.0308 7.99 2.3008 10.43L3.0508 18.43C3.2608 20.39 3.9808 22 8.0008 22Z"
                                            stroke="#292D32" stroke-width="2" stroke-miterlimit="10"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path opacity="0.4" d="M8 6V5.2C8 3.43 8 2 11.2 2H12.8C16 2 16 3.43 16 5.2V6"
                                            stroke="#292D32" stroke-width="2" stroke-miterlimit="10"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <g opacity="0.4">
                                            <path
                                                d="M14 13V14C14 14.01 14 14.01 14 14.02C14 15.11 13.99 16 12 16C10.02 16 10 15.12 10 14.03V13C10 12 10 12 11 12H13C14 12 14 12 14 13Z"
                                                stroke="#292D32" stroke-width="2" stroke-miterlimit="10"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M21.65 11C19.34 12.68 16.7 13.68 14 14.02" stroke="#292D32"
                                                stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M2.61914 11.2695C4.86914 12.8095 7.40914 13.7395 9.99914 14.0295"
                                                stroke="#292D32" stroke-width="2" stroke-miterlimit="10"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </g>
                                    </svg>
                                    Product
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                    <div class="flex flex-col gap-y-4">
                        <h6 class="text-sm text-gray-400 font-semibold">
                            OTHERS
                        </h6>
                        <ul class="flex flex-col gap-y-7">
                            <li>
                                <a href="{{ route('profile') }}" wire:navigate class="flex flex-row gap-x-2 font-semibold text-base text-indigo-950">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.34"
                                            d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                            stroke="#292D32" stroke-width="2" stroke-miterlimit="10"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M2 12.8799V11.1199C2 10.0799 2.85 9.21994 3.9 9.21994C5.71 9.21994 6.45 7.93994 5.54 6.36994C5.02 5.46994 5.33 4.29994 6.24 3.77994L7.97 2.78994C8.76 2.31994 9.78 2.59994 10.25 3.38994L10.36 3.57994C11.26 5.14994 12.74 5.14994 13.65 3.57994L13.76 3.38994C14.23 2.59994 15.25 2.31994 16.04 2.78994L17.77 3.77994C18.68 4.29994 18.99 5.46994 18.47 6.36994C17.56 7.93994 18.3 9.21994 20.11 9.21994C21.15 9.21994 22.01 10.0699 22.01 11.1199V12.8799C22.01 13.9199 21.16 14.7799 20.11 14.7799C18.3 14.7799 17.56 16.0599 18.47 17.6299C18.99 18.5399 18.68 19.6999 17.77 20.2199L16.04 21.2099C15.25 21.6799 14.23 21.3999 13.76 20.6099L13.65 20.4199C12.75 18.8499 11.27 18.8499 10.36 20.4199L10.25 20.6099C9.78 21.3999 8.76 21.6799 7.97 21.2099L6.24 20.2199C5.33 19.6999 5.02 18.5299 5.54 17.6299C6.45 16.0599 5.71 14.7799 3.9 14.7799C2.85 14.7799 2 13.9199 2 12.8799Z"
                                            stroke="#292D32" stroke-width="2" stroke-miterlimit="10"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                    Settings
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="promotion-box">
                    <div class="relative p-5 rounded-2xl bg-indigo-950 flex flex-col gap-y-5">
                        <div class="bg-violet-700 rounded-full -top-5 w-fit absolute z-10 p-3">
                            <i class="fa-solid fa-gear text-white px-1"></i>
                        </div>
                        <div class="pt-5">
                            <h3 class="text-white text-lg font-semibold mb-2">Akhiri Sesi</h3>
                            <p class="text-gray-300 text-sm leading-relaxed">
                                Sampai Jumpa, {{ Auth::user()->name }}
                            </p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-center font-semibold px-5 bg-violet-700 text-white rounded-full py-2 text-base hover:bg-red-700"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-auto w-screen lg:pl-[250px]">
            <div class="w-full navbar bg-white py-4 px-7">
                <div class="flex flex-row justify-between">
                    <div class="relative w-full md:w-[500px]">
                        <form action="#">
                            <div class="-z-10">
                                <input type="text" placeholder="Search new report here"
                                    class="w-full py-3 rounded-full pl-5 pr-10 border border-gray-300">
                            </div>
                            <button
                                class="top-2 right-2 absolute z-10 flex flex-row items-center p-2 bg-violet-700 rounded-full">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.5 21C16.7467 21 21 16.7467 21 11.5C21 6.25329 16.7467 2 11.5 2C6.25329 2 2 6.25329 2 11.5C2 16.7467 6.25329 21 11.5 21Z"
                                        stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path opacity="0.4" d="M22 22L20 20" stroke="#fff" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>

                            </button>
                        </form>
                    </div>
                    <div class="user flex-row items-center gap-x-3 hidden md:flex">
                        <div class="flex flex-col text-right    ">
                            <h3 class="text-indigo-950 font-semibold text-base">
                                {{ Auth::user()->name }}
                            </h3>
                            <p class="text-gray-500 text-sm">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                        <img class="h-10 w-10 rounded-full object-cover me-2" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                </div>
            </div>
            {{-- conten --}}
            @yield('content')
            {{-- content --}}
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const btndropdown = document.getElementById('btn-dropdown');
            const dropdownmenu = document.getElementById('dropdown-menu');

            btndropdown.addEventListener("click", function () {
                dropdownmenu.classList.toggle("hidden");
            });

            document.addEventListener("click", function (event) {
                if (!btndropdown.contains(event.target) && !dropdownmenu.contains(event.target)) {
                    dropdownmenu.classList.add("hidden");
                }
            });
        });
    </script>
    <script>
        const userMenuButton = document.getElementById('user-menu-button');
        const dropdownMenu = document.getElementById('dropdown-menu');
    
        userMenuButton.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });
    
        // Optional: close the dropdown if clicked outside
        window.addEventListener('click', (e) => {
            if (!userMenuButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/super-build/ckeditor.js"></script>
    <script>
        const editorConfig = {
            toolbar: {
                items: [
                    'exportPDF', 'exportWord', '|',
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'textPartLanguage', '|',
                    'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            },
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                ]
            },
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            fontSize: {
                options: [10, 12, 14, 'default', 18, 20, 22],
                supportAllValues: true
            },
            htmlSupport: {
                allow: [
                    {
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }
                ]
            },
            htmlEmbed: {
                showPreviews: true
            },
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            mention: {
                feeds: [
                    {
                        marker: '@',
                        feed: [
                            '@apple', '@bears', '@brownie', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                            '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                            '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                            '@sugar', '@sweet', '@topping', '@wafer'
                        ],
                        minimumCharacters: 1
                    }
                ]
            },
            removePlugins: [
                'CKBox',
                'CKFinder',
                'EasyImage',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                'MathType ',
                'SlashCommand',
                'Template',
                'DocumentOutline',
                'FormatPainter',
                'TableOfContents',
                'PasteFromOfficeEnhanced'
            ]
        };
    
        CKEDITOR.ClassicEditor.create(document.getElementById("body"), editorConfig)
            .catch(error => {
                console.error(error);
            });
    
    </script>
    @livewireScripts
</body>

</html>