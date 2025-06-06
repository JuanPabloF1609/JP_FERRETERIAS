<div id="product-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[60] hidden">
    <div class="bg-white rounded-lg shadow-xl w-11/12 md:w-3/4 lg:w-2/3 max-h-[90vh] flex flex-col">
        <div class="flex justify-between items-center border-b p-4">
            <h3 class="text-xl font-bold" id="modal-product-name"></h3>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="overflow-y-auto p-6 flex-grow">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Imagen y miniaturas -->
                <div class="flex flex-col items-center">
                    <img id="modal-product-image" src="" alt="Producto" class="w-64 h-64 object-contain mb-2 rounded-lg border">
                    <div id="modal-product-thumbnails" class="flex gap-2 mb-4"></div>
                    <div class="text-center">
                        <p id="modal-product-price" class="text-lg text-blue-600 font-semibold"></p>
                        <p id="modal-product-preciooferta" class="text-lg text-green-600 font-semibold"></p>
                        <div class="flex flex-wrap gap-2 justify-center mb-2">
                            <span id="modal-product-stock" class="text-sm text-gray-600"></span>
                            <span id="modal-product-stockmin" class="text-sm text-gray-600"></span>
                        </div>
                        <div class="flex flex-wrap gap-2 justify-center mb-2">
                            <span id="modal-product-category" class="text-sm text-gray-600"></span>
                            <span id="modal-product-reference" class="text-sm text-gray-600"></span>
                        </div>
                        <div class="flex gap-2 justify-center mb-2">
                            <span id="modal-product-oferta" class="bg-pink-500 text-white px-2 py-1 rounded text-xs font-bold hidden">OFERTA DEL DÍA</span>
                            <span id="modal-product-masvendido" class="bg-yellow-400 text-white px-2 py-1 rounded text-xs font-bold hidden">MÁS VENDIDO</span>
                        </div>
                    </div>
                </div>
                <!-- Información y descripción -->
                <div>
                    <div class="flex flex-wrap gap-2 mb-2">
                        <span id="modal-product-brand" class="text-xs text-gray-500"></span>
                        <span id="modal-product-color" class="text-xs text-gray-500"></span>
                        <span id="modal-product-unidad" class="text-xs text-gray-500"></span>
                        <span id="modal-product-material" class="text-xs text-gray-500"></span>
                        <span id="modal-product-dimensiones" class="text-xs text-gray-500"></span>
                        <span id="modal-product-uso" class="text-xs text-gray-500"></span>
                        <span id="modal-product-norma" class="text-xs text-gray-500"></span>
                        <span id="modal-product-procedencia" class="text-xs text-gray-500"></span>
                        <span id="modal-product-cuotas" class="text-xs text-gray-600"></span>
                        <span id="modal-product-cuotavalor" class="text-xs text-gray-600"></span>
                    </div>
                    <h4 class="font-bold text-lg mb-2">Descripción</h4>
                    <p id="modal-product-description" class="text-gray-700 mb-4"></p>
                    <h4 class="font-bold text-sm mb-1">Características principales</h4>
                    <ul id="modal-product-caracteristicas" class="list-disc pl-5 text-gray-700 text-sm mb-4"></ul>
                </div>
            </div>
        </div>
        <div class="border-t p-4 flex justify-end">
            <button onclick="addToCartFromModal()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded">
                Agregar al Carrito
            </button>
        </div>
    </div>
</div>
