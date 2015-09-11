<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwotAnalysesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('swot_analyses', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('swot_strength')->nullable();
            $table->string('swot_weaknesses')->nullable();
            $table->string('swot_opportunities')->nullable();
            $table->string('swot_threats')->nullable();
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
		Schema::drop('swot_analyses');
	}

}
