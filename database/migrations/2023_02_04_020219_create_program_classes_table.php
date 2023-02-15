<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_classes', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('thumbnail');
            $table->string('nama');
            $table->text('deskripsi');
            $table->integer('harga_per_bulan');
            $table->enum('status', ['aktif', 'tidak aktif']);
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
        Schema::dropIfExists('program_classes');
    }
}
