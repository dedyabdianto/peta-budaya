<?php

use Livewire\Component;
use Livewire\WithPagination;

class CagarBudayaComponent extends Component
{
    use WithPagination;
    public string $user_id;
    public string $kategori_id = '';
    public string $nama_cagar_budaya = '';
    public string $deskripsi = '';
    public string $alamat = '';
    public string $latitude = '';
    public string $longitude = '';
    public string $geom = '';
    public string $thumbnail = '';
    public string $sk_penetapan = '';
    public string $tahun_penemuan = '';
    public string $status_pelestarian = 'draft';
    public string $search = '';
    public bool $showCreateModal = false;
    public bool $showEditModal = false;
    public bool $showDeleteModal = false;

        public function render()
        {
            $query = \App\Models\CagarBudaya::query();
            $query_kategori = \App\Models\KategoriBudaya::query();

            if ($this->search) {
             $query->where(function ($q) {
                 $q->where('nama_cagar_budaya', 'like', '%' . $this->search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $this->search . '%')
                    ->orWhere('alamat', 'like', '%' . $this->search . '%')
                    ->orWhere('tahun_penemuan', 'like', '%' . $this->search . '%');
    });

            $query_kategori->where('nama_kategori', 'like', '%' . $this->search . '%');
}

            return $this->view([
                'cagar_budaya' => $query->with('kategoriBudaya', 'user')->latest()->paginate(10),
                'kategori' => $query_kategori->latest()->get(),
            ])->layout('layouts.admin')->title('Kelola Cagar Budaya')->with(['title' => 'Cagar Budaya']);
        }

        public function store()
        {
            $this->validate([
                'nama_cagar_budaya' => 'required|string|max:255',
                'kategori_id' => 'required|exists:kategori_budaya,id',
                'deskripsi' => 'nullable|string',
                'alamat' => 'nullable|string',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'geom' => 'nullable|string',
                'thumbnail' => 'nullable|string',
                'sk_penetapan' => 'nullable|string|max:255',
                'tahun_penemuan' => 'nullable|digits:4',
                'status_pelestarian' => 'nullable|string',
                'status' => 'required|in:draft,published',
            ]);

            \App\Models\CagarBudaya::create([
                'user_id' => auth()->id(),
                'kategori_id' => $this->kategori_id,
                'nama_cagar_budaya' => $this->nama_cagar_budaya,
                'deskripsi' => $this->deskripsi,
                'alamat' => $this->alamat,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'geom' => $this->geom,
                'thumbnail' => $this->thumbnail,
                'sk_penetapan' => $this->sk_penetapan,
                'tahun_penemuan' => $this->tahun_penemuan,
                'status_pelestarian' => $this->status_pelestarian,
                'status' => $this->status,
            ]);

            session()->flash('success', 'Cagar Budaya berhasil ditambahkan.');
            $this->resetInput();
            $this->closeCreateModal();
        }


        public function update()
        {
            $this->validate([
                'nama_cagar_budaya' => 'required|string|max:255',
                'kategori_id' => 'required|exists:kategori_budaya,id',
                'deskripsi' => 'nullable|string',
                'alamat' => 'nullable|string',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'geom' => 'nullable|string',
                'thumbnail' => 'nullable|string',
                'sk_penetapan' => 'nullable|string|max:255',
                'tahun_penemuan' => 'nullable|digits:4',
                'status_pelestarian' => 'nullable|string',
                'status' => 'required|in:draft,published',
            ]);

            $cagar = \App\Models\CagarBudaya::findOrFail($this->editId);
            $cagar->update([
                'kategori_id' => $this->kategori_id,
                'nama_cagar_budaya' => $this->nama_cagar_budaya,
                'deskripsi' => $this->deskripsi,
                'alamat' => $this->alamat,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'geom' => $this->geom,
                'thumbnail' => $this->thumbnail,
                'sk_penetapan' => $this->sk_penetapan,
                'tahun_penemuan' => $this->tahun_penemuan,
                'status_pelestarian' => $this->status_pelestarian,
                'status' => $this->status,
            ]);

            session()->flash('success', 'Cagar Budaya berhasil diperbarui.');
            $this->resetInput();
            $this->closeEditModal();
        }

        public function resetInput()
        {
            $this->kategori_id = '';
            $this->nama_cagar_budaya = '';
            $this->deskripsi = '';
            $this->alamat = '';
            $this->latitude = '';
            $this->longitude = '';
            $this->geom = '';
            $this->thumbnail = '';
            $this->sk_penetapan = '';
            $this->tahun_penemuan = '';
            $this->status_pelestarian = 'draft';
        }
         
        public function openCreateModal()
        {
            $this->resetInput();
            $this->showCreateModal = true;
        }

        public function closeCreateModal()
        {
            $this->resetInput();
            $this->showCreateModal = false;
        }

         public function openEditModal($id)
        {
            $cagar = \App\Models\CagarBudaya::findOrFail($id);
            
            $this->kategori_id = $cagar->kategori_id;
            $this->nama_cagar_budaya = $cagar->nama_cagar_budaya;
            $this->deskripsi = $cagar->deskripsi;
            $this->alamat = $cagar->alamat;
            $this->latitude = $cagar->latitude;
            $this->longitude = $cagar->longitude;
            $this->geom = $cagar->geom;
            $this->thumbnail = $cagar->thumbnail;
            $this->sk_penetapan = $cagar->sk_penetapan;
            $this->tahun_penemuan = $cagar->tahun_penemuan;
            $this->status_pelestarian = $cagar->status_pelestarian;
            
            $this->showEditModal = true;
        }

        public function closeEditModal()
        {
            $this->resetInput();
            $this->showEditModal = false;
        }

         public function confirmDelete($id, $name)
        {
            $this->deleteId = $id;
            $this->deleteName = $name;
            $this->showDeleteModal = true;
        }

        public function cancelDelete()
        {
            $this->deleteId = null;
            $this->deleteName = null;
            $this->showDeleteModal = false;
        }

        public function delete()
            {
                \App\Models\CagarBudaya::findOrFail($this->deleteId)->delete();
                session()->flash('success', 'Cagar Budaya berhasil dihapus.');
                $this->cancelDelete();
            }

};
