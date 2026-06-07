<?php

namespace Database\Seeders;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\Database\Seeder;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::first();

        // 8 menunggu
        Laporan::factory(8)->menunggu()->create();

        // 5 disetujui
        Laporan::factory(5)->disetujui()->create([
            'reviewed_by' => $admin?->id,
        ]);

        // 3 ditolak
        Laporan::factory(3)->ditolak()->create([
            'reviewed_by' => $admin?->id,
        ]);
    }
}
