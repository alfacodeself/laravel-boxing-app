<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsentHasTrainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absent_has_trainers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('absent_id')->constrained('absents');
            $table->foreignId('trainer_id')->constrained('trainers');
            $table->enum('keterangan', ['masuk', 'izin', 'sakit', 'tanpa keterangan'])->default('tanpa keterangan');
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
        Schema::dropIfExists('absent_has_trainers');
    }
}
