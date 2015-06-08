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

		$tablaUsuario = UsuarioTabla::with('tabla')->where('idUsuario', Auth::user()->idUsuario)->get();
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
			return Redirect::to('/admin');
		} else {			
			return Redirect::to('/login');
		}		
	}

	public function Logout()
	{		
		Auth::logout();
		return Redirect::to('/login');
	}

}