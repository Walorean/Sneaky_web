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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('store_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->boolean('payed_by_card')->default(false);
            $table->boolean('deliver_to_store')->default(false);
            $table->string('address', 100)->nullable();
            $table->float('total_price')->default(0);
            $table->string('user_name', 25)->nullable();
            $table->string('user_surname', 25)->nullable();
            $table->string('user_phone_num', 15)->nullable();
            $table->string('user_email', 50)->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();

            $table->foreign('store_id')->references('id')->on('stores')->onDelete('set null');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
