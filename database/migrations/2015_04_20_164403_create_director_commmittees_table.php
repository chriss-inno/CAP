<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectorCommmitteesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('director_commmittees', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('title',30)->nullable();
            $table->string('firstname')->nullable();
            $table->string('surname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->integer('status')->default(0);
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
		Schema::drop('director_commmittees');
	}

}
