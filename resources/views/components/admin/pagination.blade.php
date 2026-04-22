{{--
    Admin Pagination Component
    Cara menggunakan di Livewire:
        {{ $items->links('components.admin.pagination') }}

    Atau sebagai Blade component (passing paginator instance):
        <x-admin.pagination :paginator="$items" />
--}}

@props([
    'paginator' => null,
])

@php
    $paginator = $paginator ?? $paginator;

    if (! $paginator || ! $paginator->hasPages()) {
        return;
    }

    $currentPage = $paginator->currentPage();
    $lastPage = $paginator->lastPage();
    $from = $paginator->firstItem() ?? 0;
    $to = $paginator->lastItem() ?? 0;
    $total = $paginator->total();

    // Build page range with ellipsis
    $pages = [];
    if ($lastPage <= 7) {
        $pages = range(1, $lastPage);
    } else {
        $pages[] = 1;

        if ($currentPage > 3) {
            $pages[] = '...';
        }

        $start = max(2, $currentPage - 1);
        $end = min($lastPage - 1, $currentPage + 1);

        for ($i = $start; $i <= $end; $i++) {
            $pages[] = $i;
        }

        if ($currentPage < $lastPage - 2) {
            $pages[] = '...';
        }

        $pages[] = $lastPage;
    }
@endphp

@if ($paginator->hasPages())
    <div class="admin-pagination">
        <span class="pagination-info">
            Menampilkan {{ $from }}-{{ $to }} dari {{ $total }} data
        </span>

        <div class="pagination-btns">
            {{-- Previous --}}
            <button
                class="page-btn {{ $paginator->onFirstPage() ? 'disabled' : '' }}"
                @if (!$paginator->onFirstPage())
                    wire:click="previousPage"
                @endif
                {{ $paginator->onFirstPage() ? 'disabled' : '' }}
            >
                <span class="material-symbols-outlined" style="font-size:16px">chevron_left</span>
            </button>

            {{-- Page Numbers --}}
            @foreach ($pages as $page)
                @if ($page === '...')
                    <span class="page-btn page-ellipsis">…</span>
                @else
                    <button
                        class="page-btn {{ $page === $currentPage ? 'active' : '' }}"
                        wire:click="gotoPage({{ $page }})"
                    >
                        {{ $page }}
                    </button>
                @endif
            @endforeach

            {{-- Next --}}
            <button
                class="page-btn {{ !$paginator->hasMorePages() ? 'disabled' : '' }}"
                @if ($paginator->hasMorePages())
                    wire:click="nextPage"
                @endif
                {{ !$paginator->hasMorePages() ? 'disabled' : '' }}
            >
                <span class="material-symbols-outlined" style="font-size:16px">chevron_right</span>
            </button>
        </div>
    </div>
@endif
