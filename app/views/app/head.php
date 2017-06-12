<!DOCTYPE html>
<html lang="es">
<head>	
	<meta charset="<?php echo DB_ENCODE; ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo IMG; ?>favico.jpg">
    
    <title><?php echo $this->title; ?></title>
    <!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet">-->
    <!--<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>-->
    <!--<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>	-->
	
	<link href="<?php echo CSS; ?>bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo CSS; ?>bootstrap-editable.css" rel="stylesheet">
	<link href="<?php echo CSS; ?>font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo CSS; ?>localfonts.css" rel="stylesheet">
	<link href="<?php echo CSS; ?>styles.css" rel="stylesheet">
	<link href="<?php echo CSS; ?>app.css" rel="stylesheet">
	<script src="<?php echo JS; ?>assets/jquery.min.js"></script>
	<script src="<?php echo JS; ?>config.js"></script>

	<?php //echo GOOGLE_FONTS; ?>
	<?php echo GOOGLE_ANALYTICS; ?>

	<script data-main="<?php echo JS; ?>main-app" src="<?php echo JS; ?>assets/require.js"></script>
</head>
<body>
	<header class="head container-fluid">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h1><i class="heart glyphicon glyphicon-heart"></i> LIKES</h1>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<?php $this->render('default/navbar'); ?>
		</div>
	</header>
	
	<div class="container-fluid row">
 