<?php

namespace Database\Factories;

use App\Models\Barang;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->word(),
            'merek' => fake()->word(),
            'kualitas' => fake()->sentence(),
            'kuantitas' => "1 Kg",
            'gambar' => "",
            'harga' => fake()->numberBetween(100, 1000),
            'tgl_masuk' => fake()->date(),
            'tgl_pembaruan' => fake()->date(),
        ];
    }
}
