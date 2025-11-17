<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight tracking-tight">
            {{ __('Edit Statistics') }}
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
                <form method="POST" action="{{ route('admin.statistics.update', $statistic) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Name --}}
                    <div class="mb-6">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-2 w-full border-gray-300 rounded-xl" type="text"
                            name="name" value="{{ $statistic->name }}" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Icon --}}
                    <div class="mb-6">
                        <x-input-label for="icon" :value="__('Icon')" />
                        <div class="flex items-center gap-x-4 mt-2">
                            <img src="{{ Storage::url($statistic->icon) }}" alt="Icon"
                                class="rounded-2xl object-cover w-[100px] h-[100px] border border-gray-200 shadow-sm">
                            <x-text-input id="icon" class="block w-full border-gray-300 rounded-xl" type="file"
                                name="icon" autofocus autocomplete="icon" />
                        </div>
                        <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                    </div>

                    {{-- Goal --}}
                    <div class="mb-6">
                        <x-input-label for="goal" :value="__('Goal')" />
                        <x-text-input id="goal" class="block mt-2 w-full border-gray-300 rounded-xl" type="text"
                            name="goal" value="{{ $statistic->goal }}" required autofocus autocomplete="goal" />
                        <x-input-error :messages="$errors->get('goal')" class="mt-2" />
                    </div>

                    {{-- Submit --}}
                    <div class="flex justify-end mt-10">
                        <button type="submit"
                            class="font-bold py-3 px-8 bg-indigo-700 text-white rounded-full hover:bg-indigo-800 shadow transition duration-200 ease-in-out">
                            Update Statistic
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
