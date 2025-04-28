<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen antialiased" style="background-color: #F5F5F5">
        <div class="flex h-screen flex-col items-center justify-center gap-4 p-4 sm:p-6 md:p-8">
            {{ $slot }}
        </div>
        @fluxScripts
    </body>
</html>