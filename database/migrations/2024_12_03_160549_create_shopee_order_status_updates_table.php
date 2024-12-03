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
        Schema::create('shopee_order_status_updates', function (Blueprint $table) {
            $table->id();
            $table->string('ordersn')->unique();
            $table->unsignedBigInteger('shop_id');
            $table->string('status');
            $table->string('completed_scenario')->nullable();
            $table->timestamp('update_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopee_order_status_updates');
    }
};
