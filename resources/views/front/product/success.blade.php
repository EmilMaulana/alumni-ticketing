@extends('layouts.main')

@section('content')
    <div class="flex justify-center items-center min-h-screen bg-gray-900">
        <div class="max-w-md w-full bg-white p-6 rounded-lg shadow-md text-center">
            <div class="flex items-center justify-center mb-4">
                <svg class="w-16 h-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m0 4v6a2 2 0 01-2 2H7a2 2 0 01-2-2v-6a2 2 0 012-2h4" />
                </svg>
            </div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">Pembayaran Berhasil!</h2>
            <p class="text-gray-600 mb-4">Terima kasih telah melakukan pembayaran. Pesanan kamu sudah kami terima dan sedang diproses.</p>
            <a href="{{ url('/') }}" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Kembali ke Halaman Utama
            </a>
        </div>
    </div>
@endsection
