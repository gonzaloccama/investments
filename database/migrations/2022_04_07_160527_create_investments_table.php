<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->string('code', 12)->autoIncrement();
            $table->bigInteger('user_id')->unsigned();
            $table->decimal('amount')->nullable();
            $table->integer('currency');
            $table->integer('period');
            $table->integer('current_period')->default(0);
            $table->bigInteger('plan')->unsigned()->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('status', ['completed', 'canceled', 'inactive', 'active'])->default('inactive');
            $table->decimal('return_amount')->nullable();
            $table->integer('period_progress')->default(0);
            $table->integer('progress')->default(0);
            $table->boolean('payment')->default(0);
            $table->dateTime('payment_date')->nullable();
            $table->integer('last_bonus')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('investments');
    }
}
