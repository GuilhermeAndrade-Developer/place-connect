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
        Schema::create('shopee_updates', function (Blueprint $table) {
            $table->id();
            $table->string('shop_id');
            $table->string('title');
            $table->text('content');
            $table->string('url')->nullable();
            $table->timestamp('update_time');
            $table->timestamps();

            $table->foreign('shop_id')->references('shop_id')->on('shopee_shops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopee_updates');
    }
};
