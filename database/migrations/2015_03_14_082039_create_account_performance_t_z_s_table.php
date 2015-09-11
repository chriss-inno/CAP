<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountPerformanceTZSTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('account_performance_t_z_s', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('a_p_id');
            $table->string('tzs_month')->nullable();
            $table->string('tzs_low_balance')->nullable();
            $table->string('tzs_high_balance')->nullable();
            $table->string('tzs_turnover')->nullable();
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
		Schema::drop('account_performance_t_z_s');
	}

}
