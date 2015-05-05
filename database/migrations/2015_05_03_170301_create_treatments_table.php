<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateTreatmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('treatments', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('treatment')->nullable();
            $table->dateTime('treatment_date');
            $table->string('referral')->nullable();
            $table->integer('patient_id');
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
		Schema::drop('treatments');
	}

}
