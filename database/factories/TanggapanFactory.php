<?php

namespace Database\Factories;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tanggapan>
 */
class TanggapanFactory extends Factory
{
    protected $model = Tanggapan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_pengaduan' => Pengaduan::factory(),
            'id_admin' => User::factory()->admin(),
            'isi_tanggapan' => fake()->paragraph(2),
        ];
    }
}
