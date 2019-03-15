<?php
 session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}

if($_SERVER['REQUEST_METHOD']=='POST'){
	$fecha = $_POST['fecha'];
	$hora = $_POST['hora'];
	$paciente =  $_POST['paciente'];
	$medico =  $_POST['medico'];
	$consultorio =  $_POST['consultorio'];
	$estado =  $_POST['estado'];
	$observaciones =  $_POST['observaciones'];
	
	$mensaje='';

	if(empty($fecha) or empty($hora)  or empty($consultorio) or empty($paciente) or empty($estado)or empty($medico)){
		$mensaje.= 'Por favor rellena todos los datos correctamente'."<br />";
	}
	else{	
		try{
			$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','12345');
			$conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			echo "Error: ". $e->getMessage();
			die();
		}
	}
	if($mensaje==''){
		$resultado = $conexion->prepare("SELECT citfecha,cithora,citconsultorio FROM citas WHERE citconsultorio = $consultorio and citfecha = '$fecha' and cithora = '$hora'");
		$resultado ->execute();

		if ($resultado->rowCount() > 0) {
			echo "<script language='JavaScript'> 
                alert('Ya existe una cita'); 
                </script>";
		}else
		{


		$statement = $conexion->prepare(
		'INSERT INTO citas values(null,:citfecha,:cithora,:citpaciente,:citmedico,:citconsultorio,:citestado,:citobservaciones)');
		

		$statement ->execute(array(
		':citfecha'=>$fecha,
		':cithora'=>$hora,
		':citpaciente'=>$paciente,
		':citmedico'=>$medico,
		':citconsultorio'=>$consultorio,
		':citestado'=>$estado,
		':citobservaciones'=>$observaciones));

		header('Location: citas.php');
	}
	}
}
require 'vista/agregarcitas_vista.php';
?>