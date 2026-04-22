{{--
    Admin Modal Delete Confirmation

    Props:
        :show         - boolean, controls visibility
        :name         - string, name of item being deleted (displayed in red box)
        title         - string, modal title (default: "Konfirmasi Hapus")
        message       - string, confirmation message
        action        - string, Livewire method to call on confirm (default: "delete")
        cancel        - string, Livewire method to call on cancel (default: "cancelDelete")
        confirmText   - string, confirm button text (default: "Ya, Hapus")
        cancelText    - string, cancel button text (default: "Batal")

    Contoh:
        <x-admin.modal-delete
            :show="$showDeleteModal"
            :name="$deleteName"
            title="Hapus Kategori"
            message="Yakin ingin menghapus?"
            action="delete"
            cancel="cancelDelete"
        />

    Method yang di butuhkan pada component:
        public bool $showDeleteModal = false;
        public ?string $deleteId = null;
        public string $deleteName = '';
        public function confirmDelete(string $id, string $name): void
        public function cancelDelete(): void
        public function delete(): void
--}}

@props([
    'show' => false,
    'title' => 'Konfirmasi Hapus',
    'message' => 'Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.',
    'name' => '',
    'action' => 'delete',
    'cancel' => 'cancelDelete',
    'confirmText' => 'Ya, Hapus',
    'cancelText' => 'Batal',
])

@if ($show)
    <div class="modal-overlay" wire:click.self="{{ $cancel }}">
        <div class="modal-container modal-delete-container">
            <div class="modal-header">
                <div class="modal-header-info">
                    <div class="modal-icon red">
                        <span class="material-symbols-outlined">delete_forever</span>
                    </div>
                    <div>
                        <h3>{{ $title }}</h3>
                    </div>
                </div>
                <button class="modal-close-btn" wire:click="{{ $cancel }}">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <div class="modal-body">
                <p style="margin:0; font-size:0.88rem; color:var(--text-secondary); line-height:1.6;">
                    {{ $message }}
                </p>

                @if ($name)
                    <div class="modal-delete-target">
                        <span class="material-symbols-outlined" style="font-size:18px; color:#DC2626;">warning</span>
                        <span>{{ $name }}</span>
                    </div>
                @endif
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline" wire:click="{{ $cancel }}">
                    {{ $cancelText }}
                </button>
                <button type="button" class="btn btn-danger-solid" wire:click="{{ $action }}">
                    <span class="material-symbols-outlined" style="font-size:16px">delete</span>
                    {{ $confirmText }}
                </button>
            </div>
        </div>
    </div>
@endif
