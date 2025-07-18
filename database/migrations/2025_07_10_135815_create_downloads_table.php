<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('download', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('nama_file');  
            $table->string('ekstensi', 10);  
            $table->decimal('ukuran_kb', 10, 2);  
            $table->date('tanggal_upload');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

     
    public function down(): void
    {
        Schema::dropIfExists('downloads');
    }
};
