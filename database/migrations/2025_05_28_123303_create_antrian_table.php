<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('antrian', function (Blueprint $table) {
            $table->id();
            
            // Foreign Key ke Users
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // Data Pasien
            $table->string('name');
            $table->string('phone');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            
            // Data Antrian
            $table->string('no_antrian')->unique();
            $table->integer('urutan');
            $table->string('poli');
            $table->date('tanggal');
            
            // Foreign Key ke Doctors
            $table->string('doctor_id');
            $table->foreign('doctor_id')->references('doctor_id')->on('doctors')->onDelete('cascade');
            
            // Status & Waktu
            $table->enum('status', ['menunggu', 'dipanggil', 'selesai', 'dibatalkan'])->default('menunggu');
            $table->time('jam_antrian')->nullable();
            
            $table->timestamps();
            
            // Index
            $table->index(['tanggal', 'poli']);
            $table->index(['user_id', 'tanggal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('antrian');
    }
};