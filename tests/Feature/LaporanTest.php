<?php

use App\Models\Laporan;
use App\Models\LaporanFoto;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('can render the lapor situs public page', function () {
    $this->get(route('landing.lapor-situs'))
        ->assertOk()
        ->assertSee('Jaga Jejak');
});

it('can submit a laporan from the public form', function () {
    Storage::fake('public');

    Livewire::test('pages::landing.lapor-situs')
        ->set('nama_pelapor', 'Ahmad Kurniawan')
        ->set('kontak', '0812-3456-7890')
        ->set('nama_situs', 'Situs Batu Ukir Wapeko')
        ->set('lokasi', 'Kurik, Merauke')
        ->set('latitude', '-8.4900000')
        ->set('longitude', '140.4000000')
        ->set('deskripsi', 'Batu berukir ditemukan di tepi sungai.')
        ->set('fotos', [
            UploadedFile::fake()->image('foto1.jpg', 800, 600),
            UploadedFile::fake()->image('foto2.jpg', 800, 600),
        ])
        ->call('submit')
        ->assertSet('submitted', true)
        ->assertHasNoErrors();

    $this->assertDatabaseHas('laporans', [
        'nama_pelapor' => 'Ahmad Kurniawan',
        'nama_situs' => 'Situs Batu Ukir Wapeko',
        'status' => 'menunggu',
    ]);

    expect(LaporanFoto::count())->toBe(2);
});

it('validates required fields on submit', function () {
    Livewire::test('pages::landing.lapor-situs')
        ->set('nama_pelapor', '')
        ->set('nama_situs', '')
        ->call('submit')
        ->assertHasErrors(['nama_pelapor', 'nama_situs']);
});

it('requires auth for the admin verifikasi page', function () {
    $this->get(route('verifikasi.index'))
        ->assertRedirect();
});

it('can render the verifikasi page for admin', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('verifikasi.index'))
        ->assertOk()
        ->assertSee('Verifikasi Laporan');
});

it('displays laporan data in the admin table', function () {
    $user = User::factory()->create();
    Laporan::factory()->menunggu()->create(['nama_situs' => 'Situs Uji Coba']);

    $this->actingAs($user);

    Livewire::test('pages::verifikasi.index')
        ->assertSee('Situs Uji Coba');
});

it('can approve a laporan', function () {
    $user = User::factory()->create();
    $laporan = Laporan::factory()->menunggu()->create();

    $this->actingAs($user);

    Livewire::test('pages::verifikasi.index')
        ->call('openReview', $laporan->id)
        ->set('catatan_admin', 'Laporan valid, situs ditemukan.')
        ->call('approve')
        ->assertHasNoErrors();

    $laporan->refresh();
    expect($laporan->status)->toBe('disetujui');
    expect($laporan->reviewed_by)->toBe($user->id);
    expect($laporan->reviewed_at)->not->toBeNull();
});

it('can reject a laporan with a note', function () {
    $user = User::factory()->create();
    $laporan = Laporan::factory()->menunggu()->create();

    $this->actingAs($user);

    Livewire::test('pages::verifikasi.index')
        ->call('openReview', $laporan->id)
        ->set('catatan_admin', 'Lokasi tidak valid.')
        ->call('reject')
        ->assertHasNoErrors();

    $laporan->refresh();
    expect($laporan->status)->toBe('ditolak');
    expect($laporan->catatan_admin)->toBe('Lokasi tidak valid.');
});

it('requires a note when rejecting', function () {
    $user = User::factory()->create();
    $laporan = Laporan::factory()->menunggu()->create();

    $this->actingAs($user);

    Livewire::test('pages::verifikasi.index')
        ->call('openReview', $laporan->id)
        ->set('catatan_admin', '')
        ->call('reject')
        ->assertHasErrors(['catatan_admin']);
});

it('can delete a laporan', function () {
    $user = User::factory()->create();
    $laporan = Laporan::factory()->menunggu()->create();

    $this->actingAs($user);

    Livewire::test('pages::verifikasi.index')
        ->call('confirmDelete', $laporan->id, $laporan->nama_situs)
        ->call('delete')
        ->assertHasNoErrors();

    $this->assertDatabaseMissing('laporans', ['id' => $laporan->id]);
});

it('can export CSV', function () {
    $user = User::factory()->create();
    Laporan::factory(3)->create();

    $this->actingAs($user)
        ->get(route('verifikasi.export-csv'))
        ->assertOk()
        ->assertHeader('content-type', 'text/csv; charset=UTF-8');
});
