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
        Schema::create('jurusan', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->decimal('ukt1', 15, 2);
            $table->decimal('ukt2', 15, 2);
            $table->decimal('ukt3', 15, 2);
            $table->decimal('ukt4', 15, 2);
            $table->decimal('ukt5', 15, 2);
            $table->decimal('ukt6', 15, 2);
            $table->decimal('ukt7', 15, 2);
            $table->decimal('ukt8', 15, 2);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurusan');
    }
};
