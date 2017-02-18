<?php
require_once(__DIR__."/config.php");

function registrarUsuario($nick, $contrasena, $tipo, $abserv, $euro){
	global $mysqli;
	$args = array($nick, $contrasena, $tipo, $abserv, $euro);
	sanitizeArgs($args);
	$pst = $mysqli->prepare("INSERT INTO users VALUES (?,?,?,?,?);");
	$pst->bind_param("ssiii",$args[0], $args[1], $args[2], $args[3], $args[4]);
	$result = $pst->execute();
	
	$pst->close();
	
	return $result;
}

function eliminarUsuario($nick){
	global $mysqli;

	$args = array($nick);
	sanitizeArgs($args);

	$pst = $mysqli->prepare("DELETE FROM users WHERE Usuario = ?");
	$pst->bind_param("s",$args[0]);
	$result = $pst->execute();

	$pst->close();
	
	return $result;
}

function cambiarPermisos($nick, $tipo, $abserv, $euro){
	global $mysqli;
	$args = array($tipo,$abserv, $euro,$nick);
	sanitizeArgs($args);	
	$pst = $mysqli->prepare("UPDATE users SET Tipo = ? , Abservices = ? , Euroico = ? WHERE Usuario = ?");
	$pst->bind_param("iiis", $args[0], $args[1], $args[2], $args[3]);
	
	$result = $pst->execute();
	
	$pst->close();
	
	return $result;
}
?>