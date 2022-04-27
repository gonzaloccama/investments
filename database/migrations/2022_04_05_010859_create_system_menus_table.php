<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_menus', function (Blueprint $table) {
            $table->id();
            $table->string('name', 32);
            $table->string('icon', 64)->nullable();
            $table->string('route', 32)->nullable();
            $table->boolean('is_route')->default(1);
            $table->string('in_group')->nullable();
            $table->integer('order', false, true)->nullable();
            $table->bigInteger('parent', false, true)->nullable();
            $table->string('type', 26)->nullable();
            $table->string('section', 52)->nullable();
            $table->timestamps();

            $table->foreign('parent')->references('id')->on('system_menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_menus');
    }
}
