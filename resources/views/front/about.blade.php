@extends('front.layouts.app')
@section('content')
    <div id="header" class="bg-[#F6F7FA] relative">
        <x-navbar />
        <div class="container max-w-[1130px] mx-auto relative pt-10 z-10">
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
                <div class="max-w-[900px] text-center text-cp-grey leading-relaxed text-base space-y-5">
                    <p>
                        CV. Mulia Mandiri Konstruksi berawal dari sebuah usaha kecil bernama
                        Bengkel Mulia Teknik Mandiri, yang didirikan pada tahun 2000. Pada masa
                        awal berdirinya, usaha ini bergerak di bidang jasa perbaikan bangunan dan
                        pengerjaan konstruksi sederhana.
                    </p>

                    <p>
                        Dengan berbekal keahlian teknis, komitmen kerja, dan reputasi yang terus
                        berkembang di tengah masyarakat, Bengkel Mulia Teknik Mandiri mampu
                        membangun kepercayaan pelanggan dan memperluas lingkup pelayanannya.
                    </p>

                    <p>
                        Seiring berjalannya waktu, kebutuhan pasar serta permintaan proyek yang
                        semakin meningkat mendorong perusahaan untuk berkembang menjadi usaha
                        konstruksi yang lebih profesional dan terstruktur. Atas dasar kebutuhan
                        tersebut, pada tahun 2024, usaha ini resmi berubah bentuk menjadi badan
                        usaha berbadan hukum dengan nama <span class="font-semibold text-cp-black">
                            CV. Mulia Mandiri Konstruksi</span>.
                    </p>

                    <p>
                        Perubahan status ini menandai langkah penting dalam perjalanan perusahaan,
                        yaitu meningkatkan kualitas pelayanan, memperluas cakupan proyek, serta
                        memperkuat manajemen operasional.
                    </p>
                </div>

            </div>
        </div>
    </div>

    <div id="Abouts" class="container max-w-[1130px] mx-auto flex flex-col gap-20 mt-20">
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

    {{-- <div id="Clients" class="container max-w-[1130px] mx-auto flex flex-col justify-center text-center gap-5 mt-20">
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
    </div> --}}

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
