<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @vite('resources/css/app.css')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    </head>
    <body>
        @include('master.header')
<div class="flex min-h-screen">
    <!-- Side menu -->
    <div class="hidden lg:block w-1/5 bg-gray-200">
        @include('master.sidemenu')
    </div>

    <!-- Mobile drawer toggle button -->
    <div class="lg:hidden p-4 bg-gray-800 text-white flex justify-between items-center">
        <button @click="isOpen = !isOpen" class="focus:outline-none">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12H4m0 6h16"></path>
            </svg>
        </button>
        <div class="text-xl">App Title</div>
    </div>

    <!-- Mobile drawer -->
    <div x-show="isOpen" class="lg:hidden absolute inset-0 bg-gray-800 bg-opacity-75 z-50 flex">
        <div class="w-4/5 bg-gray-200 p-4 h-full">
            <button @click="isOpen = false" class="focus:outline-none">
                <svg class="h-6 w-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            @include('master.sidemenu')
        </div>
    </div>

    <!-- Main content -->
    <div class="flex-1 p-4">
        @yield('content')
    </div>
</div>

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('drawer', () => ({
            isOpen: false,
        }))
    })
</script>
    </body>
</html>
