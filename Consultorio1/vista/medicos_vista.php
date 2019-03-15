<?php
$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','12345');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}

$consulta = $conexion -> prepare("SELECT * FROM medicos ORDER BY medidentificacion");

$consulta ->execute();
$consulta = $consulta ->fetchAll();
if(!$consulta){
	$mensaje .= 'NO HAY MEDICOS PARA MOSTRAR';
}
?>
<?php include 'plantillas/header.php'; ?>
	<script language="javascript">
		function msg(id){
			var mensaje;
    		var opcion = confirm("Desea eliminar el registro...No se podra recuperar");
    		if (opcion == true) {
    			location.href='eliminar_medico.php?idMedico='+id;
			} 
		}
	</script>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>MÉDICOS</h2>
					</div>
						<a href="agregarmedicos.php"class="agregar">Agregar Médico</a>
						
						<table class="tabla">
						  <tr>
							<th>Identificación</th>
							<th>Nombre(s)</th>
							<th>Apellido paterno</th>
							<th>Apellido materno</th>
							<th>Correo</th>
							<th>Especialidad</th>
							<th colspan ="2">Opciones</th>

						  </tr>
						<?php foreach ($consulta as $Sql): ?>
						<tr >
						<?php echo "<td class='mayusculas'>". $Sql['medidentificacion']. "</td>"; ?>
						<?php echo "<td class='mayusculas'>". $Sql['mednombres']. "</td>"; ?>
						<?php echo "<td class='mayusculas'>". $Sql['medapellidopat']. "</td>"; ?>
						<?php echo "<td class='mayusculas'>". $Sql['medapellidomat']. "</td>"; ?>
						<?php echo "<td>". $Sql['medcorreo']. "</td>"; ?>
						<?php echo "<td >". $Sql['medEspecialidad']. "</td>"; ?>
						<?php echo "<td class='centrar'>"."<a href='actualizarmedico.php?idMedico=".$Sql['idMedico']."' class='editar'>Editar</a>". "</td>"; ?>
						<?php echo "<td class='centrar'>"."<a onclick=msg(".$Sql['idMedico'].") class='eliminar'>Eliminar</a>". "</td>"; ?>
						</tr>
						<?php endforeach; ?>
						</table>
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