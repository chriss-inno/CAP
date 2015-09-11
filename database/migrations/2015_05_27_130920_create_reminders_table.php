<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemindersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reminders', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('user_id');
            $table->string('email');
            $table->string('send_to');
            $table->string('subject');
            $table->dateTime('send_date');
            $table->string('contents',4000);
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
		Schema::drop('reminders');
	}

}
