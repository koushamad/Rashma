<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('walletId')->nullable(false);
            $table->foreign('walletId')->references('id')->on('wallets');
            $table->unsignedBigInteger('creditCardId')->nullable(true);
            $table->foreign('creditCardId')->references('id')->on('credit_cards');
            $table->string('trackNumber')->nullable(true);
            $table->integer('unit')->nullable(false);
            $table->boolean('isTransfer')->default(false);
            $table->boolean('isCashOut')->default(false);
            $table->float('cash', 20, 6)->default(0);
            $table->timestamps();
            $table->softDeletes();
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
}
