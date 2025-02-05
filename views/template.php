<?php
	/*============== Iniciar Variables de sesión ================================*/
	ob_start();
	session_start();

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
    <script src="/views/assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="/views/assets/plugins/material-preloader/material-preloader.js"></script>
    <script src="/views/assets/plugins/toastr/toastr.min.js"></script>

</head>

<body>

	<?php if(!empty($routesArray[0])): ?>
		
		<!-- Si la ruta es logout, cerrar la sesión -->
		<?php if($routesArray[0] == 'logout'){
			include "pages/".$routesArray[0]."/".$routesArray[0].".php";
		}?>

	<?php else: ?>

		<!-- Top Navbar -->
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark" id="top">
		<div class="container">
			<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link active" href="/">File Manager System</a>
			</li>
			</ul>

			<!-- Botón Iniciar Sesión -->
			<?php if (isset($_SESSION["admin"])): ?>
				<div class="d-flex">
					<a href="/logout" class="ms-auto px-3 text-white">Cerrar sesión</a>
				</div>
			<?php else: ?>
				<div class="d-flex">
					<a href="#myLogin" class="ms-auto px-3 text-white" data-bs-toggle="modal">Iniciar sesión</a>
				</div>
			<?php endif ?>

		</div>
		</nav>

		<!-- Contenido -->
		<div class="container-fluid p-4 min-vh-100" id="content">
			<div class="container bg-white border rounded">

				<!--=== SEARCH & BUTTONS =================
					SEARCH & BUTTONS
					======================================-->
				<div class="row py-4 px-4 pb-2">

					<!--=== 'BUSCADOR' 
						'BUSCADOR' 
						======================================-->
					<div class="col-12 col-lg-6">
						<div class="input-group mt-1">
							<input type="text" class="form-control rounded-start" placeholder="Busca archivos">
							<button type="button" class="input-group-text rounded-end"><i class="bi bi-search"></i></button>
						</div>
					</div>
					
					<!--=== 'BOTONES' 
						'BOTONES' 
						======================================-->
					<div class="col-12 col-lg-6">
						<div class="d-flex flex-row-reverse">
							<div class="p-1">
							<button type="button" class="btn btn-sm py-2 px-3 bg-info-50 font-weight-bold rounded"><i class="bi bi-arrow-up-circle pe-1"></i> Iniciar Subida</button>
							</div>
							<div class="p-1">
							<button type="button" class="btn btn-sm py-2 px-3 bg-success-50 font-weight-bold rounded"><i class="bi bi-plus-lg pe-1"></i> Agregar Archivos</button>
							</div>
						</div>
					</div>

				</div>

				<!--=== Carpetas y Filtros ============================
					'Carpetas y Filtros' 
					======================================-->
				<div class="row pb-4 px-4 py-1">
					
					<!--=== Carpetas
						Carpetas o Servidores donde se subirán los archivos
						Pueden ser: Servidores, AWS S3, Google Drive, Dropbox
						======================================-->
					<div class="col-12 col-lg-7 mt-3">
						<div class="row">

							<!-- Servidor Local -->
							<div class="col">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="check1" name="option1" value="something" checked>
									<label class="form-check-label ps-1 align-middle">Servidor</label>
								</div>
								<div class="progress mt-1" style="height:10px">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" style="width:90%">90%</div>
								</div>
							</div>

							<!-- AWS S3 -->
							<div class="col">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="check1" name="option1" value="something" checked>
									<label class="form-check-label ps-1 align-middle">AWS S3</label>
								</div>
								<div class="progress mt-1" style="height:10px">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width:20%">20%</div>
								</div>
							</div>

							<!-- Cloudinary -->
							<div class="col">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="check1" name="option1" value="something" checked>
									<label class="form-check-label ps-1 align-middle">Cloudinary</label>
								</div>
								<div class="progress mt-1" style="height:10px">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" style="width:60%">60%</div>
								</div>
							</div>

							<!-- Vimeo -->
							<div class="col">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="check1" name="option1" value="something" checked>
									<label class="form-check-label ps-1 align-middle">Vimeo</label>
								</div>
								<div class="progress mt-1" style="height:10px">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" style="width:80%">80%</div>
								</div>
							</div>

							<!-- Mailchimp -->
							<div class="col">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="check1" name="option1" value="something" checked>
									<label class="form-check-label ps-1 align-middle">Mailchimp</label>
								</div>
								<div class="progress mt-1" style="height:10px">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" style="width:90%">90%</div>
								</div>
							</div>

						</div>
						
					</div>

					<!--=== 'Filtros' 
						'Filtros' 
						======================================-->
					<div class="col-12 col-lg-5 mt-3">
						<div class="d-flex flex-row-reverse">

							<!-- Vista Lista o Cuadricula -->
							<div class="btn-group rounded">
								<!-- Botón Cuadricula -->
								<button type="button" class="btn btn-default border rounded-start text-secondary changeView" module="grid">
									<i class="bi bi-grid-3x3-gap-fill"></i>
								</button>

								<!-- Botón Lista -->
								<button type="button" class="btn btn-default border rounded-end bg-dark changeView text-white" module="list">
									<i class="bi bi-list"></i>
								</button>
							</div>

							<!-- Ordenar por -->
							<select class="form-select rounded mx-2" id="sortBy">
							<option value="">Ordenar por</option>
							<option value="date_updated_file-DESC">Nuevo primero</option>
							<option value="date_updated_file-ASC">Antiguo primero</option>
							<option value="size_file-DESC">Mas grande primero</option>
							<option value="size_file-ASC">Mas chico primero</option>
							<option value="name_file-ASC">A-Z</option>
							<option value="name_file-DESC">Z-A</option>
							</select>

							<!-- Filtrar por -->
							<select class="form-select rounded" id="filterBy">
							<option value="">Filtrar por</option>
							<option value="ALL">Todos</option>
							<option value="images/JPG">imágenes/JPG</option>
							<option value="video/mp4">video/mp4</option>
							<option value="application/pdf">aplicación/pdf</option>
							<option value="application/zip">aplicación/zip</option>
							</select>
							
						</div>
					</div>

				</div>

				<!--=== Drag and Drop 
					Drag and Drop 
					======================================-->
				<div class="container mb-3">
					<div class="jumbotron p-5 text-center rounded" id="dragFiles">
						<h4>¡Arrastra archivos aquí!</h4>
					</div>		
				</div>

				<!--=== Tabla Listado 
					Listado 
					======================================-->
				<div class="table-responsive modules" id="list">
					<table class="table mb-5">
						<thead>
							<th>Vista</th>
							<th>Nombre</th>
							<th>Tamaño</th>
							<th>Carpeta</th>
							<th>Link</th>
							<th>Modificado</th>
							<th>Acciones</th>
						</thead>
						<tbody>
							<?php for ($i = 0; $i < 10; $i++): ?>
								<tr style="height:100px">

									<!-- Vista -->
									<td>
										<img src="https://placehold.co/100x100" alt="" class="rounded">
									</td>

									<!-- Nombre -->
									<td class="align-middle">
										<div class="input-group">
											<input type="text" class="form-control" placeholder="lorem_ipsum">
											<span class="input-group-text">.jpg</span>
										</div>
									</td>

									<!-- Tamaño -->
									<td class="align-middle">
										415.2 MB
									</td>

									<!-- Carpeta -->
									<td class="align-middle">
										<span class="badge bg-dark rounded px-3 py-2 text-white">AWS S3</span>
									</td>

									<!-- Link -->
									<td class="align-middle">
										http://file-manager-system.com/lorem_i...
										<i class="bi bi-box-arrow-up-right ps-2 btn"></i>
									</td>

									<!-- Modificado -->
									<td class="align-middle">
										2024-07-05, 12:07:00
									</td>

									<!-- Acciones -->
									<td class="align-middle">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16" style="cursor:pointer">
										<path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
										</svg>
									<i class="bi bi-trash ps-2 btn"></i>
									</td>

								</tr>
							<?php endfor ?>
						</tbody>
					</table>
				</div>

				<!--=== Tabla Cuadriculado
						Cuadriculado
						======================================-->
				<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 row-cols-xl-5 my-4 px-2 modules" id="grid" style="display: none;">
				
					<?php for ($i = 0; $i < 10; $i++): ?>
						<div class="col">

							<!-- Card -->
							<div class="card rounded p-3 border-0 shadow my-3">

								<!-- Card Header -->
								<div class="card-header bg-white border-0 p-0">
									<div class="d-flex justify-content-between mb-2">
										<!-- Upload Button -->
										<div class="bg-white">
											<i class="bi bi-box-arrow-up-right ps-2 btn p-0"></i>
										</div>
										<!-- Copy Button and Trash -->
										<div class="bg-white m-0">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16" style="cursor:pointer">
												<path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
											</svg>
											<i class="bi bi-trash p-0 ps-2 btn"></i>
										</div>
									</div>
								</div>

								<img src="https://placehold.co/100x100" class="card-img-top rounded">

								<!-- Card Body -->
								<div class="card-body p-1">
									<p class="card-text">
								
										<!-- File Name -->
										<div class="input-group">
											<input type="text" class="form-control" placeholder="lorem_ipsum">
											<span class="input-group-text">.jpg</span>
										</div>

										<!-- File Size and Server -->
										<div class="d-flex justify-content-between mt-3">
											<div class="bg-white">
												<p class="small mt-1">415.2 MB</p>
											</div>
											<div class="bg-white m-0">
												<span class="badge bg-dark border rounded px-3 py-2 text-white">Mailchimp</span>
											</div>
										</div>

										<!-- Date -->
										<h6 class="float-end my-0 py-0">
											<small>2024-07-05, 12:07:00</small>
										</h6>

									</p>
								</div>

							</div>

						</div>
					<?php endfor ?>

				</div>

			</div>
		</div>

		<!-- Botón Subir -->
		<a href="#top" id="up">
			<i class="bi bi-chevron-up"></i>
		</a>
		
	<?php endif ?>


	<!-- Ventana Modal Login -->
	<div class="modal" id="myLogin" data-bs-keyboard="true" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content rounded">

				<form method="POST">

					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title"></h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>

					<!-- Modal body -->
					<div class="modal-body px-5 pb-4">

						<h3 class="mb-3 text-center">File Manager System</h3>

						<!-- email -->
						<!-- form-floating para que el label quede dentro del input -->
						<div class="form-floating mb-3">
							<input type="text" class="form-control rounded" id="email" name="email_admin" required>
							<label for="email">Correo Electrónico</label>
						</div>

						<!-- password -->
						<div class="form-floating mb-3">
							<input type="password" class="form-control rounded" id="pwd" name="password_admin" required>
							<label for="pwd">Contraseña</label>
						</div>

					</div>

					<?php
						require_once 'controllers/admins.controller.php';
						$login = new AdminsController();
						$login->login(); // Ejecutar la función
					?>

					<!-- Modal footer -->
					<div class="modal-footer d-flex justify-content-between">
						<div>
							<button type="button" class="btn btn-default border rounded" data-bs-dismiss="modal">Cerrar</button>
						</div>
						<div>
							<button type="submit" class="btn btn-dark rounded">Iniciar sesión</button>
						</div>
					</div>

				</form>

			</div>
		</div>
	</div>

	<!-- JS Scrips de FMS -->
	<script src="/views/assets/js/fms/fms.js"></script>

</body>

</html>
