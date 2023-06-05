<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lectures', function (Blueprint $table) {
            $table->id();
            $table->string("title_ar");
            $table->string("title_en");
            $table->text("description_ar");
            $table->text("description_en");
            $table->string("path_video");
            $table->string("duration");
            $table->tinyInteger('visiable');
            $table->tinyInteger('type')->default(1);
            $table->integer('order');
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
            $table->foreignId('added_id')->constrained('admins')->cascadeOnDelete();
            $table->string('poster')->nullable();
            $table->string('slug')->nullable();

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
        Schema::dropIfExists('lectures');
    }
}
