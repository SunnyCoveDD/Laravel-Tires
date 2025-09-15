<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductModel;

class ProductModelFactory extends Factory
{
    protected $model = ProductModel::class;

    public function definition(): array
    {
        $name = strtoupper($this->faker->bothify('??### ??##'));

        return [
            'name' => $name,
            'alias' => preg_replace('/[ ,]+/', '-', $name),

        ];
    }
}
