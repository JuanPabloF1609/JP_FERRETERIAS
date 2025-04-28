<?php
use Livewire\Volt\Component;
use function Livewire\Volt\{state, layout, title};

state([
    'search' => '',
]);

layout('components.layouts.app');

title('Gestión de Empleados');

new class extends Component {
    public $search = '';

    public function activate($userId)
    {
        \App\Models\User::find($userId)
            ->update(['status' => 'active']);
        $this->dispatch('notify', type: 'success', message: 'Usuario activado');
    }

    public function deactivate($userId)
    {
        \App\Models\User::find($userId)
            ->update(['status' => 'inactive']);
        $this->dispatch('notify', type: 'success', message: 'Usuario desactivado');
    }

    public function with()
    {
        return [
            'activeUsers'   => \App\Models\User::active()->count(),
            'inactiveUsers' => \App\Models\User::inactive()->count(),
            'users'         => \App\Models\User::when($this->search, function($query) {
                                   $query->where('name', 'like', '%'.$this->search.'%')
                                         ->orWhere('id', 'like', '%'.$this->search.'%');
                               })->get(),
        ];
    }
};
?>

<div class="space-y-6">
    <h1 class="text-2xl font-bold">Gestión de empleados</h1>

    <div class="grid grid-cols-2 gap-4">
        <div class="rounded-lg border p-4 flex items-center space-x-2">
            <span class="h-6 w-6 bg-orange-500 rounded-full flex items-center justify-center">
                <x-heroicon-o-user class="h-4 w-4 text-white" />
            </span>
            <div>
                <h2 class="font-semibold">Empleados activos:</h2>
                <p class="text-3xl">{{ $activeUsers }}</p>
            </div>
        </div>
        <div class="rounded-lg border p-4 flex items-center space-x-2">
            <span class="h-6 w-6 bg-orange-500 rounded-full flex items-center justify-center">
                <x-heroicon-o-user class="h-4 w-4 text-white" />
            </span>
            <div>
                <h2 class="font-semibold">Empleados inactivos:</h2>
                <p class="text-3xl">{{ $inactiveUsers }}</p>
            </div>
        </div>
    </div>

    <div class="relative">
        <input 
            wire:model.live="search"
            type="text" 
            placeholder="Buscar empleado por nombre o ID" 
            class="w-full rounded-lg border p-2 pl-10 bg-gray-100"
        >
        <x-heroicon-o-magnifying-glass 
            class="absolute left-3 top-3 h-4 w-4 text-gray-400" 
        />
    </div>

    <div class="overflow-x-auto rounded-lg border">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($users as $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->role ?? 'Vendedor' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="{{ $user->status === 'active' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $user->status === 'active' ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                            <button 
                                wire:click="$emit('editUser', '{{ $user->id }}')" 
                                class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                                Editar
                            </button>
                            @if ($user->status === 'active')
                                <button 
                                    wire:click="deactivate('{{ $user->id }}')" 
                                    class="bg-gray-600 text-white px-3 py-1 rounded hover:bg-gray-700">
                                    Deshabilitar
                                </button>
                            @else
                                <button 
                                    wire:click="activate('{{ $user->id }}')" 
                                    class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                    Habilitar
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            No se encontraron empleados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="flex justify-end">
        <a href="{{ route('users.create') }}" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">
            Crear empleado
        </a>
    </div>
</div>