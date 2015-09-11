<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShareholderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crp_shareholders', function(Blueprint $table)
		{
			//
            $table->increments('id');
            $table->integer('customer_id');
            $table->string('name');
            $table->string('holding');
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
        Schema::drop('crp_shareholders');
	}

}
