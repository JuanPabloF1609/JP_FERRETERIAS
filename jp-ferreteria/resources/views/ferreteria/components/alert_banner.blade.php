{{-- filepath: resources/views/ferreteria/components/alert_banner.blade.php --}}
<div id="alert-banner"
    class="hidden fixed top-0 right-0 z-[100] bg-yellow-200 border-b border-yellow-400 text-yellow-900 px-4 py-3 flex items-center justify-between transition-all duration-300 w-full md:w-[calc(100%-16rem)] md:ml-64">
    <div>
        <strong>¡Atención!</strong> Hay <span id="alert-count">0</span> alertas de inventario pendientes.
        <a href="{{ route('admin.alertas') }}" class="underline text-yellow-800 ml-2">Ver alertas</a>
    </div>
    <button onclick="document.getElementById('alert-banner').classList.add('hidden')" class="ml-4 text-xl font-bold">&times;</button>
</div>