<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFSLIMITSTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_limits', function(Blueprint $table)
		{
			$table->increments('id')->nullable();
            $table->integer('fs_id')->nullable();
            $table->string('facility')->nullable();
            $table->string('ccy_1')->nullable();
            $table->string('ccy_2')->nullable();
            $table->string('cr_limits')->nullable();
            $table->string('presentos')->nullable();
            $table->string('proposed')->nullable();
            $table->string('expire')->nullable();
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
		Schema::drop('fs_limits');
	}

}
