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
        let estadoActual = button.getAttribute('data-estado');
        let url = estadoActual === 'activo'
            ? `/productos/${productId}/disable`
            : `/productos/${productId}/enable`;

        fetch(url, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Cambia el estado visualmente
                if (estadoActual === 'activo') {
                    button.textContent = 'Habilitar';
                    button.classList.remove('bg-red-500', 'hover:bg-red-600');
                    button.classList.add('bg-green-500', 'hover:bg-green-600');
                    button.setAttribute('data-estado', 'inactivo');
                    button.closest('tr').querySelector('span').textContent = 'Inactivo';
                    button.closest('tr').querySelector('span').className = 'text-red-600 font-bold';
                } else {
                    button.textContent = 'Deshabilitar';
                    button.classList.remove('bg-green-500', 'hover:bg-green-600');
                    button.classList.add('bg-red-500', 'hover:bg-red-600');
                    button.setAttribute('data-estado', 'activo');
                    button.closest('tr').querySelector('span').textContent = 'Activo';
                    button.closest('tr').querySelector('span').className = 'text-green-600 font-bold';
                }
            } else {
                alert('No se pudo cambiar el estado.');
            }
        })
        .catch(error => {
            alert('Error al cambiar el estado del producto');
            console.error(error);
        });
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
                document.getElementById('edit_MARCA').value = data.MARCA || '';
                document.getElementById('edit_COLOR').value = data.COLOR || '';
                document.getElementById('edit_UNIDAD_MEDIDA').value = data.UNIDAD_MEDIDA || '';
                document.getElementById('edit_MATERIAL').value = data.MATERIAL || '';
                document.getElementById('edit_DIMENSIONES').value = data.DIMENSIONES || '';
                document.getElementById('edit_USO').value = data.USO || '';
                document.getElementById('edit_NORMA').value = data.NORMA || '';
                document.getElementById('edit_PROCEDENCIA').value = data.PROCEDENCIA || '';
                document.getElementById('edit_OFERTA').checked = !!data.OFERTA;
                document.getElementById('edit_PRECIO_OFERTA').value = data.PRECIO_OFERTA || '';
                document.getElementById('edit_CUOTAS').value = data.CUOTAS || '';
                document.getElementById('edit_CUOTA_VALOR').value = data.CUOTA_VALOR || '';
                document.getElementById('edit_MAS_VENDIDO').checked = !!data.MAS_VENDIDO;
                document.getElementById('edit_CARACTERISTICAS').value = data.CARACTERISTICAS || '';

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

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-toggle-estado').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const estadoActual = this.getAttribute('data-estado');
                const url = estadoActual === 'habilitado'
                    ? `/productos/${id}/disable`
                    : `/productos/${id}/enable`;

                fetch(url, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        // Cambia el texto y color del botón
                        if (estadoActual === 'habilitado') {
                            this.textContent = 'Habilitar';
                            this.classList.remove('bg-red-500', 'hover:bg-red-600');
                            this.classList.add('bg-green-500', 'hover:bg-green-600');
                            this.setAttribute('data-estado', 'deshabilitado');
                        } else {
                            this.textContent = 'Deshabilitar';
                            this.classList.remove('bg-green-500', 'hover:bg-green-600');
                            this.classList.add('bg-red-500', 'hover:bg-red-600');
                            this.setAttribute('data-estado', 'habilitado');
                        }
                    } else {
                        alert('No se pudo cambiar el estado.');
                    }
                });
            });
        });
    });
</script>