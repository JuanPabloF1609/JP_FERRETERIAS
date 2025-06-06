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
        const btn = document.querySelector('#product-modal button[onclick="addToCartFromModal()"]');
        const productId = parseInt(btn.getAttribute('data-product-id'));
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
    function openProductDetailsModal(productId) {
        fetch(`/productos/${productId}`)
            .then(res => res.json())
            .then(product => {
                // Campos principales
                const modalName = document.getElementById('modal-product-name');
                if (modalName) modalName.textContent = product.NOMBRE_PRODUCTO || '';

                const modalPrice = document.getElementById('modal-product-price');
                if (modalPrice) modalPrice.textContent = `Precio: $${product.PRECIO}`;

                const modalStock = document.getElementById('modal-product-stock');
                if (modalStock) modalStock.textContent = `Cantidad: ${product.CANTIDAD}`;

                const modalStockMin = document.getElementById('modal-product-stockmin');
                if (modalStockMin) modalStockMin.textContent = product.STOCK_MINIMO ? `Stock mínimo: ${product.STOCK_MINIMO}` : '';

                const modalCategory = document.getElementById('modal-product-category');
                if (modalCategory) modalCategory.textContent = product.categoria ? `Categoría: ${product.categoria.NOMBRE_CATEGORIA}` : '';

                const modalReference = document.getElementById('modal-product-reference');
                if (modalReference) modalReference.textContent = `Referencia: ${product.REFERENCIA || 'N/A'}`;

                const modalDescription = document.getElementById('modal-product-description');
                if (modalDescription) modalDescription.textContent = product.DESCRIPCION || '';

                // Detalles adicionales
                const modalBrand = document.getElementById('modal-product-brand');
                if (modalBrand) modalBrand.textContent = product.MARCA ? `Marca: ${product.MARCA}` : '';

                const modalColor = document.getElementById('modal-product-color');
                if (modalColor) modalColor.textContent = product.COLOR ? `Color: ${product.COLOR}` : '';

                const modalUnidad = document.getElementById('modal-product-unidad');
                if (modalUnidad) modalUnidad.textContent = product.UNIDAD_MEDIDA ? `Unidad: ${product.UNIDAD_MEDIDA}` : '';

                const modalMaterial = document.getElementById('modal-product-material');
                if (modalMaterial) modalMaterial.textContent = product.MATERIAL ? `Material: ${product.MATERIAL}` : '';

                const modalDimensiones = document.getElementById('modal-product-dimensiones');
                if (modalDimensiones) modalDimensiones.textContent = product.DIMENSIONES ? `Dimensiones: ${product.DIMENSIONES}` : '';

                const modalUso = document.getElementById('modal-product-uso');
                if (modalUso) modalUso.textContent = product.USO ? `Uso: ${product.USO}` : '';

                const modalNorma = document.getElementById('modal-product-norma');
                if (modalNorma) modalNorma.textContent = product.NORMA ? `Norma: ${product.NORMA}` : '';

                const modalProcedencia = document.getElementById('modal-product-procedencia');
                if (modalProcedencia) modalProcedencia.textContent = product.PROCEDENCIA ? `Procedencia: ${product.PROCEDENCIA}` : '';

                // Oferta y más vendido
                const oferta = document.getElementById('modal-product-oferta');
                if (oferta) oferta.classList.toggle('hidden', !product.OFERTA);

                const masVendido = document.getElementById('modal-product-masvendido');
                if (masVendido) masVendido.classList.toggle('hidden', !product.MAS_VENDIDO);

                const modalPrecioOferta = document.getElementById('modal-product-preciooferta');
                if (modalPrecioOferta) modalPrecioOferta.textContent = product.PRECIO_OFERTA ? `Precio oferta: $${product.PRECIO_OFERTA}` : '';

                const modalCuotas = document.getElementById('modal-product-cuotas');
                if (modalCuotas) modalCuotas.textContent = product.CUOTAS ? `Cuotas: ${product.CUOTAS}` : '';

                const modalCuotaValor = document.getElementById('modal-product-cuotavalor');
                if (modalCuotaValor) modalCuotaValor.textContent = product.CUOTA_VALOR ? `Valor por cuota: $${product.CUOTA_VALOR}` : '';

                // Características principales
                const caracteristicas = document.getElementById('modal-product-caracteristicas');
                if (caracteristicas) {
                    caracteristicas.innerHTML = product.CARACTERISTICAS
                        ? product.CARACTERISTICAS.split('\n').map(c => `<li>${c}</li>`).join('')
                        : '';
                }

                // Imagen principal
                const img = document.getElementById('modal-product-image');
                if (img) img.src = (product.fotos && product.fotos.length > 0) ? product.fotos[0].url_foto : 'https://via.placeholder.com/300';

                // Miniaturas
                const thumbnails = document.getElementById('modal-product-thumbnails');
                if (thumbnails && product.fotos && product.fotos.length > 1) {
                    thumbnails.innerHTML = product.fotos.map((foto, idx) => `
                        <img src="${foto.url_foto}" 
                             alt="Miniatura del producto" 
                             class="w-16 h-16 object-cover rounded cursor-pointer border ${idx === 0 ? 'border-blue-500' : 'border-gray-300'}"
                             onclick="updateMainImage('${foto.url_foto}')">
                    `).join('');
                } else if (thumbnails) {
                    thumbnails.innerHTML = '';
                }
                const addToCartBtn = document.querySelector('#product-modal button[onclick="addToCartFromModal()"]');
                if (addToCartBtn) {
                    addToCartBtn.setAttribute('data-product-id', product.ID_PRODUCTO);
                }

                // Mostrar el modal
                const modal = document.getElementById('product-modal');
                if (modal) modal.classList.remove('hidden');
            });
    }

    // Actualizar la imagen principal al hacer clic en una miniatura
    function updateMainImage(imageUrl) {
        const img = document.getElementById('modal-product-image');
        if (img) img.src = imageUrl;
    }
    window.updateMainImage = updateMainImage;

    // Cerrar el modal de detalles del producto
    function closeProductDetailsModal() {
        const modal = document.getElementById('product-modal');
        if (modal) modal.classList.add('hidden');
    }

    function removeFromCart(productId) {
    cart.items = cart.items.filter(item => item.ID_PRODUCTO !== productId);
    updateCartUI();
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
                cart.items = [];
                cart.total = 0;
                updateCartUI();
                toggleCartModal();

                // Limpiar campos del cliente
                document.getElementById('client-name').value = '';
                document.getElementById('client-id').value = '';
                document.getElementById('client-email').value = '';
                document.getElementById('client-address').value = '';
                document.getElementById('client-phone').value = '';

                // Eliminar el borrador después de finalizar la compra
                clearDraft();

                // ACTUALIZAR STOCK EN EL FRONTEND
                if (result.cart) {
                    result.cart.forEach(item => {
                        const stockElem = document.getElementById(`product-stock-${item.ID_PRODUCTO}`);
                        if (stockElem) {
                            let actual = parseInt(stockElem.textContent.replace(/\D/g, '')) || 0;
                            stockElem.textContent = `Cantidad: ${actual - item.quantity}`;
                        }
                    });
                }

                showAlert(result.message);
            } else {
                showAlert(result.message || 'Error al finalizar la compra.');
            }
        } catch (error) {
            console.error('Error:', error);
            showAlert('Error al procesar la compra.');
        }
    }

    function saveDraft() {
        const drafts = JSON.parse(localStorage.getItem('drafts')) || [];
        const name = document.getElementById('client-name').value || 'Sin nombre';
        const id = Date.now().toString(); // identificador único
        const draft = {
            id,
            name,
            cart: JSON.parse(JSON.stringify(cart)),
            client: {
                name,
                id: document.getElementById('client-id').value,
                email: document.getElementById('client-email').value,
                address: document.getElementById('client-address').value,
                phone: document.getElementById('client-phone').value,
            },
            fecha: new Date().toLocaleString()
        };
        drafts.push(draft);
        localStorage.setItem('drafts', JSON.stringify(drafts));
        showAlert('Borrador guardado correctamente.');
        // Limpia el carrito y los campos
        cart.items = [];
        cart.total = 0;
        updateCartUI();
        ['client-name','client-id','client-email','client-address','client-phone'].forEach(id => {
            const el = document.getElementById(id);
            if (el) el.value = '';
        });
        renderDraftsList();
        // Mostrar el modal del carrito después de guardar
        const cartModal = document.getElementById('cart-modal');
        if (cartModal) cartModal.classList.remove('hidden');
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
                    card.style.display = 'flex'; // Mostrar todas las tarjetas
                });
            }
        });
    });

    window.openProductDetailsModal = openProductDetailsModal;
    window.closeModal = closeProductDetailsModal;

    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('product-modal');
        if (modal) {
            modal.addEventListener('click', function (e) {
                // Solo cerrar si el click es en el fondo, no en el contenido
                if (e.target === modal) {
                    closeProductDetailsModal();
                }
            });
        }
    });

    function renderDraftsList() {
        const drafts = JSON.parse(localStorage.getItem('drafts')) || [];
        const draftsList = document.getElementById('drafts-list');
        if (!draftsList) return;
        if (drafts.length === 0) {
            draftsList.innerHTML = '<p class="text-gray-400 text-sm">No hay borradores guardados.</p>';
            return;
        }
        draftsList.innerHTML = drafts.map(draft => `
            <div class="flex items-center justify-between bg-gray-100 rounded p-2 mb-2">
                <div>
                    <span class="font-bold">${draft.name}</span>
                    <span class="text-xs text-gray-500 ml-2">${draft.fecha}</span>
                </div>
                <div>
                    <button onclick="loadDraftById('${draft.id}')" class="text-blue-600 hover:underline mr-2">Cargar</button>
                    <button onclick="deleteDraftById('${draft.id}')" class="text-red-600 hover:underline">Eliminar</button>
                </div>
            </div>
        `).join('');
    }
    window.renderDraftsList = renderDraftsList;

    function loadDraftById(id) {
        const drafts = JSON.parse(localStorage.getItem('drafts')) || [];
        const draft = drafts.find(d => d.id === id);
        if (!draft) return;
        cart = draft.cart;
        updateCartUI();
        Object.entries(draft.client).forEach(([key, value]) => {
            const el = document.getElementById('client-' + key);
            if (el) el.value = value || '';
        });
        showAlert('Borrador cargado correctamente.');
    }

    function deleteDraftById(id) {
        let drafts = JSON.parse(localStorage.getItem('drafts')) || [];
        drafts = drafts.filter(d => d.id !== id);
        localStorage.setItem('drafts', JSON.stringify(drafts));
        renderDraftsList();
        showAlert('Borrador eliminado correctamente.');
    }
    window.loadDraftById = loadDraftById;
    window.deleteDraftById = deleteDraftById;

    document.addEventListener('DOMContentLoaded', renderDraftsList);
</script>