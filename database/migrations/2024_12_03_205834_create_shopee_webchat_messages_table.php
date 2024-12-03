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
        Schema::create('shopee_webchat_messages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('shop_id')->unsigned();
            $table->string('conversation_id');
            $table->string('message_id');
            $table->string('from_id');
            $table->string('from_user_name')->nullable();
            $table->string('to_id')->nullable();
            $table->string('to_user_name')->nullable();
            $table->string('message_type');
            $table->json('content')->nullable();
            $table->string('region')->nullable();
            $table->boolean('is_in_chatbot_session')->default(false);
            $table->timestamp('created_timestamp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopee_webchat_messages');
    }
};
