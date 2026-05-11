<?php

namespace App\Http\Controllers;

use App\Models\CagarBudaya;
use App\Models\KategoriBudaya;
use Illuminate\Support\Str;

class PetaDigitalController extends Controller
{
    /**
     * Display the public-facing interactive GIS map page.
     */
    public function __invoke()
    {
        $mapPoints = CagarBudaya::query()
            ->with('kategoriBudaya:id,nama_kategori,icon_marker,warna_badge', 'distrik:id,nama_distrik')
            ->where('status', 'published')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->where('latitude', '!=', 0)
            ->where('longitude', '!=', 0)
            ->get(['id', 'nama_cagar_budaya', 'kategori_budaya_id', 'distrik_id', 'latitude', 'longitude', 'thumbnail', 'deskripsi', 'alamat', 'tahun_penemuan', 'status_pelestarian'])
            ->map(fn ($c) => [
                'id' => $c->id,
                'name' => $c->nama_cagar_budaya,
                'lat' => (float) $c->latitude,
                'lng' => (float) $c->longitude,
                'kategori' => $c->kategoriBudaya?->nama_kategori ?? 'Lainnya',
                'kategoriId' => $c->kategori_budaya_id,
                'icon' => $c->kategoriBudaya?->icon_marker ?? 'location_on',
                'color' => $c->kategoriBudaya?->warna_badge ?? '#1A362D',
                'thumbnail' => $c->thumbnail ? asset('storage/'.$c->thumbnail) : '',
                'deskripsi' => $c->deskripsi ? Str::limit(strip_tags($c->deskripsi), 150) : '',
                'alamat' => $c->alamat ?? '',
                'distrik' => $c->distrik?->nama_distrik ?? '',
                'tahun' => $c->tahun_penemuan ?? '',
                'pelestarian' => $c->status_pelestarian ?? '',
            ]);

        $kategoriList = KategoriBudaya::withCount(['cagarBudaya' => function ($q) {
            $q->where('status', 'published')
                ->whereNotNull('latitude')
                ->whereNotNull('longitude')
                ->where('latitude', '!=', 0)
                ->where('longitude', '!=', 0);
        }])->get();

        return view('pages.landing.peta-digital', [
            'mapPoints' => $mapPoints,
            'kategoriList' => $kategoriList,
        ]);
    }
}
