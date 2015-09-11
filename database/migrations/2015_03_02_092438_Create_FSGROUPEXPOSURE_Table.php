<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFSGROUPEXPOSURETable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_groupexposure', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('fs_id');
            $table->string('client')->nullable();
            $table->string('facility')->nullable();
            $table->string('ccy')->nullable();
            $table->string('existing_limit')->nullable();
            $table->string('osbalance')->nullable();
            $table->string('proposed_limit')->nullable();
            $table->string('gel')->nullable();
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
		Schema::drop('fs_groupexposure');
	}

}
