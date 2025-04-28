<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WelcomeModal extends Component
{
    public bool $showModal = false;

    public function mount()
    {
        // Verificar si el usuario está autenticado
        if (Auth::check()) {
            $this->showModal = false;
            return;
        }

        // Verificar si el usuario ya ha visto el modal (usando localStorage)
        $this->showModal = true; // Esto se manejará en el frontend con JavaScript
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.welcome-modal');
    }
}
?>

<div>
    <div x-data="{ show: false }" x-init="if (!localStorage.getItem('welcomeModalSeen')) { show = true; localStorage.setItem('welcomeModalSeen', 'true'); }" x-show="show" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">¡Bienvenido!</h2>
            <p class="text-gray-600 mb-6">
                ¡Gracias por visitar nuestra página! Para comenzar, por favor inicia sesión con tu correo electrónico y contraseña. Si no tienes una cuenta, puedes crear una fácilmente.
            </p>
            <button @click="show = false" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-orange-500 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                Entendido
            </button>
        </div>
    </div>
</div>