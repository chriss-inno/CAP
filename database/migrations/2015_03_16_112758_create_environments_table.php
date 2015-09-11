<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnvironmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('environments', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('political_economic')->nullable();
            $table->string('sector_performance')->nullable();
            $table->string('position_sector')->nullable();
            $table->string('regulatory')->nullable();
            $table->string('environmental_issues')->nullable();
            $table->integer('crp_id');
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
		Schema::drop('environments');
	}

}
