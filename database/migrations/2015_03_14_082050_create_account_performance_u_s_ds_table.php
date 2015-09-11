<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountPerformanceUSDsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('account_performance_u_s_ds', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('a_p_id');
            $table->string('usd_month')->nullable();
            $table->string('usd_low_balance')->nullable();
            $table->string('usd_high_balance')->nullable();
            $table->string('usd_turnover')->nullable();
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
		Schema::drop('account_performance_u_s_ds');
	}

}
