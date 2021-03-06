<?php
require_once(__DIR__."/config.php");

function getClientes(){
	
	global $mysqli;
	$clientes = null;
	
	$pst = $mysqli->prepare("SELECT * FROM clientes ORDER BY Id;");
	$pst->execute();
	$result = $pst->get_result();
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$clientes[] = $row;
	}
	
	$pst->close();
	return $clientes;          
}

function buscarClient($id){
	global $mysqli;
	$err = 0;
	$args = array($id);
	sanitizeArgs($args);
	$info = null;
	$pst = $mysqli->prepare("SELECT Id FROM clientes WHERE Id = ?");
	$pst->bind_param("s",$args[0]);
	$pst->execute();
	$result = $pst->get_result();
	$numregistros=$result->num_rows;
	$pst->close();
	return $numregistros;
}  

function registrarCliente($id, $horas){
	global $mysqli;
	$args = array($id, $horas);
	sanitizeArgs($args);
	$pst = $mysqli->prepare("INSERT INTO clientes VALUES (?,?);");
	$pst->bind_param("si",$args[0], $args[1]);
	$result = $pst->execute();
	
	$pst->close();
	
	return $result;
}  

function eliminarCliente($id){
	global $mysqli;

	$args = array($id);
	sanitizeArgs($args);

	$pst = $mysqli->prepare("DELETE FROM clientes WHERE Id = ?");
	$pst->bind_param("s",$args[0]);
	$result = $pst->execute();

	$pst->close();
	
	return $result;
}

function actualizarCliente($oldId, $newId){
	global $mysqli;
	$args = array($newId, $oldId);
	sanitizeArgs($args);	
	
	$pst = $mysqli->prepare("UPDATE clientes SET Id = ? WHERE Id = ?");
	$pst->bind_param("ss", $args[0], $args[1]);
	
	$result = $pst->execute();
	$pst->close();
	
	return $result;
}

function getHoras($id){
	global $mysqli;
	$err = 0;
	$args = array($id);
	sanitizeArgs($args);
	$info = null;
	$pst = $mysqli->prepare("SELECT Horas FROM clientes WHERE Id = ?");
	$pst->bind_param("s",$args[0]);
	$pst->execute();
	$result = $pst->get_result();
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$horas = $row['Horas'];
	}
	$pst->close();

	return $horas;
}
?>