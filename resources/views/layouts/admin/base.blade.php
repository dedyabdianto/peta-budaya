<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />

        <title>
            {{ filled($title ?? null) ? $title . ' - Admin Warisan Malind' : 'Admin Warisan Malind' }}
        </title>

        <meta name="description" content="Panel Administrasi - Digitalisasi Peta Warisan Kebudayaan Tanah Malind" />

        <link rel="icon" href="{{ asset('LogoKementrianBudaya.webp') }}" type="image/webp">
        <link rel="apple-touch-icon" href="{{ asset('LogoKementrianBudaya.webp') }}">

        {{-- Google Fonts --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

        {{-- Admin CSS --}}
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />

        {{-- Quill.js Rich Text Editor (free, single-file CDN) --}}
        <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
        <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
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
