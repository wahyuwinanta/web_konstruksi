<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight tracking-tight">
            {{ __('New Testimonial') }}
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
                <form method="POST" action="{{ route('admin.testimonials.store') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- Project Client --}}
                    <div class="mb-6">
                        <x-input-label for="project_client_id" :value="__('Project Client')" />
                        <select name="project_client_id" id="project_client_id"
                            class="mt-2 py-3 pl-3 w-full border border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Choose project client</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('project_client_id')" class="mt-2" />
                    </div>

                    {{-- Message --}}
                    <div class="mb-6">
                        <x-input-label for="message" :value="__('Message')" />
                        <textarea name="message" id="message" rows="5"
                            class="block mt-2 w-full py-3 px-4 border border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 placeholder-slate-400"
                            placeholder="Write testimonial message here...">{{ old('message') }}</textarea>
                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                    </div>

                    {{-- Thumbnail --}}
                    <div class="mb-6">
                        <x-input-label for="thumbnail" :value="__('Thumbnail')" />
                        <x-text-input id="thumbnail"
                            class="block mt-2 w-full border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500"
                            type="file" name="thumbnail" required autofocus autocomplete="thumbnail" />
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                    </div>

                    {{-- Submit --}}
                    <div class="flex justify-end mt-10">
                        <button type="submit"
                            class="font-bold py-3 px-8 bg-indigo-700 text-white rounded-full hover:bg-indigo-800 shadow transition duration-200 ease-in-out">
                            Add New Testimonial
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
