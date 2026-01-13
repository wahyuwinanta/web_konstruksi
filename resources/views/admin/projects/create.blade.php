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
                <form method="POST" action="{{ route('admin.projects.store') }}" class="space-y-6"
                    enctype="multipart/form-data">
                    @csrf

                    {{-- Select Client (Optional) --}}
                    <div>
                        <x-input-label value="Client (optional)" />

                        <select id="client_select" class="block mt-2 w-full border-gray-300 rounded-xl">
                            <option value="">-- Input Manual --</option>

                            @foreach ($appointments as $app)
                                <option value="{{ $app->id }}" data-name="{{ $app->name }}"
                                    data-address="{{ $app->address }}" data-product="{{ $app->product_id }}">
                                    {{ $app->name }} ({{ $app->meeting_at->format('d M Y') }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Project Name --}}
                    <div>
                        <x-input-label for="project_name" :value="__('Project Name')" />
                        <x-text-input id="project_name" class="block mt-2 w-full border-gray-300 rounded-xl"
                            type="text" name="project_name" value="{{ old('project_name') }}" required />
                        <x-input-error :messages="$errors->get('project_name')" class="mt-2" />
                    </div>

                    {{-- Description --}}
                    <div>
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" rows="4"
                            class="block mt-2 w-full border-gray-300 rounded-xl p-3 focus:ring-indigo-500 focus:border-indigo-500">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    {{-- Location --}}
                    <div>
                        <x-input-label for="location" :value="__('Project Location')" />
                        <x-text-input id="location" class="block mt-2 w-full border-gray-300 rounded-xl" type="text"
                            name="location" :value="old('location')" />
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>

                    {{-- Project Type --}}
                    <div>
                        <x-input-label for="product_id" value="Project Type" />
                        <select name="product_id" id="product_id" class="block mt-2 w-full border-gray-300 rounded-xl">
                            <option value="">-- Pilih Tipe Proyek --</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}"
                                    {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('product_id')" class="mt-2" />
                    </div>


                    {{-- Estimated Cost --}}
                    <div>
                        <x-input-label for="estimated_cost" :value="__('Estimated Cost (Rp)')" />
                        <x-text-input id="estimated_cost" class="block mt-2 w-full border-gray-300 rounded-xl"
                            type="number" name="estimated_cost" :value="old('estimated_cost')" min="0" step="0.01" />
                        <x-input-error :messages="$errors->get('estimated_cost')" class="mt-2" />
                    </div>

                    {{-- Start & End Date --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="start_date" :value="__('Start Date')" />
                            <x-text-input id="start_date" class="block mt-2 w-full border-gray-300 rounded-xl"
                                type="date" name="start_date" :value="old('start_date')" required />
                            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="end_date" :value="__('End Date (optional)')" />
                            <x-text-input id="end_date" class="block mt-2 w-full border-gray-300 rounded-xl"
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
                            <option value="on_progress" {{ old('status') == 'on_progress' ? 'selected' : '' }}>On
                                Progress</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed
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

                        <x-input-error :messages="$errors->get('employees')" class="mt-2" />
                    </div>


                    {{-- Project Notes --}}
                    <div>
                        <x-input-label for="notes" :value="__('Project Notes (optional)')" />
                        <textarea id="notes" name="notes" rows="4"
                            class="block mt-2 w-full border-gray-300 rounded-xl p-3 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Catatan tambahan, arahan khusus, atau informasi penting proyek...">{{ old('notes') }}</textarea>
                        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                    </div>

                    {{-- RAB File --}}
                    <div>
                        <x-input-label for="rab_file" :value="__('Upload RAB Document (PDF/DOC)')" />
                        <input type="file" name="rab_file" id="rab_file"
                            class="block mt-2 w-full border-gray-300 rounded-xl p-3 focus:ring-indigo-500 focus:border-indigo-500" />
                        <x-input-error :messages="$errors->get('rab_file')" class="mt-2" />
                    </div>

                    {{-- Design File --}}
                    <div>
                        <x-input-label for="design_file" :value="__('Upload Design File (PDF/JPG/PNG)')" />
                        <input type="file" name="design_file" id="design_file"
                            class="block mt-2 w-full border-gray-300 rounded-xl p-3 focus:ring-indigo-500 focus:border-indigo-500" />
                        <x-input-error :messages="$errors->get('design_file')" class="mt-2" />
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
    <script>
        document.getElementById('client_select').addEventListener('change', function() {
            const selected = this.options[this.selectedIndex];

            if (!this.value) return;

            const name = selected.dataset.name;
            const address = selected.dataset.address;
            const product = selected.dataset.product;

            if (name) {
                document.getElementById('project_name').value = name;
            }

            if (address) {
                document.getElementById('location').value = address;
            }

            if (product) {
                document.getElementById('product_id').value = product;
            }
        });
    </script>
</x-app-layout>
