<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDSCRDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('d_s_c_r_details', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('ds_id');
            $table->string('data_1')->nullable();
            $table->string('data_2')->nullable();
            $table->string('data_3')->nullable();
            $table->string('data_4')->nullable();
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
		Schema::drop('d_s_c_r_details');
	}

}
