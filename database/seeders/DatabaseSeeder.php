<?php

namespace Database\Seeders;

use App\Models\ProductDisk;
use App\Models\ProductModel;
use App\Models\ProductTire;
use App\Models\ProductVendor;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $tireVendors = ProductVendor::factory(10)->create([
            'product_type' => ProductTire::PRODUCT_TYPE,
        ]);

        $diskVendors = ProductVendor::factory(10)->create([
            'product_type' => ProductDisk::PRODUCT_TYPE,
        ]);

        foreach ($tireVendors as $tireVendor) {
            $tireModels = ProductModel::factory(15)->create([
                'product_vendor_id' => $tireVendor->id,
            ]);

            foreach ($tireModels as $tireModel) {
                ProductTire::factory(20)->create([
                    'product_vendor_id' => $tireVendor->id,
                    'product_model_id' => $tireModel->id,
                ]);
            }
        }

        foreach ($diskVendors as $diskVendor) {
            $diskModels = ProductModel::factory(15)->create([
                'product_vendor_id' => $diskVendor->id,
            ]);

            foreach ($diskModels as $diskModel) {
                ProductDisk::factory(20)->create([
                    'product_vendor_id' => $diskVendor->id,
                    'product_model_id' => $diskModel->id,
                ]);
            }
        }
    }
}
