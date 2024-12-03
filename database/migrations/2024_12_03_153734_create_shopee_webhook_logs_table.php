<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopeeWebhookLogsTable extends Migration
{
    public function up()
    {
        Schema::create('shopee_webhook_logs', function (Blueprint $table) {
            $table->id();
            $table->string('event_type'); // Ex: 'shop_authorization_push', 'shop_authorization_canceled_push'
            $table->json('data'); // Armazena o payload completo
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shopee_webhook_logs');
    }
}
