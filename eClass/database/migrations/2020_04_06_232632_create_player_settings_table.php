<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlayerSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('player_settings')){
			Schema::create('player_settings', function(Blueprint $table)
			{
				$table->increments('id');
				$table->string('logo', 191);
				$table->boolean('logo_enable')->default(1);
				$table->string('cpy_text', 191);
				$table->boolean('share_enable')->default(1);
				$table->boolean('autoplay')->default(1);
				$table->integer('download')->default(0);
				$table->timestamps();
			});
		}
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('player_settings');
	}

}
