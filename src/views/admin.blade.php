<!DOCTYPE html>
<html>
<head>
	<title>Administrador</title>
	<base href="<?php echo URL::to('/')?>"/>
	<meta charset="utf-8" />
	<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>	
	<?php 
	foreach($raw->css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo URL::to($file); ?>" />
	<?php endforeach; ?>
	<?php foreach($raw->js_files as $file): ?>
		<script src="<?php echo URL::to($file); ?>"></script>
	<?php endforeach; ?>
	<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body class="example">  
	<header class="l4crud-header">
		<figure>
			<img src="{{asset('/packages/osfed/l4crud/images/logo.png')}}" alt="Quimaira">
		</figure>
		<h1 class="l4crud-title">Administrador</h1>
		<div class="menu-header">
			<a href="{{Route('salir')}}">Salir</a>
			<a href="{{Route('home')}}" target="blank">Mi sitio web</a>
		</div>
	</header>
	<section class="l4crud-contenido">
		<div class="tablas">			
			<div class="tabla">
				<h3>Contenido</h3>
				<div class="contenido">				
					@foreach ($tablas as $tabla)
						<a href="{{Route('admin')}}/{{$tabla['tabla']}}">{{$tabla['nombre']}}</a>
					@endforeach									
				</div>
			</div>
		</div>
		<div class="datos">			
		</div>
	</section>	
</body>
</html>