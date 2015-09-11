<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessActivitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_activities', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('business_activity')->nullable();
            $table->string('org_hq')->nullable();
            $table->string('product_traded')->nullable();
            $table->string('credit_terms')->nullable();
            $table->string('sales_distributions')->nullable();
            $table->integer('crp_id');
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
		Schema::drop('business_activities');
	}

}
