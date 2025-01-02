<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div
        class="gap-y-16 grid grid-cols-1 lg:grid-cols-2 max-w-7xl mx-auto gap-x-10 xl:gap-x-28 px-6 pt-10 sm:px-10 sm:py-20 xl:py-20 items-center">
        <div class="bg-white px-6 py-6 sm:p-10 rounded-2xl">
            <form wire:submit.prevent="register">
                <div class="flex flex-col gap-y-7">
                    <h3 class="xl:text-4xl md:text-3xl text-2xl text-indigo-950 font-bold leading-relaxed">
                        Sign Up 
                    </h3>
                    <div>
                        <p class="font-semibold text-indigo-950 text-base mb-2">
                            Nama Lengkap
                        </p>
                        <input wire:model="name" id="name"
                            class="w-full py-3 rounded-full pl-5 pr-10 border border-gray-300 text-indigo-950 font-semibold"
                            type="text" name="name" required autofocus>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <p class="font-semibold text-indigo-950 text-base mb-2">
                            Alamat Email
                        </p>
                        <input wire:model="email" id="email"
                            class="w-full py-3 rounded-full pl-5 pr-10 border border-gray-300 text-indigo-950 font-semibold"
                            type="email" name="email" required>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div>
                        <p class="font-semibold text-indigo-950 text-base mb-2">
                            No WhatsApp
                        </p>
                        <input wire:model="wa" id="wa"
                            class="w-full py-3 rounded-full pl-5 pr-10 border border-gray-300 text-indigo-950 font-semibold"
                            type="text" name="wa" required>
                        <x-input-error :messages="$errors->get('wa')" class="mt-2" />
                    </div>
                    <div>
                        <p class="font-semibold text-indigo-950 text-base mb-2">
                            Angkatan
                        </p>
                        <select wire:model="angkatan"
                            id="angkatan"
                            class="w-full py-3 rounded-full pl-5 pr-10 border border-gray-300 text-indigo-950 font-semibold"
                            name="angkatan"
                            required>
                            <option value="" disabled selected>Pilih Angkatan</option>
                            @foreach (range(2003, date('Y')) as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('angkatan')" class="mt-2" />
                    </div>
                    
                    <div>
                        <p class="font-semibold text-indigo-950 text-base mb-2">
                            Jurusan
                        </p>
                        <select wire:model="jurusan"
                            id="jurusan"
                            class="w-full py-3 rounded-full pl-5 pr-10 border border-gray-300 text-indigo-950 font-semibold"
                            name="jurusan"
                            required>
                            <option value="" disabled selected>Pilih Jurusan</option>
                            <option value="TKRO">Teknik Kendaraan Ringan Otomotif (TKRO)</option>
                            <option value="TKJ">Teknik Komputer dan Jaringan (TKJ)</option>
                            <option value="RPL">Rekayasa Perangkat Lunak (RPL)</option>
                            <option value="OTKP">Otomatisasi dan Tata Kelola Perkantoran (OTKP)</option>
                            <option value="AKL">Akuntansi dan Keuangan Lembaga (AKL)</option>
                            <option value="DPIB">Desain Pemodelan dan Informasi Bangunan (DPIB)</option>
                            <option value="SK">Seni Karawitan (SK)</option>
                        </select>
                        <x-input-error :messages="$errors->get('jurusan')" class="mt-2" />
                    </div>

                    
                    <div class="justify-end flex flex-col">
                        <p class="font-semibold text-indigo-950 text-base mb-2">
                            Password
                        </p>
                        <input wire:model="password" id="password"
                            class="w-full py-3 rounded-full pl-5 pr-10 border border-gray-300 text-indigo-950 font-semibold"
                            type="password" name="password" required autocomplete="new-password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="justify-end flex flex-col">
                        <p class="font-semibold text-indigo-950 text-base mb-2">
                            Confirm Password
                        </p>
                        <input wire:model="password_confirmation" id="password_confirmation"
                            class="w-full py-3 rounded-full pl-5 pr-10 border border-gray-300 text-indigo-950 font-semibold"
                            type="password" name="password_confirmation" required autocomplete="new-password">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
            
                    <div class="flex flex-col gap-y-4">
                        <button type="submit"
                            class="w-full text-center px-7 rounded-full text-base py-3 font-semibold text-white bg-violet-700">
                            Sign Up
                        </button>
                        {{-- <a href=""
                            class="w-full flex flex-row justify-center px-7 gap-x-2 items-center rounded-full text-base py-3 font-semibold text-indigo-950 border border-gray-300">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M21.6 10.2H12.2V13.9H17.7C17.6 14.8 17 16.2 15.7 17.1C14.9 17.7 13.7 18.1 12.2 18.1C9.59995 18.1 7.29995 16.4 6.49995 13.9C6.29995 13.3 6.19995 12.6 6.19995 11.9C6.19995 11.2 6.29995 10.5 6.49995 9.9C6.59995 9.7 6.59995 9.5 6.69995 9.4C7.59995 7.3 9.69995 5.8 12.2 5.8C14.1 5.8 15.3 6.6 16.1 7.3L18.9 4.5C17.1999 3 14.9 2 12.2 2C8.29995 2 4.89995 4.2 3.29995 7.5C2.59995 8.9 2.19995 10.4 2.19995 12C2.19995 13.6 2.59995 15.1 3.29995 16.5C4.89995 19.8 8.29995 22 12.2 22C14.9 22 17.1999 21.1 18.7999 19.6C20.6999 17.9 21.7999 15.3 21.7999 12.2C21.7999 11.4 21.7 10.8 21.6 10.2Z"
                                    stroke="#17191C" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            Sign in with Google
                        </a> --}}
                    </div>
                </div>
            </form>                        
        </div>
        <img src="{{ asset('images/register-amico.svg') }}" alt="" class="w-full h-auto object-cover">
    </div>
</div>
