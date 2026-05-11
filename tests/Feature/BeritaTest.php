<?php

use App\Models\Berita;
use App\Models\KategoriBerita;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('berita index page is accessible for authenticated users', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('berita.index'));

    $response->assertStatus(200);
    $response->assertSee('Kelola Berita');
});

test('berita index requires authentication', function () {
    $response = $this->get(route('berita.index'));

    $response->assertRedirect();
});

test('berita create page is accessible', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('berita.create'));

    $response->assertStatus(200);
    $response->assertSee('Tulis Berita Baru');
});

test('berita model generates unique slug from judul', function () {
    $user = User::factory()->create();

    $berita1 = Berita::create([
        'user_id' => $user->id,
        'judul' => 'Festival Budaya Malind',
        'konten' => '<p>Konten artikel test</p>',
        'status' => 'published',
        'published_at' => now(),
    ]);

    $berita2 = Berita::create([
        'user_id' => $user->id,
        'judul' => 'Festival Budaya Malind',
        'konten' => '<p>Konten artikel test kedua</p>',
        'status' => 'draft',
    ]);

    expect($berita1->slug)->toBe('festival-budaya-malind');
    expect($berita2->slug)->toBe('festival-budaya-malind-1');
});

test('berita model calculates reading time', function () {
    $user = User::factory()->create();

    // ~200 words = 1 minute reading time
    $konten = str_repeat('kata ', 400);

    $berita = Berita::create([
        'user_id' => $user->id,
        'judul' => 'Artikel Panjang',
        'konten' => "<p>{$konten}</p>",
        'status' => 'draft',
    ]);

    expect($berita->reading_time)->toBe(2);
});

test('berita scopes filter correctly', function () {
    $user = User::factory()->create();

    Berita::create([
        'user_id' => $user->id,
        'judul' => 'Published Article',
        'konten' => '<p>Published</p>',
        'status' => 'published',
        'published_at' => now()->subDay(),
    ]);

    Berita::create([
        'user_id' => $user->id,
        'judul' => 'Draft Article',
        'konten' => '<p>Draft</p>',
        'status' => 'draft',
    ]);

    Berita::create([
        'user_id' => $user->id,
        'judul' => 'Scheduled Article',
        'konten' => '<p>Scheduled</p>',
        'status' => 'scheduled',
        'published_at' => now()->addDay(),
    ]);

    expect(Berita::published()->count())->toBe(1);
    expect(Berita::draft()->count())->toBe(1);
    expect(Berita::scheduled()->count())->toBe(1);
});

test('berita belongs to kategori berita', function () {
    $user = User::factory()->create();
    $kategori = KategoriBerita::create([
        'nama_kategori' => 'Budaya',
        'warna' => '#1A362D',
    ]);

    $berita = Berita::create([
        'user_id' => $user->id,
        'kategori_berita_id' => $kategori->id,
        'judul' => 'Test Berita Kategori',
        'konten' => '<p>Test</p>',
        'status' => 'draft',
    ]);

    expect($berita->kategoriBerita->nama_kategori)->toBe('Budaya');
});

test('publish scheduled berita command works', function () {
    $user = User::factory()->create();

    Berita::create([
        'user_id' => $user->id,
        'judul' => 'Jadwal Lama',
        'konten' => '<p>Scheduled past</p>',
        'status' => 'scheduled',
        'published_at' => now()->subHour(),
    ]);

    Berita::create([
        'user_id' => $user->id,
        'judul' => 'Jadwal Masa Depan',
        'konten' => '<p>Scheduled future</p>',
        'status' => 'scheduled',
        'published_at' => now()->addDay(),
    ]);

    $this->artisan('berita:publish-scheduled')->assertExitCode(0);

    expect(Berita::where('judul', 'Jadwal Lama')->first()->status)->toBe('published');
    expect(Berita::where('judul', 'Jadwal Masa Depan')->first()->status)->toBe('scheduled');
});

test('berita edit page is accessible', function () {
    $user = User::factory()->create();
    $berita = Berita::create([
        'user_id' => $user->id,
        'judul' => 'Artikel Edit Test',
        'konten' => '<p>Konten edit</p>',
        'status' => 'draft',
    ]);

    $response = $this->actingAs($user)->get(route('berita.edit', $berita));

    $response->assertStatus(200);
    $response->assertSee('Edit Berita');
    $response->assertSee('Artikel Edit Test');
});

test('berita tags are cast to array', function () {
    $user = User::factory()->create();

    $berita = Berita::create([
        'user_id' => $user->id,
        'judul' => 'Tagged Article',
        'konten' => '<p>Tagged</p>',
        'status' => 'draft',
        'tags' => ['budaya', 'malind', 'tradisi'],
    ]);

    $berita->refresh();
    expect($berita->tags)->toBeArray();
    expect($berita->tags)->toContain('budaya', 'malind', 'tradisi');
});
