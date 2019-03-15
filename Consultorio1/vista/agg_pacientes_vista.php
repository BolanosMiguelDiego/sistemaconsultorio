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
						<h2>Agregar Pacientes</h2>
						<input required type="numeric" name="identificacion" placeholder="identificación:" onkeypress='return validaNumericos(event)'>
						<input required type="text" name="nombres" placeholder="Nombres:" onkeypress="return validar(event)">
						<input required type="text" name="apellidopat" placeholder="Apellido Paterno:" onkeypress="return validar(event)">
						<input required type="text" name="apellidomat" placeholder="Apellido Materno:" onkeypress="return validar(event)">
						<input type="date" name="fechaNacimiento" placeholder="Fecha Nacimiento:">
						<select name="sexo">
                            <option value="Masculino">Masculino</option>
							<option value="Femenino">Femenino</option> 
                        </select>
						
						<input type="submit" name="enviar" value="Agregar Paciente">
						
					</form>
						<?php  if(!empty($errores)): ?>
							<ul>
							  <?php echo $errores; ?>
							</ul>
						<?php  endif; ?>
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>