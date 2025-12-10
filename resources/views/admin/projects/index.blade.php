<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-indigo-800 leading-tight tracking-wide">
            {{ __('Manage Projects') }}
        </h2>
    </x-slot>

    {{-- Tombol Add New --}}
    <div class="max-w-7xl mx-auto mt-6 sm:px-6 lg:px-8 flex justify-end">
        <a href="{{ route('admin.projects.create') }}"
            class="inline-flex items-center px-6 py-3 bg-indigo-700 hover:bg-indigo-800 text-white text-sm font-semibold rounded-full shadow-md transition duration-200 ease-in-out">
            Add New Project
        </a>
    </div>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white shadow-md sm:rounded-2xl p-6 border border-gray-100 space-y-4 transition-all duration-300 ease-in-out">
                <x-search-bar action="{{ route('admin.projects.index') }}" />

                @forelse ($projects as $project)
                    <div
                        class="item-card flex flex-col md:flex-row justify-between items-start md:items-center bg-gray-50 hover:bg-gray-100 transition rounded-xl p-5 border border-gray-200 shadow-sm hover:-translate-y-1 hover:shadow-lg duration-300 ease-in-out">

                        {{-- Kiri: Info Proyek --}}
                        <div class="flex flex-col md:flex-row items-start md:items-center gap-x-5">

                            {{-- Status --}}
                            <div class="py-1 px-3 rounded-full bg-indigo-50 text-indigo-700 font-semibold text-sm">
                                {{ strtoupper($project->status ?? 'pending') }}
                            </div>

                            <div>
                                {{-- Nama Project --}}
                                <h3 class="text-indigo-950 text-xl font-bold leading-tight">
                                    {{ $project->project_name }}
                                </h3>

                                {{-- Deskripsi --}}
                                <p class="text-slate-500 text-sm mt-1 line-clamp-2">
                                    {{ $project->description ?? '-' }}
                                </p>

                                {{-- Lokasi & Jenis --}}
                                <div class="text-sm text-slate-600 mt-2">
                                    <span class="mr-4">Location: {{ $project->location ?? '-' }}</span>
                                    <span>Type: {{ $project->project_type ?? '-' }}</span>
                                </div>

                                {{-- Tanggal --}}
                                <div class="text-xs text-slate-500 mt-1">
                                    <span class="mr-4">
                                        Start: {{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('d M Y') : '-' }}
                                    </span>
                                    <span>
                                        End: {{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('d M Y') : '-' }}
                                    </span>
                                </div>

                                {{-- Estimasi Biaya --}}
                                <div class="text-sm text-slate-700 mt-1">
                                    Estimated Cost: {{ $project->estimated_cost ? 'Rp ' . number_format($project->estimated_cost, 2, ',', '.') : '-' }}
                                </div>

                                {{-- Dokumen RAB & Desain --}}
                                <div class="text-sm mt-2 flex flex-wrap gap-2">
                                    @if($project->rab_file)
                                        <a href="{{ asset('storage/' . $project->rab_file) }}" target="_blank"
                                            class="px-3 py-1 rounded-full bg-green-100 text-green-800 text-xs font-medium">
                                            RAB Document
                                        </a>
                                    @endif
                                    @if($project->design_file)
                                        <a href="{{ asset('storage/' . $project->design_file) }}" target="_blank"
                                            class="px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-xs font-medium">
                                            Design File
                                        </a>
                                    @endif
                                </div>

                                {{-- Assigned Employees / Workers --}}
                                <div class="mt-3 text-sm">
                                    <span class="text-slate-600 font-medium">Assigned:</span>

                                    @if ($project->assignments && $project->assignments->count())
                                        <div class="flex flex-wrap gap-2 mt-2">
                                            @foreach ($project->assignments->take(6) as $a)
                                                <div
                                                    class="px-3 py-1 rounded-full bg-indigo-100 text-indigo-800 text-xs font-medium">
                                                    {{ $a->user->name }}
                                                </div>
                                            @endforeach

                                            @if ($project->assignments->count() > 6)
                                                <div class="px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs">
                                                    +{{ $project->assignments->count() - 6 }}
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-gray-500 ml-2">-</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Kanan: Tombol Aksi --}}
                        <div class="mt-4 md:mt-0 flex gap-3">
                            <a href="{{ route('admin.projects.edit', $project->id) }}"
                                class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-semibold rounded-lg shadow transition">
                                Edit
                            </a>

                            <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this project?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded-lg shadow transition">
                                    Delete
                                </button>
                            </form>
                        </div>

                    </div>
                @empty
                    <div class="text-center py-10 text-gray-500">
                        No projects found.
                    </div>
                @endforelse

                {{-- Pagination --}}
                <div class="mt-6">
                    {{ $projects->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
