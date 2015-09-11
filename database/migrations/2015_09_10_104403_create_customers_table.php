<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('customer_no')->nullable();
			$table->string('customer_name')->nullable();
			$table->string('customer_address')->nullable();
			$table->string('contact_person')->nullable();
			$table->string('rm')->nullable();
			$table->integer('autho')->default('0');
			$table->integer('created_by')->default('0');
			$table->integer('updated_by')->default('0');
			$table->string('status',60)->default('enabled');
			$table->string('del_start',1)->default('N');
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
		Schema::drop('customers');
	}

}
