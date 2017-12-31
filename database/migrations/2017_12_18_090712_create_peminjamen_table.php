<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeminjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id_peminjaman')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->string('ruangan',10);
            $table->date('tanggal_pinjam');
            $table->time('mulai_pinjam');
            $table->time('selesai_pinjam');
            $table->string('instansi_peminjaman',20);
            $table->string('keperluan_peminjaman',20);
            $table->timestamps();
        });

        Schema::table('peminjamen',function($table){
            $table->foreign('id_user')
            ->references('id')
            ->on('users')
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
        Schema::dropIfExists('peminjamen');
    }
}
