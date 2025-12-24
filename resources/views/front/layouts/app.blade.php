<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS for carousel/flickity-->
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link rel="stylesheet" href="https://unpkg.com/flickity-fade@2/flickity-fade.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <link rel="stylesheet" href="{{ asset('css/mobile.css') }}">

    <!-- CSS for modal/flowbite -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css"  rel="stylesheet" /> -->
</head>

<body class="font-poppins text-cp-black">

    {{-- HALAMAN --}}
    @yield('content')

    <x-whatsapp-bubble number="6281320534811"
        message="Halo kak, saya ingin bertanya tentang layanan CV. Mulia Mandiri Konstruksi." />

    @stack('before-scripts')
    @stack('after-scripts')
</body>

</html>
