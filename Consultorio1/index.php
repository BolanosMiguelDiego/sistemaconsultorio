<?php session_start();
if (isset($_SESSION['usuario'])){
	header('Location:pagina.php');
}else{
	header('Location: login.php');
}	
?>