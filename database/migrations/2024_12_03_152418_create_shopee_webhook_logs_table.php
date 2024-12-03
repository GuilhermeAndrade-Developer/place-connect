<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopeeWebhookLogsTable extends Migration
{
    public function up(): void
    {
        Schema::create('shopee_webhook_logs', function (Blueprint $table) {
            $table->id();
            $table->string('event_code');
            $table->json('payload');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shopee_webhook_logs');
    }
}
