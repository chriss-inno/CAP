<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProposedSecurityTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('proposed_security', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('crp_id');
            $table->string('rate_applied')->nullable();
            $table->string('status',1000);
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
		Schema::drop('proposed_security');
	}

}
