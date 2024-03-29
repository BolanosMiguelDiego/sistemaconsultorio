<?php
$mensaje='';
try{
	$conexion = new PDO('mysql:host=192.168.88.26;dbname=centromedico','ubase','12345');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}

$consulta = $conexion -> prepare("SELECT * FROM especialidades ORDER BY idespecialidad limit 5");

$consulta ->execute();
$consulta = $consulta ->fetchAll();
if(!$consulta){
	$mensaje .= 'NO HAY ESPECIALIDADES PARA MOSTRAR';
}
?>
<?php include 'plantillas/header.php'; ?>
	</div>
	<script language="javascript">
		function msg(id){
			var mensaje;
    		var opcion = confirm("Desea eliminar el registro");
    		if (opcion == true) {
    			location.href='eliminar_especialidades.php?idespecialidad='+id;
			} 
		}
	</script>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>ESPECIALIDADES</h2>
					</div>
						<a class="agregar" href="agregarEspecialidades.php">Agregar Especialidades</a>
						<table class="tabla">
						  <tr>
							<th>#</th>
							<th>Nombre</th>
							<th colspan="2">Opciones</th>
						  </tr>
						<?php foreach ($consulta as $Sql): ?>
						<tr>
						<?php echo "<td>". $Sql['idespecialidad']. "</td>"; ?>
						<?php echo "<td>". $Sql['espNombre']. "</td>"; ?>
                        <?php echo "<td class='centrar'>"."<a href='actualizarespecialidades.php?idespecialidad=".$Sql['idespecialidad']."' class='editar'>Editar</a>". "</td>"; ?>
						<?php echo "<td class='centrar'>"."<a onclick=msg(".$Sql['idespecialidad'].") class='eliminar'>Eliminar</a>". "</td>"; ?>
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