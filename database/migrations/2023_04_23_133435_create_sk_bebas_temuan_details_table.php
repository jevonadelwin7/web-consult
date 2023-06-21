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
        Schema::create('sk_bebas_temuan_details', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('id_permohonan',5);
            $table->string('id_pemohon',5);
            $table->string('sk_pangkat',50)->nullable();;
            $table->string('sk_bebas_asset',50)->nullable();;
            $table->string('sk_bebas_utang',50)->nullable();;
            $table->string('sk_bebas_ikatan_dinas',50)->nullable();;
            $table->string('sp_hukuman_disiplin',50)->nullable();;
            $table->string('message',150)->nullable();;
            $table->boolean('is_upload')->nullable();





        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sk_bebas_temuan_details');
    }
};
