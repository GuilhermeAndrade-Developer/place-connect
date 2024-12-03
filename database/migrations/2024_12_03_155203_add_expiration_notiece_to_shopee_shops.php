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
        Schema::table('shopee_shops', function (Blueprint $table) {
            $table->timestamp('expiration_notice_at')->nullable()->after('token_expires_at');
            $table->boolean('expiration_notified')->default(false)->after('expiration_notice_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shopee_shops', function (Blueprint $table) {
            $table->dropColumn(['expiration_notice_at', 'expiration_notified']);
        });
    }
};
