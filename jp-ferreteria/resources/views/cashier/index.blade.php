@extends('cashier.cashier_layout')

@section('content')
    @include('cashier.cashier_sidebar')

    <div id="main-content" class="flex-1 transition-all duration-300 ease-in-out p-6 w-full ml-0">
        <div class="mb-4">
            <button onclick="toggleSidebar()" class="text-black text-3xl focus:outline-none">
                <svg class="w-10 h-10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0" y="3" width="6" height="6" fill="black"></rect>
                    <rect x="7" y="3" width="16" height="6" fill="black"></rect>
                    <rect x="0" y="10" width="6" height="6" fill="black"></rect>
                    <rect x="7" y="10" width="16" height="6" fill="black"></rect>
                    <rect x="0" y="17" width="6" height="6" fill="black"></rect>
                    <rect x="7" y="17" width="16" height="6" fill="black"></rect>
                </svg>
            </button>
        </div>

        <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-6xl mx-auto">
            <h1 class="text-2xl font-bold mb-6 text-center">Ventas</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @can('view_products')
                    @if (isset($productos) && !empty($productos))
                        @foreach ($productos as $producto)
                            <div class="bg-white rounded-lg shadow-lg p-4 flex flex-col items-center relative group">
                                <!-- Contenedor para el hover y clic del modal -->
                                <div class="w-full relative cursor-pointer" onclick="showProductDetails({{ json_encode($producto) }})">
                                    <div class="absolute inset-0 bg-black bg-opacity-70 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                                        <span class="text-white font-bold text-lg">Detalles</span>
                                    </div>
                                    <img src="{{ $producto['imagen'] }}" alt="{{ $producto['nombre'] }}" class="w-full h-32 object-cover mb-4 rounded group-hover:scale-105 transition-transform duration-300">
                                </div>
                                
                                <!-- Información del producto -->
                                <div class="w-full text-center">
                                    <p class="text-sm font-semibold text-gray-700">Nombre: {{ $producto['nombre'] }}</p>
                                    <p class="text-sm text-gray-600">Cantidad: {{ $producto['cantidad'] }}</p>
                                    <p class="text-sm text-gray-600">Precio: {{ $producto['precio'] }}</p>
                                </div>
                                
                                <!-- Botón que permanece accesible -->
                                <button onclick="event.stopPropagation(); addToCart({{ json_encode($producto) }})" 
                                        class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded z-20 relative">
                                    Agregar al carrito
                                </button>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center text-gray-500">No hay productos disponibles.</p>
                    @endif
                @else
                <!-- ... resto del código existente ... -->
                <div class="no-permission-container">
                    <h2 class="text-red-500 text-xl font-bold">Acceso Denegado</h2>
                    <p class="text-gray-700">No tienes los permisos necesarios para acceder al historial de entregas.</p>
                    <p class="text-gray-700">Si crees que esto es un error, contacta al administrador del sistema.</p>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary mt-4">Volver al Dashboard</a>
                </div>
                @endcan
            </div>
        </div>
        
        <!-- Carrito flotante -->
        <div id="cart-container" class="fixed bottom-0 right-0 mb-4 mr-4 w-80 bg-white rounded-lg shadow-xl z-50 transition-all duration-300">
            <div id="cart-header" class="bg-blue-500 text-white p-3 rounded-t-lg flex justify-between items-center cursor-pointer">
                <h3 class="font-bold">Carrito de Compras</h3>
                <div class="flex items-center">
                    <span id="cart-count" class="bg-white text-blue-500 rounded-full w-6 h-6 flex items-center justify-center text-sm mr-2">0</span>
                    <button id="toggle-cart" class="text-white focus:outline-none">
                        <svg id="cart-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
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
        <!-- Modal de Detalles del Producto -->
        <div id="product-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[60] hidden">
            <div class="bg-white rounded-lg shadow-xl w-11/12 md:w-3/4 lg:w-2/3 max-h-[90vh] flex flex-col">
                <div class="flex justify-between items-center border-b p-4">
                    <h3 class="text-xl font-bold">Detalles del Producto</h3>
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
                                <h2 id="modal-product-name" class="text-xl font-bold mb-2"></h2>
                                <p id="modal-product-price" class="text-lg text-blue-600 font-semibold"></p>
                                <p id="modal-product-stock" class="text-sm text-gray-600 mt-1"></p>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-4">Descripción</h4>
                            <p class="text-gray-700 mb-6">
                                Herramienta esencial para cualquier taller o proyecto de bricolaje, este martillo combina
                                durabilidad y funcionalidad. Ideal para clavar, extraer clavos y ajustar piezas.
                            </p>
                            
                            <h4 class="font-bold text-lg mb-3">Características principales</h4>
                            <ul class="list-disc pl-5 mb-6 space-y-2">
                                <li><strong>Cabeza:</strong> Fabricada en acero templado de alta resistencia, con acabado pulido para mayor durabilidad.</li>
                                <li><strong>Uña:</strong> Diseño curvado para extracción eficiente de clavos.</li>
                                <li><strong>Cara de golpe:</strong> Rectangular y lisa para un impacto preciso.</li>
                                <li><strong>Mango:</strong> Disponible en madera de nogal (ergonómico y resistente) o fibra de vidrio (antivibraciones).</li>
                                <li><strong>Peso:</strong> Aprox. 450~500 g (equilibrio perfecto entre fuerza y control).</li>
                                <li><strong>Longitud total:</strong> 30~35 cm (manejo cómodo con una o dos manos).</li>
                            </ul>
                            
                            <h4 class="font-bold text-lg mb-3">Usos recomendados</h4>
                            <ul class="list-disc pl-5 mb-6 space-y-2">
                                <li>Carpintería general.</li>
                                <li>Construcción y reparaciones domésticas.</li>
                                <li>Trabajos en madera y montaje de muebles.</li>
                            </ul>
                            
                            <h4 class="font-bold text-lg mb-3">Incluye</h4>
                            <ul class="list-disc pl-5 space-y-2">
                                <li>Protector de goma para la cabeza (opcional).</li>
                                <li>Cuña de uso básico (dependiendo del modelo).</li>
                            </ul>
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
    </div>
