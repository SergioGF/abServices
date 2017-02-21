<?php
require_once __DIR__.'/config.php';
require_once __DIR__.'/trabajos.php';
require_once __DIR__.'/clientesBD.php';

function conseguirClientes(){
	
	$result = getClientes();
	
	return $result;
}

function formRegisterClient($params) {
	
	$ok = false;
	
	if(buscarClient($params['cliente']) < 1){ // Si no hay algun cliente con ese nombre
  
		
		$ok = registrarCliente($params['cliente']);
		
		if($ok){
			$result[] = "El registro se ha realizado con éxito.";
		} else {
			$result[] = "El registro no se ha podido realizar con éxito.";
		}
	}else {
			$result[] = "El ID del cliente ya se encuentra en uso.";
	}

  return $result;
}

function deleteClient($id){

  $ok = false;
  $ok2 = false;
  // Si existe el cliente
	if(buscarClient($params['cliente']) > 0) { // Siempre va a existir porque sale en la lista, aunque se realiza la comprobación por si acaso.
		$ok = eliminarCliente($id);
		$ok2 = borrarTrabajosCliente($id); // Se borran los trabajos asociados a dicho cliente.
		
		if(ok && ok2){
			$result[] = "El cliente ha sido eliminado con éxito.";
		} else {
			$result[] = "El cliente no se ha podido eliminar.";
		}
	}
	else{
		$result[] = "El cliente no se ha podido eliminar.";
	}
	return $result;
}

?>