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
        Schema::create('detailpenjualans', function (Blueprint $table) {
            $table->bigIncrements('detailid');
            $table->unsignedBigInteger('penjualanid'); 
            $table->unsignedBigInteger('produkid');
            $table->integer('jumlahproduk');
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
            $table->foreign('penjualanid')->references('penjualanid')->on('penjualans')->onDelete('cascade');
            $table->foreign('produkid')->references('produkid')->on('produks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailpenjualans');
    }
};
