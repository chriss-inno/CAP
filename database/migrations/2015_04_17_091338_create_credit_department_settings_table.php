<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditDepartmentSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('credit_department_settings', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('dpt_head')->nullable();
            $table->string('dpt_analyst')->nullable();
            $table->string('dpt_chief')->nullable();
            $table->string('app_limit')->nullable();
            $table->string('dpt_value2')->nullable();
            $table->string('created_by');
            $table->string('updated_by');
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
		Schema::drop('credit_department_settings');
	}

}
