<!-- Intro.js -->
<script src="https://unpkg.com/intro.js/minified/intro.min.js"></script>

<script>
    let cart = {
        items: [],
        total: 0
    };

    // Sidebar toggle
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('main-content');
        sidebar.classList.toggle('-translate-x-full');
        content.classList.toggle('ml-56');
    }

    function abrirModal() {
        document.getElementById('modalVenta').classList.remove('hidden');
    }

    function cerrarModal() {
        document.getElementById('modalVenta').classList.add('hidden');
    }

    function abrirModalEditar() {
        document.getElementById('modalEditar').classList.remove('hidden');
    }

    function cerrarModalEditar() {
        document.getElementById('modalEditar').classList.add('hidden');
    }

    function iniciarTutorial() {
        introJs().setOptions({
            steps: [
                {
                    element: document.querySelector('[data-intro="crear-venta"]'),
                    intro: "Aquí puedes crear una nueva venta."
                },
                {
                    element: document.querySelector('[data-intro="buscar"]'),
                    intro: "Este botón te permite buscar ventas por nombre o ID."
                },
                {
                    element: document.querySelector('[data-intro="editar"]'),
                    intro: "Usa este botón para editar una venta existente."
                },
                {
                    element: document.querySelector('[data-intro="deshabilitar"]'),
                    intro: "Este botón deshabilita una venta."
                },
                {
                    element: document.querySelector('[data-intro="ventas"]'),
                    intro: "Este botón abre el módulo de ventas."
                },
                {
                    element: document.querySelector('[data-intro="catalogo"]'),
                    intro: "Accede al catálogo desde aquí."
                },
                {
                    element: document.querySelector('[data-intro="cerrar-sesion"]'),
                    intro: "Cierra tu sesión desde este botón."
                }
            ],
            nextLabel: 'Siguiente',
            prevLabel: 'Anterior',
            doneLabel: 'Finalizar'
        }).start();
    }

    function startTutorial() {
        introJs().setOptions({
            steps: [
                {
                    element: document.querySelector('.fixed.bottom-6.right-6'), // Seleccionamos el contenedor del botón flotante
                    intro: "Este es el botón del carrito de compras. Haz clic aquí para ver los productos añadidos y finalizar tu compra.",
                    position: 'left' // Aseguramos que el cuadro aparezca al lado izquierdo del botón
                },
                {
                    element: document.querySelector('.grid .group'),
                    intro: "Estas son las tarjetas de productos. Aquí puedes ver información básica de cada producto.",
                    position: 'bottom'
                },
                {
                    element: document.querySelector('.group .w-full.h-32'),
                    intro: "Haz clic en la imagen para ver más detalles del producto.",
                    position: 'top'
                }
            ],
            nextLabel: 'Siguiente',
            prevLabel: 'Anterior',
            doneLabel: 'Finalizar',
            skipLabel: 'Saltar', // Botón "Saltar" estándar
            showSkipButton: true, // Aseguramos que el botón "Saltar" esté habilitado
            tooltipClass: 'custom-introjs-tooltip catalogo' // Clase específica para catálogo
        }).start();
    }

    // Ya no se ejecuta automáticamente

    // Mostrar detalles del producto
    function toggleProductDetails(productId) {
        const details = document.getElementById(`product-details-${productId}`);
        if (details) {
            details.classList.remove('hidden');
        }
    }

    // Cerrar detalles del producto
    function closeProductDetails(productId) {
        const details = document.getElementById(`product-details-${productId}`);
        if (details) {
            details.classList.add('hidden');
        }
    }

    function showAlert(message, onConfirm) {
        const alertModal = document.getElementById('alert-modal');
        const alertMessage = document.getElementById('alert-message');
        const confirmButton = document.getElementById('alert-confirm-btn');
        const cancelButton = document.getElementById('alert-cancel-btn');

        alertMessage.textContent = message;

        // Mostrar u ocultar el botón "Cancelar" según el mensaje
        if (message === 'No hay ningún borrador guardado.') {
            cancelButton.style.display = 'none'; // Ocultar el botón "Cancelar"
        } else {
            cancelButton.style.display = 'inline-block'; // Mostrar el botón "Cancelar"
        }

        confirmButton.onclick = () => {
            alertModal.classList.add('hidden');
            if (onConfirm) onConfirm();
        };

        cancelButton.onclick = () => {
            alertModal.classList.add('hidden');
        };

        alertModal.classList.remove('hidden');
    }

    // Añadir producto al carrito desde la tarjeta
    function addToCart(productId) {
        const productos = @json($productos); // Aseguramos que los productos estén disponibles
        const product = productos.find(p => p.ID_PRODUCTO === productId);

        if (!product) {
            showAlert('Producto no encontrado.');
            return;
        }

        showAlert(`¿Desea añadir ${product.NOMBRE_PRODUCTO} al carrito?`, () => {
            const existingItem = cart.items.find(item => item.ID_PRODUCTO === productId);
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.items.push({ ...product, quantity: 1 });
            }

            updateCartUI(); // Actualizar la interfaz del carrito
        });
    }

    // Añadir producto al carrito desde el modal
    function addToCartFromModal() {
        const productId = parseInt(document.getElementById('add-to-cart-modal-btn').dataset.productId);
        addToCart(productId);
    }

    // Actualizar la interfaz del carrito
    function updateCartUI() {
        const cartItemsContainer = document.getElementById('cart-items');
        const cartCount = document.getElementById('cart-count');
        const cartTotal = document.getElementById('cart-total');

        // Actualizar contador del carrito
        const totalItems = cart.items.reduce((sum, item) => sum + item.quantity, 0);
        cartCount.textContent = totalItems;

        // Actualizar total del carrito
        cart.total = cart.items.reduce((sum, item) => sum + item.PRECIO * item.quantity, 0);
        cartTotal.textContent = `$${cart.total.toFixed(2)}`;

        // Actualizar lista de productos en el carrito
        cartItemsContainer.innerHTML = cart.items.map(item => `
            <div class="flex justify-between items-center mb-3">
                <span>${item.NOMBRE_PRODUCTO} (${item.quantity})</span>
                <div class="flex items-center gap-2">
                    <span>$${(item.PRECIO * item.quantity).toFixed(2)}</span>
                    <button onclick="removeFromCart(${item.ID_PRODUCTO})" class="text-red-500 hover:text-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        `).join('');

        // Habilitar el botón de finalizar compra si hay productos en el carrito
        const checkoutBtn = document.getElementById('checkout-btn');
        checkoutBtn.disabled = cart.items.length === 0;
    }

    // Mostrar/ocultar el modal del carrito
    function toggleCartModal() {
        const cartModal = document.getElementById('cart-modal');
        if (cartModal) {
            cartModal.classList.toggle('hidden');
        } else {
            console.error('No se encontró el modal del carrito.');
        }
    }

    // Abrir el modal de detalles del producto
    function openProductDetailsModal(product) {
        const modal = document.getElementById('product-details-modal');
        const modalName = document.getElementById('modal-product-name');
        const modalDescription = document.getElementById('modal-product-description');
        const modalPrice = document.getElementById('modal-product-price');
        const modalStock = document.getElementById('modal-product-stock');
        const modalReference = document.getElementById('modal-product-reference');
        const modalImages = document.getElementById('modal-product-images');
        const modalThumbnails = document.getElementById('modal-product-thumbnails');
        const addToCartButton = document.getElementById('add-to-cart-modal-btn');

        // Actualizar contenido del modal
        modalName.textContent = product.NOMBRE_PRODUCTO;
        modalName.dataset.productId = product.ID_PRODUCTO;
        modalDescription.textContent = product.DESCRIPCION || 'Sin descripción disponible.';
        modalPrice.textContent = `Precio: $${product.PRECIO}`;
        modalStock.textContent = `Cantidad disponible: ${product.CANTIDAD}`;
        modalReference.textContent = `Referencia: ${product.REFERENCIA || 'N/A'}`;

        // Mostrar solo la primera imagen como principal
        const mainImage = product.fotos.length > 0 ? product.fotos[0].url_foto : 'https://via.placeholder.com/300';
        modalImages.innerHTML = `
            <img src="${mainImage}" 
                 alt="Foto principal del producto" 
                 class="w-full h-64 object-cover rounded">
        `;

        // Cargar miniaturas
        modalThumbnails.innerHTML = product.fotos.map(foto => `
            <img src="${foto.url_foto}" 
                 alt="Miniatura del producto" 
                 class="w-full h-20 object-cover rounded cursor-pointer hover:opacity-80"
                 onclick="updateMainImage('${foto.url_foto}')">
        `).join('');

        addToCartButton.dataset.productId = product.ID_PRODUCTO;
        modal.classList.remove('hidden');
    }

    // Actualizar la imagen principal al hacer clic en una miniatura
    function updateMainImage(imageUrl) {
        const modalImages = document.getElementById('modal-product-images');
        modalImages.innerHTML = `
            <img src="${imageUrl}" 
                 alt="Foto principal del producto" 
                 class="w-full h-64 object-cover rounded">
        `;
    }

    // Cerrar el modal de detalles del producto
    function closeProductDetailsModal() {
        const modal = document.getElementById('product-details-modal');
        modal.classList.add('hidden');
    }

    // Finalizar compra
    async function finalizePurchase() {
        const name = document.getElementById('client-name').value;
        const id = document.getElementById('client-id').value;
        const email = document.getElementById('client-email').value;
        const address = document.getElementById('client-address').value;
        const phone = document.getElementById('client-phone').value;
        const total = cart.total;

        if (!name || !id || total <= 0) {
            showAlert('Por favor, complete todos los campos obligatorios y asegúrese de que el carrito no esté vacío.');
            return;
        }

        try {
            const response = await fetch('{{ route("catalogo.finalizarCompra") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    name,
                    id,
                    email,
                    address,
                    phone,
                    total,
                    cart: cart.items
                })
            });

            const result = await response.json();
            if (result.success) {
                showAlert(result.message);
                cart.items = [];
                cart.total = 0;
                updateCartUI();
                toggleCartModal();

                // Eliminar el borrador después de finalizar la compra
                clearDraft();
            } else {
                showAlert(result.message || 'Error al finalizar la compra.');
            }
        } catch (error) {
            console.error('Error:', error);
            showAlert('Error al procesar la compra.');
        }
    }

    function saveDraft() {
        const draft = {
            cart: cart,
            client: {
                name: document.getElementById('client-name').value,
                id: document.getElementById('client-id').value,
                email: document.getElementById('client-email').value,
                address: document.getElementById('client-address').value,
                phone: document.getElementById('client-phone').value,
            }
        };

        localStorage.setItem('draft', JSON.stringify(draft));
        showAlert('Borrador guardado correctamente.');
    }

    function loadDraft() {
        const draft = JSON.parse(localStorage.getItem('draft'));
        if (draft) {
            // Restaurar carrito
            cart = draft.cart;
            updateCartUI();

            // Restaurar información del cliente
            document.getElementById('client-name').value = draft.client.name || '';
            document.getElementById('client-id').value = draft.client.id || '';
            document.getElementById('client-email').value = draft.client.email || '';
            document.getElementById('client-address').value = draft.client.address || '';
            document.getElementById('client-phone').value = draft.client.phone || '';

            showAlert('Borrador cargado correctamente.');
        }
    }

    function clearDraft() {
        localStorage.removeItem('draft');
        showAlert('Borrador eliminado correctamente.');
    }

    // Cargar borrador al cargar la página
    document.addEventListener('DOMContentLoaded', loadDraft);

    // Asignar funcionalidad al botón de guardar borrador
    document.getElementById('save-draft-btn').addEventListener('click', saveDraft);

    document.getElementById('checkout-btn').addEventListener('click', finalizePurchase);

    document.addEventListener('DOMContentLoaded', () => {
        const cartModal = document.getElementById('cart-modal');
        const cartModalContent = document.getElementById('cart-modal-content');
        const minimizeButton = document.getElementById('minimize-cart-modal');
        const closeButton = document.getElementById('close-cart-modal');
        const cartFloatingButton = document.querySelector('.fixed.bottom-6.right-6');

        let isMinimized = false;

        // Minimizar el modal
        minimizeButton.addEventListener('click', () => {
            isMinimized = !isMinimized;
            if (isMinimized) {
                cartModal.classList.add('hidden'); // Ocultar el modal por completo
            } else {
                cartModal.classList.remove('hidden'); // Mostrar el modal nuevamente
            }
        });

        // Mostrar el modal al hacer clic en el botón flotante
        cartFloatingButton.addEventListener('click', () => {
            cartModal.classList.remove('hidden');
            isMinimized = false; // Asegurarse de que no esté minimizado al abrir
        });

        // Cerrar el modal
        closeButton.addEventListener('click', () => {
            cartModal.classList.add('hidden');
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('search-input');
        const productCards = document.querySelectorAll('.product-card');

        searchInput.addEventListener('input', () => {
            const searchTerm = searchInput.value.toLowerCase();

            productCards.forEach(card => {
                const productName = card.dataset.name;
                if (productName.includes(searchTerm)) {
                    card.style.display = 'flex'; // Mostrar la tarjeta
                } else {
                    card.style.display = 'none'; // Ocultar la tarjeta
                }
            });

            // Si el campo de búsqueda está vacío, mostrar todas las tarjetas
            if (searchTerm === '') {
                productCards.forEach(card => {
                    card.style.display = 'flex';
                });
            }
        });
    });

    function removeFromCart(productId) {
        showAlert('¿Estás seguro de que deseas eliminar este producto del carrito?', () => {
            const productIndex = cart.items.findIndex(item => item.ID_PRODUCTO === productId);
            if (productIndex !== -1) {
                cart.items.splice(productIndex, 1); // Eliminar el producto del carrito
                updateCartUI(); // Actualizar la interfaz del carrito
            }
        });
    }
</script>