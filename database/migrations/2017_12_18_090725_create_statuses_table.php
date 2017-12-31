<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id_status');
            $table->integer('id_status_peminjaman')->unsigned();
            $table->integer('verif');
            $table->integer('status_kunci');
            $table->string('nama_peminjam_kunci');
            $table->string('jaminan');
            $table->timestamps();
        });
        Schema::table('statuses',function($table){
            $table->foreign('id_status_peminjaman')
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
        Schema::dropIfExists('statuses');
    }
}
