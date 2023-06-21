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
        Schema::create('surat_bebas_temuans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('id_permohonan_detail',5);
            $table->string('id_permohonan',5);
            $table->string('nomor_surat',50)->nullable();
            $table->string('nama_pejabat',50)->nullable();
            $table->string('nip_pejabat',50)->nullable();
            $table->string('pang_gol_pejabat',30)->nullable();
            $table->string('jabatan_pejabat',100)->nullable();
            $table->string('nama_pemohon',50)->nullable();
            $table->string('nip_pemohon',50)->nullable();
            $table->string('pang_gol_pemohon',30)->nullable();
            $table->string('jabatan_pemohon',100)->nullable();
            $table->string('unit_kerja_pemohon',70)->nullable();
            $table->string('tanggal_surat',50)->nullable();
            $table->string('jabatan_ttd',30)->nullable();
            $table->string('status',5)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_bebas_temuans');
    }
};
