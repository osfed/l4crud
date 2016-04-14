<?php
	
class UsuarioTabla extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'usuarios_tablas';

	/**
	 * Cambio de nombre por defecto del id en Eloquent	 
	 * @var string
	 */
	protected $primaryKey = 'id';

	public function usuario()
	{
		return $this->belongsTo('Usuario', 'usuario_id', 'id');		
	}

	public function tabla()
	{
		return $this->belongsTo('Tablas', 'tabla_id', 'id');		
	}	
}