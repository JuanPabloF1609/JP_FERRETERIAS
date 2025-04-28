<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    public bool $showPassword = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }

    /**
     * Toggle the visibility of the password field.
     */
    public function togglePasswordVisibility(): void
    {
        $this->showPassword = !$this->showPassword;
    }
}; ?>

<div class="flex flex-col justify-center items-center h-screen px-4" style="background-color: #F5F5F5">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-6 sm:p-8">
        <!-- Título LOGIN -->
        <h1 class="text-3xl font-bold text-center mb-6 text-gray-800">LOGIN</h1>
        
        <!-- Session Status -->
        <x-auth-session-status class="mb-4 text-center text-green-600" :status="session('status')" />

        <form wire:submit="login" class="space-y-4">
            <!-- Email Address -->
            <div>
                <input wire:model="email" id="email" type="email" placeholder="Correo electrónico" required autofocus
                       class="block w-full px-4 py-3 bg-gray-200 rounded-md shadow-sm focus:outline-none focus:ring-0 focus:border-2 focus:border-orange-500 placeholder-gray-500 text-black">
                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Password -->
            <div class="relative">
                <input wire:model="password" id="password" type="{{ $showPassword ? 'text' : 'password' }}" placeholder="Contraseña" required
                       class="block w-full px-4 py-3 bg-gray-200 rounded-md shadow-sm focus:outline-none focus:ring-0 focus:border-2 focus:border-orange-500 placeholder-gray-500 text-black">
                <button type="button" wire:click="togglePasswordVisibility" class="absolute inset-y-0 right-0 flex items-center pr-3">
                    @if ($showPassword)
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    @endif
                </button>
                @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Botón de Iniciar Sesión -->
            <button type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-orange-500 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                Iniciar Sesión
            </button>
        </form>

        <!-- Enlaces inferiores -->
        <div class="mt-4 text-center text-sm text-blue-600 space-y-1">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="hover:underline block">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif
            
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="hover:underline block">
                    Crear una cuenta
                </a>
            @endif
        </div>

        <!-- Estilos personalizados para sobrescribir autocompletado -->
        <style>
            input:-webkit-autofill,
            input:-webkit-autofill:hover,
            input:-webkit-autofill:focus,
            input:-webkit-autofill:active {
                -webkit-box-shadow: 0 0 0 30px #e5e7eb inset !important; /* Equivalente a bg-gray-200 */
                -webkit-text-fill-color: #000000 !important; /* Equivalente a text-black */
                transition: background-color 5000s ease-in-out 0s; /* Evita que el fondo cambie después de autocompletar */
            }
        </style>
    </div>
</div>