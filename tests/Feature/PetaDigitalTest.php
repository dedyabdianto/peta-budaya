<?php

use App\Models\CagarBudaya;
use App\Models\KategoriBudaya;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('peta digital page is accessible', function () {
    $response = $this->get(route('landing.peta-digital'));

    $response->assertStatus(200);
    $response->assertSee('Peta Digital Warisan Budaya');
});

test('peta digital shows published cagar budaya data', function () {
    $user = User::factory()->create();
    $kategori = KategoriBudaya::create([
        'nama_kategori' => 'Situs Sakral',
        'icon_marker' => 'temple_buddhist',
        'warna_badge' => '#1A362D',
        'deskripsi' => 'Kategori test',
    ]);

    CagarBudaya::create([
        'kategori_budaya_id' => $kategori->id,
        'user_id' => $user->id,
        'nama_cagar_budaya' => 'Tugu Peringatan Test',
        'latitude' => -8.4932,
        'longitude' => 140.4018,
        'status' => 'published',
    ]);

    $response = $this->get(route('landing.peta-digital'));

    $response->assertStatus(200);
    $response->assertSee('Tugu Peringatan Test');
    $response->assertSee('Situs Sakral');
});

test('peta digital does not show draft cagar budaya', function () {
    $user = User::factory()->create();
    $kategori = KategoriBudaya::create([
        'nama_kategori' => 'Artefak',
        'icon_marker' => 'museum',
        'warna_badge' => '#532300',
        'deskripsi' => 'Kategori draft test',
    ]);

    CagarBudaya::create([
        'kategori_budaya_id' => $kategori->id,
        'user_id' => $user->id,
        'nama_cagar_budaya' => 'Draft Situs Rahasia',
        'latitude' => -8.50,
        'longitude' => 140.50,
        'status' => 'draft',
    ]);

    $response = $this->get(route('landing.peta-digital'));

    $response->assertStatus(200);
    $response->assertDontSee('Draft Situs Rahasia');
});

