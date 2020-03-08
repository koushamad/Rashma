<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable(false);
            $table->integer('grade')->nullable(false);
            $table->dateTime('startDate')->nullable(false);
            $table->dateTime('endDate')->nullable(true);
            $table->unsignedBigInteger('companyId');
            $table->foreign('companyId')->references('id')->on('companies');
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
        Schema::dropIfExists('experiences');
    }
}
