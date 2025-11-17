<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight tracking-tight">
            {{ __('Edit Client') }}
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
                <form method="POST" action="{{ route('admin.clients.update', $client) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Name --}}
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name"
                            class="block mt-1 w-full py-3 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition"
                            type="text" name="name" value="{{ $client->name }}" required autofocus
                            autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Occupation --}}
                    <div class="mt-5">
                        <x-input-label for="occupation" :value="__('Occupation')" />
                        <x-text-input id="occupation"
                            class="block mt-1 w-full py-3 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition"
                            type="text" name="occupation" value="{{ $client->occupation }}" required autofocus
                            autocomplete="occupation" />
                        <x-input-error :messages="$errors->get('occupation')" class="mt-2" />
                    </div>

                    {{-- Avatar --}}
                    <div class="mt-5">
                        <x-input-label for="avatar" :value="__('Avatar')" />
                        <div class="flex items-center gap-x-4 mt-2">
                            <img src="{{ Storage::url($client->avatar) }}" alt="Client Avatar"
                                class="rounded-2xl object-cover w-[90px] h-[90px] border border-gray-200 shadow-sm">
                            <x-text-input id="avatar"
                                class="block w-full py-3 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition"
                                type="file" name="avatar" autocomplete="avatar" />
                        </div>
                        <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
                    </div>

                    {{-- Logo --}}
                    <div class="mt-5">
                        <x-input-label for="logo" :value="__('Logo')" />
                        <div class="flex items-center gap-x-4 mt-2">
                            <img src="{{ Storage::url($client->logo) }}" alt="Client Logo"
                                class="rounded-2xl object-cover w-[90px] h-[90px] border border-gray-200 shadow-sm">
                            <x-text-input id="logo"
                                class="block w-full py-3 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition"
                                type="file" name="logo" autocomplete="logo" />
                        </div>
                        <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="flex items-center justify-end mt-8">
                        <button type="submit"
                            class="font-bold py-3 px-8 bg-indigo-700 text-white rounded-full hover:bg-indigo-800 transition shadow-md">
                            Update Client
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
