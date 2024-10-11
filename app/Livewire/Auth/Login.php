<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session; // Import untuk session

class Login extends Component
{
    public LoginForm $form;
    // Define validation rules for the form
    protected $rules = [
        'form.email' => 'required|email',
        'form.password' => 'required|min:6',
    ];

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        // Validate form input
        $this->validate();

        // Authenticate the user
        $this->form->authenticate();

        // Regenerate session and redirect to dashboard
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false));
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
