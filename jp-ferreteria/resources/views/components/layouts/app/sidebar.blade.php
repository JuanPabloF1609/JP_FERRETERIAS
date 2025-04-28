<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen" style="background-color: #F5F5F5">
        <flux:sidebar sticky stashable class="border-e border-zinc-200" style="background-color: #D9D9D9">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse hover:bg-gray-200 text-gray-800 font-medium" wire:navigate>
                
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Platform')">
                    <!-- Dashboard -->
                    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" class="me-5 flex items-center space-x-2 rtl:space-x-reverse hover:bg-gray-200 text-gray-800 font-medium" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>

                    <!-- Opciones para Administrador -->
                    @can('view_users')
                        <flux:navlist.item icon="users" :href="route('admin.users.index')" :current="request()->routeIs('users.*')" wire:navigate>{{ __('Empleados') }}</flux:navlist.item>
                    @endcan
                    @can('view_products')
                        <flux:navlist.item icon="cube" :href="route('admin.products.index')" :current="request()->routeIs('products.*')" wire:navigate>{{ __('Productos') }}</flux:navlist.item>
                    @endcan
                    @can('view_categories')
                        <flux:navlist.item icon="tag" :href="route('admin.categories.index')" :current="request()->routeIs('categories.*')" wire:navigate>{{ __('Categorias') }}</flux:navlist.item>
                    @endcan

                    <!-- Opciones para Caja -->
                    @can('view_bill')
                        <flux:navlist.item icon="document-text" :href="route('bills.index')" :current="request()->routeIs('bills.*')" wire:navigate>{{ __('Ventas') }}</flux:navlist.item>
                    @endcan

                    <!-- Opciones para Caja y Domiciliario -->
                    @can('view_delivery_order')
                        <flux:navlist.item icon="truck" :href="route('delivery-orders.index')" :current="request()->routeIs('delivery-orders.*')" wire:navigate>{{ __('Ordenes') }}</flux:navlist.item>
                    @endcan
                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            <!-- Desktop User Menu -->
            <flux:dropdown position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal text-black">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm text-black">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold text-black">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs text-black">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate class="text-black">{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full text-black">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold text-black">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs text-black">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate class="text-black">{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full text-black">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>