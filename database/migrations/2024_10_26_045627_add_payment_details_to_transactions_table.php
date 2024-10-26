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
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('va_number')->nullable()->after('payment_type');
            $table->string('qr_code_url')->nullable()->after('va_number');
            $table->json('payment_details')->nullable()->after('qr_code_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('va_number');
            $table->dropColumn('qr_code_url');
            $table->dropColumn('payment_details');
        });
    }
};
