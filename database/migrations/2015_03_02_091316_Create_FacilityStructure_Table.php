<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilityStructureTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('facility_structure', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('crp_id');
            $table->string('valid_date')->nullable();
            $table->string('purpose',1000)->nullable();
            $table->string('remarks',1000)->nullable();
            $table->string('msg',1000)->nullable();
            $table->string('rate_applied')->default(1);
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
		Schema::drop('facility_structure');
	}

}
