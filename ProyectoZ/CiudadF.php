<?php
	session_start(); // Inicia la sesión
//Conecta con la base de datos
	include 'configdb.php'; // include del archivo con los datos de conexión
	$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); // Conecta con la base de datos
	$conexion->set_charset("utf8"); // Usa juego caracteres UTF8

//Desactiva errores
	$controlador = new mysqli_driver();
	$controlador->report_mode = MYSQLI_REPORT_OFF;
	
	$sql_lugares = "SELECT ip, lugar FROM lugar;";
	$resultado_lugares = $conexion->query($sql_lugares);
	
//Jesuita nombre
	$jesuita = $_SESSION["nombre"];
?>

<html>
<head>
	<title>Visita</title>
	<meta name="autor" content="Adrián Zambrano">
	<meta charset="utf-8">
	<link rel="stylesheet" href="css2.css">
</head>
<body>
	<form name="Visita" method="POST" action="guardarVisita.php" class="opa">
	<?php echo '<h1 class="titulo">Bienvenido a la página ' . $jesuita . '</h1>'; ?>
	<label for="lugar">Lugar:</label><br>
		<input type="hidden" name="nombre" <?php echo 'value="'.$jesuita.'"'?>>
		<select id="ciudades" name="ip">
			<?php
			// Mostrar las opciones de lugares
			while ($fila = $resultado_lugares->fetch_array()) {
				echo '<option class="visita" value="' . $fila["ip"] . '">' . $fila["lugar"] . '</option>'; //Permite coger los valores de la base de datos en vez de ser puestos uno a uno
			}
			$conexion->close();?>
			
		</select>
		<input type="submit" value="Enviar" class="enviar">
	</form>
</body>
</html>
