<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmesGenerosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('filmes_generos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('genero_id')->unsigned();
			$table->integer('filme_id')->unsigned();

			$table->foreign('genero_id')->references('id')->on('generos')->on_delete('restrict');
			$table->foreign('filme_id')->references('id')->on('filmes')->on_delete('restrict');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('filmes_generos');
	}

}