<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-indigo-800 leading-tight tracking-wide">
            {{ __('Edit Principle') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-md border border-gray-100 sm:rounded-2xl">

                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="mb-6 space-y-2">
                        @foreach ($errors->all() as $error)
                            <div class="py-3 px-4 w-full rounded-xl bg-red-500 text-white text-sm font-medium shadow-sm">
                                {{ $error }}
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Form Edit Principle --}}
                <form method="POST" action="{{ route('admin.principles.update', $principle) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Input Name --}}
                    <div class="mb-5">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-2 w-full border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                            type="text" name="name" value="{{ $principle->name }}" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Input Thumbnail --}}
                    <div class="mb-6">
                        <x-input-label for="thumbnail" :value="__('Thumbnail')" />
                        <div class="flex items-center gap-x-4 mt-2">
                            <img src="{{ Storage::url($principle->thumbnail) }}" alt="Thumbnail Preview"
                                class="rounded-xl object-cover w-[90px] h-[90px] border border-gray-200 shadow-sm">
                            <x-text-input id="thumbnail" class="block w-full border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                type="file" name="thumbnail" autocomplete="thumbnail" />
                        </div>
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                    </div>

                    {{-- Input Icon --}}
                    <div class="mb-6">
                        <x-input-label for="icon" :value="__('Icon')" />
                        <div class="flex items-center gap-x-4 mt-2">
                            <img src="{{ Storage::url($principle->icon) }}" alt="Icon Preview"
                                class="rounded-xl object-cover w-[90px] h-[90px] border border-gray-200 shadow-sm">
                            <x-text-input id="icon" class="block w-full border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                type="file" name="icon" autocomplete="icon" />
                        </div>
                        <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                    </div>

                    {{-- Input Subtitle --}}
                    <div class="mb-6">
                        <x-input-label for="subtitle" :value="__('Subtitle')" />
                        <textarea name="subtitle" id="subtitle" rows="5"
                            class="border border-gray-300 rounded-xl w-full mt-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-700 text-sm leading-relaxed">{{ trim($principle->subtitle) }}</textarea>
                        <x-input-error :messages="$errors->get('subtitle')" class="mt-2" />
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="flex items-center justify-end mt-8">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-indigo-700 hover:bg-indigo-800 text-white text-sm font-semibold rounded-full shadow-md transition duration-200 ease-in-out">
                            Update Principle
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
