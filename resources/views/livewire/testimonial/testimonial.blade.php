<div>
    {{-- Do your work, then step back. --}}
    @if (session()->has('success'))
            <div class="flex items-center p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Success</span>
                <div>
                    <span class="font-medium">Success!</span> {{ session('success') }}
                </div>
            </div>
        @endif
    <div class="container mx-auto flex flex-col md:flex-row gap-6">
        
        <!-- Form Section (Lebih kecil dari tabel) -->
        <form wire:submit.prevent="store" class="md:basis-1/3 px-7 py-10 bg-white shadow-md rounded-lg">
            @csrf
            <div class="mb-4">
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900">
                    Write Testimonial
                </label>
                <textarea wire:model="body" rows="8"
                    class="block w-full p-3 text-sm text-gray-900 bg-gray-100 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Leave a testimonial..."></textarea>
                <!-- Menampilkan pesan error jika body tidak valid -->
                @error('body')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex justify-end">
                <button type="submit"
                    class="px-4 py-2 text-white bg-violet-700 rounded-lg shadow-md hover:bg-red-700 focus:ring-4 focus:ring-blue-500">
                    Submit
                </button>
            </div>
        </form>
        
    
        <!-- Table Section (Lebih besar dari form) -->
        <div class="md:basis-2/3 overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 shadow-md rounded-lg">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Testimonial
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($testimonials as $testimonial)
                        <tr class="bg-white border-b">
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $testimonial->body }} <!-- Menampilkan isi testimonial -->
                            </td>
                            <td class="px-6 py-4">
                                <button wire:click="delete({{ $testimonial->id }})" data-modal-target="update-modal" data-modal-show="update-modal"
                                    class="block text-white font-medium rounded-full text-sm px-3 py-2 text-center bg-violet-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-4 text-center text-gray-500">
                                No testimonials found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>        
    </div>
    <div class="container">
        <section class="rounded-lg shadow bg-gray-50 antialiased my-5">
            <div class="max-w-screen-xl px-4 mx-auto py-8">
                <div class="max-w-3xl mx-auto text-center">
                    <h2 class="text-3xl font-bold leading-tight tracking-tight text-gray-800">
                        Aktifitas Saya
                    </h2>
                    <p class="mt-2 text-sm text-gray-500">
                        Lihat perjalanan dan aktivitasmu di platform kami
                    </p>
                </div>
    
                <div class="flow-root max-w-3xl mx-auto my-10">
                    <div class="divide-y divide-gray-200">
                        <!-- Item Aktifitas -->
                        <div class="flex items-start gap-4 py-6">
                            <div class="flex-shrink-0 w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-plus text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-800">
                                    Bergabung
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    Kamu bergabung pada <strong>{{ Auth::user()->created_at->toDateTimeString() }}</strong>
                                </p>
                            </div>
                        </div>
                        @if ($checkedTransaction)
                            <div class="flex items-start gap-4 py-6">
                                <!-- Ikon Kehadiran -->
                                <div class="flex-shrink-0 w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-check-circle text-xl"></i>
                                </div>
                                <!-- Detail Kehadiran -->
                                <div class="flex-1">
                                    <h4 class="text-lg font-medium text-gray-800">
                                        Kehadiran Dikonfirmasi
                                    </h4>
                                    <h4 class=" font-medium text-gray-800">
                                        {{ $checkedTransaction->product->name }}
                                    </h4>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Status diubah menjadi <strong>Hadir</strong> pada 
                                        <strong>{{ $checkedTransaction->check->updated_at->toDateTimeString() }}</strong>
                                    </p>
                                </div>
                            </div>
                        @endif

                        <!-- Daftar Transaksi -->
                        @foreach ($transactions as $transaction)
                            <div class="flex items-start gap-4 py-6">
                                <div class="flex-shrink-0 w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-shopping-cart text-xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-medium text-gray-800">
                                        Transaksi: {{ $transaction->order_id }}
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Status: 
                                        <strong>{{ ucfirst($transaction->status) }}</strong>
                                        <br>
                                        Waktu Transaksi: 
                                        <strong>{{ $transaction->created_at->toDateTimeString() }}</strong>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>    
</div>
