@props([
    'number' => '6289636495853',
    'message' => 'Halo, saya ingin bertanya.',
])

<a href="https://wa.me/{{ $number }}?text={{ urlencode($message) }}" target="_blank" class="whatsapp-bubble">
    <img src="{{ asset('assets\logo\whatsapp.png') }}" alt="WhatsApp">
</a>

<style>
    .whatsapp-bubble {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: #25D366;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        z-index: 9999;
        transition: transform 0.3s ease;
    }

    .whatsapp-bubble img {
        width: 35px;
        height: 35px;
    }

    .whatsapp-bubble:hover {
        transform: scale(1.1);
    }
</style>
