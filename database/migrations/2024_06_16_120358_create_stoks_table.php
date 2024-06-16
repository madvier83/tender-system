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
        Schema::create('stoks', function (Blueprint $table) {
            $table->id();
            $table->foreignId("barang_id")->constrained();
            $table->string("tipe");
            $table->string("kuantitas");
            $table->string("stok_awal");
            $table->string("stok_setelah_exp");
            $table->string("tanggal_exp");
            $table->string("tanggal");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stoks');
    }
};
