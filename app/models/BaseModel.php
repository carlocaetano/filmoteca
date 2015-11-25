<?php

class BaseModel extends Eloquent {

	public $timestamps = false;

	public function validade($data)
	{
		return Validator::make($data, static::$rules);
	}
	
}