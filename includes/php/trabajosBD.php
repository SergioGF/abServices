<?php
require_once(__DIR__."/config.php");

function deleteWorksClient($idCliente){
	
	global $mysqli;

	$args = array($id);
	sanitizeArgs($args);

	$pst = $mysqli->prepare("DELETE FROM trabajos WHERE IdCliente = ?");
	$pst->bind_param("s",$args[0]);
	$result = $pst->execute();

	$pst->close();
	
	return $result;
}
?>