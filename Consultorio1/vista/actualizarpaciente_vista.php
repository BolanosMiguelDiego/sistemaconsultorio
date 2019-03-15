<?php include 'plantillas/header.php'; ?>
<script type="text/javascript" src="js/confirmacion.js"></script>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>PACIENTES</h2>
					</div>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
						<h2>EDITAR PACIENTE</h2>
						<input type="hidden" name="id" value="<?php echo $paciente['idPaciente'];?>" />
						
						<input type="numeric" name="identificacion" placeholder="Identificación" value="<?php echo $paciente['pacIdentificacion'];?>" requerid onkeypress='return validaNumericos(event)' maxlength="10">
						<input type="text" name="nombres" placeholder="Nombres:" value="<?php echo $paciente['pacNombre'];?>" onkeypress="return validar(event)" >
						<input type="text" name="apellidopat" 
                            placeholder="Apellidos:"   value="<?php echo $paciente['pacApellidopat'];?>" onkeypress="return validar(event)" >
                        <input type="text" name="apellidomat" 
                            placeholder="Apellidos:"   value="<?php echo $paciente['pacApellidomat'];?>" onkeypress="return validar(event)" >
						<input type="date" name="fechanacimiento" placeholder="Fecha Nacimiento:" value="<?php echo $paciente['pacFechaNacimiento'];?>">
						<input type="numeric" name="sexo" placeholder="Telefono:" value="<?php echo $paciente['pacSexo'];?>" onkeypress='return validaNumericos(event)' maxlength="10">
				
						<input type="submit" name="enviar" value="Actualizar">
			
					</form>


						<?php  if(!empty($errores)): ?>
							<ul>
							  <?php echo $errores; ?>
							</ul>
						<?php  endif; ?>
                    <a class="btn-regresar" href="pacientes.php">Regresar</a>
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>