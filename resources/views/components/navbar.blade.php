<nav class="bg-cp-black w-full">
    <div class="max-w-[1200px] mx-auto px-4">
        <div class="nav-inner flex items-center justify-between h-[72px] relative">

            <!-- LOGO -->
            <div class="flex items-center gap-3">
                <img src="{{ asset('assets/logo/Logo-MMK-White.png') }}" class="h-9 w-auto" alt="logo">
                <div class="flex flex-col">
                    <span class="text-white font-semibold text-xs">
                        CV. MULIA MANDIRI KONSTRUKSI
                    </span>
                    <span class="text-white/70 text-[10px]">
                        Mitra Konstruksi Anda
                    </span>
                </div>
            </div>

            <!-- HAMBURGER -->
            <input type="checkbox" id="nav-toggle" class="nav-toggle hidden">
            <label for="nav-toggle" class="hamburger md:hidden">
                <span></span>
                <span></span>
                <span></span>
            </label>

            <!-- MENU -->
            <div class="nav-menu flex items-center gap-8 text-sm font-medium text-white/80">
                <a href="{{ route('front.index') }}">Beranda</a>
                <a href="{{ route('front.team') }}">Tim</a>
                <a href="{{ route('front.about') }}">Tentang</a>
                <a href="{{ route('front.appointment') }}"
                    class="ml-6 px-4 py-2 rounded-md bg-cp-dark-blue text-white
                            font-semibold transition hover:bg-gray-100">
                    Buat Janji
                </a>
            </div>

        </div>
    </div>
</nav>
