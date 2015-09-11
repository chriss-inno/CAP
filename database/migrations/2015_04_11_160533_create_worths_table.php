<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorthsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('worths', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('fa_id');
            $table->string('date_1');
            $table->string('date_2');
            $table->string('date_3');
            $table->string('worth_1');
            $table->string('worth_2');
            $table->string('worth_3');
            $table->string('asset_1');
            $table->string('asset_2');
            $table->string('asset_3');
            $table->string('comments');
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
		Schema::drop('worths');
	}

}
