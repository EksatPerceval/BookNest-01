<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id('id_buku');
            $table->string('judul');
            $table->string('penulis');
            $table->year('tahun');
            $table->unsignedBigInteger('kategori');
            $table->string('file_pdf')->nullable();
            $table->string('cover')->nullable();
            $table->text('deskripsi');
            $table->text('isi_buku')->nullable();
            $table->integer('views')->default(0);
            $table->timestamps();

            $table->foreign('kategori')->references('id_kategori')->on('categories')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
