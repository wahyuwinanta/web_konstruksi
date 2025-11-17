<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight tracking-tight">
            {{ __('Edit User') }}
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
                <form method="POST" action="{{ route('admin.users.update', $user) }}">
                    @csrf
                    @method('PUT')

                    {{-- Name --}}
                    <div class="mb-6">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="mt-2 block w-full border-gray-300 rounded-xl py-3 px-4"
                            type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Email --}}
                    <div class="mb-6">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="mt-2 block w-full border-gray-300 rounded-xl py-3 px-4"
                            type="email" name="email" value="{{ old('email', $user->email) }}" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- Password --}}
                    <div class="mb-6">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="mt-2 block w-full border-gray-300 rounded-xl py-3 px-4"
                            type="password" name="password" placeholder="Leave blank to keep current password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        <p class="text-sm text-gray-500 mt-1">Leave empty if you don’t want to change the password.</p>
                    </div>

                    {{-- Role --}}
                    <div class="mb-6">
                        <x-input-label for="role" :value="__('Role')" />
                        <select name="role" id="role"
                            class="mt-2 py-3 pl-3 w-full border border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}"
                                    {{ $user->getRoleNames()->contains($role->name) ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    {{-- Submit --}}
                    <div class="flex justify-end mt-10">
                        <button type="submit"
                            class="font-bold py-3 px-8 bg-indigo-700 text-white rounded-full hover:bg-indigo-800 shadow transition duration-200 ease-in-out">
                            Update User
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
