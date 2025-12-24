<footer class="bg-cp-black w-full relative overflow-hidden mt-20 pb-3">
    <div
        class="container max-w-[1130px] mx-auto flex flex-wrap gap-y-4 items-center justify-between pt-[100px] pb-[80px] relative z-10">
        <div class="flex flex-col gap-10">
            <div class="flex items-center gap-3">
                <div class="flex shrink-0 h-[43px] overflow-hidden">
                    <img src="{{ asset('assets/logo/Logo-MMK-White.png') }}" class="object-contain w-full h-full"
                        alt="logo">
                </div>
                <div class="flex flex-col">
                    <p id="CompanyName" class="font-extrabold text-xl leading-[30px] text-white">CV. Mulia Mandiri
                        Konstruksi</p>
                    <p id="CompanyTagline" class="text-sm text-cp-light-grey">Mitra Konstruksi Anda</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <a href="">
                    <div class="w-6 h-6 flex shrink-0 overflow-hidden">
                        <img src="{{ asset('assets/icons/youtube.svg') }}" class="w-full h-full object-contain"
                            alt="youtube">
                    </div>
                </a>
                <a href="">
                    <div class="w-6 h-6 flex shrink-0 overflow-hidden">
                        <img src="{{ asset('assets/icons/whatsapp.svg') }}" class="w-full h-full object-contain"
                            alt="whatsapp">
                    </div>
                </a>
                <a href="">
                    <div class="w-6 h-6 flex shrink-0 overflow-hidden">
                        <img src="{{ asset('assets/icons/facebook.svg') }}" class="w-full h-full object-contain"
                            alt="facebook">
                    </div>
                </a>
                <a href="">
                    <div class="w-6 h-6 flex shrink-0 overflow-hidden">
                        <img src="{{ asset('assets/icons/instagram.svg') }}" class="w-full h-full object-contain"
                            alt="instagram">
                    </div>
                </a>
            </div>
        </div>
        <div class="flex flex-wrap gap-[30px]">
            <div class="flex flex-col w-[150px] gap-3">
                <p class="font-bold text-lg text-white">Quick Links</p>
                <a href="{{ route('front.index') }}"
                    class="text-cp-light-grey hover:text-white transition-all duration-300">Produk
                    Kami</a>
                <a href="{{ route('front.team') }}"
                    class="text-cp-light-grey hover:text-white transition-all duration-300">Tim Kami</a>
                <a href="{{ route('front.about') }}"
                    class="text-cp-light-grey hover:text-white transition-all duration-300">Tentang
                    Kami</a>
                <a href="{{ route('front.appointment') }}"
                    class="text-cp-light-grey hover:text-white transition-all duration-300">Testimoni</a>
            </div>
        </div>
        <div class="flex flex-wrap gap-[30px]">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d294.3510077134882!2d108.59544964289019!3d-6.973969675556805!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f13000e9982c3%3A0x722ed049fb743a61!2sCV.%20MULIA%20MANDIRI%20KONSTRUKSI!5e0!3m2!1sen!2sid!4v1763634288316!5m2!1sen!2sid"
                width="400" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    <div class="w-full border-t border-white/10 mt-10 pt-6 pb-6 text-center">
        <p class="text-sm text-cp-light-grey">
            © {{ date('Y') }} CV. Mulia Mandiri Konstruksi. All rights reserved.
        </p>
    </div>
</footer>
