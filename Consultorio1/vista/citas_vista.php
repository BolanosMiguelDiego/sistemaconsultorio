<?php
$mensaje='';
try{
	$conexion = new PDO('mysql:host=192.168.88.26;dbname=centromedico','ubase','12345');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}

#$consulta = $conexion -> prepare("
#		SELECT 	* FROM citas order by idcita limit 5");

$consulta = $conexion->prepare("SELECT idcita,citfecha,cithora,pacNombre,pacApellidopat,pacApellidomat,mednombres,medapellidopat,medapellidomat,citConsultorio,citestado,citobservaciones FROM citas
inner join pacientes
on citPaciente = idPaciente
inner join medicos
on citMedico = idMedico;
select*from citas order by idcita limit 5;");

$consulta ->execute();
$consulta = $consulta ->fetchAll();
if(!$consulta){
	$mensaje .= 'NO HAY CITAS PARA MOSTRAR';
}
?>
<?php include 'plantillas/header.php'; ?>
	<script language="javascript">
		function msg(id){
			var mensaje;
    		var opcion = confirm("Desea eliminar el registro");
    		if (opcion == true) {
    			location.href='eliminar_citas.php?idcita='+id;
			} 
		}
	</script>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>CITAS</h2>
					</div>
					<a class="agregar" href="agregarcitas.php">Agregar Citas</a>
					<table class="tabla">
						  <tr>
							<th>#</th>
							<th>Fecha</th>
							<th>Hora</th>
							<th>Paciente</th>
							<th>Medico</th>
							<th>Consultorio</th>
							<th>Estado</th>
							<th colspan="2">Opciones</th>
						  </tr>
						<?php foreach ($consulta as $Sql): ?>
						<tr>
						<?php echo "<td class='mayusculas'>". $Sql['idcita']. "</td>"; ?>
						<?php echo "<td class='mayusculas'>". $Sql['citfecha']. "</td>"; ?>
						<?php echo "<td class='mayusculas'>". $Sql['cithora']. "</td>"; ?>
						<?php echo "<td class='mayusculas'>". $Sql['pacNombre']." ".$Sql['pacApellidopat']. " ".$Sql['pacApellidomat']."</td>"; ?>
						<?php echo "<td class='mayusculas'>". $Sql['mednombres']." ".$Sql['medapellidopat']." ".$Sql['medapellidomat']. "</td>"; ?>
						<?php echo "<td class='mayusculas'>". $Sql['citConsultorio']. "</td>"; ?>
						<?php echo "<td class='mayusculas'>". $Sql['citestado']. "</td>"; ?>
                        <?php echo "<td class='centrar'>"."<a href='actualizarcitas.php?idcita=".$Sql['idcita']."' class='editar'>Editar</a>". "</td>"; ?>
						<?php echo "<td class='centrar'>"."<a onclick=msg(".$Sql['idcita'].") class='eliminar'>Eliminar</a>". "</td>"; ?>
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