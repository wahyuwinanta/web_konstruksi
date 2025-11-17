<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight tracking-tight">
            {{ __('New Team') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-2xl p-10">

                {{-- Error Alert --}}
                @if ($errors->any())
                    <div class="mb-6 space-y-3">
                        @foreach ($errors->all() as $error)
                            <div class="py-3 px-5 rounded-xl bg-red-500 text-white font-medium shadow">
                                {{ $error }}
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Form --}}
                <form method="POST" action="{{ route('admin.teams.store') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- Name --}}
                    <div class="mb-6">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name"
                            class="block mt-2 w-full border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500"
                            type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Occupation --}}
                    <div class="mb-6">
                        <x-input-label for="occupation" :value="__('Occupation')" />
                        <x-text-input id="occupation"
                            class="block mt-2 w-full border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500"
                            type="text" name="occupation" :value="old('occupation')" required autofocus
                            autocomplete="occupation" />
                        <x-input-error :messages="$errors->get('occupation')" class="mt-2" />
                    </div>

                    {{-- Location --}}
                    <div class="mb-6">
                        <x-input-label for="location" :value="__('Location')" />
                        <x-text-input id="location"
                            class="block mt-2 w-full border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500"
                            type="text" name="location" :value="old('location')" required autofocus
                            autocomplete="location" />
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>

                    {{-- Avatar --}}
                    <div class="mb-6">
                        <x-input-label for="avatar" :value="__('Avatar')" />
                        <x-text-input id="avatar"
                            class="block mt-2 w-full border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500"
                            type="file" name="avatar" required autofocus autocomplete="avatar" />
                        <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
                    </div>

                    {{-- Submit --}}
                    <div class="flex justify-end mt-10">
                        <button type="submit"
                            class="font-bold py-3 px-8 bg-indigo-700 text-white rounded-full hover:bg-indigo-800 shadow transition duration-200 ease-in-out">
                            Add New Team
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
