 <?php session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}

if($_SERVER['REQUEST_METHOD']=='POST'){
	$nombre = filter_var(strtolower($_POST['nombres']),FILTER_SANITIZE_STRING);
	$apellidospat = $_POST['apellidopat'];
	$apellidosmat = $_POST['apellidomat'];
	$identificacion =  $_POST['identificacion'];
	$sexo =  $_POST['sexo'];
	$fecha =  $_POST['fechaNacimiento'];
	$mensaje='';
	if(empty($nombre) or empty($apellidospat)  or empty($identificacion)){
		$mensaje.= 'Por favor rellena todos los datos correctamente'."<br />";
	}
	else{	
		try{
			$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','12345');
		}catch(PDOException $e){
			echo "Error: ". $e->getMessage();
			die();
		}

		$statement = $conexion -> prepare(
			'SELECT * FROM pacientes WHERE pacIdentificacion = :id LIMIT 1');
		$statement ->execute(array(':id'=>$identificacion));
		$resultado= $statement->fetch();

		if($resultado != false){
			$mensaje .='Ya existe un paciente con esa identificación </br>';
			echo "<script language='JavaScript'> 
                alert('Ya existe un paciente con los mismos datos'); 
                </script>";
		}
	}
	if($mensaje==''){
		$statement = $conexion->prepare(
		'INSERT INTO pacientes values(null, :id,:nombre,:apellidopat,:apellidomat,:fecha,:sexo)');

		$statement ->execute(array(
		':id'=>$identificacion,
		':nombre'=> $nombre,
		':apellidopat'=>$apellidospat,
		':apellidomat'=>$apellidosmat,
		':fecha'=>$fecha,
		':sexo'=>$sexo
		));
		header('Location: pacientes.php');
	}
}
require 'vista/agg_pacientes_vista.php';
?>