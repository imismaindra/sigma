<?php

namespace Database\Factories;

use App\Models\Lampiran;
use App\Models\Pengaduan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lampiran>
 */
class LampiranFactory extends Factory
{
    protected $model = Lampiran::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $extension = fake()->randomElement(['pdf', 'jpg', 'png', 'docx']);
        $filename = 'lampiran_' . fake()->uuid() . '.' . $extension;

        return [
            'id_pengaduan' => Pengaduan::factory(),
            'nama_file' => $filename,
            'path_file' => 'uploads/lampiran/' . $filename,
            'tipe_file' => in_array($extension, ['jpg', 'png']) ? 'image/' . $extension : 'application/' . $extension,
        ];
    }
}
