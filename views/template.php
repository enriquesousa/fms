<?php
	/*============== Iniciar Variables de sesión ================================*/
	ob_start();
	session_start();

	/*============== Zona Horaria ================================*/
	date_default_timezone_set('America/Tijuana'); 

	/*==============Capturar las rutas de la URL =======================================
			Capturar las rutas de la URL 
			No olvidar incluir el archivo .htaccess para servidores apache
			Si usamos nginx no necesitamos este archivo.
			Si recibimos una url como: http://fms.test/logout/exit?type=1&views=ok
			El resultado será: Array ( [0] => logout [1] => exit [2] => type=1&views=ok )
			Con explode("?",$value)[0] descarta los parámetros después del ?, quedandonos solo con:
			Array ( [0] => logout [1] => exit )
			=============================================*/

	// $routesArray = explode("/",$_SERVER["REQUEST_URI"]);
	// array_shift($routesArray); // Elimina la primera posición del array
	// echo '<pre>'; print_r($routesArray); echo '</pre>';

	$routesArray = explode('/', $_SERVER['REQUEST_URI']);
	array_shift($routesArray);

	foreach ($routesArray as $key => $value) {
		$routesArray[$key] = explode('?', $value)[0]; // descarta los parámetros después del ?
	}
	// echo '<pre>'; print_r($routesArray); echo '</pre>';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FMS | File Manager System</title>

    <!-- Icono de la página -->
    <link rel="icon" href="https://cdn.filestackcontent.com/1LIBQrPFRuGylthi5tUp">

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,600,500,700">

    <!-- Bootstrap 5 Ver módulos: https://www.w3schools.com/bootstrap5/bootstrap_get_started.php -->
    <link rel="stylesheet" href="/views/assets/plugins/bootstrap5/bootstrap.min.css">

    <!-- Bootstrap 5 Icons https://icons.getbootstrap.com/; lo hacemos con CDN por las fonts que son de Bootstrap y no las descargamos-->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">

    <!-- https://fontawesome.com/v5/search -->
    <link rel="stylesheet" href="/views/assets/plugins/fontawesome-free/css/all.min.css">

    <!-- jQuery UI https://jqueryui.com -->
    <link rel="stylesheet" href="/views/assets/plugins/jquery-ui/jquery-ui.css">

    <!-- Material Preloader -->
    <link rel="stylesheet" href="/views/assets/plugins/material-preloader/material-preloader.css">

    <!-- Toastr Demo: https://codeseven.github.io/toastr/demo.html GitHub: https://github.com/CodeSeven/toastr Site: https://codeseven.github.io/toastr/-->
    <link rel="stylesheet" href="/views/assets/plugins/toastr/toastr.min.css">

    <!-- FMS CSS Nuestro Propio Custom CSS -->
    <link rel="stylesheet" href="/views/assets/css/fms/fms.css">

    <!-- *********************************** -->
    <!-- JavaScripts 					    -->
    <!-- *********************************** -->
    <script src="/views/assets/plugins/jquery/jquery.min.js"></script>
    <script src="/views/assets/plugins/jquery-ui/jquery-ui.js"></script>
    <script src="/views/assets/plugins/bootstrap5/bootstrap.bundle.min.js"></script>

	<!-- Mis propias alertas -->
	<script src="/views/assets/js/alerts/alerts.js"></script>

    <script src="/views/assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="/views/assets/plugins/material-preloader/material-preloader.js"></script>
    <script src="/views/assets/plugins/toastr/toastr.min.js"></script>
</head>

<body>

	<?php if(!empty($routesArray[0])): ?>
		
		<?php if($routesArray[0] == 'logout'){

			include "pages/".$routesArray[0]."/".$routesArray[0].".php";
			
		}else{
			// Top Navbar
			include "views/modules/top/top.php";

			// Contenido
			include "views/modules/content/content.php";

			// Botón Subir	
			include "views/modules/up/up.php";

			// Ventana Modal Login
			include "views/modules/modal/modal.php";
		}?>

	<?php else: ?>

		<?php
			// Top Navbar
			include "views/modules/top/top.php";

			// Contenido
			include "views/modules/content/content.php";

			// Botón Subir	
			include "views/modules/up/up.php";

			// Ventana Modal Login
			include "views/modules/modal/modal.php";
		?>
		
	<?php endif ?>

	<!-- JS Scrips de FMS -->
	<script src="/views/assets/js/fms/fms.js"></script>

</body>

</html>
