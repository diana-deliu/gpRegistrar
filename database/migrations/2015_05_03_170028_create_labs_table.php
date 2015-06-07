<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateLabsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('labs', function(Blueprint $table)
		{
			$table->increments('id');
            $table->dateTime('date');

            $table->integer('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('patients');

            $table->string('hemoglobin');
            $table->string('vsh');
            $table->string('transaminases');
            $table->string('cholesterol');
            $table->string('triglycerides');
            $table->string('creatinine');
            $table->string('urea');
            $table->string('urine');
            $table->string('copro');

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
		Schema::drop('labs');
	}

}
