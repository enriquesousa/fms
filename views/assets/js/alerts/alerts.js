/*=== Formatear envío de formulario lado servidor
    Para limpiar los formularios y de esa manera evito que el browser me este pidiendo que confirme el envío
===*/
function fncFormatInputs(){

    if(window.history.replaceState){
        window.history.replaceState( null, null, window.location.href );     
    }

}

/*=== Alerta Línea Precarga es una linea que se ve en la parte superior ===*/
function fncMatPreloader(type){

    var preloader = new $.materialPreloader({
        position: 'top',
        height: '5px',
        col_1: '#159756',
        col_2: '#da4733',
        col_3: '#3b78e7',
        col_4: '#fdba2c',
        fadeIn: 200,
        fadeOut: 200
    })

    if(type == "on"){
        preloader.on();
    }


    if(type == "off"){
        $(".load-bar-container").remove();
    }

}

/*=== Alerta Toastr ===*/
function fncToastr(type, text){

    var Toast = Swal.mixin({
        toast: true,
        // position: 'top-end',
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }

    })

    Toast.fire({
        icon: type,
        title: text
    })

}

/*=== Alerta SweetAlert ===*/
function fncSweetAlert(type, text, url){

    switch(type){

        case "success":

        if(url == ""){

            Swal.fire({

                icon: "success",
                title: "Correcto",
                text: text

            })

        }else{

            Swal.fire({

                icon: "success",
                title: "Correcto",
                text: text

            }).then((result)=>{

                if (result.value){ 

                    window.open(url, "_top");
                }

            })

        }    

        break;

        case "error":

        if(url == ""){

            Swal.fire({

                icon: "error",
                title: "Error",
                text: text

            })

        }else{

            Swal.fire({

                icon: "error",
                title: "Error",
                text: text

            }).then((result)=>{

                if (result.value){ 

                    window.open(url, "_top");
                }

            })

        }    

        break;

        case "loading":

            Swal.fire({
                allowOutsideClick: false,
                icon: 'info',
                text:text
              })
              Swal.showLoading()

        break;

        case "confirm":

            return new Promise(resolve =>{

                Swal.fire({
                    text: text,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Si, continuar!",
                    cancelButtonText: 'No'
                }).then((result) => {

                    resolve(result.value);
                    
                });

            });

        break;

        case "close":

             Swal.close()
             
        break;
    }

}

