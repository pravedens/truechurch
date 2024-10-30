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
</head>

<body class="bg-gray-50 transition-all duration-300 lg:hs-overlay-layout-open:ps-[260px] dark:bg-neutral-900">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.sidebar')

        @isset($header)
            <header class="shadow dark:bg-gray-800">
                <div class="px-2 py-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            <!-- Сообщение-->
            @if (session('success'))
            <div class="p-4 mt-2 text-sm text-center text-teal-800 bg-teal-100 border border-teal-200 rounded-lg dark:bg-teal-800/10 dark:border-teal-900 dark:text-teal-500"
                role="alert" tabindex="-1" aria-labelledby="hs-soft-color-success-label">
                <span id="hs-soft-color-success-label" class="font-bold">{{ session('success') }}</span>
            </div>
            @endif

            @if (session('danger'))
            <div class="p-4 mt-2 text-sm text-center text-red-800 bg-red-100 border border-red-200 rounded-lg dark:bg-red-800/10 dark:border-red-900 dark:text-red-500" role="alert" tabindex="-1" aria-labelledby="hs-soft-color-danger-label">
                <span id="hs-soft-color-danger-label" class="font-bold">{{ session('danger') }}</span>
              </div>
              @endif
            <!-- Конец сообщению-->
            {{ $slot }}
        </main>
    </div>
    <script src="./node_modules/preline/dist/preline.js"></script>
</body>

</html>
