<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengalamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengalamen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('akademik_id')->constrained('akademik_profiles')->onDelete('cascade');
            $table->string('judul');
            $table->string('penerbit');
            $table->string('id_krendensial');
            $table->string('bidang');
            $table->string('lokasi');
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->string('file');
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
        Schema::dropIfExists('pengalamen');
    }
}
