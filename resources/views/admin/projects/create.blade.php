<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-indigo-800 leading-tight tracking-wide">
            {{ __('New Project') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-2xl p-10 border border-gray-100">

                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="space-y-2 mb-6">
                        @foreach ($errors->all() as $error)
                            <div class="py-3 px-4 rounded-xl bg-red-500 text-white text-sm font-medium shadow-sm">
                                {{ $error }}
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Form --}}
                <form method="POST" action="{{ route('admin.projects.store') }}" class="space-y-6">
                    @csrf

                    {{-- Project Name --}}
                    <div>
                        <x-input-label for="project_name" :value="__('Project Name')" />
                        <x-text-input id="project_name"
                            class="block mt-2 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl"
                            type="text" name="project_name" :value="old('project_name')" required autofocus />
                        <x-input-error :messages="$errors->get('project_name')" class="mt-2" />
                    </div>

                    {{-- Description --}}
                    <div>
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" rows="4"
                            class="block mt-2 w-full border-gray-300 rounded-xl p-3 focus:ring-indigo-500 focus:border-indigo-500">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    {{-- Start & End Date --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="start_date" :value="__('Start Date')" />
                            <x-text-input id="start_date"
                                class="block mt-2 w-full border-gray-300 rounded-xl"
                                type="date" name="start_date" :value="old('start_date')" required />
                            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="end_date" :value="__('End Date (optional)')" />
                            <x-text-input id="end_date"
                                class="block mt-2 w-full border-gray-300 rounded-xl"
                                type="date" name="end_date" :value="old('end_date')" />
                            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                        </div>
                    </div>

                    {{-- Status --}}
                    <div>
                        <x-input-label for="status" :value="__('Status')" />
                        <select name="status" id="status"
                            class="block mt-2 w-full border-gray-300 rounded-xl p-3 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="on_progress" {{ old('status') == 'on_progress' ? 'selected' : '' }}>On Progress</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>

                    {{-- Assign Employees --}}
                    <div>
                        <x-input-label for="employees" :value="__('Assign Employees (optional)')" />
                        <select name="employees[]" id="employees" multiple
                            class="block mt-2 w-full border-gray-300 rounded-xl p-3 h-40 focus:ring-indigo-500 focus:border-indigo-500">
                            @foreach ($employees as $emp)
                                <option value="{{ $emp->id }}"
                                    {{ collect(old('employees'))->contains($emp->id) ? 'selected' : '' }}>
                                    {{ $emp->name }} — {{ $emp->email }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-slate-400 mt-1">
                            Tekan Ctrl/Cmd untuk memilih beberapa pegawai.
                        </p>
                        <x-input-error :messages="$errors->get('employees')" class="mt-2" />
                    </div>

                    {{-- Buttons --}}
                    <div class="flex items-center justify-end">
                        <a href="{{ route('admin.projects.index') }}"
                            class="inline-flex items-center px-4 py-2 mr-3 border border-gray-200 rounded-full text-sm text-slate-700">
                            Cancel
                        </a>

                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-indigo-700 hover:bg-indigo-800 text-white text-sm font-semibold rounded-full shadow-md transition duration-200 ease-in-out">
                            Create Project
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
