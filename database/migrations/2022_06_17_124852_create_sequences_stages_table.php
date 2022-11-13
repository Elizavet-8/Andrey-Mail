<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSequencesStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sequences_stages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sequence_id');
            $table->foreign('sequence_id')->references('id')->on('sequences');
            $table->integer('stage');
            $table->integer('time')->nullable();
            $table->text('type_time')->nullable();
            $table->text('subject')->nullable();
            $table->longText('content')->nullable();
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
        Schema::dropIfExists('sequences_stages');
    }
}
