<?php
$mensaje='';
try{
	$conexion = new PDO('mysql:host=192.168.88.26;dbname=centromedico','ubase','12345');
	$conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}
//SELECT PARA MEDICOS
$medicos = $conexion -> prepare("SELECT * FROM medicos");

$medicos ->execute();
$medicos = $medicos ->fetchAll();
if(!$medicos)
	$mensaje .= 'No hay medicos, por favor registre primero! <br />';
?>
<?php include 'plantillas/header.php'; ?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>Generar reporte de citas</h2>
					</div>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
						
						<script>
							    function numeros(e)
							    {
							        key = e.keyCode || e.which;
							        tecla = String.fromCharCode(key).toLowerCase();
							        letras = " 0123456789";
							        especiales = [8,37,39,46];
							     
							        tecla_especial = false
							        for(var i in especiales){
							     			if(key == especiales[i]){
							         			tecla_especial = true;
							         			break;
							            	} 
							        }
							     
							        if(letras.indexOf(tecla)==-1 && !tecla_especial){
							            return false;
							        }
								}
						</script>

						<label>Ingrese año:</label>
                        <input type="text" name="ano" placeholder="" maxlength="4" minlength="4"  onkeypress="return numeros(event)" required/>
                        


                        <label>Seleccione mes:</label>
                        <select name="mes" class="mayusculas" required>
                        		<option value="Enero">Enero</option>
                        		<option value="Febrero">Febrero</option>
                        		<option value="Marzo">Marzo</option>
                        		<option value="Abril">Abril</option>
                        		<option value="Mayo">Mayo</option>
                        		<option value="Junio">Junio</option>
                        		<option value="Julio">Julio</option>
                        		<option value="Agosto">Agosto</option>
                        		<option value="Septiembre">Septiembre</option>
                        		<option value="Octubre">Octubre</option>
                        		<option value="Noviembre">Noviembre</option>
                        		<option value="Diciembre">Diciembre</option>
                        </select>
                        
                        <label>Seleccione médico:</label>
                        <select name="medico" class="mayusculas" required> 
	                        <?php foreach ($medicos as $Sql): ?>
							<?php echo "<option value='". $Sql['mednombres']. "'>". $Sql['mednombres']." ". "</option>"; ?>
							<?php endforeach; ?>
                        </select>


						
						<input type="submit" name="enviar" value="Generar reporte">
					

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