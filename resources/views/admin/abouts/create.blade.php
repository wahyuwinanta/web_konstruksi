<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight tracking-tight">
            {{ __('New About') }}
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
                <form method="POST" action="{{ route('admin.abouts.store') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- Name --}}
                    <div class="mb-6">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-2 w-full border-gray-300 rounded-xl" type="text"
                            name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Thumbnail --}}
                    <div class="mb-6">
                        <x-input-label for="thumbnail" :value="__('Thumbnail')" />
                        <x-text-input id="thumbnail"
                            class="block mt-2 w-full border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500"
                            type="file" name="thumbnail" required autofocus autocomplete="thumbnail" />
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                    </div>

                    {{-- Type --}}
                    <div class="mb-6">
                        <x-input-label for="type" :value="__('Type')" />
                        <select name="type" id="type"
                            class="mt-2 py-3 pl-3 w-full border border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Choose type</option>
                            <option value="Visions">Visions</option>
                            <option value="Missions">Missions</option>
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    {{-- Keypoints --}}
                    <h3 class="text-indigo-950 text-lg font-bold mt-8 mb-4">Keypoints</h3>
                    <div class="flex flex-col gap-y-4">
                        @for ($i = 0; $i < 3; $i++)
                            <input type="text" name="keypoints[]" placeholder="Write your keypoint"
                                class="py-3 px-4 rounded-xl border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 placeholder-slate-400">
                        @endfor
                        <x-input-error :messages="$errors->get('keypoints')" class="mt-2" />
                    </div>

                    {{-- Submit --}}
                    <div class="flex justify-end mt-10">
                        <button type="submit"
                            class="font-bold py-3 px-8 bg-indigo-700 text-white rounded-full hover:bg-indigo-800 shadow transition duration-200 ease-in-out">
                            Add New About
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
