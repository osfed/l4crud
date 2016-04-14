<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableUsuarios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuarios', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('usuario');			
			$table->string('password');			
			$table->string('remember_token');
			$table->timestamps();
		});

		DB::table('usuarios')->insert(
	        array(
	            'usuario' => 'admin',
	            'password' => Hash::make('admin')
	        )
	    );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuarios');
	}

}
