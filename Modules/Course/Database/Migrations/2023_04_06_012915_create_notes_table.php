<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('notes', function (Blueprint $table) {
        $table->id();
        $table->string('text');
        $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
        $table->foreignId('lecture_id')->constrained('lectures')->cascadeOnDelete();

        $table->timestamps();
    }); }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
}
