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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->bigIncrements('penjualanid');
            $table->date('tanggalpenjualan');
            $table->decimal('totalharga', 10, 2);
            $table->unsignedBigInteger('pelangganid'); 
            $table->timestamps();

            $table->foreign('pelangganid')->references('pelangganid')->on('pelanggans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
