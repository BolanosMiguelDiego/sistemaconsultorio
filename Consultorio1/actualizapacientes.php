<?php session_start();
	if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
	}
	
	require 'funciones.php';
	
	try{
		$conexion = new PDO('mysql:host=192.168.88.26;dbname=centromedico','ubase','12345');
		$conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
		echo "ERROR: " . $e->getMessge();
		die();
	}
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$id = limpiarDatos($_POST['id']);
		$identificacion = limpiarDatos($_POST['identificacion']);
		$nombres = limpiarDatos($_POST['nombres']);
		$apellidopatt = limpiarDatos($_POST['apellidopat']);
		$apellidomatt = limpiarDatos($_POST['apellidomat']);
		$fecha = limpiarDatos($_POST['fechanacimiento']);
		$sexo = limpiarDatos($_POST['sexo']);
		
		$statement = $conexion->prepare(
		"UPDATE pacientes
        SET pacIdentificacion = :identificacion, 
		pacNombre =:nombres, 
		pacApellidopat =:apellidopat, 
		pacApellidomat =:apellidomat, 
		pacFechaNacimiento =:fecha, 
		pacSexo =:sexo
		WHERE idPaciente = :id");

		$statement ->execute(array(
        ':identificacion'=>$identificacion, 
		':nombres'=>$nombres, 
		':apellidopat'=>$apellidopatt, 
		':apellidomat'=>$apellidomatt, 
		':fecha'=>$fecha, 
		':sexo'=>$sexo, 
        ':id'=> $id
        ));
        
        header('Location: pacientes.php');
	}else{
		$id_pacientes = id_numeros($_GET['idPaciente']);
		echo $id_pacientes;
		if(empty($id_pacientes)){
			#header('Location: pacientes.php');
			echo $id_pacientes;
		}
		
		$paciente = obtener_paciente_id($conexion,$id_pacientes);
		
		if(!$paciente){
			echo $id_pacientes;
			echo $paciente ;
			#header('Location: pacientes.php');
		}
		$paciente =$paciente[0];
	}
	require 'vista/actualizarpaciente_vista.php';
?>