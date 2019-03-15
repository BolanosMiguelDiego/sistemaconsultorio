<?php
	
	include 'fpdf/fpdf.php';

	class PDF extends FPDF{

		function Header()
		{
			$this->Image('C:/xampp/htdocs/Consultorio/pdf/images/logotipo.jpg', 5, 5, 30);
			$this->Image('C:/xampp/htdocs/Consultorio/pdf/images/logo.jpg', 300, 5, 30);
			$this->SetFont('Arial','B',15);
			$this->Cell(30);
			$this->Cell(260,10,utf8_decode('Consultorio médico Cobarrubias Miranda.'),0,0,'C');
			$this->ln(10);
			$this->Cell(300,10,'Reporte de citas.',0,0,'C');
			$this->Ln(20);
		}

		function Footer()
		{
			$this->SetY(-15);
			$this->SetFont('Arial','I',8);
			$this->Cell(0,10,utf8_decode('Página '.$this->PageNo().'/{nb}'),0,0,'C');

		}
	}

?>