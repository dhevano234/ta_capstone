<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('antrians', function (Blueprint $table) {
            $table->id();
            $table->string('no_antrian')->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->text('address')->nullable();
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->string('phone');
            $table->string('nomor_ktp');
            $table->enum('poli', ['Umum', 'Kebidanan']);
            
            // PASTIKAN EXACT MATCH dengan doctors.id
            $table->string('dokter_id', 10)->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            
            $table->date('tanggal');
            // $table->enum('status', ['menunggu', 'dipanggil', 'selesai', 'dibatalkan'])->default('menunggu');
            // $table->time('jam_antrian')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('dokter_id')->references('id')->on('doctors')->onDelete('cascade');

            // Indexes
            $table->index(['tanggal', 'poli']);
            $table->index(['user_id', 'tanggal']);
            // $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('antrians');
    }
};