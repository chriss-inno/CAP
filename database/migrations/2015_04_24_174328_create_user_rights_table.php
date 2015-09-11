<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRightsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_rights', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('user_id');
            $table->integer('cr')->default(0);
            $table->integer('edit',0)->default(0);
            $table->integer('dl',0)->default(0);
            $table->integer('vw',0)->default(0);
            $table->integer('authorize',0)->default(0);
            $table->string('modname',40)->default(0);
            $table->integer('modulecode',0);
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
		Schema::drop('user_rights');
	}

}
