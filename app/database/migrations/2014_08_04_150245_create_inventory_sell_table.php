<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInventorySellTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inventory_sell', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('inventory_id')->unsigned()->index();
			$table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('cascade');
			$table->integer('sell_id')->unsigned()->index();
			$table->foreign('sell_id')->references('id')->on('sells')->onDelete('cascade');
			
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('inventory_sell');
	}

}
