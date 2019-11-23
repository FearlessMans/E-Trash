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
            $table->string('token');
            $table->enum('status', ['SELESAI','PENDING', 'EXPIRED'])->default('PENDING');
            $table->dateTime('tgl_transaksi')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('tgl_expired')->nullable();
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
