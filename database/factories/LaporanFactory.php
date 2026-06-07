<?php

namespace Database\Factories;

use App\Models\Laporan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Laporan>
 */
class LaporanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $situsNames = [
            'Situs Batu Ukir Wapeko', 'Pohon Sakral Kampung Salor', 'Artefak Gerabah Wasur',
            'Bekas Pemukiman Belanda', 'Rumah Adat Kayu Besi', 'Menhir Kayu Malind',
            'Situs Peninggalan Kerang', 'Gua Prasejarah Okaba', 'Tugu Batas Wilayah Adat',
            'Makam Tua Kampung Wayau', 'Relief Batu Sungai Maro', 'Bekas Benteng Jepang',
            'Patung Kayu Leluhur', 'Sumber Mata Air Sakral', 'Tapak Pendaratan Pepera',
        ];

        $lokasi = [
            'Kurik, Merauke', 'Salor, Merauke', 'Wasur, Merauke', 'Semangga',
            'Okaba, Merauke', 'Tanah Miring', 'Jagebob', 'Sota, Merauke',
            'Malind, Merauke', 'Naukenjerai', 'Kimaam', 'Waan',
        ];

        return [
            'nama_pelapor' => fake()->name(),
            'kontak' => fake()->numerify('08##-####-####'),
            'nama_situs' => fake()->randomElement($situsNames),
            'lokasi' => fake()->randomElement($lokasi),
            'latitude' => fake()->latitude(-9.0, -8.0),
            'longitude' => fake()->longitude(139.5, 141.0),
            'deskripsi' => fake()->paragraph(3),
            'status' => fake()->randomElement(['menunggu', 'disetujui', 'ditolak']),
        ];
    }

    /**
     * Set status to menunggu (waiting).
     */
    public function menunggu(): static
    {
        return $this->state(fn () => [
            'status' => 'menunggu',
            'catatan_admin' => null,
            'reviewed_by' => null,
            'reviewed_at' => null,
        ]);
    }

    /**
     * Set status to disetujui (approved).
     */
    public function disetujui(): static
    {
        return $this->state(fn () => [
            'status' => 'disetujui',
            'catatan_admin' => fake()->optional()->sentence(),
            'reviewed_at' => fake()->dateTimeBetween('-30 days', 'now'),
        ]);
    }

    /**
     * Set status to ditolak (rejected).
     */
    public function ditolak(): static
    {
        return $this->state(fn () => [
            'status' => 'ditolak',
            'catatan_admin' => fake()->sentence(),
            'reviewed_at' => fake()->dateTimeBetween('-30 days', 'now'),
        ]);
    }
}
