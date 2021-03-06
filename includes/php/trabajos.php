<?php
require_once __DIR__.'/config.php';
require_once __DIR__.'/trabajosBD.php';

function borrarTrabajosCliente($idCliente){
	
	$result = deleteWorksClient($idCliente);
	
	return $result;
}

function conseguirTrabajos($id){
	
	$result = getTrabajos($id);
	
	return $result;
}

function conseguirInfoTrabajo($id){
	
	$result = getInfoWork($id);
	
	return $result;
}

function formRegisterTrabajo($params, $cliente, $usuario) {
	
	$ok = false;
	
	$descMat = $params['descmat'];
	$obs = $params['observaciones']; // Estos 2 campos pueden ser null.
	
	if($params['descmat'] == null) $descMat = null;
	if($params['observaciones'] == null) $obs = null;
		
		$ok = registrarTrabajo($cliente, $usuario, $params['ubicacion'], $params['fvisita'],$params['horae'], $params['horas'], $params['descripcion'],
								$descMat, $obs); //Campo ID autocompletable.
		
		if($ok){
			$result[] = "El registro se ha realizado con éxito.";
			header('Location: ./trabajosCliente.php?cliente='.$cliente.'&newTrabajo=1');
		} else {
			$result[] = "El registro no se ha podido realizar con éxito.";
		}

  return $result;
}
function formModTrabajo($params, $cliente, $id) {
	
	$ok = false;
	
	$descMat = $params['descmat'];
	$obs = $params['observaciones']; // Estos 2 campos pueden ser null.
	
	if($params['descmat'] == null) $descMat = null;
	if($params['observaciones'] == null) $obs = null;
		
		$ok = modificarTrabajo($cliente, $params['ubicacion'], $params['fvisita'],$params['horae'], $params['horas'], $params['descripcion'],
								$descMat, $obs, $id); 
		
		if($ok){
			$result[] = "El registro se ha realizado con éxito.";
			//header('Location: ./trabajosCliente.php?cliente='.$cliente.'&newTrabajo=1');
			header('Location: ./infoTrabajo.php?id='.$id.'&cliente='.$cliente.'&mod=1');
		} else {
			$result[] = "El registro no se ha podido realizar con éxito.";
		}

  return $result;
}

function deleteWork($id, $cliente){
	$ok = false;
	
	$ok = eliminarTrabajo($id);
	
	if($ok){
			$result[] = "El trabajo ha sido eliminado con éxito.";
			header('Location: ./trabajosCliente.php?cliente='.$cliente.'&deleteTrabajo=1');
		} else {
			$result[] = "El trabajo no se ha podido eliminar.";
	}
	return $result;
}

function actualizarTrabajosCliente($oldId, $newId){
	$result = updateWorksClient($oldId, $newId);
	return $result;
}

function horasUsadas($cliente){
	
	$result = getHorasTrabajos($cliente);
	
	return $result;
}


function conversorHorasSegundos($tiempo_en_horas) {
	$decimales = explode(":",$tiempo_en_horas);
	
	$horas = $decimales[0] * 3600;
	$minutos = $decimales[1] * 60;
 
	$segundos = $horas + $minutos;
	return $segundos;
}


?>