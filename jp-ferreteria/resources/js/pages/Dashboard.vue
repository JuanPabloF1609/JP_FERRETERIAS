<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'; // Importamos Link de Inertia.js

const breadcrumbs = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <div class="flex h-screen bg-gray-100">


        <div class="flex-1 flex flex-col items-center justify-center bg-white shadow-lg rounded-lg mx-4 my-8">
                    <!-- Botón de Cerrar Sesión -->
            <div class="absolute top-10 right-6">
                <Link class="flex items-center bg-red-500 font-semibold text-white px-4 py-2 rounded-lg shadow-md hover:bg-red-400 transition duration-300 transform hover:scale-105" method="post" :href="route('logout')" as="button">
                        Cerrar Sesión
                </Link>
            </div>
            <div class="text-center mb-6">
                <h1 class="text-5xl font-extrabold text-gray-800 mb-4">🛠️Bienvenido a JP-Ferretería🛠️</h1>
                <p class="text-lg text-gray-600">Tu sistema de gestión de ferretería</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <!-- Botón para Administrador -->

                <a href="/dash_admin" class="flex flex-col items-center bg-gray-50 p-6 rounded-lg shadow-md text-gray-700 hover:bg-orange-500 hover:text-white transition duration-300 transform hover:scale-110">
                    <h2 class="text-xl font-semibold">Administrador</h2>
                    <p class="text-sm ">Accede al panel de administración</p>
                </a>


                <!-- Botón para Caja -->

                <a href="/cashier" class="flex flex-col items-center bg-gray-50 p-6 rounded-lg shadow-md text-gray-700 hover:bg-green-500 hover:text-white transition duration-300 transform hover:scale-110">
                    <h2 class="text-xl font-semibold">Caja</h2>
                    <p class="text-sm ">Gestiona tus pedidos y ventas</p>
                </a>


                <!-- Botón para Domiciliario -->

                <a href="/delivery" class="flex flex-col items-center bg-gray-50 p-6 rounded-lg shadow-md text-gray-700 hover:bg-blue-500 hover:text-white transition duration-300 transform hover:scale-110">
                    <h2 class="text-xl font-semibold ">Repartidor</h2>
                    <p class="text-sm">Gestiona tus órdenes de entrega</p>
                </a>

            </div>
        </div>
    </div>
</template>