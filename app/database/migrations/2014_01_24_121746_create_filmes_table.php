<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('filmes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('titulo_original', 150);
			$table->string('titulo_portugues', 150);
			$table->date('lancamento');
			$table->string('poster', 60);
			$table->text('sinopse');
			$table->smallInteger('avaliacao')->nullable();
			$table->string('imdb', 160);
			$table->integer('duracao');
			$table->smallInteger('discos');
			$table->integer('ano');
			$table->integer('tipo_id')->unsigned();

			$table->foreign('tipo_id')->references('id')->on('tipos')->on_delete('restrict');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('filmes');
	}

}