<x-pimpinan-layout>
    <x-slot name="header">
        Detail Proyek
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-5">

        <!-- Back Button -->
        <a href="{{ route('pimpinan.projects') }}"
            class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-indigo-600 transition-colors group">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span>Kembali ke Daftar Proyek</span>
        </a>

        <!-- Project Header Card -->
        <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl overflow-hidden shadow-xl">
            <div class="p-6 text-white">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        @php
                            $statusConfig = [
                                'pending' => [
                                    'label' => 'Menunggu',
                                    'bgColor' => 'bg-amber-400',
                                    'textColor' => 'text-amber-900',
                                    'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                                ],
                                'on_progress' => [
                                    'label' => 'Sedang Berjalan',
                                    'bgColor' => 'bg-blue-400',
                                    'textColor' => 'text-blue-900',
                                    'icon' => 'M13 10V3L4 14h7v7l9-11h-7z',
                                ],
                                'completed' => [
                                    'label' => 'Selesai',
                                    'bgColor' => 'bg-green-400',
                                    'textColor' => 'text-green-900',
                                    'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                                ],
                            ];
                            $status = $statusConfig[$project->status] ?? $statusConfig['pending'];
                        @endphp

                        <span
                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-bold {{ $status['bgColor'] }} {{ $status['textColor'] }} mb-3 shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="{{ $status['icon'] }}" />
                            </svg>
                            {{ $status['label'] }}
                        </span>

                        <form action="{{ route('pimpinan.projects.changeStatus', $project->id) }}" method="POST"
                            class="flex items-center gap-2 mt-2">
                            @csrf
                            @method('PATCH')

                            <select name="status"
                                class="px-3 py-2 rounded-lg bg-white text-gray-800 border border-white/30 shadow-sm focus:ring-2 focus:ring-indigo-400">
                                <option value="pending">Menunggu</option>
                                <option value="on_progress">Sedang Berjalan</option>
                                <option value="completed">Selesai</option>
                            </select>

                            <button
                                class="px-4 py-2 rounded-lg bg-indigo-500 text-white font-semibold hover:bg-indigo-600 shadow-md transition">
                                Update
                            </button>
                        </form>


                        <h1 class="text-2xl sm:text-3xl font-bold mb-2 leading-tight">
                            <br> {{ $project->project_name }}
                        </h1>
                        <p class="text-indigo-100 text-sm">ID Proyek: #{{ $project->id }}</p>
                    </div>

                    <!-- Project Icon -->
                    <div
                        class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center flex-shrink-0 ml-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>

                <!-- Date Info in Header -->
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3 border border-white/20">
                        <div class="flex items-center gap-2 mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-indigo-200" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-xs text-indigo-200 font-medium">Tanggal Mulai</span>
                        </div>
                        <p class="text-base font-bold">
                            {{ \Carbon\Carbon::parse($project->start_date)->format('d M Y') }}</p>
                    </div>

                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3 border border-white/20">
                        <div class="flex items-center gap-2 mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-indigo-200" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-xs text-indigo-200 font-medium">Target Selesai</span>
                        </div>
                        <p class="text-base font-bold">
                            {{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('d M Y') : 'Belum ditentukan' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Unified Project Information Card -->
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">

            <!-- Header -->
            <div class="bg-gradient-to-r from-indigo-50 to-indigo-100 px-6 py-4 border-b border-indigo-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">Informasi Proyek</h2>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6 space-y-8">

                <!-- Description Section -->
                <div>
                    <p class="text-xs font-semibold text-gray-500 mb-2">Deskripsi Proyek</p>

                    @if ($project->description)
                        <p class="text-gray-700 leading-relaxed whitespace-pre-line">
                            {{ $project->description }}
                        </p>
                    @else
                        <div class="text-center py-6">
                            <div
                                class="w-14 h-14 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <p class="text-gray-400 italic">Tidak ada deskripsi untuk proyek ini</p>
                        </div>
                    @endif
                </div>

                <!-- Additional Info Section -->
                <div class="border-t border-gray-200 pt-6">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                        <!-- Location -->
                        <div>
                            <p class="text-xs font-semibold text-gray-500">Lokasi Proyek</p>
                            <p class="text-gray-800 font-medium mt-1">
                                {{ $project->location ?? 'Tidak ada data' }}
                            </p>
                        </div>

                        <!-- Type -->
                        <div>
                            <p class="text-xs font-semibold text-gray-500">Jenis Proyek</p>
                            <p class="text-gray-800 font-medium mt-1">
                                {{ $project->project_type ?? 'Tidak ada data' }}
                            </p>
                        </div>

                        <!-- Estimated Cost -->
                        {{-- <div class="col-span-1 sm:col-span-2">
                            <p class="text-xs font-semibold text-gray-500">Estimasi Biaya</p>
                            <p class="text-gray-800 font-bold text-lg mt-1">
                                {{ $project->estimated_cost ? 'Rp ' . number_format($project->estimated_cost, 0, ',', '.') : 'Tidak ada data' }}
                            </p>
                        </div> --}}

                    </div>
                </div>

                <!-- Files Section -->
                <div class="border-t border-gray-200 pt-6">
                    <p class="text-xs font-semibold text-gray-500 mb-4">Dokumen</p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                        <!-- RAB File -->
                        <div>
                            <p class="text-sm font-semibold text-gray-700">File RAB</p>

                            @if ($project->rab_file)
                                <div class="flex flex-col sm:flex-row gap-3 mt-2">

                                    <!-- Tombol Lihat -->
                                    <a href="{{ asset('storage/' . $project->rab_file) }}" target="_blank"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl shadow hover:shadow-lg transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                        Buka RAB
                                    </a>

                                    <!-- Tombol Download -->
                                    <a href="{{ asset('storage/' . $project->rab_file) }}"
                                        download="RAB_Proyek_{{ $project->project_name }}"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-xl shadow hover:shadow-lg transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1M8 12l4 4m0 0l4-4m-4 4V4" />
                                        </svg>
                                        Download RAB
                                    </a>

                                </div>
                            @else
                                <p class="text-gray-400 italic mt-1">Tidak ada file</p>
                            @endif
                        </div>

                        <!-- Design File -->
                        <div>
                            <p class="text-sm font-semibold text-gray-700">Desain Proyek</p>

                            @if ($project->design_file)
                                <div class="flex flex-col sm:flex-row gap-3 mt-2">

                                    <!-- Tombol Lihat -->
                                    <a href="{{ asset('storage/' . $project->design_file) }}" target="_blank"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl shadow hover:shadow-lg transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 10l4.553 2.276A2 2 0 0120 14.105V16a2 2 0 01-2 2h-2M4 6h16M4 10h8M4 14h4" />
                                        </svg>
                                        Lihat Desain
                                    </a>

                                    <!-- Tombol Download -->
                                    <a href="{{ asset('storage/' . $project->design_file) }}"
                                        download="Desain_Proyek_{{ $project->project_name }}"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-xl shadow hover:shadow-lg transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1M8 12l4 4m0 0l4-4m-4 4V4" />
                                        </svg>
                                        Download Desain
                                    </a>

                                </div>
                            @else
                                <p class="text-gray-400 italic mt-1">Tidak ada file</p>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Project Notes --}}
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-yellow-50 to-amber-50 px-6 py-4 border-b border-amber-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 8h10M7 12h6m-6 4h10M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H9l-4 4v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">Catatan Proyek</h2>
                        <p class="text-xs text-gray-600">
                            Informasi dari admin / manajer proyek
                        </p>
                    </div>
                </div>
            </div>

            <div class="p-6 space-y-4">

                {{-- FORM TAMBAH CATATAN (PIMPINAN ONLY) --}}
                @if (auth()->user()->hasRole('pimpinan'))
                    <form action="{{ route('pimpinan.projects.notes.store', $project->id) }}" method="POST">
                        @csrf

                        <textarea name="note" rows="3"
                            class="w-full border border-amber-300 rounded-xl p-3 text-sm focus:ring-amber-500 focus:border-amber-500"
                            placeholder="Tambahkan catatan untuk proyek ini..."></textarea>

                        <div class="flex justify-end mt-2">
                            <button type="submit"
                                class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold rounded-xl">
                                Simpan Catatan
                            </button>
                        </div>
                    </form>
                @endif

                {{-- RIWAYAT CATATAN --}}
                @forelse ($project->notes as $note)
                    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">
                        <p class="text-sm text-gray-800 whitespace-pre-line">
                            {{ $note->note }}
                        </p>

                        <div class="flex justify-between items-center mt-3 text-xs text-gray-500">
                            <span>
                                Oleh: <strong>{{ $note->user->name ?? 'Admin' }}</strong>
                            </span>
                            <span>
                                {{ $note->created_at->format('d M Y, H:i') }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-400 italic">
                        Belum ada catatan untuk proyek ini
                    </p>
                @endforelse
            </div>
        </div>

        <!-- Progress History -->
        {{-- @if (isset($progress) && $progress->count()) --}}
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-purple-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-purple-500 rounded-xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-gray-900">Riwayat Progress</h2>
                                <p class="text-xs text-gray-600">{{ $progress->count() }} update tercatat</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-bold">
                            {{ $progress->count() }}
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    <div class="space-y-4">
                        @foreach ($progress as $index => $item)
                            <div
                                class="relative pl-8 pb-4 {{ !$loop->last ? 'border-l-2 border-gray-200 ml-4' : 'ml-4' }}">
                                <div
                                    class="absolute left-0 top-0 -ml-[21px] w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-full flex items-center justify-center text-white shadow-lg border-4 border-white">
                                    <span class="text-xs font-bold">{{ $progress->count() - $index }}</span>
                                </div>

                                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-4">
                                    <div class="flex justify-between items-start gap-4">
                                        <p class="text-sm text-gray-800 flex-1">{{ $item->progress_description }}</p>

                                        @if ($item->progress_percentage !== null)
                                            <span class="text-sm font-bold text-indigo-700">
                                                {{ $item->progress_percentage }}%
                                            </span>
                                        @endif
                                    </div>

                                    @if ($item->images->count())
                                        @foreach ($item->images as $image)
                                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                                class="rounded-xl shadow-md max-h-64 object-cover mt-3">
                                        @endforeach
                                    @endif

                                    <p class="text-xs text-gray-500 mt-2">
                                        {{ $item->created_at->format('d M Y, H:i') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        {{-- @endif --}}

    </div>

    <!-- Custom Styles -->
    <style>
        /* Smooth animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .bg-white {
            animation: fadeInUp 0.5s ease-out;
        }

        /* Form focus effects */
        textarea:focus {
            outline: none;
        }

        /* Button hover effects */
        button[type="submit"]:active {
            transform: translateY(0) !important;
        }

        /* Timeline animation */
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .relative {
            animation: slideInLeft 0.5s ease-out;
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
    </style>

</x-pimpinan-layout>
