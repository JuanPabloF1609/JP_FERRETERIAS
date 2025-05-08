<div id="cart-container" class="fixed bottom-0 right-0 mb-4 mr-4 w-80 bg-white rounded-lg shadow-xl z-50 hidden">
    <div id="cart-header" class="bg-blue-500 text-white p-3 rounded-t-lg flex justify-between items-center cursor-pointer" onclick="toggleCart()">
        <h3 class="font-bold">Carrito de Compras</h3>
        <div class="flex items-center">
            <span id="cart-count" class="bg-white text-blue-500 rounded-full w-6 h-6 flex items-center justify-center text-sm mr-2">0</span>
            <svg id="cart-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>
    </div>
    <div id="cart-content" class="p-4 border border-t-0 rounded-b-lg max-h-96 overflow-y-auto">
        <div id="cart-items" class="mb-4">
            <p class="text-gray-500 text-center py-4">El carrito está vacío</p>
        </div>
        <div class="border-t pt-3 space-y-3">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <input type="text" id="client-name" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nombre del cliente">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">C.C o NIT</label>
                <input type="text" id="client-id" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Número de identificación">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                <input type="text" id="client-address" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Dirección">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                <input type="text" id="client-phone" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Teléfono">
            </div>
            <div class="border-t pt-3">
                <div class="flex justify-between mb-2">
                    <span class="font-semibold">Total:</span>
                    <span id="cart-total">$0.00</span>
                </div>
                <button id="checkout-btn" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded disabled:opacity-50" disabled>
                    Finalizar Compra
                </button>
                <button id="save-draft-btn" class="w-full mt-2 bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    Guardar Borrador
                </button>
            </div>
        </div>
    </div>
</div>
