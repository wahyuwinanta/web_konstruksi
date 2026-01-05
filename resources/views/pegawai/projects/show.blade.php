<x-pegawai-layout>
    <x-slot name="header">
        Detail Proyek
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-5">

        <!-- Back Button -->
        <a href="{{ route('pegawai.projects') }}"
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

                        <h1 class="text-2xl sm:text-3xl font-bold mb-2 leading-tight">
                            {{ $project->project_name }}
                        </h1>
                        <p class="text-indigo-100 text-sm">ID Proyek: #{{ $project->id }}</p>
                    </div>

                    <div
                        class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center flex-shrink-0 ml-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3 border border-white/20">
                        <span class="text-xs text-indigo-200 font-medium">Tanggal Mulai</span>
                        <p class="text-base font-bold">
                            {{ \Carbon\Carbon::parse($project->start_date)->format('d M Y') }}
                        </p>
                    </div>

                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3 border border-white/20">
                        <span class="text-xs text-indigo-200 font-medium">Target Selesai</span>
                        <p class="text-base font-bold">
                            {{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('d M Y') : 'Belum ditentukan' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Project Info -->
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">

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

            <div class="p-6 space-y-8">

                <div>
                    <p class="text-xs font-semibold text-gray-500 mb-2">Deskripsi Proyek</p>

                    @if ($project->description)
                        <p class="text-gray-700 leading-relaxed whitespace-pre-line">
                            {{ $project->description }}
                        </p>
                    @else
                        <p class="text-gray-400 italic">Tidak ada deskripsi untuk proyek ini</p>
                    @endif
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <p class="text-xs font-semibold text-gray-500">Lokasi Proyek</p>
                            <p class="text-gray-800 font-medium mt-1">{{ $project->location ?? 'Tidak ada data' }}</p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold text-gray-500">Jenis Proyek</p>
                            <p class="text-gray-800 font-medium mt-1">{{ $project->project_type ?? 'Tidak ada data' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <p class="text-xs font-semibold text-gray-500 mb-4">Dokumen</p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                        <div>
                            <p class="text-sm font-semibold text-gray-700">Desain Proyek</p>

                            @if ($project->design_file)
                                <div class="flex flex-col sm:flex-row gap-3 mt-2">

                                    <a href="{{ asset('storage/' . $project->design_file) }}" target="_blank"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl shadow hover:shadow-lg transition-all">
                                        Lihat Desain
                                    </a>

                                    <a href="{{ asset('storage/' . $project->design_file) }}"
                                        download="Desain_Proyek_{{ $project->project_name }}"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-xl shadow hover:shadow-lg transition-all">
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

        {{-- Project Notes (View Only) --}}
        {{-- @if ($project->notes->count()) --}}
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
                    </div>
                </div>
            </div>

            <div class="p-6 space-y-4">
                @foreach ($project->notes as $note)
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
                @endforeach
            </div>
        </div>
        {{-- @endif --}}

        <!-- Update Progress -->
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-50 to-purple-50 px-6 py-4 border-b border-indigo-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-500 rounded-xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">Update Progress</h2>
                        <p class="text-xs text-gray-600">Laporkan perkembangan pekerjaan Anda</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('pegawai.projects.progress.store', $project->id) }}" method="POST"
                enctype="multipart/form-data" class="p-6">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Progress</label>
                    <textarea name="description" rows="4"
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all resize-none"
                        placeholder="Contoh: Hari ini saya telah menyelesaikan pemasangan pondasi bagian utara..."></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Progress (opsional)</label>
                    <input type="file" name="image"
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm bg-white">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Persentase Progress (%)
                    </label>

                    <input type="number" name="percentage" min="0" max="100"
                        value="{{ old('percentage') }}" placeholder="Contoh: 25"
                        class="w-full border-2 rounded-xl px-4 py-3 text-sm
                  @error('percentage') border-red-500 @else border-gray-200 @enderror">

                    @error('percentage')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold py-3.5 rounded-xl shadow-lg flex items-center justify-center gap-2">
                    Kirim Progress
                </button>
            </form>
        </div>

        <!-- Progress History -->
        @if (isset($progress) && $progress->count())
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
                                    <p class="text-xs text-gray-500 mt-2">
                                        dibuat oleh : {{ $item->user->name ?? 'User Tidak Diketahui' }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-pegawai-layout>
