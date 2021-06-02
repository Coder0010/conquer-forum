<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->increments('id', 11)->key()->unsigned(false);
            $table->string('name');
            $table->string('provider_id');
            $table->integer('user_id');
            $table->string('avater')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id', 'provider_user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('providers');
    }
}
