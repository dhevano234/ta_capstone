<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('poli', function (Blueprint $table) {
            $table->string('poli_id', 10)->primary(); // contoh: P001
            $table->string('nama'); // contoh: Poli Umum, Poli Gigi, dll.
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('poli');
    }
};
