<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporanPeminjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_peminjamen', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id_laporan');
            $table->integer('id_laporan_peminjaman')->unsigned();
            $table->string('kebersihan');
            $table->string('AC');
            $table->string('kursi');
            $table->string('LCD');
            $table->string('Lampu');
            $table->string('kritik_dan_saran');
            $table->string('PC');
            $table->timestamps();
        });

        Schema::table('laporan_peminjamen',function($table){
            $table->foreign('id_laporan_peminjaman')
            ->references('id_peminjaman')
            ->on('peminjamen')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan_peminjamen');
    }
}
