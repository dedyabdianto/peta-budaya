<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')

        {{-- Warisan Malind Fonts --}}
        <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

        <style>
            .auth-bg-overlay {
                background: linear-gradient(135deg, rgba(3, 33, 25, 0.85) 0%, rgba(26, 54, 45, 0.75) 50%, rgba(83, 35, 0, 0.6) 100%);
            }
            .auth-brand {
                font-family: 'Noto Serif', serif;
            }
            .auth-body {
                font-family: 'Inter', sans-serif;
            }
            .auth-sidebar-quote {
                font-family: 'Noto Serif', serif;
            }

            /* Override Flux accent colors for Warisan Malind theme */
            :root {
                --color-accent: #064e3b !important;
                --color-accent-content: #064e3b !important;
                --color-accent-foreground: #ffffff !important;
            }

            /* Input styling */
            input[data-flux-control],
            textarea[data-flux-control],
            select[data-flux-control] {
                color: #1b1c19 !important;
                background-color: #f5f3ee !important;
                border: 1px solid #c1c8c4 !important;
                border-radius: 0.75rem !important;
            }
            input[data-flux-control]:focus,
            textarea[data-flux-control]:focus {
                border-color: #064e3b !important;
                box-shadow: 0 0 0 2px rgba(6, 78, 59, 0.15) !important;
            }
            input[data-flux-control]::placeholder {
                color: #727975 !important;
            }

            /* Label styling */
            [data-flux-label] {
                color: #1b1c19 !important;
                font-weight: 500 !important;
            }

            /* Button styling */
            button[data-flux-button][data-variant="primary"],
            button[type="submit"] {
                background-color: #064e3b !important;
                color: #ffffff !important;
                border-radius: 0.75rem !important;
                font-weight: 600 !important;
            }
            button[data-flux-button][data-variant="primary"]:hover,
            button[type="submit"]:hover {
                background-color: #032119 !important;
            }

            /* Link styling */
            a[data-flux-link],
            [data-flux-link] {
                color: #735c00 !important;
            }
            a[data-flux-link]:hover,
            [data-flux-link]:hover {
                color: #574500 !important;
            }

            /* Checkbox styling */
            [data-flux-checkbox] input:checked {
                background-color: #064e3b !important;
                border-color: #064e3b !important;
            }

            /* Bottom text styling */
            .text-zinc-600,
            .text-zinc-400 {
                color: #414845 !important;
            }
        </style>
    </head>
    <body class="auth-body min-h-screen antialiased">
        <div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
            {{-- Left Panel: Visual Showcase --}}
            <div class="relative hidden h-full flex-col p-10 text-white lg:flex overflow-hidden">
                {{-- Background Image --}}
                <img
                    class="absolute inset-0 w-full h-full object-cover"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBlRRSWmEYIop32FmBjp8vrrDs12iYR2njp6n0lqnsgV5LTmmhtyrDP_LCmZRhfva_WFfpOmo1etxA4jkk7iO7ZOGFa6Q-zEq78qnjE-E6L0Rs_Ic9U4-DA5eAfZhqTIt4vBTE2hSoV9LGNvm9DqHV8pl54JoiZ7AyN0rY0sNUQ1oSBmVPwX5EoHlABDwMh0lNeyGD44wLB4_UyWKqkKM_onoNT3Izq-mLWKzWEE3gNnD1EorM7sdKzWPZs8PtEyWtWHoqf6DHzrkU"
                    alt="Tanah Malind Landscape"
                />
                <div class="auth-bg-overlay absolute inset-0"></div>

                {{-- Top Brand --}}
                <a href="{{ route('home') }}" class="relative z-20 flex items-center gap-3" wire:navigate>
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-white/20 backdrop-blur-md border border-white/30">
                        <span class="material-symbols-outlined text-white text-xl" style="font-variation-settings: 'FILL' 1;">eco</span>
                    </div>
                    <span class="auth-brand text-xl font-bold tracking-tighter text-white">Warisan Malind</span>
                </a>

                {{-- Bottom Quote --}}
                <div class="relative z-20 mt-auto space-y-6">
                    <div class="w-16 h-1 bg-gradient-to-r from-yellow-500 to-yellow-600/0 rounded-full"></div>
                    <blockquote class="space-y-3">
                        <p class="auth-sidebar-quote text-2xl leading-relaxed text-white/90 italic">
                            &ldquo;Setiap koordinat menyimpan narasi yang diturunkan melalui lisan, dari totem leluhur hingga monumen berabad-abad.&rdquo;
                        </p>
                        <footer class="text-sm text-white/50 font-medium tracking-widest uppercase">Portal Geospasial Warisan Budaya</footer>
                    </blockquote>
                </div>
            </div>

            {{-- Right Panel: Auth Form --}}
            <div class="w-full lg:p-8 bg-[#fbf9f4]">
                <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[380px]">
                    {{-- Mobile Logo --}}
                    <a href="{{ route('home') }}" class="z-20 flex flex-col items-center gap-3 lg:hidden" wire:navigate>
                        <div class="flex items-center justify-center w-14 h-14 rounded-full bg-emerald-950/10 border border-emerald-900/10">
                            <span class="material-symbols-outlined text-emerald-900 text-3xl" style="font-variation-settings: 'FILL' 1;">eco</span>
                        </div>
                        <span class="auth-brand text-2xl font-bold tracking-tighter text-emerald-950">Warisan Malind</span>
                    </a>
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
