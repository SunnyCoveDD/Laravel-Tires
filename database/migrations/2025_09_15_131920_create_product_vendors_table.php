<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('product_vendors', function (Blueprint $table) {
            $table->id();
            $table->string('alias');
            $table->string('name');
            $table->tinyInteger('product_type');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_vendors');
    }
};
