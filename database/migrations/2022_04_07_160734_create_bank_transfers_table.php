<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_transfers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('investment_id', false, true);
            $table->bigInteger('user_id', false, true);
            $table->bigInteger('bank_id', false, true);
            $table->decimal('amount');
            $table->dateTime('transfer_date');
            $table->string('transfer_account', 64)->nullable();
            $table->string('attachment')->nullable();
            $table->enum('status', ['cancelled', 'pending', 'verified'])->default('pending');
            $table->timestamps();

            $table->foreign('investment_id')->references('id')->on('investments')->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
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
        Schema::dropIfExists('bank_transfers');
    }
}
