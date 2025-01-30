$(document).on("click",".changeView",function(){

	var modules = $(".modules");

	modules.each((i)=>{

		$(modules[i]).hide();

	})

	$("#"+$(this).attr("module")).show();

	var changeView = $(".changeView");

	changeView.each((i)=>{

		$(changeView[i]).removeClass("text-white")
		$(changeView[i]).addClass("text-secondary")

		$(changeView[i]).removeClass("bg-dark")
		$(changeView[i]).addClass("bg-white")

	})

	$(this).addClass("text-white")
	$(this).removeClass("text-secondary")

	$(this).addClass("bg-dark")
	$(this).removeClass("bg-white")
})