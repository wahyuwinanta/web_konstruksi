<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight tracking-tight">
            {{ __('Edit Testimonial') }}
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
                <form method="POST" action="{{ route('admin.testimonials.update', $testimonial) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Project Client --}}
                    <div class="mb-6">
                        <x-input-label for="project_client_id" :value="__('Project Client')" />
                        <select name="project_client_id" id="project_client_id"
                            class="mt-2 py-3 pl-3 w-full border border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="{{ $testimonial->client->id }}" selected>
                                {{ $testimonial->client->name }}
                            </option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('project_client')" class="mt-2" />
                    </div>

                    {{-- Message --}}
                    <div class="mb-6">
                        <x-input-label for="message" :value="__('Message')" />
                        <textarea name="message" id="message" rows="5"
                            class="mt-2 w-full border border-gray-300 rounded-xl py-3 px-4 focus:ring-indigo-500 focus:border-indigo-500">{{ $testimonial->message }}</textarea>
                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                    </div>

                    {{-- Thumbnail --}}
                    <div class="mb-6">
                        <x-input-label for="thumbnail" :value="__('Thumbnail')" />
                        <div class="flex items-center gap-x-4 mt-2">
                            <img src="{{ Storage::url($testimonial->thumbnail) }}" alt="Thumbnail"
                                class="rounded-2xl object-cover w-[100px] h-[100px] border border-gray-200 shadow-sm">
                            <x-text-input id="thumbnail" class="block w-full border-gray-300 rounded-xl" type="file"
                                name="thumbnail" autofocus autocomplete="thumbnail" />
                        </div>
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                    </div>

                    {{-- Submit --}}
                    <div class="flex justify-end mt-10">
                        <button type="submit"
                            class="font-bold py-3 px-8 bg-indigo-700 text-white rounded-full hover:bg-indigo-800 shadow transition duration-200 ease-in-out">
                            Update Testimonial
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
