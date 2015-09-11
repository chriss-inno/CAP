<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCovenantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('covenants', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('appraisal_fee_1')->nullable();
            $table->string('appraisal_fee_2')->nullable();
            $table->string('appraisal_fee_3')->nullable();
            $table->string('disbursal')->nullable();
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
		Schema::drop('covenants');
	}

}
