<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>correo</title>
	   <style>
		   .titulo {
			    color: #4672F8;
			    padding-top: 20px;
			    padding-bottom: 10px;
			    padding-left: 20px;
			    padding-right: 20px;
		    }
		    .body{
		    	background-color: #ECECEC;	
		    }
		    .div_contenido{
			    color: #1e80b6;
			    padding-top: 20px;
			    padding-bottom: 10px;
			    padding-left: 20px;
			    padding-right: 20px;
			    background-color: #ffffff !important;
		   }
	   </style>
	</head> 
	<body class="body">
		<div class="titulo" ><center><h3>{{ $header }}</h3></center></div>
		<hr>
		<div class=".div_contenido">
			<div>
				<br>
					Estima@ {{ $usrNombreFull }}. Esta notificación es para informarle que ha sido solicitada una recuperación de contraseña para su usuario. Su nueva clave es: <b>{{ $pass }}</b>
				<br>
				<br>
					Si usted desconoce esta solicitud contacte al administrador del sistema.
				<br><br>
			</div>
		</div>
		<div class=".div_contenido"> 
			<b>
				{{ $footer }}
			</b>
		</div>
		<br />
	</body>
</html>