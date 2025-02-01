$(document).ready(function () {

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

});