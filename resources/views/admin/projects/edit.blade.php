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
                <form method="POST" action="{{ route('admin.projects.update', $project) }}">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="project_name" :value="__('Project Name')" />
                        <x-text-input id="project_name"
                            class="block mt-2 w-full py-3 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition"
                            type="text" name="project_name" value="{{ old('project_name', $project->project_name) }}" required autofocus />
                        <x-input-error :messages="$errors->get('project_name')" class="mt-2" />
                    </div>

                    <div class="mt-5">
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" rows="4"
                            class="block mt-2 w-full border-gray-300 rounded-xl p-3 focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $project->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-5">
                        <div>
                            <x-input-label for="start_date" :value="__('Start Date')" />
                            <x-text-input id="start_date" class="block mt-2 w-full border-gray-300 rounded-xl"
                                type="date" name="start_date" value="{{ old('start_date', optional($project->start_date)->format('Y-m-d')) }}" required />
                            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="end_date" :value="__('End Date (optional)')" />
                            <x-text-input id="end_date" class="block mt-2 w-full border-gray-300 rounded-xl"
                                type="date" name="end_date" value="{{ old('end_date', optional($project->end_date)->format('Y-m-d')) }}" />
                            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-5">
                        <x-input-label for="status" :value="__('Status')" />
                        <select name="status" id="status" class="block mt-2 w-full border-gray-300 rounded-xl p-3 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="pending" {{ old('status', $project->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="on_progress" {{ old('status', $project->status) == 'on_progress' ? 'selected' : '' }}>On Progress</option>
                            <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    {{-- Assign Employees --}}
                    <div class="mt-5">
                        <x-input-label for="employees" :value="__('Assigned Employees (edit)')" />
                        <select name="employees[]" id="employees" multiple
                            class="block mt-2 w-full border-gray-300 rounded-xl p-3 h-40 focus:ring-indigo-500 focus:border-indigo-500">
                            @php
                                $assignedIds = $project->assignments->pluck('user_id')->toArray();
                            @endphp
                            @foreach ($employees as $emp)
                                <option value="{{ $emp->id }}" {{ (in_array($emp->id, old('employees', $assignedIds)) ) ? 'selected':'' }}>
                                    {{ $emp->name }} — {{ $emp->email }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-slate-400 mt-1">Tekan Ctrl/Cmd untuk memilih/deselect beberapa pegawai.</p>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center justify-end mt-8">
                        <a href="{{ route('admin.projects.index') }}" class="inline-flex items-center px-4 py-2 mr-3 border border-gray-200 rounded-full text-sm text-slate-700">
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
