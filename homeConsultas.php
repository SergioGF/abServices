<?php require_once __DIR__.'/includes/php/config.php';?>
<!DOCTYPE html>
<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if($_SESSION["tipo"] != 1 && $_SESSION["tipo"] != 2 && $_SESSION["tipo"] != 3)
		header('Location: ./login.php');
?>
<html lang="en">
  <head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="./includes/css/abs_logo.jpg" />

    <title>abServices</title>
 
    <!-- CSS de Bootstrap -->
    <link href="includes/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
	<link rel="stylesheet" type="text/css" href="includes/css/style.css"> 
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
 $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '< Ant',
 nextText: 'Sig >',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
// dateFormat: 'yy-mm-dd',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
$("#fecha").datepicker();
});
</script>
<script>
  $( function() {
    $( "#consf11" ).datepicker();
  } );
   $( function() {
    $( "#consf12" ).datepicker();
  } );
   $( function() {
    $( "#consf13" ).datepicker();
  } );
   $( function() {
    $( "#consf14" ).datepicker();
  } );
  $( function() {
    $( "#consf21" ).datepicker();
  } );
  $( function() {
    $( "#consf22" ).datepicker();
  } );
  $( function() {
    $( "#consf23" ).datepicker();
  } );
  $( function() {
    $( "#consf24" ).datepicker();
  } );
  </script>
	

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
		else if(isset($_POST['formFechas'])) { //Habrá que comprobar primero si existe el cliente.
			  header('Location: ./infoConsulta.php?fIni='.$_POST['consf1'].'&fFin='.$_POST['consf2'].'&tipo=4');
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
				<!--<a class="navbar-brand" href="homeClientes.php"><span class="glyphicon glyphicon-home"></span> abServices</a>-->
				<a class="navbar-brand" href="homeClientes.php"><img src="./includes/css/home.jpg" class="img-responsive" alt="Imagen responsive"></a>
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
							<div class="col-md-4">
								<a ><button name="b2" class="btn btn-primary" id="b2" onclick="showContent2()"><strong>Cliente</strong></button></a> </br></br>
								<a ><button name="b3" class="btn btn-primary" id="b3" onclick="showContent3()"><strong>Técnico</strong></button></a><br><br>
								<a ><button name="b4" class="btn btn-primary" id="b4" onclick="showContent4()"><strong>Fechas</strong></button></a><br><br>
								<a ><button name="b1" class="btn btn-primary" id="b1" onclick="showContent()"><strong>Acumulado de horas</strong></button></a></br></br>
							</div>
							<div class="col-md-5">
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
									<strong>Error!</strong> No existe ningún cliente con ese Id.
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
											<div class="form-group" id="divUser2">  <label  class="col-lg-4 control-label" style="padding-right: 4px;">Id del cliente: </label> <div class="col-lg-8"><input id="conscliente2"  name="conscliente" required="required" class="form-control" placeholder="Id del cliente" maxlength="30"/></div></div>
											<div class="form-group">  <label  class="col-lg-4 control-label" style="padding-right: 4px;">Fecha inicial: </label> <div class="col-lg-8"><input id="consf11" type="text"  name="consf1" class="form-control" placeholder="Fecha inicial"/></div></div>
											<div class="form-group">  <label  class="col-lg-4 control-label">Fecha final: </label> <div class="col-lg-8"><input id="consf21" type="text"  name="consf2" class="form-control" value="<?php $ahora = time(); $formateado= date('d/m/Y', $ahora); echo $formateado?>"/></div></div><br>
											<button type="submit" id="sub2" style="float:right" class="btn btn-primary" name="formConsFyC" value="Sign in"><strong>Buscar</strong></button>
										</form>
									</div>
									<div id="content3" style="display: none;">
										<form method = "POST" action="" autocomplete="on" onSubmit="return validarDatos3()" class="form-horizontal" role="form">
											<div class="form-group" id="divTec">  <label  class="col-lg-4 control-label" style="padding-right: 4px;">Id del técnico: </label> <div class="col-lg-8"><input id="constecnico"  name="constecnico" required="required" class="form-control" placeholder="Id del tecnico" maxlength="3"/></div></div>
											<div class="form-group">  <label  class="col-lg-4 control-label" style="padding-right: 4px;">Fecha inicial: </label> <div class="col-lg-8"><input id="consf12" type="text"  name="consf1" class="form-control" placeholder="Fecha inicial"/></div></div>
											<div class="form-group">  <label  class="col-lg-4 control-label">Fecha final: </label> <div class="col-lg-8"><input id="consf22" type="text"  name="consf2" class="form-control" value="<?php $ahora = time(); $formateado= date('d/m/Y', $ahora); echo $formateado?>"/></div></div><br>
											 <button type="submit" id="sub3" style="float:right" class="btn btn-primary" name="formTecnico" value="Sign in"><strong>Buscar</strong></button>
										</form>								
									</div>
									<div id="content4" style="display: none;">
										<form method = "POST" action="" autocomplete="on" onSubmit="return validarDatos4()" class="form-horizontal" role="form">
											<div class="form-group">  <label  class="col-lg-4 control-label" style="padding-right: 4px;">Fecha inicial: </label> <div class="col-lg-8"><input id="consf13" type="text"  name="consf1" class="form-control" placeholder="Fecha inicial"/></div></div>
											<div class="form-group">  <label  class="col-lg-4 control-label">Fecha final: </label> <div class="col-lg-8"><input id="consf23" type="text"  name="consf2" class="form-control" value="<?php $ahora = time(); $formateado= date('d/m/Y', $ahora); echo $formateado?>"/></div></div><br>
											 <button type="submit" id="sub4" style="float:right" class="btn btn-primary" name="formFechas" value="Sign in"><strong>Buscar</strong></button>
										</form>								
									</div>
									<div id="content1" style="display: none;">
										<form method = "POST" action="" autocomplete="on" onSubmit="return validarDatos()" class="form-horizontal" role="form">
											<div class="form-group" id="divUser2">  <label  class="col-lg-4 control-label" style="padding-right: 4px;">Id del cliente: </label> <div class="col-lg-8"><input id="conscliente"  name="conscliente" required="required" class="form-control" placeholder="Id del cliente" maxlength="30"/></div></div>
											<div class="form-group">  <label  class="col-lg-4 control-label" style="padding-right: 4px;">Fecha inicial: </label> <div class="col-lg-8"><input id="consf14" type="text"  name="consf1" class="form-control" placeholder="Fecha inicial"/></div></div>
											<div class="form-group">  <label  class="col-lg-4 control-label">Fecha final: </label> <div class="col-lg-8"><input id="consf24" type="text"  name="consf2" class="form-control" value="<?php $ahora = time(); $formateado= date('d/m/Y', $ahora); echo $formateado?>"/></div></div><br>
											 <button type="submit" id="sub1"  style="float:right" class="btn btn-primary" name="formAcumulados" value="Sign in"><strong>Buscar</strong></button>
										</form>
									</div>								
							</div>
							<div class="col-md-1">
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
					document.getElementById("content4").style.display = "none";
					document.getElementById("b1").style.backgroundColor = "#161e45";
					document.getElementById("b2").style.backgroundColor = "#5284d4";
					document.getElementById("b3").style.backgroundColor = "#5284d4";
					document.getElementById("b4").style.backgroundColor = "#5284d4";
				}
				
				function showContent2() {
				   document.getElementById("content2").style.display = "block";
				   document.getElementById("content1").style.display = "none";
				   document.getElementById("content3").style.display = "none";
				   document.getElementById("content4").style.display = "none";
				   document.getElementById("b2").style.backgroundColor = "#161e45";
					document.getElementById("b1").style.backgroundColor = "#5284d4";
					document.getElementById("b3").style.backgroundColor = "#5284d4";
					document.getElementById("b4").style.backgroundColor = "#5284d4";
				}
				
				function showContent3() {
				   document.getElementById("content3").style.display = "block";
				   document.getElementById("content1").style.display = "none";
				   document.getElementById("content2").style.display = "none";
				   document.getElementById("content4").style.display = "none";
				   document.getElementById("b3").style.backgroundColor = "#161e45";
					document.getElementById("b2").style.backgroundColor = "#5284d4";
					document.getElementById("b1").style.backgroundColor = "#5284d4";
					document.getElementById("b4").style.backgroundColor = "#5284d4";
				}
				
				function showContent4() {
				   document.getElementById("content4").style.display = "block";
				   document.getElementById("content1").style.display = "none";
				   document.getElementById("content2").style.display = "none";
				   document.getElementById("content3").style.display = "none";
				   document.getElementById("b4").style.backgroundColor = "#161e45";
					document.getElementById("b2").style.backgroundColor = "#5284d4";
					document.getElementById("b1").style.backgroundColor = "#5284d4";
					document.getElementById("b3").style.backgroundColor = "#5284d4";
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
				var orig = document.getElementById("consf14").value; // 23/04/2017 --> 2017-04-23 
				var format = "";
				format = format.concat(orig.charAt(6));
				format = format.concat(orig.charAt(7));
				format = format.concat(orig.charAt(8));
				format = format.concat(orig.charAt(9));
				format = format.concat("-");
				format = format.concat(orig.charAt(3));
				format = format.concat(orig.charAt(4));
				format = format.concat("-");
				format = format.concat(orig.charAt(0));
				format = format.concat(orig.charAt(1));
				document.getElementById("consf14").value = format;
				
				var orig = document.getElementById("consf24").value; // 23/04/2017 --> 2017-04-23 
				var format = "";
				format = format.concat(orig.charAt(6));
				format = format.concat(orig.charAt(7));
				format = format.concat(orig.charAt(8));
				format = format.concat(orig.charAt(9));
				format = format.concat("-");
				format = format.concat(orig.charAt(3));
				format = format.concat(orig.charAt(4));
				format = format.concat("-");
				format = format.concat(orig.charAt(0));
				format = format.concat(orig.charAt(1));
				document.getElementById("consf24").value = format;
				
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
				var orig = document.getElementById("consf21").value; // 23/04/2017 --> 2017-04-23 
				var format = "";
				format = format.concat(orig.charAt(6));
				format = format.concat(orig.charAt(7));
				format = format.concat(orig.charAt(8));
				format = format.concat(orig.charAt(9));
				format = format.concat("-");
				format = format.concat(orig.charAt(3));
				format = format.concat(orig.charAt(4));
				format = format.concat("-");
				format = format.concat(orig.charAt(0));
				format = format.concat(orig.charAt(1));
				document.getElementById("consf21").value = format;
				
				var orig = document.getElementById("consf11").value; // 23/04/2017 --> 2017-04-23 
				var format = "";
				format = format.concat(orig.charAt(6));
				format = format.concat(orig.charAt(7));
				format = format.concat(orig.charAt(8));
				format = format.concat(orig.charAt(9));
				format = format.concat("-");
				format = format.concat(orig.charAt(3));
				format = format.concat(orig.charAt(4));
				format = format.concat("-");
				format = format.concat(orig.charAt(0));
				format = format.concat(orig.charAt(1));
				document.getElementById("consf11").value = format;
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
				var orig = document.getElementById("consf12").value; // 23/04/2017 --> 2017-04-23 
				var format = "";
				format = format.concat(orig.charAt(6));
				format = format.concat(orig.charAt(7));
				format = format.concat(orig.charAt(8));
				format = format.concat(orig.charAt(9));
				format = format.concat("-");
				format = format.concat(orig.charAt(3));
				format = format.concat(orig.charAt(4));
				format = format.concat("-");
				format = format.concat(orig.charAt(0));
				format = format.concat(orig.charAt(1));
				document.getElementById("consf12").value = format;
				
				var orig = document.getElementById("consf22").value; // 23/04/2017 --> 2017-04-23 
				var format = "";
				format = format.concat(orig.charAt(6));
				format = format.concat(orig.charAt(7));
				format = format.concat(orig.charAt(8));
				format = format.concat(orig.charAt(9));
				format = format.concat("-");
				format = format.concat(orig.charAt(3));
				format = format.concat(orig.charAt(4));
				format = format.concat("-");
				format = format.concat(orig.charAt(0));
				format = format.concat(orig.charAt(1));
				document.getElementById("consf22").value = format;
				}
				function validarDatos4() {
				var orig = document.getElementById("consf13").value; // 23/04/2017 --> 2017-04-23 
				var format = "";
				format = format.concat(orig.charAt(6));
				format = format.concat(orig.charAt(7));
				format = format.concat(orig.charAt(8));
				format = format.concat(orig.charAt(9));
				format = format.concat("-");
				format = format.concat(orig.charAt(3));
				format = format.concat(orig.charAt(4));
				format = format.concat("-");
				format = format.concat(orig.charAt(0));
				format = format.concat(orig.charAt(1));
				document.getElementById("consf13").value = format;
				
				var orig = document.getElementById("consf23").value; // 23/04/2017 --> 2017-04-23 
				var format = "";
				format = format.concat(orig.charAt(6));
				format = format.concat(orig.charAt(7));
				format = format.concat(orig.charAt(8));
				format = format.concat(orig.charAt(9));
				format = format.concat("-");
				format = format.concat(orig.charAt(3));
				format = format.concat(orig.charAt(4));
				format = format.concat("-");
				format = format.concat(orig.charAt(0));
				format = format.concat(orig.charAt(1));
				document.getElementById("consf23").value = format;
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
		<!--<script src="http://code.jquery.com/jquery.js"></script>-->
		<script src="includes/js/bootstrap.min.js"></script>
  </body>
</html>
<?php require(__DIR__.'/includes/php/cleanup.php');?>