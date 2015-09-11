<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDebtorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('debtors', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('fa_id');
            $table->string('date_1');
            $table->string('date_2');
            $table->string('date_3');
            $table->string('debtors_amount_1');
            $table->string('debtors_amount_2');
            $table->string('debtors_amount_3');
            $table->string('debtors_days_1');
            $table->string('debtors_days_2');
            $table->string('debtors_days_3');
            $table->string('comments');
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
		Schema::drop('debtors');
	}

}
