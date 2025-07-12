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
        Schema::create('biro', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('nama_pimpinan')->nullable();
            $table->string('gambar_pimpinan')->nullable();
            $table->string('email_pimpinan')->nullable();
            $table->string('slug')->nullable();
            $table->longText('content')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.php artisan make:migration add_biro_to_struktur_table
     */
    public function down(): void
    {
        Schema::dropIfExists('biros');
    }
};
