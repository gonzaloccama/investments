<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_configs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->mediumText('short_description')->nullable();
            $table->text('description')->nullable();

            $table->text('phones');
            $table->text('emails');
            $table->text('addresses')->nullable();
            $table->text('media_social')->nullable();
            $table->text('facebook_page')->nullable();

            $table->string('logo')->nullable();
            $table->string('logo2sd')->nullable();
            $table->string('favicon')->nullable();

            $table->text('mission')->nullable();
            $table->text('vision')->nullable();
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
        Schema::dropIfExists('system_configs');
    }
}
