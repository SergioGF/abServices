<?php
require_once __DIR__.'/config.php';
require_once __DIR__.'/usuariosBD.php';
require_once __DIR__.'/registrosBD.php';

function formRegisterUser($params) {
	
	$ok = false;
	
	if(buscarNick($params['usuario']) < 1){ // Si no hay algun usuario con ese nombre
  
		$tipo = 1;
		$abservices = 0; //false
		$euroico = 0; // false;
		
		if($params['tipo'] == 'TrabajadorL') $tipo = 1;
		else if ($params['tipo'] == 'Trabajador') $tipo = 2;
		else if($params['tipo'] == 'Administrador')$tipo = 3; 
		
		if($params['empresa'] == 'abServices') $abservices = 1;
		if($params['empresa'] == 'Euroico') $euroico = 1;
		
		$ok = registrarUsuario($params['usuario'],$params['pass'],$tipo,$abservices,$euroico);
		
		if($ok){
			$result[] = "El registro se ha realizado con éxito.";
			header('Location: ./principalAdmin.php?userNew=1');
		} else {
			$result[] = "El registro no se ha podido realizar con éxito.";
		}
	}else {
			$result[] = "El nombre de usuario ya se encuentra en uso.";
	}

  return $result;
}

function deleteUser($nick){
  $usuario = getInfoUser($nick);
  //$ok = false;
  // Si existe el usuario
	if ( $usuario ) { // Siempre va a existir porque sale en la lista, aunque se realiza la comprobación por si acaso.
		$ok = eliminarUsuario($nick);
		if($ok){
			$result[] = "El usuario ha sido eliminado con éxito.";
		} else {
			$result[] = "El usuario no se ha podido eliminar.";
		}
	}
	else{
		$result[] = "El usuario no se ha podido eliminar.";
	}
	return $result;
}

function changePermission($params, $nick){
	
		$tipo = 1;
		$abservices = 0; //false
		$euroico = 0; // false;
		
		if($params['tipo'] == 'TrabajadorL') $tipo = 1;
		else if ($params['tipo'] == 'Trabajador') $tipo = 2;
		else if($params['tipo'] == 'Administrador')$tipo = 3; 
		
		if($params['empresa'] == 'abServices') $abservices = 1;
		else if($params['empresa'] == 'Euroico') $euroico = 1;
		
		$ok = cambiarPermisos($nick,$tipo,$abservices,$euroico);
		
		if($ok){
			$result[] = "Los permisos han sido cambiados con éxito.";
			 header('Location: ./principalAdmin.php?userEdit=1');
		} else {
			$result[] = "Los permisos no han podido ser modificados.";
		}
		
		return $result;
}

?>