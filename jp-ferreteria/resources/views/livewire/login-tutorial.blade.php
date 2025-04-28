<?php

use Livewire\Component;

class LoginTutorial extends Component
{
    public bool $showTutorial = false;

    public function openTutorial()
    {
        $this->showTutorial = true;
    }

    public function closeTutorial()
    {
        $this->showTutorial = false;
    }

    public function render()
    {
        return view('livewire.login-tutorial');
    }
}
?>

<div>
    <!-- Botón para abrir el tutorial -->
    <button wire:click="openTutorial" class="text-blue-600 hover:underline text-sm mb-4">
        ¿Cómo iniciar sesión?
    </button>

    <!-- Modal del tutorial -->
    <div x-show="showTutorial" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" wire:model="showTutorial">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Tutorial: Cómo Iniciar Sesión</h2>
            <ol class="list-decimal list-inside text-gray-600 mb-6 space-y-2">
                <li>Ingresa tu correo electrónico en el primer campo.</li>
                <li>Escribe tu contraseña en el segundo campo. Puedes hacer clic en el ícono del ojo para ver la contraseña.</li>
                <li>Haz clic en el botón naranja "Iniciar Sesión" para acceder.</li>
                <li>Si olvidaste tu contraseña, haz clic en "¿Olvidaste tu contraseña?" para restablecerla.</li>
                <li>Si no tienes una cuenta, selecciona "Crear una cuenta" para registrarte.</li>
            </ol>
            <button wire:click="closeTutorial" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-orange-500 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                Cerrar
            </button>
        </div>
    </div>
</div>