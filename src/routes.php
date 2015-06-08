<?php

	Route::get('/admin', array('before' => 'auth', 'as' => 'admin', 'uses' => 'RawController@Welcome'));
	Route::get('/logout', array('as' => 'salir', 'uses' => 'RawController@Logout'));
	Route::get('/login', array('as' => 'login', 'uses' => 'RawController@Login'));
	Route::post('/login', 'RawController@LoginPost');
