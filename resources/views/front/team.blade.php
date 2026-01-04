@extends('front.layouts.app')
@section('content')
    <div id="header" class="bg-[#F6F7FA] relative">
        <x-navbar />
    </div>
    <div id="Teams" class="w-full px-[10px] relative pt-10 z-10 -mt-[10px]">
        <div class="container max-w-[1130px] mx-auto flex flex-col gap-[50px] items-center">
            <div class="flex flex-col gap-[50px] items-center">
                <div class="breadcrumb flex items-center justify-center gap-[30px]">
                    <p class="text-cp-light-grey last-of-type:text-cp-black last-of-type:font-semibold">Beranda</p>
                    <span class="text-cp-light-grey">/</span>
                    <p class="text-cp-light-grey last-of-type:text-cp-black last-of-type:font-semibold">Tim</p>
                </div>
                <h2 class="font-bold text-4xl leading-[45px] text-center">Kami Siap Membangun Proyek Terbaik untuk Anda
                </h2>
            </div>
            <div
                class="teams-card-container grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-[30px] justify-center">
                @forelse ($teams as $team)
                    <div
                        class="card bg-white flex flex-col h-full justify-center items-center p-[30px] px-[29px] gap-[30px] rounded-[20px] border border-[#E8EAF2] hover:shadow-[0_10px_30px_0_#D1D4DF80] hover:border-cp-dark-blue transition-all duration-300">
                        <div
                            class="w-[100px] h-[100px] flex shrink-0 items-center justify-center rounded-full bg-[linear-gradient(150.55deg,_#007AFF_8.72%,_#312ECB_87.11%)]">
                            <div class="w-[90px] h-[90px] rounded-full overflow-hidden">
                                <img src="{{ Storage::url($team->avatar) }}"
                                    class="object-cover w-full h-full object-center" alt="photo">
                            </div>
                        </div>
                        <div class="flex flex-col gap-1 text-center">
                            <p class="font-bold text-xl leading-[30px]">{{ $team->name }}</p>
                            <p class="text-cp-light-grey">{{ $team->occupation }}</p>
                        </div>
                        <div class="flex items-center justify-center gap-[10px]">
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="assets/icons/global.svg" alt="icon">
                            </div>
                            <p class="text-cp-dark-blue font-semibold">{{ $team->location }}</p>
                        </div>
                    </div>
                @empty
                    <p>
                        Belum ada data team
                    </p>
                @endforelse
            </div>
        </div>
    </div>
    <div id="Stats" class="bg-cp-black w-full mt-20" x-data="{ open: false, doc: null }" x-cloak>

        <div class="container max-w-[1000px] mx-auto py-10">
            <div class="flex flex-wrap items-center justify-between p-[10px]">

                @forelse ($statistics as $statistic)
                    <div class="card w-[200px] flex flex-col items-center gap-[10px] text-center cursor-pointer"
                        @click="
                        @if ($statistic->document) doc = '{{ Storage::url($statistic->document) }}';
                            open = true; @endif
                    ">
                        <div class="w-[55px] h-[55px] flex shrink-0 overflow-hidden">
                            <img src="{{ Storage::url($statistic->icon) }}"
                                class="object-contain w-full h-full hover:scale-110 transition" alt="icon">
                        </div>

                        <p class="text-cp-pale-orange font-bold text-4xl">
                            {{ $statistic->goal }}
                        </p>
                        <p class="text-cp-light-grey">
                            {{ $statistic->name }}
                        </p>
                    </div>
                @empty
                    <p class="text-white">Belum ada data terbaru</p>
                @endforelse

            </div>
        </div>

        <!-- MODAL DOKUMEN -->
        <div x-show="open" x-transition.opacity @keydown.escape.window="open = false"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm"
            @click.self="open = false">
            <div x-transition.scale
                class="relative w-[470px] h-[550px] bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col"
                @click.stop>

                <!-- Header -->
                <div class="flex items-center justify-between px-6 py-4 bg-white/90 backdrop-blur border-b">
                    <h2 class="text-lg font-semibold text-gray-800">
                        Document Preview
                    </h2>

                    <button @click="open = false"
                        class="w-10 h-10 flex items-center justify-center rounded-full text-gray-600 hover:bg-red-50 hover:text-red-600 transition"
                        aria-label="Close">
                        ✕
                    </button>
                </div>

                <!-- Content -->
                <div class="flex-1 bg-gray-100">
                    <template x-if="doc">
                        <iframe :src="doc" class="w-full h-full bg-white" loading="lazy"></iframe>
                    </template>
                </div>

            </div>
        </div>

    </div>
    {{-- <div id="Awards" class="container max-w-[1130px] mx-auto flex flex-col gap-[30px] mt-20">
        <div class="flex items-center justify-between">
            <div class="flex flex-col gap-[14px]">
                <p
                    class="badge w-fit bg-cp-pale-blue text-cp-light-blue p-[8px_16px] rounded-full uppercase font-bold text-sm">
                    Sertifikasi Kami</p>
                <h2 class="font-bold text-4xl leading-[45px]">Kami Mendedikasikan Upaya Terbaik<br>Dari Tim Kami</h2>
            </div>
            <a href="" class="bg-cp-black p-[14px_20px] w-fit rounded-xl font-bold text-white">Jelajahi Lebih
                Lanjut</a>
        </div>
        <div
            class="awards-card-container grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-[30px] justify-center">
            <div
                class="card bg-white flex flex-col h-full p-[30px] gap-[30px] rounded-[20px] border border-[#E8EAF2] hover:border-cp-dark-blue transition-all duration-300">
                <div class="w-[55px] h-[55px] flex shrink-0">
                    <img src="{{ asset('assets/icons/cup-blue.svg') }}" alt="icon">
                </div>
                <hr class="border-[#E8EAF2]">
                <p class="font-bold text-xl leading-[30px]">Solid Fundame</p>
                <hr class="border-[#E8EAF2]">
                <p class="text-cp-light-grey">Bali, 2020</p>
            </div>
        </div>
    </div> --}}
    <x-footer />
@endsection
