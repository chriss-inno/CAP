<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuantitativeAnalysesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quantitative_analyses', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('crg_id');
            $table->integer('Current_Ratio')->default('0')->nullable();
            $table->integer('Debt_Service')->default('0')->nullable();
            $table->integer('Dept_Equity')->default('0')->nullable();
            $table->integer('Asset_Coverage')->default('0')->nullable();
            $table->integer('Security_Cove')->default('0')->nullable();
            $table->integer('Operation_Profit')->default('0')->nullable();
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
		Schema::drop('quantitative_analyses');
	}

}
