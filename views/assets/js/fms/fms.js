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

	if(type == 'btn'){
		files = event.target.files;
	}else{
		files = event;
	}

	console.log("files", files);
	console.log("time", time);
}