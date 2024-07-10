<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkademikProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akademik_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('nim');
            // $table->string('perguruan_tinggi');
            $table->foreignId('jurusan_id')->constrained('jurusan_kampuses')->onDelete('cascade');
            $table->string('transkip')->nullable();
            $table->string('ipk')->nullable();
            $table->string('semester')->nullable();
            $table->string('cv')->nullable();
            $table->foreignId('admin_kampus_id')->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('akademik_profiles');
    }
}
