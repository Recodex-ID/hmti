<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <!-- Header -->
        @include('partials.header')

        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Main Content -->
        <main>
            {{ $slot }}
        </main>

        <!-- Footer -->
        @include('partials.footer')

        @fluxScripts
    </body>
</html>
