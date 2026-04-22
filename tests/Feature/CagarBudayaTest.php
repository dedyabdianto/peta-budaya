<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\KategoriBudaya;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

class CagarBudayaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_store_cagar_budaya()
    {
        // 1. buat user & kategori
        $user = User::factory()->create();
        $kategori = KategoriBudaya::factory()->create();

        // 2. login
        $this->actingAs($user);

        // 3. jalankan livewire
        Livewire::test(\App\Http\Livewire\CagarBudayaComponent::class)
            ->set('nama_cagar_budaya', 'Situs Papua')
            ->set('kategori_id', $kategori->id)
            ->set('deskripsi', 'Deskripsi situs')
            ->set('alamat', 'Papua')
            ->set('latitude', -8.5)
            ->set('longitude', 140.4)
            ->set('geom', 'POINT(140.4 -8.5)')
            ->set('thumbnail', 'gambar.jpg')
            ->set('sk_penetapan', 'SK-001')
            ->set('tahun_penemuan', '2020')
            ->set('status_pelestarian', 'baik')
            ->set('status', 'published')
            ->call('store')
            ->assertSessionHas('success', 'Cagar Budaya berhasil ditambahkan.');

        // 4. cek database
        $this->assertDatabaseHas('cagar_budayas', [
            'nama_cagar_budaya' => 'Situs Papua',
            'kategori_id' => $kategori->id,
            'user_id' => $user->id,
            'status' => 'published',
        ]);
    }

    /** @test */
    public function validation_error_if_required_fields_empty()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Livewire::test(\App\Http\Livewire\NamaKomponenKamu::class)
            ->set('nama_cagar_budaya', '')
            ->set('kategori_id', null)
            ->set('status', 'draft')
            ->call('store')
            ->assertHasErrors([
                'nama_cagar_budaya' => 'required',
                'kategori_id' => 'required',
            ]);
    }

    /** @test */
    public function status_must_be_valid()
    {
        $user = User::factory()->create();
        $kategori = KategoriBudaya::factory()->create();

        $this->actingAs($user);

        Livewire::test(\App\Http\Livewire\NamaKomponenKamu::class)
            ->set('nama_cagar_budaya', 'Test')
            ->set('kategori_id', $kategori->id)
            ->set('status', 'salah')
            ->call('store')
            ->assertHasErrors(['status' => 'in']);
    }
}