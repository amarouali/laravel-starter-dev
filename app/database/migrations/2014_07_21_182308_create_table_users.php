<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsers extends Migration {

/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table) {
					$table->engine = 'InnoDB';
		            $table->increments('id')->unsigned();
		            $table->integer('role_id')->unsigned();
		            $table->string('username', 64)->unique();
		            $table->string('password', 64);
		            $table->boolean('confirmed')->default(false);
					$table->string('email', 64)->unique();
		            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
		            $table->string('remember_token', 100)->nullable();
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
		Schema::drop('users');
	}


}


