<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public string $name = '';
    public string $email = '';
    public string $about_me = '';
    public $photo; // Properti untuk foto profil baru
    public $occupation; // Properti untuk foto profil baru
    public $wa; // Properti untuk foto profil baru
    public $angkatan; // Properti untuk foto profil baru
    public $jurusan; // Properti untuk foto profil baru

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->wa = $user->wa;
        $this->angkatan = $user->angkatan;
        $this->jurusan = $user->jurusan;
        $this->about_me = $user->about_me ?? '';
        $this->occupation = $user->occupation;
        // Tidak perlu mendeklarasikan profile_photo_path di sini
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation()
    {
        $user = Auth::user();

        // Konversi nomor WA terlebih dahulu
        $this->wa = $this->convertTo62($this->wa);

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'about_me' => ['required', 'string', 'max:255'],
            'wa' => ['required', 'string', 'max:255', 'regex:/^(\+62|62|08)[0-9]{9,15}$/', Rule::unique(User::class)->ignore($user->id)],
            'jurusan' => ['required'],
            'angkatan' => ['required'],
            'occupation' => ['required'],
            'photo' => ['nullable', 'image', 'max:2048'], // Validasi untuk foto
        ]);

        // Simpan foto profil jika ada
        if ($this->photo) {
            // Menghapus foto lama jika ada
            if ($user->profile_photo_path) {
                \Storage::disk('public')->delete($user->profile_photo_path);
            }

            // Simpan foto baru
            $path = $this->photo->store('profile-photos', 'public');
            $user->profile_photo_path = $path;
        }

        // Update informasi profil
        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    // Fungsi konversi nomor ke format 62
    private function convertTo62($value)
    {
        // Menghapus karakter selain angka
        $value = preg_replace('/[^0-9]/', '', $value);

        // Konversi sesuai format
        if (substr($value, 0, 2) === '0') {
            return '62' . substr($value, 2);
        } elseif (substr($value, 0, 3) === '062') {
            return '62' . substr($value, 3);
        } elseif (substr($value, 0, 1) === '0') {
            return '62' . substr($value, 1);
        }

        return $value;
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-900 ">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div>
            <x-input-label for="photo" :value="__('Profile Photo')" />
            <input type="file" wire:model="photo" id="photo" class="block mt-1 w-full">
            <x-input-error class="mt-2" :messages="$errors->get('photo')" />

            @if ($photo) {{-- Preview foto baru --}}
                <div class="mt-2">
                    <img src="{{ $photo->temporaryUrl() }}" alt="New Profile Photo" class="w-20 h-20 rounded-full object-cover">
                </div>
            @elseif (Auth::user()->profile_photo_path) {{-- Foto yang sudah ada --}}
                <div class="mt-2">
                    <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="Current Profile Photo" class="w-20 h-20 rounded-full object-cover">
                </div>
            @endif
        </div>

        <!-- WA -->
        <div>
            <x-input-label for="wa" :value="__('WhatsApp')" />
            <x-text-input wire:model="wa" id="wa" name="wa" type="text" class="mt-1 block w-full" required placeholder="Contoh: +6281234567890" />
            <x-input-error class="mt-2" :messages="$errors->get('wa')" />
        </div>

        <!-- Jurusan -->
        <div>
            <x-input-label for="jurusan" :value="__('Jurusan')" />
            <select wire:model="jurusan" id="jurusan" name="jurusan" class="px-2 py-2 mt-1 block w-full border-gray-300 rounded-lg">
                <option value="" disabled selected>Pilih Jurusan</option>
                <option value="TKRO">Teknik Kendaraan Ringan Otomotif (TKRO)</option>
                <option value="TKJ">Teknik Komputer dan Jaringan (TKJ)</option>
                <option value="RPL">Rekayasa Perangkat Lunak (RPL)</option>
                <option value="OTKP">Otomatisasi dan Tata Kelola Perkantoran (OTKP)</option>
                <option value="AKL">Akuntansi dan Keuangan Lembaga (AKL)</option>
                <option value="DPIB">Desain Pemodelan dan Informasi Bangunan (DPIB)</option>
                <option value="SK">Seni Kerajinan (SK)</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('jurusan')" />
        </div>

        <!-- Angkatan -->
        <div>
            <x-input-label for="angkatan" :value="__('Angkatan')" />
            <select wire:model="angkatan" id="angkatan" name="angkatan" class="px-2 py-2 mt-1 block w-full border-gray-300 rounded-lg">
                <option value="" disabled selected>Pilih Angkatan</option>
                @for ($year = 2003; $year <= now()->year; $year++)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endfor
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('angkatan')" />
        </div>
        
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button wire:click.prevent="sendVerification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
        <div>
            <x-input-label for="occupation" :value="__('Pekerjaan')" />
            <x-text-input wire:model="occupation" id="occupation" name="occupation" type="text" class="mt-1 block w-full"/>
            <x-input-error class="mt-2" :messages="$errors->get('occupation')" />
        </div>
        <div>
            <x-input-label for="about_me" :value="__('Deskripsi')" />
            {{-- <textarea wire:model="about_me" name="about_me" id="about_me" cols="30" rows="10" class="block p-2.5 w-full text-sm mt-1 " required autofocus autocomplete="about_me"></textarea> --}}
            <textarea wire:model="about_me" name="about_me" id="about_me" rows="10" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " placeholder="Write your thoughts here..."></textarea>
            {{-- <x-text-input wire:model="about_me" id="about_me" name="about_me" type="text" class="mt-1 block w-full" required autofocus autocomplete="about_me" /> --}}
            <x-input-error class="mt-2" :messages="$errors->get('about_me')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            <x-action-message class="me-3" on="profile-updated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>
</section>
