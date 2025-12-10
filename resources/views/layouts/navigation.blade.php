<ul class="space-y-2 text-gray-700" x-data="menuState()" x-init="init()">
    <!-- Home -->
    <li>
        <x-nav-link :href="route('front.index')" :active="request()->routeIs('front.index')">
            {{ __('Beranda') }}
        </x-nav-link>
    </li>

    <!-- Company Profile -->
    <li class="mt-4">
        <button @click="openMenus.company = !openMenus.company"
            class="w-full flex justify-between items-center text-left font-semibold text-gray-500 uppercase text-xs hover:text-indigo-600 transition">
            <span>Profil Perusahaan</span>
            <svg :class="openMenus.company ? 'rotate-180 text-indigo-600' : 'text-gray-400'"
                class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <ul x-show="openMenus.company" x-collapse class="ml-4 mt-2 space-y-2 text-sm">

            <!-- Landing Page -->
            <li>
                <button @click="openMenus.landing = !openMenus.landing"
                    class="w-full flex justify-between items-center text-left text-gray-600 hover:text-indigo-600 font-medium transition">
                    <span>Halaman Utama</span>
                    <svg :class="openMenus.landing ? 'rotate-180 text-indigo-600' : 'text-gray-400'"
                        class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <ul x-show="openMenus.landing" x-collapse class="ml-4 mt-1 space-y-1">
                    <li><x-nav-link :href="route('admin.hero_sections.index')" :active="request()->routeIs('admin.hero_sections.*')">Bagian Hero</x-nav-link></li>
                    <li><x-nav-link :href="route('admin.principles.index')" :active="request()->routeIs('admin.principles.*')">Prinsip Kami</x-nav-link></li>
                    <li><x-nav-link :href="route('admin.statistics.index')" :active="request()->routeIs('admin.statistics.*')">Statistik Perusahaan</x-nav-link></li>
                </ul>
            </li>

            <!-- Management -->
            <li>
                <button @click="openMenus.management = !openMenus.management"
                    class="w-full flex justify-between items-center text-left text-gray-600 hover:text-indigo-600 font-medium transition">
                    <span>Manajemen</span>
                    <svg :class="openMenus.management ? 'rotate-180 text-indigo-600' : 'text-gray-400'"
                        class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <ul x-show="openMenus.management" x-collapse class="ml-4 mt-1 space-y-1">
                    <li><x-nav-link :href="route('admin.teams.index')" :active="request()->routeIs('admin.teams.*')">Tim Kami</x-nav-link></li>
                    <li><x-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.*')">Produk Kami</x-nav-link></li>
                    <li><x-nav-link :href="route('admin.abouts.index')" :active="request()->routeIs('admin.abouts.*')">Tentang Kami</x-nav-link></li>
                    <li><x-nav-link :href="route('admin.appointments.index')" :active="request()->routeIs('admin.appointments.*')">Janji Temu</x-nav-link></li>
                </ul>
            </li>

            <!-- Stories -->
            <li>
                <button @click="openMenus.stories = !openMenus.stories"
                    class="w-full flex justify-between items-center text-left text-gray-600 hover:text-indigo-600 font-medium transition">
                    <span>Kisah</span>
                    <svg :class="openMenus.stories ? 'rotate-180 text-indigo-600' : 'text-gray-400'"
                        class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <ul x-show="openMenus.stories" x-collapse class="ml-4 mt-1 space-y-1">
                    <li><x-nav-link :href="route('admin.testimonials.index')" :active="request()->routeIs('admin.testimonials.*')">Testimoni</x-nav-link></li>
                    <li><x-nav-link :href="route('admin.clients.index')" :active="request()->routeIs('admin.clients.*')">Klien Kami</x-nav-link></li>
                </ul>
            </li>
        </ul>
    </li>

    <!-- Project Management -->
    <li class="mt-4">
        <button @click="openMenus.project = !openMenus.project"
            class="w-full flex justify-between items-center text-left font-semibold text-gray-500 uppercase text-xs hover:text-indigo-600 transition">
            <span>Manajemen Proyek</span>
            <svg :class="openMenus.project ? 'rotate-180 text-indigo-600' : 'text-gray-400'"
                class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <ul x-show="openMenus.project" x-collapse class="ml-4 mt-2 space-y-1 text-sm">
            <li><x-nav-link :href="route('admin.projects.index')" :active="request()->routeIs('admin.projects.*')">Proyek</x-nav-link></li>
            <li><x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">Kelola Pengguna</x-nav-link></li>
        </ul>
    </li>
</ul>
