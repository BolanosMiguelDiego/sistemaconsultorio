<?php session_start();
	if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
	}
	require 'funciones.php';
	try{
		$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','12345');
	}catch(PDOException $e){
		echo "ERROR: " . $e->getMessge();
		die();
	}
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$id = limpiarDatos($_POST['id']);
		$usuario = limpiarDatos($_POST['usuario']);
		$password = limpiarDatos($_POST['password']);
		$password2= limpiarDatos($_POST['password2']);
		$nombres = limpiarDatos($_POST['nombres']);
		$apellidopat = limpiarDatos($_POST['apellidopat']);
		$apellidomat = limpiarDatos($_POST['apellidomat']);
		$rol = limpiarDatos($_POST['roll']);

		$statement = $conexion->prepare(
		"UPDATE usuarios
        SET usuario= :usuario, 
		pass =:pass, 
		nombres =:nombres, 
		apellidopat =:apellidopat, 
		apellidomat =:apellidomat, 
		Roll =:roll 
		WHERE id = :id");

		$statement ->execute(array(
        ':usuario'=>$usuario, 
		':password2'=>$password2, 
		':nombres'=>$nombres, 
		':apellidopat'=>$apellidopat, 
		':apellidomat'=>$apellidomat, 
		':roll'=>$rol,
        ':id'=> $id
        ));
        header('Location: usuarios.php');
	}else{
		$id_usuario = id_numeros($_GET['id']);
		if(empty($id_usuario)){
			header('Location: usuarios.php');
		}
		$user = obtenerUser_id($conexion,$id_usuario);
		
		if(!$user){
			header('Location: usuarios.php');
		}
		$user =$user[0];
	}
	require 'vista/actualizarusuario.php';
?>