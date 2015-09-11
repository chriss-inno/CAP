<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDSCRsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('d_s_c_rs', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('fa_id');
            $table->string('date_1')->nullable();
            $table->string('date_2')->nullable();
            $table->string('date_3')->nullable();
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
		Schema::drop('d_s_c_rs');
	}

}
