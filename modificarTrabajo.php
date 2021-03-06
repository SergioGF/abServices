﻿<?php require_once __DIR__.'/includes/php/config.php';?>
<!DOCTYPE html>
<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if($_SESSION["tipo"] == 1)
		header('Location: ./login.php');
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

	<?php
	$id=$_GET['idTrabajo']; 
	$cliente =$_GET['cliente']; 
	?>
	
    <title>abServices</title>
 
    <!-- CSS de Bootstrap -->
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
		 //dateFormat: 'yy-mm-dd',
		 firstDay: 1,
		 isRTL: false,
		 showMonthAfterYear: false,
		 yearSuffix: ''
		 };
		 $.datepicker.setDefaults($.datepicker.regional['es']);
	</script>
	<script>
	  $( function() {
		$( "#cajaFecha" ).datepicker();
	  } );
	</script>
	<script type="text/javascript">
    function showContent() {
        element = document.getElementById("content");
        check = document.getElementById("check");
        if (check.checked) {
            element.style.display='table-row';
        }
        else {
            element.style.display='none';
        }
    }
</script>
	<script type="text/javascript">
	function formTipo(t) {
			document.getElementById("inputTipo").value=t;
			if(t == "CC"){
			document.getElementById("tipo1").style.backgroundColor = "#161e45";
			document.getElementById("tipo2").style.backgroundColor = "#286090";
			document.getElementById("tipo3").style.backgroundColor = "#286090";
			document.getElementById("tipo4").style.backgroundColor = "#286090";
			}
			else if(t == "OF"){
			document.getElementById("tipo1").style.backgroundColor = "#286090";
			document.getElementById("tipo2").style.backgroundColor = "#161e45";
			document.getElementById("tipo3").style.backgroundColor = "#286090";
			document.getElementById("tipo4").style.backgroundColor = "#286090";
			}
			else if(t == "AR"){
			document.getElementById("tipo1").style.backgroundColor = "#286090";
			document.getElementById("tipo2").style.backgroundColor = "#286090";
			document.getElementById("tipo3").style.backgroundColor = "#161e45";
			document.getElementById("tipo4").style.backgroundColor = "#286090";
			} else if(t == "AT") {
			document.getElementById("tipo1").style.backgroundColor = "#286090";
			document.getElementById("tipo2").style.backgroundColor = "#286090";
			document.getElementById("tipo3").style.backgroundColor = "#286090";
			document.getElementById("tipo4").style.backgroundColor = "#161e45";				
			}
		}
	</script>
  </head>
  <?php
	require(__DIR__.'/includes/php/trabajos.php');
		if(isset($_POST['formRTrabajo'])) {
			$result = formModTrabajo($_POST,$cliente,$id);
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
				<h2 id="cab2">Modificar trabajo a <?php echo $cliente?></h2> 
				</div>
		</div>
		<?php 
		$trabajo = conseguirInfoTrabajo($id);
		?>
		<div class="container-fluid">
			<div class="panel panel-primary" >
						<div class="panel-heading" id="panelHead"><div class="text-center"><strong>Modificar trabajo</strong></div></div>

						<form method = "POST" action="" autocomplete="on" onSubmit="return validarDatos()" class="form-horizontal" role="form">
					
						<div class="panel-body">
							<center>
							<table border="0" cellpadding="0" cellspacing="2" width="50%">
								<tr>
								  <td width="70%"><strong id="nombresForm">Descripción:</strong></td> <td width="30%"><textarea id="cajas" name="descripcion" required="required" rows="5" cols="35"> <?php echo $trabajo["Descripcion"]?></textarea></td>
								</tr>
								<tr>
								  <td width="70%"><strong id="nombresForm">Trabajo realizado por:</strong></td> <td width="30%"><p id="cajas" name="tecnico" rows="5" cols="35"> <?php echo $trabajo["Trabajador"]?></a></td>
								</tr>
								<tr>
								 <td width="70%"><strong>Ubicación:</strong></td>
								 <td style="padding-top: 5px; padding-bottom: 7px;">
								    <div class="text-center btn-group">
										<button type="button" class="btn btn-primary" id="tipo1" onClick="formTipo('CC')">CC</button>
										<button type="button" class="btn btn-primary" id="tipo2" onClick="formTipo('OF')">OF</button>
									    <button type="button" class="btn btn-primary" id="tipo3" onClick="formTipo('AR')">AR</button>
										<button type="button" class="btn btn-primary" id="tipo4" onClick="formTipo('AT')">AT</button>
										<input id="inputTipo"  name="ubicacion" required="required" class="form-control" value=" " style="display: none"/>
									</div>
								 </td>
								</tr>
									<?php
									if($trabajo["Ubicacion"] == "CC"){
										echo "<script>";
										echo "formTipo('CC');";
										echo "</script>";
									}
									else if($trabajo["Ubicacion"] == "OF"){
										echo "<script>";
										echo "formTipo('OF');";
										echo "</script>";
									}
									else if($trabajo["Ubicacion"] == "AR"){
										echo "<script>";
										echo "formTipo('AR');";
										echo "</script>";
									}
									else if($trabajo["Ubicacion"] == "AT"){
										echo "<script>";
										echo "formTipo('AT');";
										echo "</script>";
									}
									?>
								<tr>
								 <td width="70%"><strong>Fecha visita:</strong></td><td width="30%"><input id="cajaFecha" value=""  name="fvisita" type="text" required="required"/></td>
								</tr>
								<tr>
								 <td width="70%"><strong>Hora entrada (hh:mm):</strong></td><td width="30%"><input id="horaE" value="<?php echo $trabajo["HoraE"]?>" name="horae" type="text" required="required"/></td>
								</tr>
								<tr>
								  <td width="70%"><strong>Hora salida (hh:mm):</strong></td><td width="30%"><input id="horaS" value="<?php echo $trabajo["HoraS"]?>" name="horas" type="text" required="required"/></td>
								</tr>
								<tr id="content" style="display: in-line;">
								<td width="70%"><strong>Descripción material:</strong></td><td width="30%"><textarea id="cajas" name="descmat" rows="5" cols="35"><?php echo $trabajo["DescripcionMat"]?></textarea></td>
								</tr>
								<tr>
								 <td width="70%"><strong>Observaciones:</strong></td><td width="30%"><textarea id="cajas" name="observaciones" rows="5" cols="35"><?php echo $trabajo["Observaciones"]?></textarea></td>
								</tr>
							</table>
							</center>
						</div>
						<div class="panel-footer">
							<input  class="btn btn-primary" type="button" onClick="location.href='./infoTrabajo.php?id=<?php echo $id ?>&cliente=<?php echo $cliente ?>'" value="Volver atrás"></input>
							<button type="submit" class="btn btn-primary" name="formRTrabajo" value="Sign in" style="float: right"><strong>Guardar</strong></button>
						</div>
						</form>
			</div>
		</div>
		<script type="text/javascript">
				 var orig = "<?php echo $trabajo["FVisita"]?>"; //2017-04-05 --> 05/04/2017
				 var format ="";
				 format = format.concat(orig.charAt(8));
				format = format.concat(orig.charAt(9));
				format = format.concat("/");
				format = format.concat(orig.charAt(5));
				format = format.concat(orig.charAt(6));
				format = format.concat("/");
				format = format.concat(orig.charAt(0));
				format = format.concat(orig.charAt(1));
				format = format.concat(orig.charAt(2));
				format = format.concat(orig.charAt(3));
				document.getElementById("cajaFecha").value =format;
				function validarDatos() {
				var he = document.getElementById("horaE").value;
				var hs = document.getElementById("horaS").value;
				var format = false;
				var cont = 0;
				while (!format && (cont < he.length)) {
				  if (he.charAt(cont) == ":")
					format = true;
				  cont++;
				}
				if(he.charAt(0) != "0" && he.charAt(0) != "1" && he.charAt(0) != "2")
					format = false;
				
				if (!format) {
				  //alert ("La contraseña no puede contener espacios en blanco");
				  document.getElementById("horaE").value ="";
				  document.getElementById("horaE").placeholder ="formato incorrecto";
				  document.getElementById("horaE").style="border: 2px solid #ff1313";
				  return false;
				}
				
				var format2 = false;
				var cont2 = 0;
				while (!format2 && (cont2 < hs.length)) {
				  if (hs.charAt(cont2) == ":")
					format2 = true;
				  cont2++;
				}
				if(hs.charAt(0) != "0" && hs.charAt(0) != "1" && hs.charAt(0) != "2")
					format2 = false;
				if (!format2) {
				  document.getElementById("horaS").value ="";
				  document.getElementById("horaS").placeholder ="formato incorrecto";
				  document.getElementById("horaS").style="border: 2px solid #ff1313";
				  return false;
				}
				
				var orig = document.getElementById("cajaFecha").value; // 23/04/2017 --> 2017-04-23 
				var format = "";
				if(orig.charAt(4) != "-"){
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
				document.getElementById("cajaFecha").value = format;
				}
				}
		</script>
		<!--<script src="http://code.jquery.com/jquery.js"></script>-->
		<script src="includes/js/bootstrap.min.js"></script>
  </body>
</html>
<?php require(__DIR__.'/includes/php/cleanup.php');?>