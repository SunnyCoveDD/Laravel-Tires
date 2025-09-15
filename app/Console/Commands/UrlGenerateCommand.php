<?php

namespace App\Console\Commands;

use App\Models\ProductDisk;
use App\Models\ProductModel;
use App\Models\ProductTire;
use App\Models\ProductVendor;
use App\Models\Url;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class UrlGenerateCommand extends Command
{
    protected $signature = 'url:generate';

    protected $description = 'Создает список ссылок на товары';

    public function handle(): void
    {
        echo "\e[0;33mСброс текущих ссылок.\e[0m\n";
        DB::table('urls')->truncate();
        echo "\e[0;32mСброс ссылок выполнен!\e[0m\n";

        echo "\e[0;33mГенерация ссылок для производителей.\e[0m\n";
        ProductVendor::chunk(50, function ($vendors) {
            foreach ($vendors as $vendor) {
                Url::create([
                    'object_type' => ProductVendor::OBJECT_TYPE,
                    'object_id' => $vendor->id,
                    'url' => $vendor->alias,
                ]);
            }
        });
        echo "\e[0;32mГенерация ссылок для производителей выполнена!\e[0m\n";

        echo "\e[0;33mГенерация ссылок для моделей.\e[0m\n";
        ProductModel::with('vendor')->chunk(50, function ($models) {
            foreach ($models as $model) {
                Url::create([
                    'object_type' => ProductModel::OBJECT_TYPE,
                    'object_id' => $model->id,
                    'url' => $model->vendor->alias . '/' . $model->alias,
                ]);
            }
        });
        echo "\e[0;32mГенерация ссылок для моделей выполнена!\e[0m\n";

        echo "\e[0;33mГенерация ссылок для шин.\e[0m\n";
        ProductTire::with('vendor', 'model')->chunk(50, function ($tires) {
            foreach ($tires as $tire) {
                Url::create([
                    'object_type' => ProductTire::OBJECT_TYPE,
                    'object_id' => $tire->id,
                    'url' => $tire->vendor->alias . '/' . $tire->model->alias . '/' . $tire->alias,
                ]);
            }
        });
        echo "\e[0;32mГенерация ссылок для шин выполнена!\e[0m\n";

        echo "\e[0;33mГенерация ссылок для дисков.\e[0m\n";
        ProductDisk::with('vendor', 'model')->chunk(50, function ($disks) {
            foreach ($disks as $disk) {
                Url::create([
                    'object_type' => ProductDisk::OBJECT_TYPE,
                    'object_id' => $disk->id,
                    'url' => $disk->vendor->alias . '/' . $disk->model->alias . '/' . $disk->alias,
                ]);
            }
        });
        echo "\e[0;32mГенерация ссылок для дисков выполнена!\e[0m\n";

        echo "\e[0;32mГенерация всех ссылок завершена!\e[0m\n";
    }
}
