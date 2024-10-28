@extends('layouts.main')

@section('content')
<div class="container mx-auto p-6 my-[120px]">
    <div class="bg-gray-900 shadow-md rounded-lg p-6">
        <!-- Detail Transaksi -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-4">Detail Transaksi</h2>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-600">ID Transaksi:</p>
                    <p class="font-medium">{{ $transaction->order_id }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Tanggal Transaksi:</p>
                    <p class="font-medium">{{ $transaction->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>
        </div>

        <!-- Detail Produk -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-4">Detail Produk</h2>
            <div class="flex items-center space-x-4">
                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" 
                    class="w-24 h-24 object-cover rounded-lg">
                <div>
                    <h3 class="font-medium">{{ $product->name }}</h3>
                    <p class="text-gray-600">{{ $product->description }}</p>
                    <p class="font-medium text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <!-- Informasi Pembayaran -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-4">Informasi Pembayaran</h2>
            <div class="bg-gray-50 p-4 rounded-lg">
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-600">Metode Pembayaran:</p>
                        <p class="font-medium text-gray-600">{{ ucfirst($transaction->payment_type) }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Total Pembayaran:</p>
                        <p class="font-medium text-gray-600">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Instruksi Pembayaran -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-4">Petunjuk Pembayaran</h2>
            <div class="bg-blue-50 p-4 rounded-lg">
                <ul class="list-disc list-inside space-y-2 text-sm text-gray-700">
                    <li>Mohon selesaikan pembayaran Anda dalam waktu 24 jam</li>
                    <li>Pembayaran akan diverifikasi secara otomatis oleh sistem</li>
                    <li>Setelah pembayaran terverifikasi, status akan berubah menjadi "Sukses"</li>
                    <li>Jika ada kendala, silakan hubungi customer service kami</li>
                </ul>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex space-x-4">
            <a href="{{ route('product.checkout', ['product' => $product->id]) }}" 
            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Beranda
            </a>
            
            @if($transaction->payment_instructions)
            <a href="{{ route('download.instructions', $transaction->id) }}" 
            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Download Instruksi
            </a>
            @endif
        </div>
    </div>
</div>

<script>
    // Fungsi untuk memeriksa status transaksi secara berkala
    setInterval(function() {
        fetch(`/api/check-transaction-status?order_id={{ $transaction->order_id }}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Jika status berhasil, arahkan pengguna ke halaman terima kasih
                    window.location.href = '/product/checkout/thank-you';
                }
            })
            .catch(error => console.error('Error:', error));
    }, 5000); // Poll setiap 5 detik
</script>
<script>
    // Fungsi untuk refresh halaman setiap 30 detik jika status masih pending
    @if($transaction->status === 'pending')
        setTimeout(function() {
            window.location.reload();
        }, 30000);
    @endif

    // Disable tombol setelah diklik untuk mencegah multiple submission
    document.querySelector('form').addEventListener('submit', function(e) {
        const button = this.querySelector('button[type="submit"]');
        button.disabled = true;
        button.innerHTML = 'Memverifikasi...';
    });
</script>
@endsection
