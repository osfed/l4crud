<?php


class Tablas extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tablas';

	protected $primaryKey = 'id';

	public function usuarios()
	{		
		return $this->hasMany('UsuarioTabla', 'tabla_id', 'id');		
	}	
}
