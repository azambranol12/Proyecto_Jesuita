<?php

//Conecta con la base de datos
	include 'configdb.php'; // include del archivo con los datos de conexión
	$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); // Conecta con la base de datos
	$conexion->set_charset("utf8"); // Usa juego caracteres UTF8

//Desactiva errores
	$controlador = new mysqli_driver();
	$controlador->report_mode = MYSQLI_REPORT_OFF;
	
//Recibe la ip y el nombre de ciudaf.php
	$ip = $_POST["ip"];
	$jesuita = $_POST["nombre"]; 
	
//Primero selecciona el jesuita y verifica que este
	$sql_id = "SELECT idJesuita FROM jesuita WHERE nombre = '$jesuita'";
	$resultado_id = $conexion->query($sql_id);
	$idJesuita = $resultado_id->fetch_assoc()["idJesuita"];
	
	
//Inserta las filas jesuita e ip en la base de datos
	echo $sql = "INSERT INTO visita (idJesuita, ip) VALUES ('$idJesuita', '$ip')";
	$conexion->query($sql);
	
//Nos muestra lo que hemos realizado y la ip del lugar
	echo '<br>';
	echo "La IP seleccionada es: ".$ip."Visita realizada con exito";
	echo'<h2><a href="CiudadF.php">Volver hacer otra visita</a></h2>';
	
	$conexion->close();
?>