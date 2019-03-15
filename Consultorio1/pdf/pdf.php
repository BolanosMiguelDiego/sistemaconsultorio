<?php

	include 'plantilla.php';
	
	
	$pdf = new PDF('L');
	$pdf->AliasNbPages(); 
	$pdf->addPage();

	#Cabeceras de la tabla.
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);

	$pdf->Cell(25,6,'ID CITA',1,0,'C',1);
	$pdf->Cell(25,6,'FECHA',1,0,'C',1);
	$pdf->Cell(25,6,'HORA',1,0,'C',1);
	$pdf->Cell(40,6,'ID PACIENTE',1,0,'C',1);
	$pdf->Cell(40,6,'ID CONSULTORIO',1,0,'C',1);
	$pdf->Cell(40,6,'ESTADO CITA',1,0,'C',1);
	$pdf->Cell(60,6,'OBSERVACIONES',1,0,'C',1);

	#Cuerpo de la tabla:
	try{
		$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','root');
	}catch(PDOException $e){
		echo "Error: ". $e->getMessage();
	}

	$consulta = $conexion -> prepare("SELECT * FROM citas");

	$consulta ->execute();
	$consulta = $consulta ->fetchAll();

	$pdf->SetFont('Arial','',10);
	
	foreach ($consulta as $Sql): 
			$pdf->Ln(1);
			$pdf->Cell(25,6,$Sql['idcita'],1,0,'C');
			$pdf->Cell(25,6,$row['citafecha'],1,0,'C');
			$pdf->Cell(25,6,$row['citahora'],1,0,'C');
			$pdf->Cell(40,6,$row['citPaciente'],1,0,'C');
			$pdf->Cell(40,6,$row['citMedico'],1,0,'C');
			$pdf->Cell(40,6,$row['citConsultorio'],1,0,'C');
			$pdf->Cell(40,6,$row['citestado'],1,0,'C');
			$pdf->Cell(40,6,$row['ciobservaciones'],1,0,'C');
						
	endforeach;
	#Para mostrar el pdf en la página web:
	$pdf->Output();
?>