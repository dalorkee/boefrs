<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::create('patient', function (Blueprint $table) {
			$table->bigIncrements('id')->comment('index');
			$table->string('hoscpde', 16);
			$table->string('hn', 16);
			$table->string('an', 16)->nullable();
			$table->string('title_name', 6)->nullable();
			$table->string('first_name', 100)->nullable();
			$table->string('last_name', 100)->nullable();
			$table->string('gender', 6)->nullable();
			$table->date('date_of_birth')->nullable();
			$table->string('nationality', 6)->nullable();
			$table->string('nationality_other', 60)->nullable();
			$table->string('occupation', 6)->nullable();
			$table->string('occupation_other', 60)->nullable();
			$table->string('house_no', 20)->nullable();
			$table->string('village', 100)->nullable();
			$table->string('village_no', 6)->nullable();
			$table->string('lane', 100)->nullable();
			$table->string('sub_district', 12)->nullable();
			$table->string('district', 12)->nullable();
			$table->string('province', 12)->nullable();
			$table->string('phone', 30)->nullable();
			$table->string('lab_code', 60)->nullable();
			$table->enum('lab_status', ['generate', 'complete']);
			$table->string('user', 6);
			$table->string('active', 16)->default('1');
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
		Schema::dropIfExists('patient');
	}
}
