<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->name(),
            'nim_nip' => fake()->unique()->numerify('19##########'), // e.g. 19xxxxxxxxxx
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => fake()->randomElement(['mahasiswa', 'admin', 'pimpinan', 'super_admin']),
        ];
    }

    /**
     * State: Mahasiswa
     */
    public function mahasiswa(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'mahasiswa',
            'nim_nip' => fake()->unique()->numerify('21##########'),
        ]);
    }

    /**
     * State: Admin
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
            'nim_nip' => fake()->unique()->numerify('1976########'),
        ]);
    }

    /**
     * State: Pimpinan
     */
    public function pimpinan(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'pimpinan',
            'nim_nip' => fake()->unique()->numerify('1965########'),
        ]);
    }

    /**
     * State: Super Admin
     */
    public function superAdmin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'super_admin',
            'nim_nip' => fake()->unique()->numerify('1990########'),
        ]);
    }
}
