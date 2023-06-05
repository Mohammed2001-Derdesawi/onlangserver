<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid("uuid");
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('age')->nullable();
            $table->string('image')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('is_start_campaigns')->default(0);
            $table->enum('campaign_type',["money","course"])->default('money');
            $table->string('connect_account_id')->nullable();
            $table->boolean('has_completed_on_boarding')->nullable()->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
