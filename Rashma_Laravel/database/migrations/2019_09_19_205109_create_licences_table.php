<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable(false);
            $table->integer('grade')->nullable(false);
            $table->dateTime('startDate')->nullable(false);
            $table->dateTime('endDate')->nullable(true);
            $table->unsignedBigInteger('universityId');
            $table->foreign('universityId')->references('id')->on('universities');
            $table->unsignedBigInteger('profileId');
            $table->foreign('profileId')->references('id')->on('profiles');
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
        Schema::dropIfExists('licences');
    }
}
