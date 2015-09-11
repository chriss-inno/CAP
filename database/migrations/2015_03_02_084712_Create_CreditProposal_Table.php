<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditProposalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('credit_proposal', function(Blueprint $table)
		{
			//
            $table->increments('id');
            $table->integer('customer_id')->default('0');
            $table->string('reference_no');
            $table->string('sno');
            $table->date('app_date')->nullable();
            $table->string('open_type')->nullable();
            $table->string('app_type')->nullable();
            $table->integer('current_stage')->default('0');
            $table->integer('autho')->default('0');
            $table->integer('approval_limit')->default('0');
            $table->integer('created_by')->default('0');
            $table->integer('updated_by')->default('0');
            $table->string('inputer')->nullable();
            $table->string('authorizer')->nullable();
            $table->string('status',60)->default('Incomplete');
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
		Schema::drop('credit_proposal');
	}

}
