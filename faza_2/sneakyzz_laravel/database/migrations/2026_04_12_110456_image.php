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
            $table->string('filename',512);
            $table->timestamps();
            $table->foreign('product_code')->references('id')->on('shoes');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
