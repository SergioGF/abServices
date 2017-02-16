<?php require_once(__DIR__.'/includes/php/config.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="./includes/css/logo2.jpg" />

    <title>AbServices</title>
 
    <!-- CSS de Bootstrap -->
    <link href="./includes/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
	<link rel="stylesheet" type="text/css" href="./includes/css/stylelogin.css"> 
	<script type="text/javascript" src="./includes/jquery/jquery-3.1.1.js"></script>
  </head>
  <?php
	require(__DIR__.'/includes/php/usuarios.php');
		if(isset($_POST['formLogin'])) {
			$result = formLogin($_POST);
		}
	?>
  <body>
		
			<div class="jumbotron">
				<div class="container">
				<img src="./includes/css/logo2.jpg" class="img-responsive" alt="Imagen responsive" id="cab1">
				<h1 id="cab2">abServices</h1> 
				<p>Asesoría, consultoría y servicios informáticos para empresas y centros educativos</p>
				</div>
			</div>
			<div class="container-fluid">
			<div class="row">
				<div class="col-md-1" id="vacio"><h3> <div class="container-fluid"> </div> </h3></div>
				<div class="col-md-4" id="zonaFormulario">
					<!--Formulario -->
					<div class="contener-fluid">
					<div class="panel panel-primary" >
						<div class="panel-heading" id="panelHead"><div class="text-center"><strong>Entrar en abServices</strong></div></div>
						<div class="panel-body">
						<form method = "POST" action="" autocomplete="on" class="form-horizontal" role="form">
							<?php 
                                    if(isset($result)){
                                        echo '<ul>';
                                        foreach($result as $error){
                                            echo '<li class = "errorLogin">'.$error.'</li>';
                                        }
                                        echo '</ul>';
                                    }
                            ?>
							<div class="form-group">
								<div class="container-fluid">
								  <input id="usuario" type="text" name="usuario" required="required" class="form-control" placeholder="Usuario"/>
								</div>
							</div>
							<div class="form-group">
								<div class="container-fluid">
								  <input id="password" type="password" name="password" required="required" class="form-control" placeholder="Contraseña"/>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-offset-4 col-lg-11">
								  <div class="center-block"><button type="submit" class="btn btn-primary" name="formLogin" value="Sign in"><strong>Iniciar sesión</strong></button></div>
								</div>
							</div>
						</form>
						</div>
						<div class="panel-footer"><div class="text-center">¿Has olvidado la contraseña? <a href="olvidacontrasena"> Soluciónalo </a></div></div>
					</div>
					</div>
				</div>
					<!--Fin formulario -->
				
				<div class="col-md-7"></div>
			</div>
			</div>
		
		  
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="./includes/js/bootstrap.min.js"></script>
  </body>
</html>
<?php require(__DIR__.'/includes/php/cleanup.php');?>