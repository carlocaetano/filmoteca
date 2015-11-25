<?php

class Genero extends BaseModel
{
	protected $table = "generos";

	protected $fillable = array('descricao');

	public static $rules = array(
		'descricao' => 'required|min:3|max:45|unique:generos,descricao'
	);

	public function filmes()
	{
		return $this->belongsToMany('Filme', 'filmes_generos', 'genero_id', 'filme_id');
	}

	public static function validate($data)
	{
		if(Request::getMethod() == 'PUT') {
			$id = $data['id'];
			self::$rules['descricao'] .= ",$id";
		}

		return Validator::make($data, self::$rules);
	}

	public static function options()
	{
		return static::orderBy('descricao')->lists('descricao', 'id');
	}

}