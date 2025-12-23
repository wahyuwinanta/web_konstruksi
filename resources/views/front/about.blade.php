@extends('front.layouts.app')
@section('content')
    <div id="header" class="bg-[#F6F7FA] relative">
        <div class="container max-w-[1130px] mx-auto relative pt-10 z-10">
            <x-navbar />
            <div class="flex flex-col gap-[50px] items-center py-20">
                <div class="breadcrumb flex items-center justify-center gap-[30px]">
                    <p class="text-cp-light-grey last-of-type:text-cp-black last-of-type:font-semibold">Beranda</p>
                    <span class="text-cp-light-grey">/</span>
                    <p class="text-cp-light-grey last-of-type:text-cp-black last-of-type:font-semibold">Tentang Kami</p>
                </div>
                <h2 class="font-bold text-4xl leading-[45px] text-center">
                    Sejak Awal Berdiri Kami <br>
                    Berkomitmen Membuat Dunia Lebih Baik
                </h2>
            </div>
        </div>
    </div>

    <div id="Products" class="container max-w-[1130px] mx-auto flex flex-col gap-20 mt-20">
        @forelse ($abouts as $about)
            <div class="product flex flex-wrap justify-center items-center gap-[60px] even:flex-row-reverse">
                <div class="w-[470px] h-[550px] flex shrink-0 overflow-hidden">
                    <img src="{{ Storage::url($about->thumbnail) }}" class="w-full h-full object-contain" alt="thumbnail">
                </div>
                <div class="flex flex-col gap-[30px] py-[50px] h-fit max-w-[500px]">
                    <p
                        class="badge w-fit bg-cp-pale-blue text-cp-light-blue p-[8px_16px] rounded-full uppercase font-bold text-sm">
                        Visi Misi Kami
                    </p>
                    <div class="flex flex-col gap-[10px]">
                        <h2 class="font-bold text-4xl leading-[45px]">{{ $about->name }}</h2>
                        <div class="flex flex-col gap-5">
                            @forelse ($about->keypoints as $keypoint)
                                <div class="flex items-center gap-[10px]">
                                    <div class="w-6 h-6 flex shrink-0">
                                        <img src="{{ asset('assets/icons/tick-circle.svg') }}" alt="icon">
                                    </div>
                                    <p class="leading-[26px] font-semibold">
                                        {{ $keypoint->keypoint }}
                                    </p>
                                </div>
                            @empty
                                <p>Belum ada data poin utama</p>
                            @endforelse

                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p>Belum ada data terbaru</p>
        @endforelse
    </div>

    <div id="Clients" class="container max-w-[1130px] mx-auto flex flex-col justify-center text-center gap-5 mt-20">
        <h2 class="font-bold text-lg">
            Klien yang Telah Mempercayakan Proyeknya Kepada Kami
        </h2>
        <div class="logo-container flex flex-wrap gap-5 justify-center">
            @forelse ($clients as $client)
                <div
                    class="logo-card h-[68px] w-fit flex items-center shrink-0 border border-[#E8EAF2] rounded-[18px] p-4 gap-[10px] bg-white hover:border-cp-dark-blue transition-all duration-300">
                    <div class="overflow-hidden h-9">
                        <img src="{{ Storage::url($client->logo) }}" class="object-contain w-full h-full" alt="logo">
                    </div>
                </div>
            @empty
                <p>Belum ada data klien</p>
            @endforelse
        </div>
    </div>

    <div id="Stats" class="bg-cp-black w-full mt-20">
        <div class="container max-w-[1000px] mx-auto py-10">
            <div class="flex flex-wrap items-center justify-between p-[10px]">
                @forelse ($statistics as $statistic)
                    <div class="card w-[200px] flex flex-col items-center gap-[10px] text-center">
                        <div class="w-[55px] h-[55px] flex shrink-0 overflow-hidden">
                            <img src="{{ Storage::url($statistic->icon) }}" class="object-contain w-full h-full"
                                alt="icon">
                        </div>
                        <p class="text-cp-pale-orange font-bold text-4xl leading-[54px]">
                            {{ $statistic->goal }}
                        </p>
                        <p class="text-cp-light-grey">{{ $statistic->name }}</p>
                    </div>
                @empty
                    <p>Belum ada data statistik</p>
                @endforelse
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
