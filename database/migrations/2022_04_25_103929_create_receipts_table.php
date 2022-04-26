<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('investment_id')->unsigned();
            $table->bigInteger('payment_id')->unsigned();
            $table->string('attachment');
            $table->timestamps();

            $table->foreign('investment_id')->references('id')->on('investments')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('payment_id')->references('id')->on('payments')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receipts');
    }
}
