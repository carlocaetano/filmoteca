<?php

class Filme extends BaseModel
{
	protected $table = "filmes";

	protected $fillable = array(
		'titulo_original',
		'titulo_portugues',
		'lancamento',
		'poster',
		'sinopse',
		'avaliacao',
		'imdb',
		'duracao',
		'discos',
		'ano',
		'comentario',
		'tipo_id'
	);

	public static $rules = array(
		'titulo_original' => 'required|min:3|max:150',
		'titulo_portugues' => 'required|min:3|max:150',
		'lancamento' => 'required|date_format:d/m/Y',
		'poster' => 'required|image|max:1000',
		'sinopse' => 'min:10',
		'avaliacao' => 'integer|in:1,2,3,4,5',
		'imdb' => 'required|min:3|max:160|url',
		'duracao' => 'required|integer',
		'discos' => 'required|integer',
		'ano' => 'required|integer',
		'comentario' => 'min:10',
		'tipo_id' => 'required|integer',
		'genero_ids' => 'required|array',
	);

	public function tipo()
	{
		return $this->belongsTo('Tipo', 'tipo_id');
	}

	public function generos()
	{
		return $this->belongsToMany('Genero', 'filmes_generos', 'filme_id', 'genero_id');
	}


	public static function validate($data)
	{
		if(Request::getMethod() == 'PUT') {
			
			if($data['poster'] == '') {
				unset(self::$rules['poster']);
			}
		}

		return Validator::make($data, self::$rules);
	}

}