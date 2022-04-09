<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('username');
            $table->string('email')->unique();
            $table->string('mobile', 12)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->tinyInteger('group', false, true)->default(5);
            $table->boolean('email_verified')->default(0);
            $table->boolean('activated')->default(1);
            $table->boolean('user_verified')->default(0);
            $table->boolean('banned')->default(0);

            $table->string('firstname');
            $table->string('lastname');
            $table->string('dni', 8)->nullable();
            $table->tinyInteger('gender', false, true)->nullable();
            $table->string('picture')->nullable();
            $table->integer('picture_id')->nullable();
            $table->string('cover')->nullable();
            $table->integer('cover_id')->nullable();

            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->integer('region')->nullable();
            $table->integer('country')->nullable();
            $table->date('birthdate')->nullable();
            $table->integer('relationship')->nullable();
            $table->mediumText('job')->nullable();

            $table->mediumText('social_media')->nullable();

            $table->boolean('user_is_online')->default(0);
            $table->string('user_last_activity')->nullable();

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
