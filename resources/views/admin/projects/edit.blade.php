<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight tracking-tight">
            {{ __('Edit Project') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-md sm:rounded-2xl border border-gray-100">

                {{-- Error Handling --}}
                @if ($errors->any())
                    <div class="mb-6 space-y-3">
                        @foreach ($errors->all() as $error)
                            <div class="py-3 px-4 w-full rounded-xl bg-red-500 text-white font-medium shadow-sm">
                                {{ $error }}
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Form Update --}}
                <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Project Name --}}
                    <div>
                        <x-input-label for="project_name" :value="__('Project Name')" />
                        <x-text-input id="project_name"
                            class="block mt-2 w-full py-3 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition"
                            type="text" name="project_name" value="{{ old('project_name', $project->project_name) }}"
                            required autofocus />
                        <x-input-error :messages="$errors->get('project_name')" class="mt-2" />
                    </div>

                    {{-- Description --}}
                    <div class="mt-5">
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" rows="4"
                            class="block mt-2 w-full border-gray-300 rounded-xl p-3 focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $project->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    {{-- Location --}}
                    <div class="mt-5">
                        <x-input-label for="location" :value="__('Project Location')" />
                        <x-text-input id="location" type="text" name="location"
                            class="block mt-2 w-full border-gray-300 rounded-xl p-3 focus:ring-indigo-500 focus:border-indigo-500"
                            value="{{ old('location', $project->location) }}" />
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>

                    {{-- Project Type --}}
                    <div class="mt-5">
                        <x-input-label for="project_type" :value="__('Project Type')" />
                        <x-text-input id="project_type" type="text" name="project_type"
                            class="block mt-2 w-full border-gray-300 rounded-xl p-3 focus:ring-indigo-500 focus:border-indigo-500"
                            value="{{ old('project_type', $project->project_type) }}" />
                        <x-input-error :messages="$errors->get('project_type')" class="mt-2" />
                    </div>

                    {{-- Estimated Cost --}}
                    <div class="mt-5">
                        <x-input-label for="estimated_cost" :value="__('Estimated Cost (Rp)')" />
                        <x-text-input id="estimated_cost" type="number" name="estimated_cost" min="0"
                            step="0.01"
                            class="block mt-2 w-full border-gray-300 rounded-xl p-3 focus:ring-indigo-500 focus:border-indigo-500"
                            value="{{ old('estimated_cost', $project->estimated_cost) }}" />
                        <x-input-error :messages="$errors->get('estimated_cost')" class="mt-2" />
                    </div>

                    {{-- Start & End Date --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-5">
                        <div>
                            <x-input-label for="start_date" :value="__('Start Date')" />
                            <x-text-input id="start_date" class="block mt-2 w-full border-gray-300 rounded-xl"
                                type="date" name="start_date"
                                value="{{ old('start_date', optional($project->start_date)->format('Y-m-d')) }}"
                                required />
                            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="end_date" :value="__('End Date (optional)')" />
                            <x-text-input id="end_date" class="block mt-2 w-full border-gray-300 rounded-xl"
                                type="date" name="end_date"
                                value="{{ old('end_date', optional($project->end_date)->format('Y-m-d')) }}" />
                            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="mt-5">
                        <x-input-label for="status" :value="__('Status')" />
                        <select name="status" id="status"
                            class="block mt-2 w-full border-gray-300 rounded-xl p-3 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="pending"
                                {{ old('status', $project->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="on_progress"
                                {{ old('status', $project->status) == 'on_progress' ? 'selected' : '' }}>On Progress
                            </option>
                            <option value="completed"
                                {{ old('status', $project->status) == 'completed' ? 'selected' : '' }}>Completed
                            </option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>

                    {{-- Assign Employees --}}
                    <div>
                        <x-input-label :value="__('Assign Employees (optional)')" />

                        <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-72 overflow-y-auto">
                            @foreach ($employees as $emp)
                                <label
                                    class="relative flex items-center gap-3 p-4 border-2 rounded-xl cursor-pointer transition
    hover:border-indigo-400
    {{ collect(old('employees'))->contains($emp->id) ? 'border-indigo-500 bg-indigo-50' : 'border-gray-200' }}">

                                    <input type="checkbox" name="employees[]" value="{{ $emp->id }}"
                                        class="peer"
                                        {{ collect(old('employees'))->contains($emp->id) ? 'checked' : '' }}>

                                    {{-- Avatar --}}
                                    <div class="relative">
                                        <div
                                            class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
                                            {{ strtoupper(substr($emp->name, 0, 1)) }}
                                        </div>

                                        {{-- Badge jumlah proyek aktif --}}
                                        @if ($emp->active_projects_count > 0)
                                            <span
                                                class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center">
                                                {{ $emp->active_projects_count }}
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Info --}}
                                    <div class="flex flex-col">
                                        <span class="text-sm font-semibold text-gray-800">
                                            {{ $emp->name }}
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            {{ $emp->email }}
                                        </span>
                                        <span class="text-xs text-indigo-600 mt-1">
                                            {{ $emp->active_projects_count }} proyek aktif
                                        </span>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        {{-- Project Notes --}}
                        <div class="mt-5">
                            <x-input-label for="notes" :value="__('Project Notes (optional)')" />

                            {{-- Textarea untuk edit / tambah --}}
                            <textarea id="notes" name="notes" rows="4"
                                class="block mt-2 w-full border-gray-300 rounded-xl p-3 focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Catatan tambahan, arahan khusus, atau informasi penting proyek...">{{ old('notes', $project->notes->first()?->note) }}</textarea>

                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />

                            {{-- Riwayat Catatan --}}
                            @if ($project->notes->count())
                                <div class="mt-4 space-y-3">
                                    <p class="text-sm font-semibold text-gray-700">Riwayat Catatan</p>

                                    @foreach ($project->notes as $note)
                                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-3">
                                            <p class="text-sm text-gray-800 whitespace-pre-line">
                                                {{ $note->note }}
                                            </p>

                                            <div class="flex justify-between mt-2 text-xs text-gray-500">
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
                            @endif
                        </div>


                        {{-- RAB File --}}
                        <div class="mt-5">
                            <x-input-label for="rab_file" :value="__('Upload RAB Document (PDF/DOC)')" />
                            @if ($project->rab_file)
                                <p class="text-sm text-gray-500 mt-1">Current file: <a
                                        href="{{ asset('storage/' . $project->rab_file) }}" target="_blank"
                                        class="underline text-indigo-600">{{ basename($project->rab_file) }}</a></p>
                            @endif
                            <input type="file" name="rab_file" id="rab_file"
                                class="block mt-2 w-full border-gray-300 rounded-xl p-3 focus:ring-indigo-500 focus:border-indigo-500" />
                            <x-input-error :messages="$errors->get('rab_file')" class="mt-2" />
                        </div>

                        {{-- Design File --}}
                        <div class="mt-5">
                            <x-input-label for="design_file" :value="__('Upload Design File (PDF/JPG/PNG)')" />
                            @if ($project->design_file)
                                <p class="text-sm text-gray-500 mt-1">Current file: <a
                                        href="{{ asset('storage/' . $project->design_file) }}" target="_blank"
                                        class="underline text-indigo-600">{{ basename($project->design_file) }}</a>
                                </p>
                            @endif
                            <input type="file" name="design_file" id="design_file"
                                class="block mt-2 w-full border-gray-300 rounded-xl p-3 focus:ring-indigo-500 focus:border-indigo-500" />
                            <x-input-error :messages="$errors->get('design_file')" class="mt-2" />
                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center justify-end mt-8">
                            <a href="{{ route('admin.projects.index') }}"
                                class="inline-flex items-center px-4 py-2 mr-3 border border-gray-200 rounded-full text-sm text-slate-700">
                                Cancel
                            </a>
                            <button type="submit"
                                class="font-bold py-3 px-8 bg-indigo-700 text-white rounded-full hover:bg-indigo-800 transition shadow-md">
                                Update Project
                            </button>
                        </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
