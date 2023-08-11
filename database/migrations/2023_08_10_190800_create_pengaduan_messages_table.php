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
        Schema::create('pengaduan_messages', function (Blueprint $table) {
            $table->id();
            $table->string('UserID');
            $table->string('room_id');
            $table->timestamps();
            //$table->string('nama_terlapor',50)->nullable();
            $table->string('nama_terlapor',50);
            $table->string('jabatan_pekerjaan',50);
            $table->string('alamat',100);
            $table->string('tempat_kejadian',50);
            $table->date('waktu_kejadian',50);
            $table->string('uraian',1500);
            $table->string('aduan_file',50)->nullable();
            $table->string('message',1000)->nullable();
            $table->string('message_file',50)->nullable();
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengaduan_messages');
    }
};
