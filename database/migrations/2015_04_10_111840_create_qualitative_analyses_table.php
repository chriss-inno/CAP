<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQualitativeAnalysesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('qualitative_analyses', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('crg_id');
            $table->string('Management')->default('0')->nullable();
            $table->string('Market_share')->default('0')->nullable();
            $table->string('Concentration_risk')->default('0')->nullable();
            $table->string('Track_record')->default('0')->nullable();
            $table->string('Compliance_record')->default('0')->nullable();
            $table->string('auditing_firm')->default('0')->nullable();
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
		Schema::drop('qualitative_analyses');
	}

}
