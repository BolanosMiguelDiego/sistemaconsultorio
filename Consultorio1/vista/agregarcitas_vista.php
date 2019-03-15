<?php
$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','12345');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}
//SELECT PARA MEDICOS
$medicos = $conexion -> prepare("SELECT * FROM medicos");

$medicos ->execute();
$medicos = $medicos ->fetchAll();
if(!$medicos)
{
	$mensaje .= 'No hay medicos, por favor registre primero! <br />  <a href="agregarmedicos.php" class="agregar">Agregar Médico</a>';
	;
}
//SELECT PARA CONSULTORIOS
$consultorios = $conexion -> prepare("SELECT * FROM consultorios");

$consultorios ->execute();
$consultorios = $consultorios ->fetchAll();
if(!$consultorios)
{
	$mensaje .= 'No hay consultorios, por favor registre primero! <br /> <a class="agregar" href="agregarconsultorios.php">Agregar Consultorio</a>';
}
//SELECT PARA PACIENTES
$pacientes = $conexion -> prepare("SELECT * FROM pacientes");

$pacientes ->execute();
$pacientes = $pacientes ->fetchAll();
if(!$pacientes){
	$mensaje .= 'No hay pacientes, por favor registre primero! <br /> <a class="agregar" href="agregarpacientes.php">Agregar Paciente</a>';
	#header('Location: medicos.php');
}

?>
<?php include 'plantillas/header.php'; ?>
<script type="text/javascript" src="js/confirmacion.js"></script>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>CITAS</h2>
					</div>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
						<h2>Agregar Citas</h2>
						<label>Fecha:</label>
                        <input type="date" name="fecha" id="fecha" placeholder="Fecha:" required min=<?php $hoy=date("Y-m-d"); echo $hoy;?> />
                        <label>Hora:</label>
                        <input type="time" name="hora" value="11:45" max="15:30" min="09:00" step="60" required>
                        <label>Paciente:</label>
                        <select name="paciente" class="mayusculas" required> 
	                        <?php foreach ($pacientes as $Sql2): ?>
<?php echo "<option value='". $Sql2['idPaciente']. "'>". $Sql2['pacNombre']. " ".$Sql2['pacApellidopat']." ".$Sql2['pacApellidomat'].  "</option>"; ?>
							<?php endforeach; ?>
                        </select>
                        <label>Medicos:</label>
                        <select name="medico" class="mayusculas" required> 
	                        <?php foreach ($medicos as $Sql): ?>
							<?php echo "<option value='". $Sql['idMedico']. "'>". $Sql['mednombres']." ". $Sql['medapellidopat']." ".$Sql['medapellidomat']. "</option>"; ?>
							<?php endforeach; ?>
                        </select>
                        <label>Consultorios:</label>
                        
                        <select name="consultorio" class="mayusculas" required> 
	                        <?php foreach ($consultorios as $Sql2): ?>
							<?php echo "<option value='". $Sql2['conNombre']. "'>". $Sql2['conNombre']."</option>"; ?>
							<?php endforeach; ?>
                        </select>
                        <label>Estado:</label required>
                        <select name="estado">
                        	<option value="asignado">Asignado</option>
                        	<option value="atendido">Atendido</option>                    	
                        </select>
                        <label>Observaciones:</label>
                        <textarea placeholder="Observacion:" name="observaciones"></textarea>
						
						<input type="submit" name="enviar" value="Agregar Citas">
					
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