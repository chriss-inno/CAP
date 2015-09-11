<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProposedSecurityDetailedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('prs_details', function(Blueprint $table)
		{
			//
            $table->increments('id');
            $table->integer('ps_id');
            $table->string('security_type')->nullable();
            $table->string('existing_security')->nullable();
            $table->string('ccy_1')->nullable();
            $table->string('open_marketvalue')->nullable();
            $table->string('forced_salevalue')->nullable();
            $table->string('tobe_charges')->nullable();
            $table->string('immovable')->nullable();
            $table->string('location')->nullable();
            $table->string('area')->nullable();
            $table->string('certificate')->nullable();
            $table->string('owner')->nullable();
            $table->string('tennor')->nullable();
            $table->string('plot_area')->nullable();
            $table->string('valued_by')->nullable();
            $table->string('valued_on')->nullable();
            $table->string('valued_at')->nullable();
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
		Schema::drop('prs_details', function(Blueprint $table)
		{
			//
		});
	}

}
