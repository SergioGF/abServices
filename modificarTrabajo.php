<?php require_once __DIR__.'/includes/php/config.php';?>
<!DOCTYPE html>
<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if($_SESSION["tipo"] == 1)
		header('Location: ./login.php');
?>
<html lang="en">
  <head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="./includes/css/logo2.jpg" />

	<?php
	$id=$_GET['idTrabajo']; 
	$cliente =$_GET['cliente']; 
	?>
	
    <title>abServices</title>
 
    <!-- CSS de Bootstrap -->
    <link href="includes/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
	<link rel="stylesheet" type="text/css" href="includes/css/style.css"> 
	<script type="text/javascript" src="includes/jquery/jquery-3.1.1.js"></script>
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
			else if(t == "AR"{
			document.getElementById("tipo1").style.backgroundColor = "#286090";
			document.getElementById("tipo2").style.backgroundColor = "#286090";
			document.getElementById("tipo3").style.backgroundColor = "#161e45";
			document.getElementById("tipo4").style.backgroundColor = "#286090";
			} else {
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
				<h2 id="cab2">Modificar trabajo a <?php echo $cliente?></h2> 
				</div>
		</div>
		<?php 
		$trabajo = conseguirInfoTrabajo($id);
		?>
		<div class="container-fluid">
			<div class="panel panel-primary" >
						<div class="panel-heading" id="panelHead"><div class="text-center"><strong>Modificar trabajo</strong></div></div>

						<form method = "POST" action="" autocomplete="on" class="form-horizontal" role="form">
					
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
								<tr>
								 <td width="70%"><strong>Fecha visita:</strong></td><td width="30%"><input id="cajas" value="<?php echo $trabajo["FVisita"]?>" name="fvisita" type="date" required="required"/></td>
								</tr>
								<tr>
								 <td width="70%"><strong>Hora entrada:</strong></td><td width="30%"><input id="cajas" value="<?php echo $trabajo["HoraE"]?>" name="horae" type="time" required="required"/></td>
								</tr>
								<tr>
								  <td width="70%"><strong>Hora salida:</strong></td><td width="30%"><input id="cajas" value="<?php echo $trabajo["HoraS"]?>" name="horas" type="time" required="required"/></td>
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
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="includes/js/bootstrap.min.js"></script>
  </body>
</html>
<?php require(__DIR__.'/includes/php/cleanup.php');?>