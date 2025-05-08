<div id="cart-modal" class="fixed bottom-6 right-6 z-50 hidden">
    <div id="cart-modal-content" class="bg-white rounded-lg shadow-xl w-80 max-h-[90vh] overflow-y-auto p-6 relative">
        <div class="flex justify-between items-center border-b pb-4">
            <h3 class="text-xl font-bold">Carrito de Compras</h3>
            <div class="flex items-center gap-2">
                <!-- Botón para minimizar -->
                <button id="minimize-cart-modal" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 12h16" />
                    </svg>
                </button>
                <!-- Botón para cerrar -->
                <button id="close-cart-modal" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        <div id="cart-content" class="p-4 border border-t-0 rounded-b-lg max-h-96 overflow-y-auto">
            <div id="cart-items" class="mb-4">
                <!-- Los items del carrito se agregarán aquí dinámicamente -->
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
                    <label class="block text-sm font-medium text-gray-700 mb-1">Correo</label>
                    <input type="email" id="client-email" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Correo electrónico">
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
</div>
