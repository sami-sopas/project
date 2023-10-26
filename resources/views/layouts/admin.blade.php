<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Icono pagina -->
        <link rel="shortcut icon" href="{{ asset('template-app/assets/images/logo/icons8-kuromi-32.png') }}" type="image/x-icon">

        <!-- Custom css -->
        <link rel="stylesheet" href="{{ asset('template-app/assets/css/style-prefix.css') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        <!-- Iconos font awesome -->
        <link rel="stylesheet" href=" {{ asset('vendor/fontawesome-free-6.4.2-web/css/all.min.css') }}">

        {{-- CKEditor--}}
        <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

        {{-- SweetAlert 2--}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @livewireStyles
    </head>
    
    <body class="font-sans antialiased">
        <x-banner/>
        <div class="min-h-screen">
            <!-- LLama a un componente de livewire -->
            {{-- @livewire('nav-bar') --}}
            
            @livewire('navigation-menu')
        
            
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <!-- Slot por nombre, se renderiza con el x-slot name="header" -->
                        {{ $header }}
                    </div>
                </header>
            @endif
            

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <!-- Footer -->
            <x-footer/>
        </div>

        @stack('modals')

        @livewireScripts

        <!-- Custom JS -->
        <script src="{{ asset('template-app/assets/js/script.js') }}"></script>

        <!-- Ionicon link -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

        @stack('script')
    </body>
</html>
