<?php
$mensaje='';
try{
	$conexion = new PDO('mysql:host=192.168.88.26;dbname=centromedico','ubase','12345');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}

$consulta = $conexion -> prepare("
	SELECT * FROM usuarios limit 5");

$consulta ->execute();
$consulta = $consulta ->fetchAll();
if(!$consulta){
	$mensaje .= 'NO HAY USUARIOS PARA MOSTRAR';
}
?>
<?php include 'plantillas/header.php'; ?>
	<script language="javascript">
		function msg(id){
			var mensaje;
    		var opcion = confirm("Desea eliminar el registro");
    		if (opcion == true) {
    			location.href='eliminar_usuario.php?id='+id;
    			alert("Eliminado correctamente");
			} 
		}
	</script>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>USUARIOS</h2>
					</div>
					<a class="agregar" href="registrarusuarios.php">Agregar Usuarios</a>
						<table class="tabla">
						  <tr>
							<th>Nombres</th>
							<th>Apellido paterno</th>
							<th>Apellido materno</th>
                            <th>Usuario</th>
							<th>Roll</th>
                            <th colspan="2">Opciones</th>
						  </tr>
						<?php foreach ($consulta as $Sql): ?>
						<tr>
							<?php echo "<td>". $Sql['nombres']. "</td>"; ?>
                            <?php echo "<td>". $Sql['apellidopat']. "</td>"; ?>
                            <?php echo "<td>". $Sql['apellidomat']. "</td>"; ?>
                            <?php echo "<td>". $Sql['usuario']. "</td>"; ?>
                            <?php echo "<td>". $Sql['Roll']. "</td>"; ?>
                            <?php echo "<td class='centrar'>"."<a href='actualizarusuario.php?id=".$Sql['id']."' class='editar'>Editar</a>". "</td>"; ?>
                            
						  <?php echo "<td class='centrar'>"."<a onclick=msg(".$Sql['id'].") class='eliminar'>Eliminar</a>"."</td>"; ?>
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