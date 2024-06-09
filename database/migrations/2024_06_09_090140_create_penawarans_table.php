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
        Schema::create('penawarans', function (Blueprint $table) {
            $table->id();

            $table->foreignId("tender_id")->constrained();

            $table->string('vendor');
            $table->string('telepon');
            $table->string('email');
            $table->string('alamat');
            $table->string('tgl_pengajuan');
            $table->string('tgl_selesai');

            $table->string('nama');
            $table->string('merek');
            $table->string('kualitas');
            $table->integer('satuan');
            $table->bigInteger('harga');
            $table->integer('kuantitas');
            $table->string('gambar')->nullable();
            $table->date('tgl_masuk');
            $table->date('tgl_pembaruan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penawarans');
    }
};
