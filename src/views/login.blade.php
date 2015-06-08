<!DOCTYPE html>
<html>
<head>
	<title>Administrador</title>
	<base href="<?php echo URL::to('/')?>"/>
	<meta charset="utf-8" />	
	<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="{{asset('/packages/osfed/l4crud/css/adminTemplate.css')}}">	
	<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->	
</head>
<body class="l4crud-login">  
	<header class="l4crud-headerlogin">		
		<img src="{{asset('/packages/osfed/l4crud/images/logoAdmin.jpg')}}">
	</header>	
	<form class="l4crud-form-login" method="post" action="{{Route('login')}}">
		<div>
			<label>Usuario</label>
			<input type="text" name="usuario">
		</div>		
		<div>
			<label>Contraseña</label>
			<input type="password" name="password">
		</div>		
		<button>Entrar</button>
	</form>
	<footer class="l4crud-footerlogin">
		Av. Panorama No. 314 • Panorama • León, Gto. • Tel. 01 (477) 716 50 86 • ID 52 * 33496 * 9 • ideas@quimaira.com
	</footer>
</body>
</html>