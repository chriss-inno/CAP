<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('account_profiles', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('customer_id');
            $table->string('borrowerid')->nullable();
            $table->string('credit_rating')->nullable();
            $table->string('legal_entity')->nullable();
            $table->string('business_activity')->nullable();
            $table->string('app_group')->nullable();
            $table->string('g_indicator')->nullable();
            $table->string('emanagement')->nullable();
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
		Schema::drop('account_profiles');
	}

}
