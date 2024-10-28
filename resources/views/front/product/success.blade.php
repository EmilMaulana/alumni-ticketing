@extends('layouts.main')

@section('content')
    <div class="flex justify-center items-center min-h-screen bg-gray-900">
        <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg text-center transform transition-transform duration-300 hover:scale-105">
            <div class="flex items-center justify-center mb-6">
                <svg class="w-16 h-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m0 4v6a2 2 0 01-2 2H7a2 2 0 01-2-2v-6a2 2 0 012-2h4" />
                </svg>
            </div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">Pembayaran Berhasil!</h2>
            <p class="text-gray-600 mb-4">Terima kasih telah menyelesaikan pembayaran. Pesanan kamu sedang diproses, dan kami akan segera mengirimkan detailnya.</p>
            <p class="text-sm text-gray-500">Halaman ini akan otomatis menutup dalam beberapa saat...</p>
        </div>
    </div>
@endsection

<script>
    // Timer dalam milidetik (5000 untuk 5 detik)
    setTimeout(function() {
        // Ganti URL berikut dengan rute yang diinginkan setelah redirect
        window.location.href = "{{ route('transactions.list') }}"; 
    }, 3000); // Waktu dalam milidetik (5000ms = 5 detik)
</script>
