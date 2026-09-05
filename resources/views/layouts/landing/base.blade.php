<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />

        <title>
            {{ filled($title ?? null) ? $title . ' - Warisan Malind' : 'Warisan Malind' }}
        </title>

        <link rel="icon" href="{{ asset('LogoKementrianBudaya.webp') }}" type="image/webp">
        <link rel="apple-touch-icon" href="{{ asset('LogoKementrianBudaya.webp') }}">

        {{-- Google Fonts --}}
        <link
            href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap"
            rel="stylesheet" />
        <link
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
            rel="stylesheet" />

        {{-- Tailwind CDN (terpisah dari admin Tailwind v4) --}}
        <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

        {{-- Landing Page Assets --}}
        <link rel="stylesheet" href="{{ asset('css/landing.css') }}" />
        <script src="{{ asset('js/tailwind-config.js') }}"></script>
    </head>
    <body class="bg-surface font-body text-on-surface">
        @include('partials.landing.navbar')

        {{ $slot }}

        @include('partials.landing.footer')
    </body>
</html>
