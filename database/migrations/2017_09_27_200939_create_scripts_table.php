<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScriptsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('scripts', function (Blueprint $table) {
			$table->increments('id');
			$table->string("user_id");
			$table->string("course_id");
			$table->string("quiz_id");
			$table->text("questions");
			$table->text("answers");
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
		Schema::dropIfExists('scripts');
	}
}
