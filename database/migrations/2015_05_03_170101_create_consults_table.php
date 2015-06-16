<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateConsultsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('consults', /**
         * @param Blueprint $table
         */
        function(Blueprint $table)
		{
			$table->increments('id');
            $table->dateTime('date');
            $table->dateTime('next_date');

            $table->integer('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('patients');

            $table->integer('height');
            $table->integer('weight');
            $table->integer('abdominal_circumference');
            $table->string('blood_pressure');
            $table->integer('glucose');

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
		Schema::drop('consults');
	}

}
