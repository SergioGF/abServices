<?php
require_once __DIR__.'/config.php';
require_once __DIR__.'/trabajosBD.php';

function borrarTrabajosCliente($idCliente){
	
	$result = deleteWorksClient($idCliente);
	
	return $result;
}
?>