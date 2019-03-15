<?php
	$errores='';
	extract ($_REQUEST);
	try{
		$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','12345');
	}catch(PDOException $e){
		echo "Error: ". $e->getMessage();
	}
	

	#Comprobar que no exitan citas que el medico va a atender.
	$id = $_REQUEST['idMedico'];

	$consulta = $conexion -> prepare("SELECT count(idcita) as sepuede 
								from citas 
								where citMedico='".$id."'
								and citestado = 'asignado';");

	$consulta ->execute();
	$consulta = $consulta ->fetch();
	$sepuede = $consulta['sepuede'];

	if($sepuede === 0)
	{
		$sql="DELETE FROM medicos WHERE idMedico = '$_REQUEST[idMedico]'";
		$resultado = $conexion->query($sql);

		if($resultado == true){
			header('Location: medicos.php');
			$errores .='Medico eliminado correctamente';
			echo "<script language='JavaScript'> 
                alert('Medico eliminado correctamente'); 
                </script>";
		}
	}
	else
	{

		echo "<script language='javascript'> alert('Hay citas asignadas a este médico. Cambie al médico para atender la cita.'); </script>";
		

	}
header('Location: medicos.php');

	

?>