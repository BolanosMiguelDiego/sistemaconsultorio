<?php session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}

if($_SERVER['REQUEST_METHOD']=='POST'){
	$nombre = filter_var(strtolower($_POST['nombre']),FILTER_SANITIZE_STRING);
	$mensaje='';
		try{
			$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','12345');
		}catch(PDOException $e){
			echo "Error: ". $e->getMessage();
			die();
		}

		$statement = $conexion -> prepare('SELECT * FROM consultorios WHERE conNombre = :nombre LIMIT 1');
		$statement ->execute(array(':nombre'=>$nombre));
		$resultado= $statement->fetch();

		if($resultado != false){
			$mensaje .='El nombre de usuario ya existe </br>';
			echo "<script language='JavaScript'> 
                alert('Ya existe un consultorio con los mismos datos'); 
                </script>";
		}

	if($mensaje==''){
		$statement = $conexion->prepare(
		"INSERT INTO consultorios
		values(null,:nombre)");

		$statement ->execute(array( 
		':nombre'=> $nombre
		));
		header('Location: consultorios.php');
	}
}
require 'vista/agg_consultorios_vista.php';
?>