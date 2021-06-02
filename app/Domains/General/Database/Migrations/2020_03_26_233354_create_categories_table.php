<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id', 11)->key()->unsigned(false);
            $table->string('name_en');
            $table->string('name_ar')->nullable();
            $table->longText('data')->nullable();
            $table->integer('parent_id')->index()->nullable();
            $table->integer('child_id')->index()->nullable();
            $table->integer('order')->default(0);
            $table->enum('status', [config('system.status')])->default(config('system.status.deactivate'));
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('parent_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('child_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
