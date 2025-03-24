<?php

session_start(); // Inicia la sesión

//Conecta con la base de datos ($conexión)
    include 'configdb.php'; //include del archivo con los datos de conexión
	$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); //Conecta con la base de datos
    $conexion->set_charset("utf8"); //Usa juego caracteres UTF8
	
//Desactiva errores
	$controlador = new mysqli_driver();
    $controlador->report_mode = MYSQLI_REPORT_OFF;
	
//Recoge la información de lugar.html
	$nombre=$_POST["nombre"];
	$codigo=$_POST["codigo"];
	
	
//Verificar si el usuario existe en la base de datos y si exite se ejecuta si no debes volver a inciar sesion
	$sql = "SELECT nombre, codigo FROM jesuita WHERE codigo = '$codigo' AND nombre = '$nombre'";
	$resultado = $conexion->query($sql);
	echo $sql;

	if ($resultado->num_rows > 0) {
		$_SESSION["nombre"] = $nombre; //Y sin el session no he encontrado manera de pasar el valor del nombre a otro sitio si no era asi
		echo '<h1>Jesuita introducido correctamente</h1>';
		echo '<br>';
		echo '<h2><a href="Ciudadf.php">Continua con la visita</a></h2>'; //Header te permite abrir directamente la pagina a la que haces referencia en vez de abrir una pagina y continuar la visita
	} else {
		echo '<h1>ERROR: El jesuita introducido no existe.</h1>';
		echo '<h3><a href="Lugar.html">Volver a inicio</a></h3>';
		exit(); 
}

$conexion->close();
?>
