<?php session_start();
	
	include 'pdf/plantilla.php';
	

	if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
	}

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$ano = $_POST['ano'];
		$mes = $_POST['mes'];
		$medico =  $_POST['medico'];
		$mensaje='';

		if(empty($ano) or empty($mes)  or empty($medico)){
			$mensaje.= 'Por favor rellena todos los datos correctamente'."<br />";
		}
		else{	
			try{
				$conexion = new PDO('mysql:host=192.168.88.26;dbname=centromedico','ubase','12345');
			}catch(PDOException $e){
				echo "Error: ". $e->getMessage();
				die();
			}
		}
		
		$nMes="0";
		if($mes=='Enero')	{$nMes= $nMes."1";}	if($mes=='Julio'){$nMes= $nMes."7";}
		if($mes=='Febrero')	{$nMes= $nMes."2";}	if($mes=='Agosto'){$nMes= $nMes."8";}
		if($mes=='Marzo')	{$nMes= $nMes."3";}	if($mes=='Septiembre'){$nMes= $nMes."9";}
		if($mes=='Abril')	{$nMes= $nMes."4";}	if($mes=='Octubre'){ $nMes="10";}
		if($mes=='Mayo')	{$nMes= $nMes."5";}	if($mes=='Noviembre'){ $nMes="11";}
		if($mes=='Junio')	{$nMes= $nMes."6";}	if($mes=='Diciembre'){ $nMes="12";}


		if($mensaje==''){
			
			$pdf = new PDF('L','mm','Legal');
			$pdf->AliasNbPages(); 
			$pdf->addPage();

			#Cabeceras de la tabla.
			$pdf->SetFillColor(232,232,232);
			$pdf->SetFont('Arial','B',12);

			$pdf->Cell(25,5,'# de cita',1,0,'C',1);
			$pdf->Cell(25,5,'Fecha',1,0,'C',1);
			$pdf->Cell(25,5,'Hora',1,0,'C',1);
			$pdf->Cell(60,5,utf8_decode('Médico'),1,0,'C',1);
			$pdf->Cell(60,5,'Paciente',1,0,'C',1);
			$pdf->Cell(40,5,'Consultorio',1,0,'C',1);
			$pdf->Cell(40,5,'Estado cita',1,0,'C',1);
			$pdf->Cell(50,5,'Observaciones',1,0,'C',1);

		

			$consulta = $conexion -> prepare("SELECT idcita, citfecha, cithora, mednombres, medapellidopat,medapellidomat, pacNombre, pacApellidopat, pacApellidomat, conNombre, citestado,citobservaciones 
				from citas 
				inner join medicos on  citas.citMedico = medicos.medidentificacion
				inner join pacientes on pacientes.idPaciente = citas.citPaciente
				inner join consultorios on consultorios.idConsultorio = citas.citConsultorio
				where mednombres ='".$medico."' and citfecha like '".$ano."-".$nMes."-%' ;");

			$consulta ->execute();
			$consulta = $consulta ->fetchAll();

			$pdf->SetFont('Arial','',10);
			
			foreach ($consulta as $Sql): 
					$pdf->Ln(10);
					
					$pdf->Cell(25,10,$Sql['idcita'],1,0,'C');
					
					$pdf->Cell(25,10,$Sql['citfecha'],1,0,'C');
					
					$pdf->Cell(25,10,$Sql['cithora'],1,0,'C');
					
					$pdf->Cell(60,10,utf8_decode($Sql['mednombres']." ".$Sql['medapellidopat']." ".$Sql['medapellidomat']),1,0,'C');
					
					$pdf->Cell(60,10,utf8_decode($Sql['pacNombre']." ".$Sql['pacApellidopat'])." ".$Sql['pacApellidomat'],1,0,'C');
					
					$pdf->Cell(40,10,utf8_decode($Sql['conNombre']),1,0,'C');
					
					$pdf->Cell(40,10,$Sql['citestado'],1,0,'C');
					
					$pdf->Cell(50,10,utf8_decode($Sql['citobservaciones']),1,0,'C');
								
			endforeach;
			#Para mostrar el pdf en la página web:
			$pdf->Output();

		}









	}
	require 'vista/reporte_vista.php';


?>