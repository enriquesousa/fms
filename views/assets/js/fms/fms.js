/* ------------------------------- */
/* Cambiar de Listado a Cuadricula */
/* ------------------------------- */
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

	/* Ajustar imágenes cuando activamos el grid */
	if($(this).attr("module") == "grid"){
		imgAdjustGrid();
	}

});

/* ------------------ */
/* Zona Drag and Drop */
/* ------------------ */
$("#dragFiles").on('dragover', function (e) {
	e.preventDefault();
	e.stopPropagation(); // para cuando estemos pasando el archivo sobre la zona se active el dragover
	$(this).addClass("bg-info-50");
});

$("#dragFiles").on('dragenter', function (e) {
	e.preventDefault();
	e.stopPropagation();
});

$("#dragFiles").on('mouseleave', function (e) {
	e.preventDefault();
	e.stopPropagation();
	$(this).removeClass("bg-info-50");
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

/* -------------- */
/* Subir Archivos */
/* -------------- */
var files;
function uploadFiles(event, type, time) {

	// Activar el preloader barra linea que se ve en la parte superior y un sweet alert
	fncMatPreloader("on");
	fncSweetAlert("loading", "Subiendo archivos...", "");
	
	// Captura de los archivos
	if(type == 'btn'){
		files = event.target.files;
	}else{
		files = event;
	}

	// Recorriendo los archivos
	Array.from(files).forEach((file, index) => {


		if( file.type.split("/")[0] == "image" || 
			file.type.split("/")[0] == "video" ||
			file.type.split("/")[0] == "audio" ||
			file.type.split("/")[1] == "pdf" ||
			file.type.split("/")[1] == "zip"
			){

			/* Capturar el nombre */
			var name = file.name.split('.'); // separamos en un array donde nos separa el .
			name.pop(); // el ultimo elemento del array lo eliminamos porque este va a ser la extension
			name = name.toString().replace(/,/g, '_'); // y si hay un nombre de archivo que tenia un . el split lo convierte en , y aquí lo convertimos en _
			// console.log("name:", name);

			/* Capturar la extension */
			var extension = file.name.split('.').pop();
			// console.log("extension:", extension);

			/* Capturar tamaño en MB */
			var size = (Number(file.size)/1000000).toFixed(2);
			// console.log("size:", size);


			/* Captura la miniatura si el archivo es una Imagen */
			var path;
			if(file.type.split('/')[0] == "image"){

				var data = new FileReader();
				data.readAsDataURL(file);

				$(data).on('load', function(event) {
					// console.log("event", event);
					path = event.target.result;

					// Pintar en el DOM solo cuando se haya capturado la miniatura
					paintFiles(path, name, extension, size, time);
				})

			}

			/* Captura la miniatura si el archivo es un Video */
			if(file.type.split('/')[0] == "video"){

				// Si es un video mp4
				if(file.type.split('/')[1] == "mp4"){

					// Para poder sacar la miniatura del video, convertir elemento en canvas
					var canvas = document.createElement("canvas");
					var video = document.createElement("video");

					video.autoplay = true;
					video.muted = true;
					video.src = URL.createObjectURL(file);

					video.onloadeddata = () => {

						var ctx = canvas.getContext("2d");

						canvas.width = video.videoWidth;
						canvas.height = video.videoHeight;

						ctx.drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
						video.pause();

						path = canvas.toDataURL("image/png");

						// Pintar en el DOM solo cuando se haya capturado la miniatura de video mp4
						paintFiles(path,name,extension,size,time);
					}
				}else{
					// Si NO es un video mp4
					path = "/views/assets/img/multimedia.png";
					paintFiles(path,name,extension,size,time);
				}

			}

			/* Captura la miniatura si el archivo es un Audio */
			if(file.type.split('/')[0] == "audio"){
				path = "/views/assets/img/multimedia.png";
				paintFiles(path,name,extension,size,time);
			}

			/* Captura la miniatura si el archivo es un PDF */
			if(file.type.split('/')[1] == "pdf"){
				path = "/views/assets/img/pdf.jpeg";
				paintFiles(path,name,extension,size,time);
			}

			/* Captura la miniatura si el archivo es un ZIP */
			if(file.type.split('/')[1] == "zip"){
				path = "/views/assets/img/zip.jpeg";
				paintFiles(path,name,extension,size,time);
			}

			/* Para pintar en el DOM lo vamos a pintar después de haber capturado las miniaturas */
			function paintFiles(path, name, extension, size, time){

				/* Visualizar los archivos a subir en la tabla - lista */
				$("#list table tbody tr:first-child").before(` 
					
					<tr style="height:100px">
		
						<!-- Vista -->
						<td>
							<img src="${path}" class="rounded" style="height:100px; width:100px; object-fit:cover; object-position:center">
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
		
				/* Visualizar los archivos a subir en la tabla - Grid */
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
			
							<img src="${path}" class="card-img-top rounded w-100">
			
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

				/* Ejecutar función ajuste de imagen */
				imgAdjustGrid();

				fncMatPreloader("off");
				fncSweetAlert("close", "", "");
			}

		}else{
			fncToastr("error", "El formato de archivo que intenta subir no es permitido");
			return;
		}

		
		

	});
	
}


/* ----------------------------- */
/* Ajuste de imagen para el grid */
/* ----------------------------- */
function imgAdjustGrid(){

	if($(".card-img-top").length > 0){

		var cardImgTop = $(".card-img-top");

		cardImgTop.each((i)=>{

			$(cardImgTop[i]).attr("style", "height:"+$(cardImgTop[i]).width()+"px;  object-fit: cover; object-position: center;");		
			
		})
	}

}




