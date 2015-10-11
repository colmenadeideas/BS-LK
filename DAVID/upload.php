<!DOCTYPE html>
<html lang="es">
<head>	
	<meta charset="<?php echo DB_ENCODE; ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="public/images/favico.jpg">
    
    
    <title>LIKES</title>
	
	<link href="public/css/bootstrap.min.css" rel="stylesheet">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet">
	<!--<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>-->
	<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
	<link href="public/css/styles.css" rel="stylesheet">
	<link type="text/css" href="css/jquery-ui.min.css" rel="Stylesheet" /> 
	<link rel="stylesheet" type="text/css" href="./public/css/style.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="public/js/jquery-ui.min.js"></script> 
	<script src="//www.dropzonejs.com/new-js/dropzone.js?v=1423494334"></script>


</head>
    <header class="head">
        <h1><i class="heart glyphicon glyphicon-heart"></i> LIKES</h1>
    </header>
<body>
	<div class="hidden">
		<form class="upload" role="form">
			<div class="form-group">
				<input type="text" placeholder="Escribe el texto que acompana la imagen" name="titulo" class="titulo form-control" id="title">
			</div>
			<div class="form-group users">
				<input type="text" placeholder="Agregar usuarios" name="users" class="acomplete form-control" id="title">
				<div></div>
			</div>
			<button class="submit" type="button" class="btn btn-default">GUARDAR</button>
		</form>
	</div>
	<div id="dropzone" class="dropzone"></div>
	<script type="text/javascript" src="./public/js/preview.js"></script>

</body>
</body>
</html>