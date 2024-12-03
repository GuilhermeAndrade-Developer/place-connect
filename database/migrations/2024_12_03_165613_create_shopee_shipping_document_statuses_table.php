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
        Schema::create('shopee_shipping_document_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('ordersn')->index();
            $table->unsignedBigInteger('shop_id');
            $table->string('package_number');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopee_shipping_document_statuses');
    }
};
