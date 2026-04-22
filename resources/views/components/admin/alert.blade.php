{{--
    Admin Alert Component
    Usage:
        <x-admin.alert type="success" message="Berhasil disimpan!" />
        <x-admin.alert type="error" message="Terjadi kesalahan." />
        <x-admin.alert type="warning" message="Perhatian!" />
        <x-admin.alert type="info" message="Informasi penting." />

    Akan hilang otomatis (optional, dalam milidetik):
        <x-admin.alert type="success" message="..." :dismissAfter="5000" />

    Bisa dihilangkan manual (default true):
        <x-admin.alert type="success" message="..." :dismissible="false" />
--}}

@props([
    'type' => 'info',
    'message' => '',
    'dismissible' => true,
    'dismissAfter' => null,
])

@php
    $config = match($type) {
        'success' => [
            'class' => 'alert-success',
            'icon'  => 'check_circle',
        ],
        'error' => [
            'class' => 'alert-error',
            'icon'  => 'error',
        ],
        'warning' => [
            'class' => 'alert-warning',
            'icon'  => 'warning',
        ],
        default => [
            'class' => 'alert-info',
            'icon'  => 'info',
        ],
    };
@endphp

@if ($message)
    <div
        x-data="{ show: true }"
        x-show="show"
        x-transition:enter="alert-enter"
        x-transition:leave="alert-leave"
        @if ($dismissAfter)
            x-init="setTimeout(() => show = false, {{ $dismissAfter }})"
        @endif
        class="admin-alert {{ $config['class'] }}"
        style="display: flex;"
    >
        <span class="material-symbols-outlined admin-alert-icon">{{ $config['icon'] }}</span>
        <span class="admin-alert-message">{{ $message }}</span>

        @if ($dismissible)
            <button type="button" class="admin-alert-close" @click="show = false">
                <span class="material-symbols-outlined" style="font-size:16px;">close</span>
            </button>
        @endif
    </div>
@endif
