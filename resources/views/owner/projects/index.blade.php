<x-owner-layout>
    <x-slot name="header">
        Proyek Saya
    </x-slot>

    <div class="max-w-4xl mx-auto">

        <!-- Header Section dengan Stats -->
        <div class="mb-6">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Proyek Anda</h1>
                    <p class="text-sm text-gray-500 mt-1">Kelola dan pantau semua proyek Anda</p>
                </div>

                <!-- Simple Filter/Sort (Optional) -->
                <form id="filterForm" method="GET">
                    <select name="status" onchange="document.getElementById('filterForm').submit()"
                        class="text-sm border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="on_progress" {{ request('status') == 'on_progress' ? 'selected' : '' }}>Sedang
                            Berjalan</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai
                        </option>
                    </select>
                </form>

            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-3 gap-3 mb-2">
                <div class="bg-gradient-to-br from-amber-50 to-amber-100 rounded-xl p-3 border border-amber-200">
                    <div class="text-xs font-medium text-amber-700 mb-1">Pending</div>
                    <div class="text-xl font-bold text-amber-900">
                        {{ $allProjects->where('status', 'pending')->count() }}
                    </div>
                </div>
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-3 border border-blue-200">
                    <div class="text-xs font-medium text-blue-700 mb-1">Berjalan</div>
                    <div class="text-xl font-bold text-blue-900">
                        {{ $allProjects->where('status', 'on_progress')->count() }}</div>
                </div>
                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-3 border border-green-200">
                    <div class="text-xs font-medium text-green-700 mb-1">Selesai</div>
                    <div class="text-xl font-bold text-green-900">
                        {{ $allProjects->where('status', 'completed')->count() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Projects List -->
        <div class="space-y-3">
            @forelse ($projects as $project)
                <a href="{{ route('owner.projects.show', $project->id) }}"
                    class="group block bg-white rounded-2xl border border-gray-200 hover:border-indigo-300 hover:shadow-lg transition-all duration-300 overflow-hidden">

                    <!-- Status Bar -->
                    @php
                        $statusConfig = [
                            'pending' => [
                                'color' => 'bg-amber-500',
                                'label' => 'Menunggu',
                                'bgColor' => 'bg-amber-50',
                                'textColor' => 'text-amber-700',
                                'borderColor' => 'border-amber-200',
                            ],
                            'on_progress' => [
                                'color' => 'bg-blue-500',
                                'label' => 'Sedang Berjalan',
                                'bgColor' => 'bg-blue-50',
                                'textColor' => 'text-blue-700',
                                'borderColor' => 'border-blue-200',
                            ],
                            'completed' => [
                                'color' => 'bg-green-500',
                                'label' => 'Selesai',
                                'bgColor' => 'bg-green-50',
                                'textColor' => 'text-green-700',
                                'borderColor' => 'border-green-200',
                            ],
                        ];
                        $status = $statusConfig[$project->status] ?? $statusConfig['pending'];
                    @endphp

                    <div class="h-1.5 {{ $status['color'] }} w-full"></div>

                    <!-- Content -->
                    <div class="p-4">
                        <!-- Header -->
                        <div class="flex items-start justify-between gap-3 mb-3">
                            <div class="flex-1 min-w-0">
                                <h2
                                    class="font-bold text-lg text-gray-900 mb-1 group-hover:text-indigo-600 transition-colors line-clamp-1">
                                    {{ $project->project_name }}
                                </h2>

                                <!-- Status Badge -->
                                <span
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold {{ $status['bgColor'] }} {{ $status['textColor'] }} border {{ $status['borderColor'] }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $status['color'] }} animate-pulse"></span>
                                    {{ $status['label'] }}
                                </span>
                            </div>

                            <!-- Arrow Icon -->
                            <div
                                class="flex-shrink-0 w-8 h-8 bg-gray-50 rounded-full flex items-center justify-center group-hover:bg-indigo-50 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-4 h-4 text-gray-400 group-hover:text-indigo-600 group-hover:translate-x-0.5 transition-all"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>

                        <!-- Description -->
                        @if ($project->description)
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2 leading-relaxed">
                                {{ $project->description }}
                            </p>
                        @else
                            <p class="text-sm text-gray-400 italic mb-4">
                                Tidak ada deskripsi
                            </p>
                        @endif

                        <!-- Date Info -->
                        <div class="flex flex-wrap items-center gap-4 pt-3 border-t border-gray-100">
                            <div class="flex items-center gap-2 text-xs">
                                <div
                                    class="w-7 h-7 bg-indigo-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-indigo-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-gray-400 font-medium">Mulai</div>
                                    <div class="text-gray-700 font-semibold">
                                        {{ \Carbon\Carbon::parse($project->start_date)->format('d M Y') }}</div>
                                </div>
                            </div>

                            <div class="w-px h-8 bg-gray-200"></div>

                            <div class="flex items-center gap-2 text-xs">
                                <div
                                    class="w-7 h-7 bg-gray-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-gray-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-gray-400 font-medium">Target</div>
                                    <div class="text-gray-700 font-semibold">
                                        {{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('d M Y') : 'Belum ditentukan' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <!-- Empty State -->
                <div class="bg-white rounded-2xl border-2 border-dashed border-gray-200 p-12 text-center">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Proyek</h3>
                    <p class="text-gray-500 text-sm max-w-sm mx-auto">
                        Anda belum memiliki proyek yang ditugaskan. Proyek baru akan muncul di sini ketika Anda
                        ditambahkan ke dalam tim.
                    </p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($projects->hasPages())
            <div class="mt-6">
                {{-- {{ $projects->links() }} --}}
                {{ $projects->appends(request()->query())->links() }}
            </div>
        @endif
    </div>

    <!-- Custom Styles -->
    <style>
        /* Smooth animations */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .group {
            animation: slideIn 0.3s ease-out;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Line clamp utility jika belum ada di Tailwind config */
        .line-clamp-1 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 1;
        }

        .line-clamp-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }
    </style>

</x-owner-layout>
