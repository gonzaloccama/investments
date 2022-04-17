<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('investment_id');
            $table->decimal('amount');
            $table->integer('currency');
            $table->enum('type_payment', ['return', 'capital']);
            $table->integer('current_period')->default(1);
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->datetime('payment_date')->nullable();
            $table->enum('status', ['paid', 'pending', 'waiting'])->default('waiting');
            $table->timestamps();

            $table->foreign('investment_id')->references('id')->on('investments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
