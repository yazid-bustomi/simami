<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('lowongan_id')->constrained('lowongans')->onDelete('cascade');
            $table->enum('status', ['pending', 'approve', 'select', 'rejected_kampus', 'rejected_perusahaan']);

            /**
             * pending => masih proses mendaftar
             * approve => di approve oleh kampus untuk di ajukan seleksi ke perusahaan
             * select  => di pilih oleh perusahaan untuk magang di tempat tersebut
             * rejected  => ditolak oleh kampus atau perusahaan
             */
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
        Schema::dropIfExists('pendaftars');
    }
}
