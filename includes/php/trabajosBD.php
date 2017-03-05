<?php
require_once(__DIR__."/config.php");

function deleteWorksClient($id){
	
	global $mysqli;

	$args = array($id);
	sanitizeArgs($args);

	$pst = $mysqli->prepare("DELETE FROM trabajos WHERE IdCliente = ?");
	$pst->bind_param("s",$args[0]);
	$result = $pst->execute();

	$pst->close();
	
	return $result;
}

function getTrabajos($id){
	
	global $mysqli;
	$trabajos = null;
	
	$args = array($id);
	sanitizeArgs($args);
	
	$pst = $mysqli->prepare("SELECT * FROM trabajos WHERE IdCliente = ? ORDER BY FVisita DESC;");
	$pst->bind_param("s",$args[0]);
	$pst->execute();
	$result = $pst->get_result();
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$trabajos[] = $row;
	}
	
	$pst->close();
	return $trabajos;          
}

function getInfoWork($id){
	
	global $mysqli;
	$args = array($id);
	sanitizeArgs($args);
	
	$pst = $mysqli->prepare("SELECT * FROM trabajos WHERE Id = ?");
	$pst->bind_param("i",$args[0]);
	$pst->execute();
	$result = $pst->get_result();
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$info = $row;
	}
	$pst->close();
	return $info;     
}

function registrarTrabajo($cliente, $usuario, $fVisita, $horaE, $horaS, $desc, $descM, $obs){
	global $mysqli;
	$args = array($cliente,$usuario, $fVisita, $horaE, $horaS, $desc, $descM, $obs);
	sanitizeArgs($args);
	$pst = $mysqli->prepare("INSERT INTO trabajos VALUES (null,?,?,?,?,?,?,?,?);"); //null para el campo autoincrement
	$pst->bind_param("ssssssss",$args[0], $args[1], $args[2], $args[3], $args[4], $args[5], $args[6], $args[7]);
	$result = $pst->execute();
	
	$pst->close();
	
	return $result;
}

function modificarTrabajo($cliente, $fVisita, $horaE, $horaS, $desc, $descM, $obs, $id){
	global $mysqli;
	$args = array($cliente,$fVisita, $horaE, $horaS, $desc, $descM, $obs, $id);
	sanitizeArgs($args);
	$pst = $mysqli->prepare("UPDATE trabajos SET IdCliente = ?, FVisita = ?, HoraE = ?, HoraS = ?, Descripcion = ?, DescripcionMat = ?, Observaciones = ? WHERE Id = ?"); //null para el campo autoincrement
	$pst->bind_param("ssssssss",$args[0], $args[1], $args[2], $args[3], $args[4], $args[5], $args[6], $args[7]);
	$result = $pst->execute();
	
	$pst->close();
	
	return $result;
}
function eliminarTrabajo($id){
	global $mysqli;

	$args = array($id);
	sanitizeArgs($args);

	$pst = $mysqli->prepare("DELETE FROM trabajos WHERE Id = ?");
	$pst->bind_param("i",$args[0]);
	$result = $pst->execute();

	$pst->close();
	
	return $result;
}

function updateWorksClient($idCliente, $idClienteN){
	global $mysqli;
	$args = array($idClienteN,$idCliente);
	sanitizeArgs($args);	
	$pst = $mysqli->prepare("UPDATE trabajos SET IdCliente = ? WHERE IdCliente = ?");
	$pst->bind_param("ss", $args[0], $args[1]);
	
	$result = $pst->execute();
	
	$pst->close();
	
	return $result;
}
?>