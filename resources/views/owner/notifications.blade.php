<x-owner-layout>
    @slot('header')
        Notifikasi
    @endslot

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Header Section -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Notifikasi</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola dan lihat semua notifikasi Anda</p>
        </div>

        @if (session('error'))
            <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded mb-3">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded mb-3">
                {{ session('success') }}
            </div>
        @endif

        <!-- Notifications List -->
        <div class="space-y-3">

            @if ($notifications->count() == 0)
                <!-- Empty State -->
                <div class="flex flex-col items-center justify-center py-16 px-4">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Tidak ada notifikasi</h3>
                    <p class="text-sm text-gray-500 text-center max-w-sm">
                        Anda akan menerima notifikasi di sini ketika ada update penting
                    </p>
                </div>
            @endif

            @foreach ($notifications as $notif)
                <div
                    class="group relative bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden
                    {{ $notif->is_read ? 'border border-gray-100' : 'border-2 border-indigo-200 bg-gradient-to-r from-indigo-50 to-white' }}">

                    <a href="{{ route('owner.notifications.open', $notif->id) }}" class="block p-5 sm:p-6">
                        <div class="flex gap-4">

                            <!-- Icon/Avatar -->
                            <div class="flex-shrink-0">
                                <div
                                    class="w-12 h-12 rounded-full flex items-center justify-center
                                    {{ $notif->is_read ? 'bg-gray-100' : 'bg-indigo-100' }}">
                                    <svg class="w-6 h-6 {{ $notif->is_read ? 'text-gray-500' : 'text-indigo-600' }}"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                        </path>
                                    </svg>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="flex-1">
                                        <h3
                                            class="text-base font-semibold text-gray-900 mb-1 group-hover:text-indigo-600 transition-colors">
                                            {{ $notif->title }}
                                        </h3>
                                        <p class="text-sm text-gray-600 leading-relaxed mb-2">
                                            {{ $notif->message }}
                                        </p>
                                        <div class="flex items-center gap-2 text-xs text-gray-500">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span>{{ $notif->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>

                                    <!-- Mark as Read Button -->
                                    @if (!$notif->is_read)
                                        <form action="{{ route('owner.notifications.read', $notif->id) }}"
                                            method="POST" onclick="event.stopPropagation();" class="flex-shrink-0">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-indigo-700 bg-indigo-100 rounded-lg hover:bg-indigo-200 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                <span class="hidden sm:inline">Tandai dibaca</span>
                                                <span class="sm:hidden">Baca</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </a>

                    <!-- Unread Indicator Dot -->
                    @if (!$notif->is_read)
                        <div class="absolute top-4 right-4 w-2.5 h-2.5 bg-indigo-600 rounded-full animate-pulse"></div>
                    @endif

                </div>
            @endforeach

        </div>

        <!-- Pagination (if needed) -->
        @if ($notifications->hasPages())
            <div class="mt-8">
                {{ $notifications->links() }}
            </div>
        @endif

    </div>

</x-owner-layout>
