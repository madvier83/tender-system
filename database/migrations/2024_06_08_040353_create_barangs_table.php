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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->integer('bobot')->default(0);
            $table->string('nama');
            $table->string('merek');
            $table->string('kualitas');
            $table->longText('kualitas_select')->nullable();
            $table->string('gambar')->nullable();
            $table->bigInteger('harga');
            $table->string('kuantitas');
            $table->date('tgl_masuk');
            $table->date('tgl_pembaruan')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
