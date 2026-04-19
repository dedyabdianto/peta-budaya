@props([
    'title',
    'description',
])

<div class="flex w-full flex-col text-center gap-2">
    <h2 class="auth-brand text-2xl font-bold text-emerald-950 tracking-tight">{{ $title }}</h2>
    <p class="text-sm text-emerald-800/60 leading-relaxed">{{ $description }}</p>
</div>
