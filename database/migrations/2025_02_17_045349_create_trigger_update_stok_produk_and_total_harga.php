<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
        CREATE TRIGGER update_stok_after_insert_detailpenjualan
        AFTER INSERT ON detailpenjualans
        FOR EACH ROW
        BEGIN
            -- Mengurangi stok produk
            UPDATE produks 
            SET stok = stok - NEW.jumlahproduk
            WHERE produks.produkid = NEW.produkid;

            -- Mengupdate totalharga penjualan
            UPDATE penjualans
            SET totalharga = totalharga + NEW.subtotal
            WHERE penjualans.penjualanid = NEW.penjualanid;
        END
    ');

    // Trigger untuk mengurangi stok produk setelah update detailpenjualan
    DB::unprepared('
        CREATE TRIGGER update_stok_after_update_detailpenjualan
        AFTER UPDATE ON detailpenjualans
        FOR EACH ROW
        BEGIN
            -- Mengembalikan stok produk yang lama
            UPDATE produks 
            SET stok = stok + OLD.jumlahproduk
            WHERE produks.produkid = OLD.produkid;

            -- Mengurangi stok produk yang baru
            UPDATE produks 
            SET stok = stok - NEW.jumlahproduk
            WHERE produks.produkid = NEW.produkid;

            -- Update totalharga penjualan (mengurangi dengan subtotal lama, menambah dengan subtotal baru)
            UPDATE penjualans
            SET totalharga = totalharga - OLD.subtotal + NEW.subtotal
            WHERE penjualans.penjualanid = NEW.penjualanid;
        END
    ');

    // Trigger untuk mengembalikan stok produk setelah delete detailpenjualan
    DB::unprepared('
        CREATE TRIGGER update_stok_after_delete_detailpenjualan
        AFTER DELETE ON detailpenjualans
        FOR EACH ROW
        BEGIN
            -- Mengembalikan stok produk yang hilang
            UPDATE produks 
            SET stok = stok + OLD.jumlahproduk
            WHERE produks.produkid = OLD.produkid;

            -- Mengurangi totalharga pada penjualan
            UPDATE penjualans
            SET totalharga = totalharga - OLD.subtotal
            WHERE penjualans.penjualanid = OLD.penjualanid;
        END
    ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS update_stok_after_insert_detailpenjualan');
        DB::unprepared('DROP TRIGGER IF EXISTS update_stok_after_update_detailpenjualan');
        DB::unprepared('DROP TRIGGER IF EXISTS update_stok_after_delete_detailpenjualan');
    }
};
