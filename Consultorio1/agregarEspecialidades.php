<?php session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}

if($_SERVER['REQUEST_METHOD']=='POST'){
	$nombre = filter_var(strtolower($_POST['nombre']),FILTER_SANITIZE_STRING);
	
	$mensaje='';
		try{
			$conexion = new PDO('mysql:host=192.168.88.26;dbname=centromedico','ubase','12345');
			$conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			echo "Error: ". $e->getMessage();
			die();
		}
		$statement = $conexion -> prepare('SELECT * FROM especialidades WHERE espNombre = :nombre LIMIT 1');
		$statement ->execute(array(':nombre'=>$nombre));
		$resultado= $statement->fetch();

		if($resultado != false){
			$mensaje .='El nombre de usuario ya existe </br>';
			echo "<script language='JavaScript'> 
                alert('Ya existe una especialidad con los mismos datos'); 
                </script>";
		}

	if($mensaje==''){
		$statement = $conexion->prepare("INSERT INTO especialidades values(null,:nombre)");

		$statement ->execute(array( 
		':nombre'=> $nombre
		));
		header('Location: especialidades.php');
	}
}
require 'vista/agg_especialidades_vista.php';
?>