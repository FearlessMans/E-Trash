<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email_pembeli');
            $table->integer('id_sampah');
            $table->integer('total_harga');
            $table->integer('jumlah_sampah');
            $table->enum('status', ['Selesai','Belum Selesai']);

            // $table->foreign('id_sampah')->references('id')
            //         ->on('sampah')
            //         ->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
