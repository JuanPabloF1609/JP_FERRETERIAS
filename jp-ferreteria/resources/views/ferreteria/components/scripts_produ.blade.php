 <!-- Scripts -->
 <script>
    const modal = document.getElementById('formularioModal');
    function mostrarFormulario() {
        modal.classList.remove('hidden');
    }
    function ocultarFormulario() {
        modal.classList.add('hidden');
    }

    function toggleProductStatus(productId, button) {
        if (confirm('¿Estás seguro de cambiar el estado de este producto?')) {
            fetch(`/admin/productos/${productId}/toggle-status`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Cambiar el texto y color del botón
                    if (data.new_status) {
                        button.textContent = 'Desactivar';
                        button.classList.remove('bg-green-500', 'hover:bg-green-600');
                        button.classList.add('bg-red-500', 'hover:bg-red-600');
                    } else {
                        button.textContent = 'Activar';
                        button.classList.remove('bg-red-500', 'hover:bg-red-600');
                        button.classList.add('bg-green-500', 'hover:bg-green-600');
                    }
                    
                    // Opcional: Mostrar notificación
                    alert(data.message);
                    
                    // Opcional: Recargar la fila o tabla si es necesario
                    // location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al cambiar el estado del producto');
            });
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const searchBtn = document.querySelector('.btn-buscar');
        const searchInput = document.querySelector('input[type="text"]');
        
        searchBtn.addEventListener('click', buscarProductos);
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') buscarProductos();
        });
        
        function buscarProductos() {
            const termino = searchInput.value.trim();
            
            if (!termino) {
                alert('Por favor ingrese un término de búsqueda');
                return;
            }
            
            fetch(`/productos/buscar?q=${termino}`)
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('productos-container');
                    container.innerHTML = '';
                    
                    if (data.length === 0) {
                        container.innerHTML = '<tr><td colspan="7">No se encontraron resultados</td></tr>';
                        return;
                    }
                    
                    data.forEach(producto => {
                        container.innerHTML += `
                            <tr>
                                <td>${producto.ID_PRODUCTO}</td>
                                <td>${producto.NOMBRE_PRODUCTO}</td>
                                <td>${producto.categoria?.NOMBRE_CATEGORIA || 'Sin categoría'}</td>
                                <td>${producto.DESCRIPCION}</td>
                                <td>${producto.CANTIDAD}</td>
                                <td>${producto.PRECIO}</td>
                                <td>
                                    <button onclick="editarProducto(${producto.ID_PRODUCTO})" class="btn-editar">
                                        Editar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al buscar productos');
                });
            }
    });
    
    function abrirModalEditar(productoId) {
        const modal = document.getElementById('modalEditarProducto');
        const form = document.getElementById('formEditarProducto');

        // Realizar una solicitud AJAX para obtener los datos del producto
        fetch(`/productos/${productoId}`)
            .then(response => response.json())
            .then(data => {
                // Llenar los campos del formulario con los datos del producto
                document.getElementById('edit_NOMBRE_PRODUCTO').value = data.NOMBRE_PRODUCTO;
                document.getElementById('edit_PRECIO').value = data.PRECIO;
                document.getElementById('edit_CANTIDAD').value = data.CANTIDAD;
                document.getElementById('edit_STOCK_MINIMO').value = data.STOCK_MINIMO;
                document.getElementById('edit_REFERENCIA').value = data.REFERENCIA;
                document.getElementById('edit_DESCRIPCION').value = data.DESCRIPCION;

                // Seleccionar la categoría correcta en el <select>
                const categoriaSelect = document.getElementById('edit_ID_CATEGORIA');
                categoriaSelect.value = data.ID_CATEGORIA;

                // Actualizar la acción del formulario
                form.action = `/productos/${productoId}`;
            })
            .catch(error => console.error('Error al obtener los datos del producto:', error));

        modal.classList.remove('hidden');
    }

    function cerrarModalEditar() {
        const modal = document.getElementById('modalEditarProducto');
        modal.classList.add('hidden');
    }
</script>