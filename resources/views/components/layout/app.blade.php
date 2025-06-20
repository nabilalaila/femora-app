<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Femora</title>
    <script type="module" src="https://unpkg.com/cally"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <meta name="route-store" content="{{ route('kalender.store') }}">
    <meta name="route-update" content="{{ route('kalender.update') }}">
    <meta name="route-destroy" content="{{ route('kalender.destroy') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="font-poppins">

    @if (empty($noNavbar))
        @include('components.navbar')
    @endif

    <div class="flex">
        @if (session('success'))
            <x-toast type="success" :message="session('success')" />
        @endif

        @if (session('error'))
            <x-toast type="error" :message="session('error')" />
        @endif
        @if (empty($noSidebar) && Auth::check())
            <aside class="w-64 hidden md:block">
                @if (Auth::user()->role === 'pengguna')
                    @include('components.sidebar.sidebar-pengguna')
                @elseif (Auth::user()->role === 'admin')
                    @include('components.sidebar.sidebar-admin')
                @endif
            </aside>
        @endif
        @php
            $marginLeft =
                Auth::check() && Auth::user()->role === 'admin' ? 'md:ml-[325px]' : (Auth::check() ? 'md:ml-12' : '');
        @endphp

        <main class="flex-1 transition-all duration-300 {{ $marginLeft }}">
            @yield('content')
            @yield('scripts')
        </main>
    </div>

    @if (empty($noNavbar))
        @include('components.footer')
    @endif
    @stack('scripts')
</body>

</html>
