<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricingRationaleDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pricing_rationale_details', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('pricing_rationale_id')->nullable();
            $table->string('facility')->nullable();
            $table->string('anual_interest')->nullable();
            $table->string('fees');
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
		Schema::drop('pricing_rationale_details');
	}

}
