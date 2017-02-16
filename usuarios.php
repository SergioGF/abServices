<?php
require_once __DIR__.'/config.php';
require_once __DIR__.'/usuariosBD.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function formLogin($params) {

  $name = $params['usuario'];
  $pass = $params['password'];
  $result = [];
  
  $result = login($name, $pass);

  return $result;
}
function formPass($params, &$error) {

  $passV = $params['antPass'];
  $passN = $params['newPass1'];
  $result = [];
  
  $result = changePass($passV, $passN1, $error);

  return $result;
}
function login($nombreUsuario, $password) {
 
  $usuario = getInfoUser($nombreUsuario);
  
  // Si existe el usuario
	if ( $usuario ) {
		//Si la contraseña es correcta
		if($password == $usuario['Password']){
		// Rescatar tipo de usuario y ver donde situarlo.	
		  $_SESSION["usuario"] = $usuario['Usuario'];
		  $_SESSION["password"] = $usuario['Password'];
		  $_SESSION["tipo"] = $usuario['Tipo'];
		  header('Location: ./principalUser.php');
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

function changePass($passV, $passN1, &$error) {
 
  $ok = false;
  $usuario = getInfoUser($nombreUsuario);
  
  // Si existe el usuario
	if ( $usuario ) {
		$ok = password_verify($password, $usuario['Password']);
		//Si la contraseña es correcta
		if($ok){
			$ok = [];
		  $ok[] = "Todo bien";
		  
		  $_SESSION["usuario"] = $usuario['Usuario'];
		  $_SESSION["password"] = $usuario['Password'];
		  $_SESSION["tipo"] = $usuario['Tipo'];
		// Rescatar tipo de usuario y ver donde situarlo.	
		} else {
		  $error = TRUE;
		  $ok = [];
		  $ok[] = "Usuario o contraseña no válidos";
		}
	}else {
		$error =  TRUE;
		$ok = [];
		$ok[] = "Usuario o contraseña no válidos";
	}
  return $ok;
  
}
?>