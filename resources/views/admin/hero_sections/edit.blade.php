<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-indigo-800 leading-tight tracking-wide">
            {{ __('Edit Hero Section') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md border border-gray-100 rounded-2xl p-10">
                
                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="space-y-3 mb-6">
                        @foreach ($errors->all() as $error)
                            <div class="py-3 px-4 w-full rounded-xl bg-red-500 text-white font-medium">
                                {{ $error }}
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Form Start --}}
                <form method="POST" action="{{ route('admin.hero_sections.update', $heroSection) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Heading --}}
                    <div>
                        <x-input-label for="heading" :value="__('Heading')" />
                        <x-text-input id="heading" class="block mt-1 w-full" type="text" name="heading"
                            value="{{ $heroSection->heading }}" required autofocus autocomplete="heading" />
                        <x-input-error :messages="$errors->get('heading')" class="mt-2" />
                    </div>

                    {{-- Banner --}}
                    <div>
                        <x-input-label for="banner" :value="__('Banner')" />
                        <div class="flex items-center gap-4 mt-2">
                            <img src="{{ Storage::url($heroSection->banner) }}" alt="Current Banner"
                                class="rounded-xl object-cover w-[100px] h-[100px] border border-gray-200 shadow-sm">
                            <x-text-input id="banner" class="block w-full" type="file" name="banner" autocomplete="banner" />
                        </div>
                        <x-input-error :messages="$errors->get('banner')" class="mt-2" />
                    </div>

                    {{-- Subheading --}}
                    <div>
                        <x-input-label for="subheading" :value="__('Subheading')" />
                        <x-text-input id="subheading" class="block mt-1 w-full" type="text" name="subheading"
                            value="{{ $heroSection->subheading }}" required autocomplete="subheading" />
                        <x-input-error :messages="$errors->get('subheading')" class="mt-2" />
                    </div>

                    {{-- Achievement --}}
                    <div>
                        <x-input-label for="achievement" :value="__('Achievement')" />
                        <x-text-input id="achievement" class="block mt-1 w-full" type="text" name="achievement"
                            value="{{ $heroSection->achievement }}" required autocomplete="achievement" />
                        <x-input-error :messages="$errors->get('achievement')" class="mt-2" />
                    </div>

                    {{-- Path Video --}}
                    <div>
                        <x-input-label for="path_video" :value="__('Video Path')" />
                        <x-text-input id="path_video" class="block mt-1 w-full" type="text" name="path_video"
                            value="{{ $heroSection->path_video }}" required autocomplete="path_video" />
                        <x-input-error :messages="$errors->get('path_video')" class="mt-2" />
                    </div>

                    {{-- Submit Button --}}
                    <div class="flex items-center justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-indigo-700 hover:bg-indigo-800 text-white font-semibold rounded-full shadow-sm transition duration-200 ease-in-out">
                            Update Hero Section
                        </button>
                    </div>
                </form>
                {{-- Form End --}}
            </div>
        </div>
    </div>
</x-app-layout>
