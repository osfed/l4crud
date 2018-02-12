<?php

	Route::get('/admin', array('before' => 'auth', 'as' => 'admin', 'uses' => 'RawController@Welcome'));
	Route::get('/logout', array('as' => 'salir', 'uses' => 'RawController@Logout'));
	Route::get('/login', array('as' => 'login', 'uses' => 'RawController@Login'));
	Route::post('/login', 'RawController@LoginPost');

	Route::match(array('GET', 'POST'),'/admin/tablas/{action?}/{id?}', array('before' => 'auth', 'uses' => 'RawController@Tablas'));
	Route::match(array('GET', 'POST'),'/admin/usuarios/{action?}/{id?}', array('before' => 'auth', 'uses' => 'RawController@Usuarios'));
	Route::match(array('GET', 'POST'),'/admin/usuario/{clave?}/{action?}/{id?}', array('before' => 'auth', 'uses' => 'RawController@UsuarioTabla'));

	Route::post('/upload-images', array('as' => 'rawUploadImages', 'uses' => 'RawController@UploadImages'));
	Route::post('/remove-images', array('as' => 'rawRemoveImages', 'uses' => 'RawController@RemoveImages'));
