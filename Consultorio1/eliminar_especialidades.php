<?php
	$mensaje='';
	extract ($_REQUEST);
	try{
		$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','12345');
	}catch(PDOException $e){
		echo "Error: ". $e->getMessage();
	}
	$sql="DELETE FROM especialidades WHERE idespecialidad = '$_REQUEST[idespecialidad]'";
	$resultado = $conexion->query($sql);

	if($resultado == true){s
		header('Location: especialidades.php');
		$mensaje .='Especialidades eliminado correctamente';
	}
?>