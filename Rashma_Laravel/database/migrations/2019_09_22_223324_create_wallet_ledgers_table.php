<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_ledgers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('walletId');
            $table->foreign('walletId')->references('id')->on('wallets');
            $table->unsignedBigInteger('transactionId');
            $table->foreign('transactionId')->references('id')->on('transactions');
            $table->unsignedBigInteger('profileId');
            $table->foreign('profileId')->references('id')->on('profiles');
            $table->float('cash', 20, 6)->default(0);
            $table->float('total', 20, 6)->default(0);
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
        Schema::dropIfExists('wallet_ledgers');
    }
}
