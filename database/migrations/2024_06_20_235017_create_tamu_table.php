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
        Schema::create('tamus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keperluan_id')->nullable()->constrained();
            $table->foreignId('pegawai_id')->constrained();
            $table->string('nama');
            $table->string('telp');
            $table->string('instansi');
            $table->string('alamat');
            $table->string('jekel');
            $table->string('keperluan_lainnya')->nullable();
            $table->dateTime('keluar')->nullable();
            $table->string('foto');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tamus');
    }
};
