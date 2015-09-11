<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnexureIIsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('annexure_i_is', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('crp_id');
            $table->string('title')->nullable();
            $table->text('contents')->nullable();
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
		Schema::drop('annexure_i_is');
	}

}
