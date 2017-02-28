<?php require_once __DIR__.'/includes/php/config.php';?>
<!DOCTYPE html>
<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<html lang="en">
  <head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="./includes/css/logo2.jpg" />

    <title>abServices</title>
 
    <!-- CSS de Bootstrap -->
    <link href="includes/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
	<link rel="stylesheet" type="text/css" href="includes/css/style.css"> 
	<script type="text/javascript" src="includes/jquery/jquery-3.1.1.js"></script>
	<script type="text/javascript">
    function showContent() {
       $('#content1').toggle();
    }
	
	function showContent2() {
       $('#content2').toggle();
    }
	
	function showContent3() {
       $('#content3').toggle();
    }
	</script>
  </head>
  <?php
	require(__DIR__.'/includes/php/consultas.php');
		if(isset($_POST['formConsCliente'])) { //Habrá que comprobar primero si existe el cliente.
			  header('Location: ./infoConsulta.php?cliente='.$_POST['conscliente'].'&tipo=1');
		}
		if(isset($_POST['formConsFyC'])) { //Habrá que comprobar primero si existe el cliente.
			  header('Location: ./infoConsulta.php?cliente='.$_POST['conscliente'].'&fIni='.$_POST['consf1'].'&fFin='.$_POST['consf2'].'&tipo=2');
		}
		if(isset($_POST['formTecnico'])) { //Habrá que comprobar primero si existe el técnico.
			  header('Location: ./infoConsulta.php?tecnico='.$_POST['constecnico'].'&tipo=3');
		}
	?>
  <body>
		<nav class="navbar navbar-default" role="navigation" id="navSup">
			<div class="navbar-header" id="navSupHeader">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
						data-target=".navbar-ex1-collapse">
				  <span class="sr-only">Desplegar navegación</span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="homeClientes.php"><span class="glyphicon glyphicon-home"></span> abServices</a>
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse" id="navSupDerecha">
			 
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#"><span class="glyphicon glyphicon-user"></span>  <?php echo $_SESSION["usuario"] ?></a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"> Configuración <span class="glyphicon glyphicon-menu-hamburger"></span></a>
						<ul class="dropdown-menu">
						  <li><a href="#">Cambiar nombre</a></li>
						  <li><a href="cambiarPass.php">Cambiar contraseña</a></li>
						  <li><a href="login.php">Cerrar Sesión </a></li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
		<?php/* include 'headerUser.php'; */?>
		<div class="jumbotron">
				<div class="container">
				<h2 id="cab2">Consultas de trabajos</h2> 
				</div>
		</div>
			
		<div class="container-fluid">
						<div class="panel panel-primary" >
						<div class="panel-heading" id="panelHead"><div class="text-center"><strong><img id="margenIm" src="./includes/css/lupa.png">Consultas de trabajos</strong></div></div>
						<div class="panel-body">
							<center>
								<a href=""><button name="b1" class="btn btn-primary" onclick="showContent()"><strong>Cliente</strong></button></a>
								<a href=""><button name="b2" class="btn btn-primary" onclick="showContent2()"><strong>Fecha y cliente</strong></button></a>
								<a href=""><button name="b3" class="btn btn-primary" onclick="showContent3()"><strong>Técnico</strong></button></a>
								<div id="content1" style="display: none;">
									<form method = "POST" action="" autocomplete="on" class="form-horizontal" role="form">
										 <input id="conscliente"  name="conscliente" required="required" class="form-control" placeholder="Id de cliente" maxlength="30"/>
										 <button type="submit" class="btn btn-primary" name="formConsCliente" value="Sign in"><strong>Buscar</strong></button>
									</form>
								</div>
								<div id="content2" style="display: none;">
									<form method = "POST" action="" autocomplete="on" class="form-horizontal" role="form">
										<input id="conscliente"  name="conscliente" required="required" class="form-control" placeholder="Id de cliente" maxlength="30"/>
										Fecha inicial: <input id="consf1" type="date"  name="consf1" required="required" class="form-control" placeholder="Fecha inicial"/>
										Fecha final: <input id="consf2" type="date"  name="consf2" required="required" class="form-control" placeholder="Fecha final"/>
										<button type="submit" class="btn btn-primary" name="formConsFyC" value="Sign in"><strong>Buscar</strong></button>
									</form>
								</div>
								<div id="content3" style="display: none;">
									<form method = "POST" action="" autocomplete="on" class="form-horizontal" role="form">
										 <input id="constecnico"  name="constecnico" required="required" class="form-control" placeholder="Id del tecnico" maxlength="3"/>
										 <button type="submit" class="btn btn-primary" name="formTecnico" value="Sign in"><strong>Buscar</strong></button>
									</form>								
								</div>
							</center>
						</div>
						</div>
						</div>
		
		
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="includes/js/bootstrap.min.js"></script>
  </body>
</html>
<?php require(__DIR__.'/includes/php/cleanup.php');?>