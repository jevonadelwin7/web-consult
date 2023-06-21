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
        Schema::create('consult_messages', function (Blueprint $table) {
            $table->id();
            $table->string('UserID');
            $table->string('room_id');
            $table->timestamps();
            $table->string('message',1000);
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
        Schema::dropIfExists('consult_messages');
    }
};
