<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-indigo-800 leading-tight tracking-wide">
            {{ __('New Principle') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-md border border-gray-100 sm:rounded-2xl">

                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="mb-6 space-y-3">
                        @foreach ($errors->all() as $error)
                            <div class="py-3 px-4 rounded-2xl bg-red-500 text-white font-medium">
                                {{ $error }}
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Form Start --}}
                <form method="POST" action="{{ route('admin.principles.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    {{-- Name --}}
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl" 
                            type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Thumbnail --}}
                    <div>
                        <x-input-label for="thumbnail" :value="__('Thumbnail')" />
                        <x-text-input id="thumbnail" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl" 
                            type="file" name="thumbnail" required autocomplete="thumbnail" />
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                    </div>

                    {{-- Icon --}}
                    <div>
                        <x-input-label for="icon" :value="__('Icon')" />
                        <x-text-input id="icon" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl" 
                            type="file" name="icon" required autocomplete="icon" />
                        <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                    </div>

                    {{-- Subtitle --}}
                    <div>
                        <x-input-label for="subtitle" :value="__('Subtitle')" />
                        <textarea name="subtitle" id="subtitle" rows="5"
                            class="mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl resize-none shadow-sm">{{ old('subtitle') }}</textarea>
                        <x-input-error :messages="$errors->get('subtitle')" class="mt-2" />
                    </div>

                    {{-- Submit Button --}}
                    <div class="flex items-center justify-end pt-4">
                        <button type="submit"
                            class="font-semibold py-4 px-8 bg-indigo-700 hover:bg-indigo-800 text-white rounded-full shadow-md transition duration-200 ease-in-out">
                            Add New Principle
                        </button>
                    </div>
                </form>
                {{-- Form End --}}
            </div>
        </div>
    </div>
</x-app-layout>
