<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />

        <title>
            {{ filled($title ?? null) ? $title . ' - Admin Warisan Malind' : 'Admin Warisan Malind' }}
        </title>

        <meta name="description" content="Panel Administrasi - Digitalisasi Peta Warisan Kebudayaan Tanah Malind" />

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        {{-- Google Fonts --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

        {{-- Admin CSS --}}
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    </head>
    <body class="admin-body">
        <div class="admin-layout">
            {{-- Sidebar Overlay (mobile) --}}
            <div id="sidebar-overlay" class="sidebar-overlay"></div>

            @include('partials.admin.sidebar')

            <div class="admin-main">
                @include('partials.admin.topbar')

                <div class="page-content">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <script src="{{ asset('js/admin.js') }}"></script>
    </body>
</html>
