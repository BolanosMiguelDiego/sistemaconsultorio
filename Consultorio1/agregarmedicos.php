<?php session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}
require 'funciones.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
	$nombre = filter_var(strtolower($_POST['nombres']),FILTER_SANITIZE_STRING);
	$apellidopatt =  limpiarDatos($_POST['apellidopat']);
	$apellidomatt =  limpiarDatos($_POST['apellidomat']);
	$correo =  $_POST['correo'];
	$identificacion =  $_POST['identificacion'];
	$especialidad =  $_POST['especialidad'];
	$telefono =  $_POST['telefono'];
	$mensaje='';
	if(empty($nombre) or empty($apellidopatt)  or empty($identificacion)){
		$mensaje.= 'Por favor rellena todos los datos correctamente'."<br />";
	}
	else{	
		try{
			$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','12345');
		}catch(PDOException $e){
			echo "Error: ". $e->getMessage();
			die();
		}

		$statement = $conexion -> prepare('SELECT * FROM medicos WHERE medidentificacion = :id LIMIT 1');
		$statement ->execute(array(':id'=>$identificacion));
		$resultado= $statement->fetch();

		if($resultado != false){
			$mensaje .='El nombre de usuario ya existe </br>';
			echo "<script language='JavaScript'> 
                alert('Ya existe un medico con los mismos datos'); 
                </script>";
		}
	}
	if($mensaje==''){
		$statement = $conexion->prepare(
		'INSERT INTO medicos (idMedico,medidentificacion,mednombres,medapellidopat,medapellidomat,
		medEspecialidad,medtelefono,medcorreo)
		values(null, :id,:nombre,:apellidopat,:apellidomat,:especialidad,:telefono,:correo)');

		$statement ->execute(array(
		':id'=>$identificacion,
		':nombre'=> $nombre,
		':apellidopat'=>$apellidopatt,
		':apellidomat'=>$apellidomatt,
		':especialidad'=>$especialidad,
		':telefono'=>$telefono,
		':correo'=>$correo
		));
		header('Location: medicos.php');
	}
}
require 'vista/agg_medicos_vista.php';
?>