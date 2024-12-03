<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shopee_reserved_stock_changes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('shop_id')->unsigned();
            $table->bigInteger('item_id')->unsigned();
            $table->bigInteger('variation_id')->unsigned()->nullable();
            $table->string('action'); // place_order ou cancel_order
            $table->string('ordersn')->nullable();
            $table->string('promotion_type')->nullable();
            $table->bigInteger('promotion_id')->unsigned()->nullable();
            $table->integer('old_value')->nullable();
            $table->integer('new_value')->nullable();
            $table->timestamp('update_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopee_reserved_stock_changes');
    }
};
