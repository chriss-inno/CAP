<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemosactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('memosactions', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('sno');
            $table->date('app_date')->nullable();
            $table->string('company_name');
            $table->string('credit_usd')->nullable();
            $table->string('credit_tzs')->nullable();
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
		Schema::drop('memosactions');
	}

}
