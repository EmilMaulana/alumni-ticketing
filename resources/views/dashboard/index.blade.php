@extends('layouts.dashboard')

@section('content')
    <section class="header px-7 pt-10">
        <div
            class="flex flex-col gap-y-5 md:flex-row md:items-center justify-start md:justify-between header-section w-full">
            <div class="title">
                <h1 class="text-2xl text-indigo-950 font-bold mb-1">
                    My Overview
                </h1>
            </div>
            <div class="flex flex-row gap-x-3">
            </div>
        </div>
    </section>
    @if (Auth::user()->role_id == 3)
        @livewire('statistic.statistic')
        <section class="header px-7 py-5">
            <div class="grid grid-cols-1 gap-4">
                @livewire('user.user-list')
                {{-- @livewire('dashboard.post-list') --}}
            </div>
        </section>
        <section class="header px-7 py-5">
            @livewire('dashboard.transactions-list')
        </section>
        {{-- <section class="header px-7 py-5">
            @livewire('product.check')
        </section> --}}
    @else
        <section class="header px-7 pt-10">
            <div class="flex flex-col gap-y-5 md:flex-row md:items-center justify-start md:justify-between header-section w-full">
                <div class="block w-full p-6 bg-violet-700 border border-gray-200 rounded-lg shadow ">
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Halo, Selamat datang {{ Auth::user()->name }}</h5>
                    <p class="font-normal text-white">Anda login sebagai <span style="text-transform: capitalize;">{{ Auth::user()->role->name }}</span></p>
                </div>
            </div>
        </section>
    @endif
    <section class="px-7 py-5">
        @livewire('testimonial.testimonial')
    </section>
@endsection