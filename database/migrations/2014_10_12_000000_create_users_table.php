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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->uniqid();
            $table->string('user_name')->unique();
            $table->string('first_name');
            $table->string('sur_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('phonenumber');
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('post_id');
            $table->integer('message_id');
            $table->string('friend_list');
            $table->tinyInteger('status');
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
};
