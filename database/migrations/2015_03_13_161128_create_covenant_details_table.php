<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCovenantDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('covenant_details', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('covenants_id');
            $table->string('fund_type')->nullable();
            $table->string('type_nonfunded')->nullable();
            $table->string('nonfunded_spread')->nullable();
            $table->string('nonfunded_ef_rate')->nullable();
            $table->string('pricing')->nullable();
            $table->string('facility')->nullable();
            $table->string('spread')->nullable();
            $table->string('effective_rate')->nullable();
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
		Schema::drop('covenant_details');
	}

}
