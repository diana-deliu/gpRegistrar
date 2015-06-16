<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notifications', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('user_id');

            $table->string('user_type');
            $table->string('subject');
            $table->string('body');
            $table->string('object_id');
            $table->string('object_type');
            $table->boolean('is_read');
            $table->dateTime('sent_at');
            $table->dateTime('start_date');
            $table->integer('interval');
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
		Schema::drop('notifications');
	}

}
