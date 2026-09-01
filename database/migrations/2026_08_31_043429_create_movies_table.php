<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration untuk membuat tabel.
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul film
            $table->text('description')->nullable(); // Sinopsis/deskripsi film
            $table->string('genre')->nullable(); // Kategori atau genre
            $table->string('poster')->nullable(); // Nama file gambar thumbnail
            $table->string('video_url')->nullable(); // Link untuk memutar video
            $table->timestamps();
        });
    }

    /**
     * Batalkan migration (hapus tabel jika di-rollback).
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};