<?php
	$errores='';
	extract ($_REQUEST);
	try{
		$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','12345');
	}catch(PDOException $e){
		echo "Error: ". $e->getMessage();
	}
	$sql="DELETE FROM citas WHERE idcita = '$_REQUEST[idcita]'";
	$resultado = $conexion->query($sql);

	if($resultado == true){
		header('Location: citas.php');
		$errores .='Cita eliminada correctamente';
	}
?>