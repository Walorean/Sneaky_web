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
        Schema::create('shoes', function (Blueprint $table) {
            $table->string('product_code', 10);
            $table->unsignedBigInteger('color_id');
            $table->unsignedBigInteger('size_id');
            $table->integer('stock_quantity');

            $table->primary(['product_code', 'color_id', 'size_id']);

            $table->foreign('product_code')->references('product_code')->on('products');
            $table->foreign('color_id')->references('color_id')->on('colors');
            $table->foreign('size_id')->references('size_id')->on('sizes');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shoes');
    }
};
