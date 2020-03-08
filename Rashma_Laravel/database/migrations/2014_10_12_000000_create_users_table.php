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
            $table->bigIncrements('id');
            $table->string('name')->nullable(true);
            $table->string('phone')->unique()->nullable(true);
            $table->string('code')->unique()->nullable(true);
            $table->text('token')->nullable(true);
            $table->text('refreshToken')->nullable(true);
            $table->dateTime('phone_verified_at')->nullable(true);
            $table->string('email')->unique()->nullable(true);
            $table->dateTime('email_verified_at')->nullable(true);
            $table->string('password')->nullable(true);
            $table->string('sid')->nullable(true)->unique()->index();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
