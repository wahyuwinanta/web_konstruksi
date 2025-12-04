<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CV. Mulia Mandiri Konstruksi') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Hapus flicker saat load -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Sidebar State -->
    <script>
        function menuState() {
            return {
                openMenus: {
                    company: false,
                    landing: false,
                    management: false,
                    stories: false,
                    project: false,
                },
                init() {
                    // Delay kecil agar localStorage sempat dibaca
                    setTimeout(() => {
                        const savedState = localStorage.getItem('openMenus');
                        if (savedState) {
                            this.openMenus = JSON.parse(savedState);
                        }

                        this.$watch('openMenus', value => {
                            localStorage.setItem('openMenus', JSON.stringify(value));
                        });

                        this.activateFromRoute();
                    }, 50);
                },
                activateFromRoute() {
                    @if (request()->routeIs('admin.hero_sections.*') ||
                            request()->routeIs('admin.principles.*') ||
                            request()->routeIs('admin.statistics.*'))
                        this.openMenus.company = true;
                        this.openMenus.landing = true;
                    @endif

                    @if (request()->routeIs('admin.teams.*') ||
                            request()->routeIs('admin.products.*') ||
                            request()->routeIs('admin.abouts.*') ||
                            request()->routeIs('admin.appointments.*'))
                        this.openMenus.company = true;
                        this.openMenus.management = true;
                    @endif

                    @if (request()->routeIs('admin.testimonials.*') || request()->routeIs('admin.clients.*'))
                        this.openMenus.company = true;
                        this.openMenus.stories = true;
                    @endif

                    @if (request()->routeIs('admin.users.*'))
                        this.openMenus.project = true;
                    @endif

                    @if (request()->routeIs('admin.projects.*') || request()->routeIs('admin.schedules.*'))
                        this.openMenus.project = true;
                    @endif

                }
            };
        }
    </script>
</head>

<body class="font-sans antialiased bg-gray-100">
    <div x-data="{ open: false }" class="flex min-h-screen">

        <!-- Sidebar -->
        <aside :class="open ? 'translate-x-0' : '-translate-x-full'"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-x-10"
            x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 -translate-x-10"
            class="fixed inset-y-0 left-0 w-64 bg-white shadow-md transform transition-transform duration-200 ease-in-out sm:translate-x-0 sm:static sm:inset-0 z-20"
            x-cloak>

            <div class="p-6 flex justify-between items-center border-b">
                <a href="{{ route('front.index') }}" class="flex items-center gap-2">
                    <x-application-logo class="block h-8 w-auto text-indigo-600" />
                    <span class="font-bold text-indigo-500 text-sm">Mulia Mandiri </b> Konstruksi</span>
                </a>
                <button @click="open = false" class="sm:hidden text-gray-600 focus:outline-none">✕</button>
            </div>

            <nav class="p-4 space-y-2 overflow-y-auto" x-data="menuState()" x-init="init()" x-cloak>
                @include('layouts.navigation')
            </nav>
        </aside>

        <!-- Main content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow flex items-center justify-between px-6 py-4">
                <div class="flex items-center gap-4">
                    <button @click="open = true" class="sm:hidden text-gray-600 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    @isset($header)
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $header }}</h2>
                    @endisset
                </div>

                <!-- Profile dropdown -->
                <div class="relative" x-data="{ dropdownOpen: false }">
                    <button @click="dropdownOpen = !dropdownOpen"
                        class="flex items-center gap-3 bg-gray-50 hover:bg-gray-100 border rounded-full px-3 py-1 transition">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=4F46E5&color=fff"
                            alt="Avatar" class="w-8 h-8 rounded-full border border-indigo-600">
                        <span class="hidden sm:inline text-gray-800 font-medium">{{ Auth::user()->name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-xl shadow-lg overflow-hidden z-50"
                        x-cloak>
                        <a href="{{ route('profile.editAdmin') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profile</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
