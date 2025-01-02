<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Pastikan untuk mengimpor model User
use Illuminate\Validation\Rules; // Pastikan untuk mengimpor rules
use Illuminate\Validation\ValidationException;

    class Register extends Component
    {
        public $name;
        public $email;
        public $wa;
        public $angkatan;
        public $jurusan;
        public $password;
        public $password_confirmation; // Tambahkan ini untuk konfirmasi password

    public function register(): void
    {
        // Konversi nomor WA terlebih dahulu
        $this->wa = $this->convertTo62($this->wa);

        // Validasi input
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'], // Pastikan table dan field yang benar
            'wa' => ['required', 'string', 'max:255', 'regex:/^(\+62|62|08)[0-9]{9,15}$/', 'unique:users,wa'],
            'jurusan' => ['required'],
            'angkatan' => ['required'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ], [
            // Pesan error dalam bahasa Indonesia
            'name.required' => 'Nama harus diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari :max karakter.',

            'email.required' => 'Alamat email harus diisi.',
            'email.string' => 'Alamat email harus berupa teks.',
            'email.lowercase' => 'Alamat email harus ditulis dengan huruf kecil.',
            'email.email' => 'Alamat email harus berupa email yang valid.',
            'email.max' => 'Alamat email tidak boleh lebih dari :max karakter.',
            'email.unique' => 'Alamat email sudah terdaftar.',

            'wa.required' => 'Nomor WhatsApp harus diisi.',
            'wa.string' => 'Nomor WhatsApp harus berupa teks.',
            'wa.max' => 'Nomor WhatsApp tidak boleh lebih dari :max karakter.',
            'wa.regex' => 'Format nomor WhatsApp tidak valid.',
            'wa.unique' => 'Nomor WhatsApp sudah terdaftar.',

            'angkatan.required' => 'Angkatan harus diisi.',
            'jurusan.required' => 'Jurusan harus diisi.',

            'password.required' => 'Kata sandi harus diisi.',
            'password.string' => 'Kata sandi harus berupa teks.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);


        // Konversi nomor WA menjadi format 62

        // Hash password sebelum menyimpannya
        $validated['password'] = Hash::make($validated['password']);

        // Buat pengguna baru
        event(new Registered($user = User::create($validated)));

        // Login pengguna yang baru terdaftar
        Auth::login($user);

        // Redirect ke halaman dashboard
        $this->redirect(route('dashboard'));
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
    
    public function render()
    {
        return view('livewire.auth.register');
    }
}

