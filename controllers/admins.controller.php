<?php 

class AdminsController{

	/*=============================================
	Login de administradores
	=============================================*/	

	public function login(){

		if(isset($_POST["email_admin"]) && isset($_POST["password_admin"])){

			echo '<script>
					fncMatPreloader("on");
					fncSweetAlert("loading", "Cargando...", "");
				</script>';
			// return;


            $url = "admins?login=true&suffix=admin";
            $method = "POST";
            $fields = array(
				"email_admin" => $_POST["email_admin"],
				"password_admin" => $_POST["password_admin"]
			);

            $login = CurlController::request($url,$method,$fields);
            // echo '<pre>'; print_r($login); echo '</pre>'; // Nos entrega un objeto con el status y el resultado
			
			if($login->status == 200){
				$_SESSION["admin"] = $login->results[0]; // Guardamos la variable de sesión
				echo '<script>
						localStorage.setItem("token-admin","'.$login->results[0]->token_admin.'");
						window.location = "/"; 
					</script>';
			
			}else{

				if($login->results == "Wrong password"){
					$error = "Contraseña incorrecta";
				}
				elseif($login->results == "Wrong email"){
					$error = "Email incorrecto";
				}
				else{
					$error = "Email o contraseña incorrectos";
				}
				
				
				// fncToastr("error", "'.$login->results.'");
				echo '<script>
					fncFormatInputs();
					fncMatPreloader("off");
					fncToastr("error", "'.$error.'");
				</script>';
			}

		}

	}

}
