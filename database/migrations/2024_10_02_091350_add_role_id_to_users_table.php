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
        Schema::table('users', function (Blueprint $table) {
            //
            // Menambahkan kolom role_id dengan nilai default
            $table->unsignedBigInteger('role_id')->default(1); // 1 untuk role 'user'
            
            // Membuat foreign key ke tabel roles
            $table->foreign('role_id')->references('id')->on('roles');
            $table->text('about_me')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop kolom role_id dan foreign key
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
            $table->dropColumn('about_me');
        });
    }
};
