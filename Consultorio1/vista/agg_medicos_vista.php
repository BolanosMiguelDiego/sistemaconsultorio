<?php
$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','12345');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}

//CARGAR ESPECIALIDADES EN EL SELECT
$especialidad = $conexion -> prepare("SELECT * FROM especialidades");

$especialidad ->execute();
$especialidad = $especialidad ->fetchAll();
if(!$especialidad)
	$mensaje .= 'NO hay especialidades, por favor registre!';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Medicos - CenterMedicine</title>
	<link rel="stylesheet" href="css/estilos1.css">
	<link rel="icon" type="image/x-icon" href="img/favicon.png">
</head>
<body>
<?php include 'plantillas/header.php'; ?>
<script type="text/javascript" src="js/confirmacion.js"></script>

	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>MÉDICOS</h2>
					</div>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
						<h2>Agregar Médico</h2>
						<input required type="numeric" name="identificacion" placeholder="* identificación:" onkeypress='return validaNumericos(event)' maxlength="7" minlength="7">
						<input required type="text" name="nombres" placeholder="Nombres:" onkeypress="return validar(event)" >
						<input required type="text" name="apellidopat" placeholder="Apellido paterno:" onkeypress="return validar(event)">
						<input required type="text" name="apellidomat" placeholder="Apellido materno:" onkeypress="return validar(event)">
						<input type="email" name="correo" placeholder="Correo:">
						<input type="numeric" name="telefono" placeholder="Telefono:" onkeypress='return validaNumericos(event)' maxlength="10">
						<select name="especialidad">  
                        <?php foreach ($especialidad as $Sql): ?>
						<?php echo "<option value='". $Sql['espNombre']. "'>". $Sql['espNombre']. "</option>"; ?>
						<?php endforeach; ?>
						</select>
						<input type="submit" name="enviar" value="Agregar Médico">
						
					</form>
						<?php  if(!empty($mensaje)): ?>
							<ul>
							  <?php echo $mensaje; ?>
							</ul>
						<?php  endif; ?>
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>