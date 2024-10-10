@extends('layouts.dashboard')

@section('content')
    <section class="header px-7 pt-10">
        <div
            class="flex flex-col gap-y-5 md:flex-row md:items-center justify-start md:justify-between header-section w-full">
            <div class="title">
                <h1 class="text-2xl text-indigo-950 font-bold mb-1">
                    My Overview
                </h1>
                <p class="text-sm text-gray-500">
                    Lorem dolor reporting easier
                </p>
            </div>
            <div class="flex flex-row gap-x-3">

                <a href=""
                    class="md:w-fit w-full text-center px-7 rounded-full text-base py-3 font-semibold text-indigo-950 bg-white">
                    Filter
                </a>
                <a href=""
                    class="md:w-fit w-full text-center px-7 rounded-full text-base py-3 font-semibold text-white bg-violet-700">
                    Export Data
                </a>
            </div>
        </div>
    </section>
    @if (Auth::user()->role_id == 3)
        @livewire('user.user-list')
    @else
        <section class="header px-7 pt-10">
            <div class="flex flex-col gap-y-5 md:flex-row md:items-center justify-start md:justify-between header-section w-full">
                <div class="block w-full p-6 bg-violet-700 border border-gray-200 rounded-lg shadow ">
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Halo, Selamat datang {{ Auth::user()->name }}</h5>
                    <p class="font-normal text-white">Anda login sebagai <span style="text-transform: capitalize;">{{ Auth::user()->role->name }}</span></p>
                </div>
            </div>
        </section>
        <section class="px-7 py-10">
            @livewire('testimonial.testimonial')
        </section>
    @endif
@endsection