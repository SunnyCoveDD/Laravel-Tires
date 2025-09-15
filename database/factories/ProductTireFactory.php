<?php

namespace Database\Factories;

use App\Models\ProductTire;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductTireFactory extends Factory
{
    protected $model = ProductTire::class;

    public function definition(): array
    {
        $name = $this->faker->word();

        return [
            'name' => $name,
            'alias' => preg_replace('/[ ,]+/', '-', $name),
        ];
    }
}
