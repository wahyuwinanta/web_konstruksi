<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'CV. Mulia Mandiri Konstruksi') }} - Pimpinan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Header dengan backdrop blur effect */
        .header-blur {
            backdrop-filter: blur(12px);
            background-color: rgba(255, 255, 255, 0.85);
            border-bottom: 1px solid rgba(229, 231, 235, 0.5);
        }

        /* Bottom Nav dengan glassmorphism */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(229, 231, 235, 0.5);
            display: flex;
            justify-content: space-around;
            padding: 0.5rem 1rem 0.75rem;
            z-index: 50;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.05);
        }

        .bottom-nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex: 1;
            padding: 0.5rem;
            gap: 0.25rem;
            color: #9ca3af;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            border-radius: 12px;
        }

        .bottom-nav-item:active {
            transform: scale(0.95);
        }

        .bottom-nav-item.active {
            color: #6366f1;
        }

        /* Icon wrapper dengan animasi */
        .nav-icon-wrapper {
            position: relative;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .bottom-nav-item.active .nav-icon-wrapper {
            transform: translateY(-2px);
        }

        /* Active indicator - dot dibawah icon */
        .nav-indicator {
            position: absolute;
            bottom: -6px;
            width: 4px;
            height: 4px;
            background: #6366f1;
            border-radius: 50%;
            opacity: 0;
            transform: scale(0);
            transition: all 0.3s ease;
        }

        .bottom-nav-item.active .nav-indicator {
            opacity: 1;
            transform: scale(1);
        }

        .nav-label {
            font-size: 0.6875rem;
            font-weight: 500;
            letter-spacing: 0.01em;
            transition: all 0.3s ease;
        }

        .bottom-nav-item.active .nav-label {
            font-weight: 600;
        }

        /* Profile dropdown dengan smooth animation */
        .dropdown-menu {
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(229, 231, 235, 0.5);
        }

        /* Avatar dengan hover effect */
        .avatar-wrapper {
            position: relative;
            transition: transform 0.2s ease;
        }

        .avatar-wrapper:hover {
            transform: scale(1.05);
        }

        /* Smooth transitions */
        * {
            -webkit-tap-highlight-color: transparent;
        }

        /* Content padding untuk bottom nav */
        .main-content {
            padding-bottom: 5rem;
        }

        /* Menu button hover effect */
        .menu-btn {
            transition: all 0.2s ease;
        }

        .menu-btn:active {
            transform: scale(0.95);
        }

        /* Profile button dengan subtle hover */
        .profile-btn {
            transition: all 0.2s ease;
        }

        .profile-btn:hover {
            background-color: #f9fafb;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        /* Icon filter untuk active state */
        .bottom-nav-item.active img {
            filter: brightness(0) saturate(100%) invert(45%) sepia(89%) saturate(2295%) hue-rotate(226deg) brightness(99%) contrast(95%);
        }

        .bottom-nav-item img {
            transition: filter 0.3s ease;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans antialiased">

    <div class="min-h-screen">

        <!-- Header dengan Blur Effect -->
        <header class="header-blur sticky top-0 z-40 px-4 py-3.5">
            <div class="flex items-center justify-between max-w-7xl mx-auto">
                <!-- Left Section -->
                <div class="flex items-center gap-3">


                    @isset($header)
                        <h2 class="font-bold text-lg text-gray-900 leading-tight tracking-tight">{{ $header }} Pimpinan
                        </h2>
                    @endisset
                </div>

                <!-- Profile Dropdown -->
                <div class="relative" x-data="{ dropdownOpen: false }">
                    <button @click="dropdownOpen = !dropdownOpen"
                        class="profile-btn flex items-center gap-2.5 bg-white border border-gray-200 rounded-full pl-1 pr-3 py-1 transition-all">
                        <div class="avatar-wrapper">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6366f1&color=fff"
                                alt="Avatar" class="w-9 h-9 rounded-full">
                        </div>
                        <span
                            class="hidden sm:inline text-gray-900 font-semibold text-sm">{{ Auth::user()->name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500 transition-transform"
                            :class="dropdownOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95 translate-y-[-10px]"
                        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="dropdown-menu absolute right-0 mt-3 w-56 bg-white rounded-2xl overflow-hidden z-50"
                        x-cloak>

                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-xs text-gray-500 font-medium">Akun Anda</p>
                            <p class="text-sm text-gray-900 font-semibold mt-0.5">{{ Auth::user()->name }}</p>
                        </div>

                        <div class="py-2">
                            <a href="{{ route('profile.editPimpinan') }}"
                                class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span class="font-medium">Profile</span>
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex items-center gap-3 w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    <span class="font-medium">Keluar</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="main-content px-4 py-5 max-w-7xl mx-auto">
            {{ $slot }}
        </main>
    </div>

    <!-- Modern Bottom Navigation -->
    <nav class="bottom-nav sm:hidden">
        <a href="{{ route('pimpinan.dashboard') }}"
            class="bottom-nav-item {{ request()->routeIs('pimpinan.dashboard') ? 'active' : '' }}">
            <div class="nav-icon-wrapper">
                <img src="{{ asset('assets/icons/dashboards.png') }}" alt="Beranda" width="24" height="24">
                <div class="nav-indicator"></div>
            </div>
            <span class="nav-label">Beranda Pimpinan</span>
        </a>

        <a href="{{ route('pimpinan.projects') }}"
            class="bottom-nav-item {{ request()->routeIs('pimpinan.projects*') ? 'active' : '' }}">
            <div class="nav-icon-wrapper">
                <img src="{{ asset('assets/icons/workers.png') }}" alt="Proyek" width="24" height="24">
                <div class="nav-indicator"></div>
            </div>
            <span class="nav-label">Proyek Pimpinan</span>
        </a>

        <a href="{{ route('pimpinan.notifications') }}"
            class="bottom-nav-item {{ request()->routeIs('pimpinan.notifications*') ? 'active' : '' }}">
            <div class="nav-icon-wrapper">
                <img src="{{ asset('assets/icons/notification_off.png') }}" alt="Notifikasi" width="24"
                    height="24">
                <div class="nav-indicator"></div>
            </div>
            <span class="nav-label">Notifikasi Pimpinan</span>
        </a>

        <a href="{{ route('profile.editPimpinan') }}"
            class="bottom-nav-item {{ request()->routeIs('pimpinan.profile') ? 'active' : '' }}">
            <div class="nav-icon-wrapper">
                <img src="{{ asset('assets/icons/user.png') }}" alt="Profil" width="24" height="24">
                <div class="nav-indicator"></div>
            </div>
            <span class="nav-label">Profil Pimpinan</span>
        </a>
    </nav>

</body>

</html>
