<?php
	$errores='';
	extract ($_REQUEST);
	try{
		$conexion = new PDO('mysql:host=192.168.88.26;dbname=centromedico','ubase','12345');
	}catch(PDOException $e){
		echo "Error: ". $e->getMessage();
	}
	

	#Comprobar que no exitan citas que el medico va a atender.
	$id = $_REQUEST['idPaciente'];

	$consulta = $conexion -> prepare("SELECT count(idcita) as sepuede 
								from citas 
								where citPaciente='".$id."'
								and citestado = 'asignado';");

	$consulta ->execute();
	$consulta = $consulta ->fetch();
	$sepuede = $consulta['sepuede'];


	if($sepuede===0)
	{
		$sql="DELETE FROM pacientes WHERE idPaciente = '$_REQUEST[idPaciente]'";
		$resultado = $conexion->query($sql);

		if($resultado == true){
			header('Location: Pacientes.php');
			$errores .='Paciente eliminado correctamente';
		}
	}
	else{
	echo "<script language='javascript'> alert('El paciente tiene citas asignadas. Elimine las citas primero.'); </script>";
	}





	
?>