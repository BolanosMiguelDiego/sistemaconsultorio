<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=decive-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
    <title>Iniciar </title>
    <link rel="stylesheet" href="css/login3.css">
    <link rel="icon" type="image/x-svg" href="img/login.png">

</head>
<body>
	<form class="login" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" name="login">
        <h2>Dra. Carolina Cobarrubias Miranda</h2>
       
        <img src="img/login.png">
        <input type="text" name="usuario"placeholder="Usuario" class="bordes" autofocus/>
        <input type="password" name="password" placeholder="Contraseña" class="bordes"/>
        <input type="submit" value="Ingresar"></input>
        <?php  if(!empty($errores)): ?>
          <ul>
              <?php echo $errores; ?>
          </ul>
        <?php  endif; ?>
      </form>
</body>
</html>