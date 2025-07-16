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
        Schema::table('jurusan', function (Blueprint $table) {
            $table->integer('fakultas_id')->nullable(); // tambahkan kolom
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jurusan', function (Blueprint $table) {
            //
        });
    }
};
