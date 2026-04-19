<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')

        {{-- Warisan Malind Fonts --}}
        <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

        <style>
            .auth-card {
                background: rgba(255, 255, 255, 0.92);
                backdrop-filter: blur(24px);
                -webkit-backdrop-filter: blur(24px);
                border: 1px solid rgba(255, 255, 255, 0.4);
            }
            .auth-brand {
                font-family: 'Noto Serif', serif;
            }
            .auth-body {
                font-family: 'Inter', sans-serif;
            }

            /* Override Flux accent colors for Warisan Malind theme */
            :root {
                --color-accent: #064e3b !important;
                --color-accent-content: #064e3b !important;
                --color-accent-foreground: #ffffff !important;
            }

            /* Input styling */
            .auth-card input[data-flux-control],
            .auth-card textarea[data-flux-control],
            .auth-card select[data-flux-control] {
                color: #1b1c19 !important;
                background-color: #f5f3ee !important;
                border: 1px solid #c1c8c4 !important;
                border-radius: 0.75rem !important;
            }
            .auth-card input[data-flux-control]:focus,
            .auth-card textarea[data-flux-control]:focus {
                border-color: #064e3b !important;
                box-shadow: 0 0 0 2px rgba(6, 78, 59, 0.15) !important;
            }
            .auth-card input[data-flux-control]::placeholder {
                color: #727975 !important;
            }

            /* Label styling */
            .auth-card [data-flux-label] {
                color: #1b1c19 !important;
                font-weight: 500 !important;
            }

            /* Button styling */
            .auth-card button[data-flux-button][data-variant="primary"],
            .auth-card button[type="submit"] {
                background-color: #064e3b !important;
                color: #ffffff !important;
                border-radius: 0.75rem !important;
                font-weight: 600 !important;
            }
            .auth-card button[data-flux-button][data-variant="primary"]:hover,
            .auth-card button[type="submit"]:hover {
                background-color: #032119 !important;
            }

            /* Link styling */
            .auth-card a[data-flux-link],
            .auth-card [data-flux-link] {
                color: #735c00 !important;
            }
            .auth-card a[data-flux-link]:hover,
            .auth-card [data-flux-link]:hover {
                color: #574500 !important;
            }

            /* Checkbox styling */
            .auth-card [data-flux-checkbox] input:checked {
                background-color: #064e3b !important;
                border-color: #064e3b !important;
            }

            /* Bottom text styling */
            .auth-card .text-zinc-600,
            .auth-card .text-zinc-400 {
                color: #414845 !important;
            }
        </style>
    </head>
    <body class="auth-body min-h-screen antialiased bg-[#fbf9f4]">
        <div class="flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-md flex-col gap-6">
                {{-- Brand Logo --}}
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-3" wire:navigate>
                    <div class="flex items-center justify-center w-14 h-14 rounded-full bg-emerald-950/10 border border-emerald-900/10">
                        <span class="material-symbols-outlined text-emerald-900 text-3xl" style="font-variation-settings: 'FILL' 1;">eco</span>
                    </div>
                    <span class="auth-brand text-2xl font-bold tracking-tighter text-emerald-950">Warisan Malind</span>
                </a>

                {{-- Card --}}
                <div class="auth-card rounded-2xl shadow-xl">
                    <div class="px-10 py-8">
                        {{ $slot }}
                    </div>
                </div>

                {{-- Footer --}}
                <p class="text-center text-xs text-emerald-800/40 tracking-wide">
                    © {{ date('Y') }} Warisan Malind — Digitalisasi Peta Warisan Kebudayaan
                </p>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
