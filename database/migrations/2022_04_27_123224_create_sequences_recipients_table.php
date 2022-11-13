<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSequencesRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sequences_recipients', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('sequence_id');
            $table->foreign('sequence_id')->references('id')->on('sequences');
            $table->text('name');
            $table->text('email');
            $table->boolean('sent');
            $table->boolean('opened');
            $table->boolean('replied');
            $table->boolean('active');
            $table->boolean('exited');
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
        Schema::dropIfExists('sequences_recipients');
    }
}
