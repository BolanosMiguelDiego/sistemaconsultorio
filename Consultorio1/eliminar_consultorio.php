<?php
	$mensaje='';
	extract ($_REQUEST);
	try{
		$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','12345');
	}catch(PDOException $e){
		echo "Error: ". $e->getMessage();
	}


	#Comprobar que no exitan citas que el medico va a atender.
	$id = $_REQUEST['idConsultorio'];

	$consulta = $conexion -> prepare("SELECT count(idcita) as sepuede 
								from citas 
								where citConsultorio='".$id."'
								and citestado = 'asignado';");

	$consulta ->execute();
	$consulta = $consulta ->fetch();
	$sepuede = $consulta['sepuede'];

	if($sepuede===0)
	{
		$sql="DELETE FROM consultorios WHERE idconsultorio = '$_REQUEST[idConsultorio]'";
		$resultado = $conexion->query($sql);

		if($resultado == true){
			header('Location: consultorios.php');
			$mensaje .='Consultorio eliminado correctamente';
		}
	}
	else
	{
		echo "<script language='javascript'> alert('El consultorio cuenta con citas asignadas. Elimine las citas primero.'); </script>";
	}
?>