<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorthDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('worth_details', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('worth_id');
            $table->string('data_1')->nullable();
            $table->string('data_2')->nullable();
            $table->string('data_3')->nullable();
            $table->string('data_4')->nullable();
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
		Schema::drop('worth_details');
	}

}
