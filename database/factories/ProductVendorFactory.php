<?php

namespace Database\Factories;

use App\Models\ProductVendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVendorFactory extends Factory
{
    protected $model = ProductVendor::class;

    public function definition(): array
    {
        $name = $this->faker->company();

        return [
            'name' => $name,
            'alias' => preg_replace('/[ ,]+/', '-', $name),
        ];
    }
}
