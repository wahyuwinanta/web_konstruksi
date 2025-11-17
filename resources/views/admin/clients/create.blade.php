<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-indigo-800 leading-tight tracking-wide">
            {{ __('New Client') }}
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
                <form method="POST" action="{{ route('admin.clients.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    {{-- Name --}}
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-2 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl" 
                            type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Occupation --}}
                    <div>
                        <x-input-label for="occupation" :value="__('Occupation')" />
                        <x-text-input id="occupation" class="block mt-2 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl" 
                            type="text" name="occupation" :value="old('occupation')" required autofocus autocomplete="occupation" />
                        <x-input-error :messages="$errors->get('occupation')" class="mt-2" />
                    </div>

                    {{-- Avatar --}}
                    <div>
                        <x-input-label for="avatar" :value="__('Avatar')" />
                        <x-text-input id="avatar" class="block mt-2 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl" 
                            type="file" name="avatar" required autofocus autocomplete="avatar" />
                        <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
                    </div>

                    {{-- Logo --}}
                    <div>
                        <x-input-label for="logo" :value="__('Logo')" />
                        <x-text-input id="logo" class="block mt-2 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl" 
                            type="file" name="logo" required autofocus autocomplete="logo" />
                        <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                    </div>

                    {{-- Submit Button --}}
                    <div class="flex items-center justify-end">
                        <button type="submit" 
                            class="inline-flex items-center px-6 py-3 bg-indigo-700 hover:bg-indigo-800 text-white text-sm font-semibold rounded-full shadow-md transition duration-200 ease-in-out">
                            Add New Client
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
