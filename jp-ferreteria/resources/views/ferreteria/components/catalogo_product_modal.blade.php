<div id="product-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[60] hidden">
    <div class="bg-white rounded-lg shadow-xl w-11/12 md:w-3/4 lg:w-2/3 max-h-[90vh] flex flex-col">
        <div class="flex justify-between items-center border-b p-4">
            <h3 class="text-xl font-bold" id="modal-product-name"></h3>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="overflow-y-auto p-6 flex-grow">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="flex flex-col items-center">
                    <img id="modal-product-image" src="" alt="Producto" class="w-64 h-64 object-contain mb-4 rounded-lg">
                    <div class="text-center">
                        <p id="modal-product-price" class="text-lg text-blue-600 font-semibold"></p>
                        <p id="modal-product-stock" class="text-sm text-gray-600 mt-1"></p>
                    </div>
                </div>
                <div>
                    <h4 class="font-bold text-lg mb-4">Descripción</h4>
                    <p id="modal-product-description" class="text-gray-700 mb-6"></p>
                </div>
            </div>
        </div>
        <div class="border-t p-4 flex justify-end">
            <button onclick="addModalProductToCart()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded">
                Agregar al Carrito
            </button>
        </div>
    </div>
</div>
