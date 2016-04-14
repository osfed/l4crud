<?php

class RawController extends Controller {

	//public $data = array();
	//protected $layout = 'raw::raw';

	

	/*
	|--------------------------------------------------------------------------
	| Controladores de acceso al Administrador
	|--------------------------------------------------------------------------	
	*/
	public function Welcome($action = false,$id = false)
	{					
		$raw = new Osfed\L4CRUD\Raw($action,$id,$this); 

		$tablas = array();

		$tablaUsuario = UsuarioTabla::with('tabla')->where('usuario_id', Auth::user()->id)->get();		
		foreach ($tablaUsuario as $tabla) {
			$arrayTabla =array('nombre' => $tabla->tabla->nombre, 'tabla' => $tabla->tabla->tabla);
			array_push($tablas, $arrayTabla);					
		}		

		sort($tablas);
		$data = array();		
		$data['raw'] = $raw;		
		$data['tablas'] = $tablas;				
		$this->template_file = 'raw::admin';
		$this->layout = View::make($this->template_file, $data);
	}

	public function Login()
	{		
		return View::make('raw::login');			
	}

	public function LoginPost()
	{		
		$user = array(
			'usuario' 	=> Input::get('usuario'),
			'password' 	=> Input::get('password')
		);
		
		if (Auth::attempt($user)) {
			return Redirect::route('admin');			
		} else {			
			return Redirect::route('login');			
		}		
	}

	public function Logout()
	{		
		Auth::logout();
		return Redirect::route('login');
	}


	public function Usuarios($action = false,$id = false)
	{
		$raw = new Osfed\L4CRUD\Raw($action,$id,$this); 		
		$raw->setTable('usuarios');		
		$raw->setTitle('Usuarios');
		$raw->action(array('url'=>'/admin/usuario/%d','title'=>'Permisos','span'=>'glyphicon glyphicon-list', 'class'=>"raw-naranja"));
		$raw->fields(
			array(
				'id'=>array('type'=>'hidden','primary_key'=>true, 'column' => false),
		        'usuario'=>array('column'=>true),
		        'password'=>array('column'=>false, 'type' => 'password')
			)
		);		

		$raw->rules(
			array(
				'usuario'=>'required',
				'password'=>'required',				
			)
		);

		$raw->callbacks(
		array(
				'insert_before'=>array('class'=>'RawController','method'=>'callback_insert_usuario_before'),
				'update_before'=>array('class'=>'RawController','method'=>'callback_insert_usuario_before'),
			)
		);

		$tablas = array();				
		$tablaUsuario = UsuarioTabla::with('tabla')->where('usuario_id', Auth::user()->id)->get();
		foreach ($tablaUsuario as $tabla) {
			$arrayTabla =array('nombre' => $tabla->tabla->nombre, 'tabla' => $tabla->tabla->tabla);
			array_push($tablas, $arrayTabla);					
		}

		sort($tablas);
		$data = array();		
		$data['raw'] = $raw;
		$data['tablas'] = $tablas;			
		$data['raw_output'] = $raw->render();		
		$this->template_file = 'raw::raw';
		$this->layout = View::make($this->template_file, $data);
	}

	static function callback_insert_usuario_before($values)
	{
	        		
		$values['password'] = Hash::make($values['password']);
	        
		return $values;
	}

	public function UsuarioTabla($clave= false, $action = false,$id = false)
	{
		$usuario = Usuario::where('id', intval($clave))->first();
		$raw = new Osfed\L4CRUD\Raw($action,$id,$this); 		
		$raw->setTable('usuarios_tablas');		
		$raw->setTitle('Permisos del usuario '.$usuario->usuario);	
		$raw->where('usuario_id', $clave);
		$raw->fields(
			array(
				'id'=>array('type'=>'hidden','primary_key'=>true, 'column' => false, 'title' => 'Clave'),		        			    			      
			    'tabla_id'=>array('column'=>true, 'title' => 'Permiso'),
			    'usuario_id'=>array('type'=>'hidden', 'default' => $clave),
			)
		);		

		$raw->relation(
			array('field'=>'tabla_id','relation_table'=>'tablas','relation_column'=>'id','relation_display'=>'nombre','relation_order'=>array('nombre','desc'))
		);

		$raw->rules(
			array(											
				'tabla_id'=>'required',								
			)
		);

		$tablas = array();				
		$tablaUsuario = UsuarioTabla::with('tabla')->where('usuario_id', Auth::user()->id)->get();
		foreach ($tablaUsuario as $tabla) {
			$arrayTabla =array('nombre' => $tabla->tabla->nombre, 'tabla' => $tabla->tabla->tabla);
			array_push($tablas, $arrayTabla);					
		}

		sort($tablas);
		$data = array();		
		$data['raw'] = $raw;
		$data['tablas'] = $tablas;			
		$data['raw_output'] = $raw->render();		
		$this->template_file = 'raw::raw';
		$this->layout = View::make($this->template_file, $data);
	}

	public function Tablas($action = false,$id = false)
	{
		$raw = new Osfed\L4CRUD\Raw($action,$id,$this); 		
		$raw->setTable('tablas');		
		$raw->setTitle('Tablas');

		$raw->fields(
			array(
				'id'=>array('type'=>'hidden','primary_key'=>true, 'column' => true),
		        'nombre'=>array('column'=>true),
		        'tabla'=>array('column'=>true)
			)
		);		

		$raw->rules(
			array(
				'nombre'=>'required',
				'tabla'=>'required',				
			)
		);

		$tablas = array();		
		$tablaUsuario = UsuarioTabla::with('tabla')->where('usuario_id', Auth::user()->id)->get();
		foreach ($tablaUsuario as $tabla) {
			$arrayTabla =array('nombre' => $tabla->tabla->nombre, 'tabla' => $tabla->tabla->tabla);
			array_push($tablas, $arrayTabla);					
		}

		sort($tablas);
		$data = array();		
		$data['raw'] = $raw;
		$data['tablas'] = $tablas;			
		$data['raw_output'] = $raw->render();		
		$this->template_file = 'raw::raw';
		$this->layout = View::make($this->template_file, $data);
	}

}