<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('userId')->nullable(false);
            $table->foreign('userId')->references('id')->on('users');
            $table->float('range', 20, 6)->default(0);
            $table->float('activity', 20, 6)->default(0);
            $table->string('fullName')->nullable(true);
            $table->string('imageId')->nullable(true);
            $table->string('nationalCode')->nullable(true);
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
        Schema::dropIfExists('profiles');
    }
}
