<div>
    @if(Auth::check())
        <div class="mb-7">
            @if (session()->has('success'))
                <div class="mt-4 text-green-600">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="">
            <form wire:submit.prevent="submit" class="max-w-xl mx-auto">
                <!-- Field Deskripsi Produk -->
                <div class="mb-5">
                    <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Produk</label>
                    <textarea id="deskripsi" wire:model="deskripsi" rows="10" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan deskripsi produk"></textarea>
                    @error('deskripsi') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <!-- Field Nomor WhatsApp -->
                <div class="mb-5">
                    <label for="nomor-wa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor WhatsApp</label>
                    <input type="text" id="nomor-wa" wire:model="nomorWa" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan nomor WhatsApp Anda" />
                    @error('nomorWa') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>
        </div>
    @else
        <div class="text-center mt-10">
            <p class="text-lg">Anda harus <a href="{{ route('login') }}" class="text-blue-500 underline">login</a> untuk mengakses formulir ini.</p>
        </div>
    @endif
</div>
