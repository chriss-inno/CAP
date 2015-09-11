<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinalRecommendationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('final_recommendations', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('fs_id')->nullable();
            $table->string('facility')->nullable();
            $table->string('facility_comments')->nullable();
            $table->string('amount')->nullable();
            $table->string('tenor')->nullable();
            $table->string('rate_interest')->nullable();
            $table->string('cr_pricing')->nullable();
            $table->string('repayment')->nullable();
            $table->string('facility_fee')->nullable();
            $table->string('review_date')->nullable();
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
		Schema::drop('final_recommendations');
	}

}
