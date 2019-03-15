<?php
$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','12345');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}

$consulta = $conexion -> prepare("
	SELECT * FROM consultorios order by idconsultorio limit 5");

$consulta ->execute();
$consulta = $consulta ->fetchAll();
if(!$consulta){
	$mensaje .= 'NO HAY CONSULTORIOS PARA MOSTRAR';
}
?>
<?php include 'plantillas/header.php'; ?>
	</div>
	<script language="javascript">
		function msg(id){
			var mensaje;
    		var opcion = confirm("Desea eliminar el registro");
    		if (opcion == true) {
    			location.href='eliminar_consultorio.php?idConsultorio='+id;
			} 
		}
	</script>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>CONSULTORIOS</h2>
					</div>
						<a class="agregar" href="agregarconsultorios.php">Agregar Consultorio</a>
						<table class="tabla">
						  <tr>
							<th>#</th>
							<th>Nombre</th>
							<th colspan="2">Opciones</th>
						  </tr>
						<?php foreach ($consulta as $Sql): ?>
						<tr>
						<?php echo "<td>". $Sql['idConsultorio']. "</td>"; ?>
						<?php echo "<td>". $Sql['conNombre']. "</td>"; ?>
                        <?php echo "<td class='centrar'>"."<a href='actualizarconsultorio.php?idConsultorio=".$Sql['idConsultorio']."' class='editar'>Editar</a>". "</td>"; ?>
						<?php echo "<td class='centrar'>"."<a onclick=msg(".$Sql['idConsultorio'].") class='eliminar'>Eliminar</a>". "</td>"; ?>
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