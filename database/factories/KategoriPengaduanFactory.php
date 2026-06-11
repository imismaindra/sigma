<?php

namespace Database\Factories;

use App\Models\KategoriPengaduan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<KategoriPengaduan>
 */
class KategoriPengaduanFactory extends Factory
{
    protected $model = KategoriPengaduan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_kategori' => fake()->randomElement([
                'Fasilitas Akademik', 
                'Pelayanan Administrasi', 
                'Infrastruktur Kampus', 
                'Keamanan & Parkir', 
                'Kebersihan Lingkungan',
                'Kesejahteraan Mahasiswa'
            ]),
            'deskripsi' => fake()->paragraph(),
            'status_aktif' => true,
        ];
    }
}
