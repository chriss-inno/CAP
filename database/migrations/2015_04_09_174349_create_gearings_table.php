<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGearingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gearings', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('fa_id');
            $table->string('date_1');
            $table->string('date_2');
            $table->string('date_3');
            $table->string('comments');
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
		Schema::drop('gearings');
	}

}
