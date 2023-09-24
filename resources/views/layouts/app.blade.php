<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        <!-- Iconos font awesome -->
        <link rel="stylesheet" href=" {{ asset('vendor/fontawesome-free-6.4.2-web/css/all.min.css') }}">
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner/>

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <!-- LLama a un componente de livewire -->
            @livewire('nav-bar')

            {{-- 
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <!-- Slot por nombre, se renderiza con el x-slot name="header" -->
                        {{ $header }}
                    </div>
                </header>
            @endif
            {{ --}}

            <!-- Page Content -->
            <main>
                <!-- En este slot se renderiza el dashboard -->
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
