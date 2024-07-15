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
        Schema::create('tenders', function (Blueprint $table) {
            $table->id();
            $table->string("judul");
            $table->string("deskripsi");
            $table->foreignId("barang_id")->constrained();
            // $table->foreign('barang_id')
            //     ->references('id')
            //     ->on('barangs')
            //     ->onDelete('set null');
            $table->dateTime("tgl_buka");
            $table->dateTime("tgl_tutup");
            $table->boolean("is_complete")->default(false);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenders');
    }
};
