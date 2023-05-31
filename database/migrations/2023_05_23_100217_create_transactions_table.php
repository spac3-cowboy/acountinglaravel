<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('note')->nullable();
            $table->integer('amount');
            $table->string('file')->nullable();
            $table->date('date');
            $table->integer('ac_balance')->nullable();
            $table->integer('main_balance')->nullable();
            $table->integer('position_key');
            $table->unsignedBigInteger('transaction_head_id');
            $table->unsignedBigInteger('transaction_account_id');
            $table->softDeletes();
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
        Schema::dropIfExists('transactions');
    }
};
