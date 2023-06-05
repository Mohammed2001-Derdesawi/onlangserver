<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->text('title_en');
            $table->text('title_ar');
            $table->text("description_ar");
            $table->text("description_en");
            $table->text("meta_description");
            $table->text("features");
            $table->string("duration");
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->unsignedBigInteger('added_id')->nullable();
            $table->foreign('added_id')->references('id')->on('admins')->nullOnDelete();
            $table->tinyInteger('visiable');
			$table->string('image', 255);
			$table->float('price',5,2);
			$table->string('preview_video');
            $table->enum('type',['paid','free']);
            $table->unsignedBigInteger('language_id')->nullable();
            $table->foreign('language_id')->references('id')->on('languages')->nullOnDelete();
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
        Schema::dropIfExists('courses');
    }
}
