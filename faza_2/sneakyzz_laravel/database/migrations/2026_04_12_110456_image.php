<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('image_id');
            $table->string('product_code', 10);
            $table->unsignedBigInteger('color_id');
            $table->string('filename',512);
            $table->timestamps();
            $table->foreign('product_code')->references('product_code')->on('products');
            $table->foreign('color_id')->references('color_id')->on('colors');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
