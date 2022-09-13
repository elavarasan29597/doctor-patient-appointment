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
        Schema::create('appointments', function (Blueprint $table) {

            $table->id();

            $table->bigInteger('doctor_id')->unsigned();
            $table->bigInteger('patient_id')->unsigned();

            $table->dateTime('start_date_time')->nullable();
            $table->dateTime('end_date_time')->nullable();

            $table->foreign("doctor_id")->references("id")->on("doctors")->onDelete('cascade')->onUpdate('cascade');
            $table->foreign("patient_id")->references("id")->on("patients")->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('appointments');
    }
};
