<?php

class GeneroTableSeeder extends Seeder {

	public function run() {

		DB::table('generos')->delete();

		Genero::create(array(
			'descricao' => 'Ação'
		));

		Genero::create(array(
			'descricao' => 'Aventura'
		));

		Genero::create(array(
			'descricao' => 'Animação'
		));

		Genero::create(array(
			'descricao' => 'Comédia'
		));

		Genero::create(array(
			'descricao' => 'Crime'
		));

		Genero::create(array(
			'descricao' => 'Documentário'
		));

		Genero::create(array(
			'descricao' => 'Drama'
		));

		Genero::create(array(
			'descricao' => 'Terror'
		));

	}
}