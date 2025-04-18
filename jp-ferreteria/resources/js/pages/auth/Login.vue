<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

defineProps<{
    status?: string;
    canResetPassword: boolean;
    href: string;
    tabindex: number | string;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <div class="flex min-h-screen items-center justify-center bg-gray-100">
        <div class="w-full max-w-md rounded-lg bg-white p-8 shadow-lg">
            <h2 class="mb-6 text-center text-2xl font-bold uppercase text-gray-800">Login</h2>

            <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">
                {{ status }}
            </div>

            <form @submit.prevent="submit" class="flex flex-col gap-6">
                <div class="grid gap-4">
                    <div class="grid gap-2">
                        <Label for="email" class="text-sm font-medium text-gray-700">Correo electrónico</Label>
                        <Input
                            id="email"
                            type="email"
                            required
                            autofocus
                            :tabindex="1"
                            autocomplete="email"
                            v-model="form.email"
                            placeholder="Correo electrónico"
                            class="w-full rounded-md border-none bg-gray-200 py-3 text-gray-700 placeholder-gray-500 focus:ring-2 focus:ring-orange-500"
                        />
                        <InputError :message="form.errors.email" />
                    </div>

                    <div class="grid gap-2">
                        <div class="flex items-center justify-between">
                            <Label for="password" class="text-sm font-medium text-gray-700">Contraseña</Label>
                        </div>
                        <Input
                            id="password"
                            type="password"
                            required
                            :tabindex="2"
                            autocomplete="current-password"
                            v-model="form.password"
                            placeholder="Contraseña"
                            class="w-full rounded-md border-none bg-gray-200 py-3 text-gray-700 placeholder-gray-500 focus:ring-2 focus:ring-orange-500"
                        />
                        <InputError :message="form.errors.password" />
                    </div>

                    <Button
                        type="submit"
                        class="mt-4 w-full rounded-md bg-orange-500 py-3 text-white hover:bg-orange-600 focus:ring-2 focus:ring-orange-500 focus:ring-offset-2"
                        :tabindex="4"
                        :disabled="form.processing"
                    >
                        <LoaderCircle v-if="form.processing" class="mr-2 h-4 w-4 animate-spin" />
                        Iniciar Sesión
                    </Button>
                </div>

                <div class="mt-4 text-center text-sm text-gray-600">
                    
                    <a :href="route('password.request')" class="text-blue-600 hover:underline" :tabindex="5">
                        ¿Olvidaste tu contraseña?
                    </a>
                </div>

                <div class="mt-4 text-center text-sm text-gray-600">
                    ¿No tienes una cuenta?
                    <a :href="route('register')" class="text-blue-600 hover:underline" :tabindex="5">
                        Crear una cuenta
                    </a>
                </div>
            </form>
        </div>
    </div>
</template>