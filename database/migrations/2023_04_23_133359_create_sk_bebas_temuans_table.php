<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sk_bebas_temuans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('no_surat',30);
            $table->string('id_pemohon',5);
            $table->string('pemohon',30);
            $table->string('tujuan',50);
            $table->string('status',5);
            $table->string('file_name',50); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sk_bebas_temuans');
    }
};
