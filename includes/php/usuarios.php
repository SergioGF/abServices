<?php
require_once __DIR__.'/config.php';
require_once __DIR__.'/usuariosBD.php';
require_once __DIR__.'/password.php';

function formLogin($params) {

  $name = $params['usuario'];
  $pass = $params['password'];
  $result = [];
  
  $result = login($name, $pass);

  return $result;
}
function getUser($nombreUsuario){
$usuario = getInfoUser($nombreUsuario);
return $usuario;
}
function login($nombreUsuario, $password) {
 
  $usuario = getInfoUser($nombreUsuario);
  
  // Si existe el usuario
	if ( $usuario ) {
		//Si la contraseña es correcta
	//	if($password == $usuario['Password']){
		if(password_verify($password, $usuario['Password'])){
		// Rescatar tipo de usuario y ver donde situarlo.	
		  $_SESSION["usuario"] = $usuario['Usuario'];
		  $_SESSION["password"] = $usuario['Password'];
		  $_SESSION["tipo"] = $usuario['Tipo'];
		  if($usuario['Tipo'] == 3)
		  header('Location: ./homeClientes.php');
		  else if($usuario['Tipo'] == 2)
		  header('Location: ./homeClientes.php');
		  else if($usuario['Tipo'] == 1)
		  header('Location: ./homeClientes.php');
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

function formPass($params, $nick) {

  $passV = $params['antPass'];
  $passN = $params['newPass1'];
  $result = [];
  $ok = false;
  
   $usuario = getInfoUser($nick);

   if(password_verify($passV, $usuario['Password'])){
   //if($usuario['Password'] == $passV){ //Si las contraseñas son iguales
	 $ok = editPass($nick,$passN);
	
		if($ok == false){
			$result[] = "La contraseña no se ha podido actualizar con éxito.";
		}
		else {
			$result[] = "La contraseña se ha actualizado con éxito.";
			header('Location: ./homeClientes.php?passNew=1');
		}
   } else{
	   $result[] = "La contraseña que ha introducido no coincide con la actual.";
   }
  return $result;
}

function formUser($params, $nick) {

  $nickN = $params['nickNuevo'];
  $result = [];
  
  $ok = false;
 
	 $ok = editUser($nick,$nickN);
	
		if($ok == false){
			$result[] = "El nombre de usuario que ha introducido ya se encuentra en uso.";
		}
		else {
			$_SESSION["usuario"] = $nickN;
			$result[] = "El nombre de usuario se ha actualizado correctamente.";
		}
  return $result;
}

function getUsuarios(){
	
	$users = getUsers();
	
	return $users;
}

function getTecnico($nick){
	$ok = false;
	
	if(buscarNick($nick) > 0){
		$ok = true;
	}
	
	return $ok;
}


?>