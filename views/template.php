<?php 

	/*=============================================
	Capturar las rutas de la URL 
	No olvidar incluir el archivo .htaccess para servidores apache
	Si usamos nginx no necesitamos este archivo.
	Si recibimos una url como: http://fms.test/logout/exit?type=1&views=ok
	El resultado será: Array ( [0] => logout [1] => exit [2] => type=1&views=ok )
	Con explode("?",$value)[0] descarta los parámetros después del ?, quedandonos solo con:
	Array ( [0] => logout [1] => exit )
	=============================================*/

	$routesArray = explode("/",$_SERVER["REQUEST_URI"]);
	array_shift($routesArray); // Elimina la primera posición del array
	echo '<pre>'; print_r($routesArray); echo '</pre>';

	$routesArray = explode("/",$_SERVER["REQUEST_URI"]);
	array_shift($routesArray);

	foreach ($routesArray as $key => $value) {	
		$routesArray[$key] = explode("?",$value)[0]; // descarta los parámetros después del ?
	}
	echo '<pre>'; print_r($routesArray); echo '</pre>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<h1>Hola Mundo, soy la plantilla!</h1>
</body>
</html>