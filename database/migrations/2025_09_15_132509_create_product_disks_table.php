<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('product_disks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\ProductVendor::class);
            $table->foreignIdFor(\App\Models\ProductModel::class);
            $table->string('alias');
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_disks');
    }
};
