<?php include 'plantillas/header.php'; ?>
<script type="text/javascript" src="js/confirmacion.js"></script>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>CONSULTORIOS</h2>
					</div>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
						<h2>Agregar Consultorios</h2>
                        <label>Nombres: *</label>
                        <input requerid type="text" name="nombre" placeholder="0" onkeypress='return validaNumericos(event)' maxlength="3" />
						<input type="submit" name="enviar" value="Agregar Consultorio">
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