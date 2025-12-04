<x-pekerja-layout>
    <x-slot name="header">
        Detail Proyek
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-5">
        
        <!-- Back Button -->
        <a href="{{ route('pekerja.projects') }}" 
           class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-indigo-600 transition-colors group">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                                    'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'
                                ],
                                'on_progress' => [
                                    'label' => 'Sedang Berjalan',
                                    'bgColor' => 'bg-blue-400',
                                    'textColor' => 'text-blue-900',
                                    'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'
                                ],
                                'completed' => [
                                    'label' => 'Selesai',
                                    'bgColor' => 'bg-green-400',
                                    'textColor' => 'text-green-900',
                                    'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'
                                ],
                            ];
                            $status = $statusConfig[$project->status] ?? $statusConfig['pending'];
                        @endphp

                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-bold {{ $status['bgColor'] }} {{ $status['textColor'] }} mb-3 shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="{{ $status['icon'] }}" />
                            </svg>
                            {{ $status['label'] }}
                        </span>

                        <h1 class="text-2xl sm:text-3xl font-bold mb-2 leading-tight">
                            {{ $project->project_name }}
                        </h1>
                        <p class="text-indigo-100 text-sm">ID Proyek: #{{ $project->id }}</p>
                    </div>

                    <!-- Project Icon -->
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center flex-shrink-0 ml-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>

                <!-- Date Info in Header -->
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3 border border-white/20">
                        <div class="flex items-center gap-2 mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-indigo-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-xs text-indigo-200 font-medium">Tanggal Mulai</span>
                        </div>
                        <p class="text-base font-bold">{{ \Carbon\Carbon::parse($project->start_date)->format('d M Y') }}</p>
                    </div>

                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3 border border-white/20">
                        <div class="flex items-center gap-2 mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-indigo-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
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

        <!-- Project Description Card -->
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-bold text-gray-900">Deskripsi Proyek</h2>
                </div>
            </div>
            <div class="p-6">
                @if($project->description)
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $project->description }}</p>
                @else
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <p class="text-gray-400 italic">Tidak ada deskripsi untuk proyek ini</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Update Progress Card -->
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-50 to-purple-50 px-6 py-4 border-b border-indigo-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-500 rounded-xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">Update Progress</h2>
                        <p class="text-xs text-gray-600">Laporkan perkembangan pekerjaan Anda</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('pekerja.projects.progress.store', $project->id) }}" method="POST" class="p-6">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi Progress
                    </label>
                    <textarea name="description" 
                              rows="4"
                              class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all resize-none"
                              placeholder="Contoh: Hari ini saya telah menyelesaikan pemasangan pondasi bagian utara..."></textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold py-3.5 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                    Kirim Progress
                </button>
            </form>
        </div>

        <!-- Progress History Card -->
        @if(isset($progress) && $progress->count())
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-purple-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-purple-500 rounded-xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
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
                            <div class="relative pl-8 pb-4 {{ !$loop->last ? 'border-l-2 border-gray-200 ml-4' : 'ml-4' }}">
                                <!-- Timeline dot -->
                                <div class="absolute left-0 top-0 -ml-[21px] w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-full flex items-center justify-center shadow-lg border-4 border-white">
                                    <span class="text-white text-xs font-bold">{{ $progress->count() - $index }}</span>
                                </div>

                                <!-- Content -->
                                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-4 hover:shadow-md transition-shadow">
                                    <div class="flex items-start justify-between gap-3 mb-2">
                                        <p class="text-sm text-gray-800 leading-relaxed flex-1">{{ $item->description }}</p>
                                    </div>
                                    
                                    <div class="flex items-center gap-2 text-xs text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="font-medium">{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                                        <span class="text-gray-300">•</span>
                                        <span>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <!-- Empty State for Progress -->
            <div class="bg-white rounded-2xl shadow-md border-2 border-dashed border-gray-200 p-12 text-center">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Progress</h3>
                <p class="text-gray-500 text-sm max-w-md mx-auto">
                    Belum ada laporan progress untuk proyek ini. Mulai update perkembangan pekerjaan Anda di form di atas.
                </p>
            </div>
        @endif

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

</x-pekerja-layout>