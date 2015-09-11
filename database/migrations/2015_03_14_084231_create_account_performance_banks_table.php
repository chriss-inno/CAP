<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountPerformanceBanksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('account_performance_banks', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('a_p_id');
            $table->string('bank_maintained')->nullable();
            $table->string('loan_disbursement_tzs')->nullable();
            $table->string('total_tzs')->nullable();
            $table->string('Credit_turnover_tzs')->nullable();
            $table->string('loan_disbursement_usd')->nullable();
            $table->string('total_usd')->nullable();
            $table->string('Credit_turnover_usd')->nullable();

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
		Schema::drop('account_performance_banks');
	}

}
