<?php

namespace Database\Factories;

use App\Models\Pengaduan;
use App\Models\StatusLog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StatusLog>
 */
class StatusLogFactory extends Factory
{
    protected $model = StatusLog::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_pengaduan' => Pengaduan::factory(),
            'status_lama' => fake()->randomElement([null, 'pending', 'proses']),
            'status_baru' => fake()->randomElement(['proses', 'selesai', 'ditolak']),
            'catatan' => fake()->sentence(),
            'created_by' => User::factory()->admin(),
        ];
    }
}
