<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id', 11)->key()->unsigned(false);
            $table->string('name');
            $table->string('username')->unique()->nullable();
            $table->string('rank')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('data')->nullable();
            $table->string('password')->nullable();
            $table->longText('date')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->integer('order')->default(0);
            $table->enum('status', [config('system.status')])->default(config('system.status.deactivate'));
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
