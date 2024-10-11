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
    public $password;
    public $password_confirmation; // Tambahkan ini untuk konfirmasi password

    public function register(): void
    {
        // Validasi input
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'], // Pastikan table dan field yang benar
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // Hash password sebelum menyimpannya
        $validated['password'] = Hash::make($validated['password']);

        // Buat pengguna baru
        event(new Registered($user = User::create($validated)));

        // Login pengguna yang baru terdaftar
        Auth::login($user);

        // Redirect ke halaman dashboard
        $this->redirect(route('dashboard'));
    }
    
    public function render()
    {
        return view('livewire.auth.register');
    }
}

