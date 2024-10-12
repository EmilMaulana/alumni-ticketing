<div>
    <div
    class="gap-y-16 grid grid-cols-1 lg:grid-cols-2 max-w-7xl mx-auto gap-x-10 xl:gap-x-28 px-6 pt-10 sm:px-10 sm:py-20 xl:py-20 items-center">
        <div class="bg-gray-800 border-gray-700 px-6 py-6 sm:p-10 rounded-2xl my-20">
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                Terima kasih telah mendaftar! 
                <br>
                <br>
                Sebelum memulai, apakah Kamu bisa memverifikasi alamat email Kamu dengan mengklik tautan yang baru saja kami kirimkan ke email Kamu?
                <br>
                <br>
                Jika Kamu tidak menerima email tersebut, kami dengan senang hati akan mengirimkan yang lain.
            </div>
        
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                    Tautan verifikasi baru telah dikirim ke alamat email yang Kamu berikan saat pendaftaran.
                </div>
            @endif
        
            <div class="mt-4 flex items-center justify-between">
                <x-primary-button wire:click="sendVerification">
                    Kirim Ulang Email Verifikasi
                </x-primary-button>
            </div>
        </div>
        <img src="{{ asset('images/emails-pana.svg') }}" alt="" class="w-full h-auto object-cover">
    </div>
</div>