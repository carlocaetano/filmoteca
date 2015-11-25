<?php

class Tipo extends BaseModel {

	protected $table = 'tipos';

	protected $fillable = array('titulo', 'descricao');

	public static $rules = array (
		'titulo' => 'required|min:3|max:45',
		'descricao' => 'required|min:10',
	);

	public function filmes() {
		return $this->hasMany('Filme', 'tipo_id');
	}

	public static function validate($data)
	{
		if(Request::getMethod() == 'PUT') {
			$id = $data['id'];
			self::$rules['titulo'] .= ",$id";
			self::$rules['descricao'] .= ",$id";
		}

		return Validator::make($data, self::$rules);
	}

	public static function options()
	{
		return array('' => '') + static::orderBy('titulo')->lists('titulo', 'id');
	}

}