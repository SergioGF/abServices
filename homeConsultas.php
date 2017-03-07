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
	
  </head>
  	 <?php
	require(__DIR__.'/includes/php/consultas.php');
	require(__DIR__.'/includes/php/clientes.php');
	require(__DIR__.'/includes/php/usuarios.php');
	$ws1 = false;
	$ws2 = false;
	$ws3 = false;
		if(isset($_POST['formAcumulados'])) { //Habrá que comprobar primero si existe el cliente.
			if(getCliente($_POST['conscliente'])){
			  header('Location: ./infoConsulta.php?cliente='.$_POST['conscliente'].'&fIni='.$_POST['consf1'].'&fFin='.$_POST['consf2'].'&tipo=1');
			}
			else{
				$ws1 = true;
				}
		}
		else if(isset($_POST['formConsFyC'])) { //Habrá que comprobar primero si existe el cliente.
			if(getCliente($_POST['conscliente'])){
			  header('Location: ./infoConsulta.php?cliente='.$_POST['conscliente'].'&fIni='.$_POST['consf1'].'&fFin='.$_POST['consf2'].'&tipo=2');
			}
			else{
				$ws2 = true;
			}
		}
		else if(isset($_POST['formTecnico'])) { //Habrá que comprobar primero si existe el técnico.
			if(getTecnico($_POST['constecnico'])){
			  header('Location: ./infoConsulta.php?tecnico='.$_POST['constecnico'].'&fIni='.$_POST['consf1'].'&fFin='.$_POST['consf2'].'&tipo=3');
			}
			else{
				$ws3 = true;
			}
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
						<div class="panel-heading" id="panelHead"><div class="text-center"><strong><span class="glyphicon glyphicon-filter"></span>Consultas de trabajos</strong></div></div><br>
						<div class="panel-body">
							<div class="row">
							<div class="col-md-2">
								<p> <strong>Consulta por: </strong></p>
							</div>
							<div class="col-md-3">
								<a ><button name="b2" class="btn btn-primary" id="b2" onclick="showContent2()"><strong>Cliente y fecha</strong></button></a> </br></br>
								<a ><button name="b3" class="btn btn-primary" id="b3" onclick="showContent3()"><strong>Técnico y fecha</strong></button></a><br><br>
								<a ><button name="b1" class="btn btn-primary" id="b1" onclick="showContent()"><strong>Acumulado de horas</strong></button></a></br></br>
							</div>
							<div class="col-md-7">
								<div class="alert alert-danger" style="display: none" id="infoWrongSearch1">
									<script type="text/javascript">
										function wrongSearch1() {
										  document.getElementById("infoWrongSearch1").style.display = 'block';
										  document.getElementById("b1").click();
										}
									</script>
									<strong>Error!</strong> No existe ningún cliente con ese Id en su consulta por Acumulados.
								</div>
								<div class="alert alert-danger" style="display: none" id="infoWrongSearch2">
									<script type="text/javascript">
										function wrongSearch2() {
										  document.getElementById("infoWrongSearch2").style.display = 'block';
										   document.getElementById("b2").click();
										}
									</script>
									<strong>Error!</strong> No existe ningún cliente con ese Id en su consulta por Fecha y Cliente.
								</div>
								<div class="alert alert-danger" style="display: none" id="infoWrongSearch3">
									<script type="text/javascript">
										function wrongSearch3() {
										  document.getElementById("infoWrongSearch3").style.display = 'block';
										  document.getElementById("b3").click();
										}
									</script>
									<strong>Error!</strong> No existe ningún técnico con ese Id.
								</div>
									<div id="content2" style="display: none;">
										<form method = "POST" action="" autocomplete="on" onSubmit="return validarDatos2()" class="form-horizontal" role="form">
											<div id="divUser2"><input id="conscliente2"  name="conscliente" required="required" class="form-control" placeholder="Id de cliente" maxlength="30"/></div> </br>
											<div class="form-group">  <label  class="col-lg-2 control-label" style="padding-right: 4px;">Fecha inicial: </label> <div class="col-lg-10"><input id="consf1" type="date"  name="consf1" class="form-control"/></div></div>
											<div class="form-group">  <label  class="col-lg-2 control-label">Fecha final: </label> <div class="col-lg-10"><input id="consf2" type="date"  name="consf2" class="form-control" value="<?php $ahora = time(); $formateado= date('Y-m-d', $ahora); echo $formateado?>"/></div></div><br>
											<button type="submit" id="sub2" style="float:right" class="btn btn-primary" name="formConsFyC" value="Sign in"><strong>Buscar</strong></button>
										</form>
									</div>
									<div id="content3" style="display: none;">
										<form method = "POST" action="" autocomplete="on" onSubmit="return validarDatos3()" class="form-horizontal" role="form">
											<div id="divTec"> <input id="constecnico"  name="constecnico" required="required" class="form-control" placeholder="Id del tecnico" maxlength="3"/><br></div>
											<div class="form-group">  <label  class="col-lg-2 control-label" style="padding-right: 4px;">Fecha inicial: </label> <div class="col-lg-10"><input id="consf1" type="date"  name="consf1" class="form-control" placeholder="Fecha inicial"/></div></div>
											<div class="form-group">  <label  class="col-lg-2 control-label">Fecha final: </label> <div class="col-lg-10"><input id="consf2" type="date"  name="consf2" class="form-control" value="<?php $ahora = time(); $formateado= date('Y-m-d', $ahora); echo $formateado?>"/></div></div><br>
											 <button type="submit" id="sub3" style="float:right" class="btn btn-primary" name="formTecnico" value="Sign in"><strong>Buscar</strong></button>
										</form>								
									</div>
									<div id="content1" style="display: none;">
										<form method = "POST" action="" autocomplete="on" onSubmit="return validarDatos()" class="form-horizontal" role="form">
											 <div id="divUser"><input id="conscliente"  name="conscliente" required="required" class="form-control" placeholder="Id del cliente" maxlength="30"/><br></div>
											<div class="form-group">  <label  class="col-lg-2 control-label" style="padding-right: 4px;">Fecha inicial: </label> <div class="col-lg-10"><input id="consf1" type="date"  name="consf1" class="form-control" placeholder="Fecha inicial"/></div></div>
											<div class="form-group">  <label  class="col-lg-2 control-label">Fecha final: </label> <div class="col-lg-10"><input id="consf2" type="date"  name="consf2" class="form-control" value="<?php $ahora = time(); $formateado= date('Y-m-d', $ahora); echo $formateado?>"/></div></div><br>
											 <button type="submit" id="sub1" style="float:right" class="btn btn-primary" name="formAcumulados" value="Sign in"><strong>Buscar</strong></button>
										</form>
									</div>								
							</div>
							</div>
						</div>
						</div>
						</div>
		
			<script type="text/javascript">
				function showContent() {
					document.getElementById("content1").style.display = "block";
					document.getElementById("content2").style.display = "none";
					document.getElementById("content3").style.display = "none";
					document.getElementById("b1").style.backgroundColor = "#161e45";
					document.getElementById("b2").style.backgroundColor = "#286090";
					document.getElementById("b3").style.backgroundColor = "#286090";
				}
				
				function showContent2() {
				   document.getElementById("content2").style.display = "block";
				   document.getElementById("content1").style.display = "none";
				   document.getElementById("content3").style.display = "none";
				   document.getElementById("b2").style.backgroundColor = "#161e45";
					document.getElementById("b1").style.backgroundColor = "#286090";
					document.getElementById("b3").style.backgroundColor = "#286090";
				}
				
				function showContent3() {
				   document.getElementById("content3").style.display = "block";
				   document.getElementById("content1").style.display = "none";
				   document.getElementById("content2").style.display = "none";
				   document.getElementById("b3").style.backgroundColor = "#161e45";
					document.getElementById("b2").style.backgroundColor = "#286090";
					document.getElementById("b1").style.backgroundColor = "#286090";
				}
				function validarDatos() {
				var p1 = document.getElementById("conscliente").value;
				var espacios1 = false;
				var cont = 0;
				while (!espacios1 && (cont < p1.length)) {
				  if (p1.charAt(cont) == " ")
					espacios1 = true;
				  cont++;
				}
				if (espacios1) {
				  document.getElementById("conscliente").value ="";
				  document.getElementById("conscliente").placeholder ="El Id no puede contener espacios en blanco";
				  document.getElementById("divUser").className = "form-group has-error has-feedback";
				  return false;
				}
				}
				function validarDatos2() {
				var p1 = document.getElementById("conscliente2").value;
				var espacios1 = false;
				var cont = 0;
				while (!espacios1 && (cont < p1.length)) {
				  if (p1.charAt(cont) == " ")
					espacios1 = true;
				  cont++;
				}
				if (espacios1) {
				  document.getElementById("conscliente2").value ="";
				  document.getElementById("conscliente2").placeholder ="El Id no puede contener espacios en blanco";
				  document.getElementById("divUser2").className = "form-group has-error has-feedback";
				  return false;
				}
				}
				function validarDatos3() {
				var p1 = document.getElementById("constecnico").value;
				var espacios1 = false;
				var cont = 0;
				while (!espacios1 && (cont < p1.length)) {
				  if (p1.charAt(cont) == " ")
					espacios1 = true;
				  cont++;
				}
				if (espacios1) {
				  document.getElementById("constecnico").value ="";
				  document.getElementById("constecnico").placeholder ="El Id no puede contener espacios en blanco";
				  document.getElementById("divTec").className = "form-group has-error has-feedback";
				  return false;
				}
				}
		</script>
		<?php
		if($ws1 == true){
			echo "<script>";
			echo "wrongSearch1();";
			echo "</script>";
		}
		else if($ws2 == true){
			echo "<script>";
			echo "wrongSearch2();";
			echo "</script>";
		}
		else if($ws3 == true){
			echo "<script>";
			echo "wrongSearch3();";
			echo "</script>";
		}
		?>
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="includes/js/bootstrap.min.js"></script>
  </body>
</html>
<?php require(__DIR__.'/includes/php/cleanup.php');?>