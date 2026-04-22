{{--
    Admin Flash Alerts - cukup letakkan syntax):
        <x-admin.flash-alert />

    component ini membaca session
        session()->flash('message', '...')        → success
        session()->flash('success', '...')         → success
        session()->flash('error', '...')           → error
        session()->flash('warning', '...')         → warning
        session()->flash('info', '...')            → info

    akan hilang 5 detik
--}}

@props([
    'dismissAfter' => 5000,
])

@if (session()->has('message'))
    <x-admin.alert type="success" :message="session('message')" :dismissAfter="$dismissAfter" />
@endif

@if (session()->has('success'))
    <x-admin.alert type="success" :message="session('success')" :dismissAfter="$dismissAfter" />
@endif

@if (session()->has('error'))
    <x-admin.alert type="error" :message="session('error')" />
@endif

@if (session()->has('warning'))
    <x-admin.alert type="warning" :message="session('warning')" />
@endif

@if (session()->has('info'))
    <x-admin.alert type="info" :message="session('info')" :dismissAfter="$dismissAfter" />
@endif
