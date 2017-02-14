<?php
require_once __DIR__.'/config.php';
require_once __DIR__.'/usuariosBD.php';

function formLogin($params) {

  $name = $params['usuario'];
  $pass = $params['password'];
  $result = [];
  
  $result = login($name, $pass);

  return $result;
}

function login($nombreUsuario, $password) {
 
  $ok = false;
  $usuario = getInfoUser($nombreUsuario);
  
  // Si existe el usuario
	if ( $usuario ) {
		$ok = password_verify($password, $usuario['Password']);
		
		//Si la contraseña es correcta
		if($ok){
		// Rescatar tipo de usuario y ver donde situarlo.	
		} else {
		  $ok = [];
		  $ok[] = "Usuario o contraseña no válidos";
		}
	}else {
		$ok = [];
		$ok[] = "Usuario o contraseña no válidos";
	}
  return $ok;
  
}

?>