@endsection

@section('scripts')
    @include('cashier.cashier_scripts')
    
    <script>
        // Estado del carrito
        let cart = {
            items: [],
            total: 0,
            isMinimized: false
        };

        // Función para agregar productos al carrito
        function addToCart(product) {
            // Buscar si el producto ya está en el carrito
            const existingItem = cart.items.find(item => item.id === product.id);
            
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.items.push({
                    ...product,
                    quantity: 1
                });
            }
            
            // Actualizar el total
            cart.total = cart.items.reduce((sum, item) => sum + (item.precio * item.quantity), 0);
            
            // Actualizar la UI del carrito
            updateCartUI();
            
            // Mostrar notificación
            showNotification(`${product.nombre} agregado al carrito`);
        }

        // Función para actualizar la UI del carrito
        function updateCartUI() {
            const cartItemsContainer = document.getElementById('cart-items');
            const cartCount = document.getElementById('cart-count');
            const cartTotal = document.getElementById('cart-total');
            const checkoutBtn = document.getElementById('checkout-btn');
            
            // Actualizar contador
            const totalItems = cart.items.reduce((sum, item) => sum + item.quantity, 0);
            cartCount.textContent = totalItems;
            
            // Actualizar total
            cartTotal.textContent = `$${cart.total.toFixed(2)}`;
            
            // Habilitar/deshabilitar botón de compra
            checkoutBtn.disabled = totalItems === 0;
            
            // Actualizar items del carrito
            if (cart.items.length === 0) {
                cartItemsContainer.innerHTML = '<p class="text-gray-500 text-center py-4">El carrito está vacío</p>';
            } else {
                cartItemsContainer.innerHTML = cart.items.map(item => `
                    <div class="flex justify-between items-center mb-3 pb-3 border-b">
                        <div class="flex-1">
                            <h4 class="font-medium">${item.nombre}</h4>
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>${item.quantity} x $${item.precio.toFixed(2)}</span>
                                <span>$${(item.quantity * item.precio).toFixed(2)}</span>
                            </div>
                        </div>
                        <button onclick="removeFromCart(${item.id})" class="ml-2 text-red-500 hover:text-red-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                `).join('');
            }
        }

        // Función para remover items del carrito
        function removeFromCart(productId) {
            cart.items = cart.items.filter(item => item.id !== productId);
            cart.total = cart.items.reduce((sum, item) => sum + (item.precio * item.quantity), 0);
            updateCartUI();
        }

        // Función para mostrar notificaciones
        function showNotification(message) {
            const notification = document.createElement('div');
            notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg animate-fade-in-out';
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.classList.add('opacity-0', 'transition-opacity', 'duration-300');
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        // Función para minimizar/maximizar el carrito
        function toggleCart() {
            const cartContent = document.getElementById('cart-content');
            const cartIcon = document.getElementById('cart-icon');
            
            cart.isMinimized = !cart.isMinimized;
            
            if (cart.isMinimized) {
                cartContent.classList.add('hidden');
                cartIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>';
            } else {
                cartContent.classList.remove('hidden');
                cartIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>';
            }
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle del carrito
            document.getElementById('toggle-cart').addEventListener('click', toggleCart);
            document.getElementById('cart-header').addEventListener('click', toggleCart);
            
            // Botón de finalizar compra
            document.getElementById('checkout-btn').addEventListener('click', function() {
                // Aquí iría la lógica para finalizar la compra
                alert('Compra finalizada! Total: $' + cart.total.toFixed(2));
                // Limpiar carrito después de la compra
                cart.items = [];
                cart.total = 0;
                updateCartUI();
            });
            
            // Botón de guardar borrador
            document.getElementById('save-draft-btn').addEventListener('click', function() {
                // Aquí iría la lógica para guardar el borrador
                // Por ejemplo, enviar a una ruta de Laravel mediante AJAX
                fetch('{{ route("cashier.saveDraft") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        items: cart.items,
                        total: cart.total
                    })
                })
                .then(response => response.json())
                .then(data => {
                    showNotification('Borrador guardado correctamente');
                })
                .catch(error => {
                    showNotification('Error al guardar el borrador');
                    console.error('Error:', error);
                });
            });
        });

        // Variable para almacenar el producto actual
        let currentModalProduct = null;

        // Mostrar modal
        function showProductDetails(product) {
            currentModalProduct = product;
            document.getElementById('product-modal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            
            // Actualizar contenido del modal
            document.getElementById('modal-product-image').src = product.imagen;
            document.getElementById('modal-product-name').textContent = product.nombre;
            document.getElementById('modal-product-price').textContent = `$${product.precio}`;
            document.getElementById('modal-product-stock').textContent = `Disponibles: ${product.cantidad}`;
        }

        // Cerrar modal
        function closeModal() {
            document.getElementById('product-modal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Agregar desde el modal
        function addModalProductToCart() {
            if (currentModalProduct) {
                addToCart(currentModalProduct);
                closeModal();
            }
        }
    </script>

    <style>
        .animate-fade-in-out {
            animation: fadeInOut 3s ease-in-out;
        }
        
        @keyframes fadeInOut {
            0% { opacity: 0; transform: translateY(-10px); }
            10% { opacity: 1; transform: translateY(0); }
            90% { opacity: 1; transform: translateY(0); }
            100% { opacity: 0; transform: translateY(-10px); }
        }

        /* Efectos hover */
        .group-hover\:opacity-100:hover {
            opacity: 1 !important;
        }

        .group-hover\:scale-105:hover {
            transform: scale(1.05);
        }

        /* Transiciones */
        .transition-opacity {
            transition: opacity 0.3s ease;
        }

        .transition-transform {
            transition: transform 0.3s ease;
        }

        /* Modal */
        #product-modal {
            z-index: 60;
        }
    </style>
@endsection