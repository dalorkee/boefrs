<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodeGenerateTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::create('code_generate', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('hoscpde', 16);
			$table->string('hn', 16);
			$table->string('an', 16)->nullable();
			$table->string('title_name', 6)->nullable();
			$table->string('first_name', 100)->nullable();
			$table->string('last_name', 100)->nullable();
			$table->string('lab_code', 60)->nullable();
			$table->timestamps();
			$table->engine = 'InnoDB';
			$table->charset = 'utf8mb4';
			$table->collation = 'utf8mb4_unicode_ci';

		});
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down()
	{
		Schema::dropIfExists('code_generate');
	}
}
