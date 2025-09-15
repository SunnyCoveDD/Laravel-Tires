<?php

namespace Database\Factories;

use App\Models\ProductDisk;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductDiskFactory extends Factory
{
    protected $model = ProductDisk::class;

    public function definition(): array
    {
        $name = $this->faker->word();

        return [
            'name' => $name,
            'alias' => preg_replace('/[ ,]+/', '-', $name),
        ];
    }
}
