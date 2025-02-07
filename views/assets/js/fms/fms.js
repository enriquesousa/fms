// *******************************
// Cambiar de Listado a Cuadricula
// *******************************
$(document).on("click", ".changeView", function () {

	// var module = $(this).attr("module");
	// console.log("module: ", $(this).attr("module"));
	// nos regresa list o grid

	// Capturar todos los módulos que tengan la clase modules
	var modules = $(".modules");

	// Ocultar todos los módulos (elementos DOM lso div con la clase modules)
	modules.each((i)=>{
		$(modules[i]).hide();
	})

	// Solo mostrar el módulo que venga en el atributo module
	$("#"+$(this).attr("module")).show();

	// Para cambiar el color de los botones list y grid
	var changeView = $(".changeView");
	// Le ponemos color neutro a los dos botones
	changeView.each((i)=>{
		// Color de texto
		$(changeView[i]).removeClass("text-white")
		$(changeView[i]).addClass("text-secondary")

		// Color de fondo
		$(changeView[i]).removeClass("bg-dark")
		$(changeView[i]).addClass("bg-white")
	})

	// Texto: Le cambiamos el color al que se le dio click
	$(this).addClass("text-white")
	$(this).removeClass("text-secondary")

	// Fondo: Le cambiamos el color al que se le dio click
	$(this).addClass("bg-dark")
	$(this).removeClass("bg-white")
	
});

// *******************************
// Zona Drag and Drop
// *******************************
$("#dragFiles").on('dragover', function (e) {
	e.preventDefault();
	e.stopPropagation(); // para cuando estemos pasando el archivo sobre la zona se active el dragover
	$(this).addClass("bg-light");
});

$("#dragFiles").on('dragenter', function (e) {
	e.preventDefault();
	e.stopPropagation();
});

$("#dragFiles").on('mouseleave', function (e) {
	e.preventDefault();
	e.stopPropagation();
	$(this).removeClass("bg-light");
});

$("#dragFiles").on('drop', function (e) {
	e.preventDefault();
	e.stopPropagation();

	if(e.originalEvent.dataTransfer){
		if(e.originalEvent.dataTransfer.files.length){
			$(this).removeClass("bg-light");

			var t = new Date();
			var time = t.getFullYear()+"-"+("0"+(t.getMonth()+1)).slice(-2)+"-"+("0"+t.getDate()).slice(-2)+", "+t.toLocaleTimeString();

			uploadFiles(e.originalEvent.dataTransfer.files, 'drag', time);
		}
	}

});

// *******************************
// Subir Archivos
// *******************************
var files;
function uploadFiles(event, type, time) {

	// console.log("event", event);
	// return;

	// Captura de los archivos
	if(type == 'btn'){
		files = event.target.files;
	}else{
		files = event;
	}

	// Recorriendo los archivos
	Array.from(files).forEach((file, index) => {

		// console.log("file", file);

		// ------------------
		// Capturar el nombre
		// ------------------
		var name = file.name.split('.'); // separamos en un array donde nos separa el .
		name.pop(); // el ultimo elemento del array lo eliminamos porque este va a ser la extension
		name = name.toString().replace(/,/g, '_'); // y si hay un nombre de archivo que tenia un . el split lo convierte en , y aquí lo convertimos en _
		// console.log("name:", name);

		// ---------------------
		// Capturar la extension
		// ---------------------
		var extension = file.name.split('.').pop();
		// console.log("extension:", extension);

		// ---------------------
		// Capturar tamaño en MB
		// ---------------------
		var size = (Number(file.size)/1000000).toFixed(2);
		// console.log("size:", size);


		// ---------------------------------------------------
		// Visualizar los archivos a subir en la tabla - lista
		// ---------------------------------------------------
		$("#list table tbody tr:first-child").before(` 
			
			<tr style="height:100px">

				<!-- Vista -->
				<td>
					<img src="https://placehold.co/100x100" alt="" class="rounded">
				</td>

				<!-- Nombre -->
				<td class="align-middle">
					<div class="input-group">
						<input type="text" class="form-control" value="${name}">
						<span class="input-group-text">.${extension}</span>
					</div>
				</td>

				<!-- Tamaño -->
				<td class="align-middle">
					${size} MB
				</td>

				<!-- Carpeta -->
				<td class="align-middle">
					<span class="badge bg-dark rounded px-3 py-2 text-white">Servidor</span>
				</td>

				<!-- Progress bar -->
				<td class="align-middle">
					<div class="progress-spinner"></div>
					<div class="progress mt-1" style="height:10px">
						<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width:0%">0%</div>
					</div>
				</td>

				<!-- Fecha Modificado -->
				<td class="align-middle">
					${time}
				</td>

				<!-- Acciones -->
				<td class="align-middle">
					<button type="button" class="btn btn-sm py-2 px-3 bg-default border font-weight-bold rounded">
						<i class="bi bi-x-circle"></i> Eliminar
					</button>
				</td>

			</tr>
			
		`);

		// ---------------------------------------------------
		// Visualizar los archivos a subir en la tabla - Grid
		// ---------------------------------------------------
		$("#grid .col:first-child").before(`

			<div class="col">
				<div class="card rounded p-3 border-0 shadow my-3">
	
					<!-- Card Header -->
					<div class="card-header bg-white border-0 p-0">
						<div class="d-flex justify-content-between mb-2">
							<!-- Barra de progreso -->
							<div class="bg-white w-50">
								<div class="progress-spinner"></div>
								<div class="progress mt-1" style="height:10px">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width:0%">0%</div>
								</div>
							</div>
							<!-- Button Eliminar -->
							<div class="bg-white m-0">
								<button type="button" class="btn btn-sm py-2 px-3 bg-default border font-weight-bold rounded">
									<i class="bi bi-x-circle"></i> Clear
								</button>
							</div>
						</div>
					</div>
	
					<img src="https://placehold.co/100x100" class="card-img-top rounded">
	
					<!-- Card Body -->
					<div class="card-body p-1">
						<p class="card-text">
	
							<!-- File Name -->
						<div class="input-group">
							<input type="text" class="form-control" value="${name}">
							<span class="input-group-text">.${extension}</span>
						</div>
	
						<!-- File Size and Server -->
						<div class="d-flex justify-content-between mt-3">
							<div class="bg-white">
								<p class="small mt-1">${size} MB</p>
							</div>
							<div class="bg-white m-0">
								<span class="badge bg-dark border rounded px-3 py-2 text-white">Servidor</span>
							</div>
						</div>
	
						<!-- Date -->
						<h6 class="float-end my-0 py-0">
							<small>${time}</small>
						</h6>
	
						</p>
					</div>
	
				</div>
			</div>

		`);


	});

	// console.log("files", files);
	// console.log("time", time);
	
}