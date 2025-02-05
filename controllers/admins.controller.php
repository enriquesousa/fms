<?php 

class AdminsController{

	/*=============================================
	Login de administradores
	=============================================*/	

	public function login(){

		if(isset($_POST["email_admin"]) && isset($_POST["password_admin"])){

            // echo "Hola soy el login";

            $url = "admins?login=true&suffix=admin";
            $method = "POST";
            $fields = array(
				"email_admin" => $_POST["email_admin"],
				"password_admin" => $_POST["password_admin"]
			);


            $login = CurlController::request($url,$method,$fields);

            echo '<pre>'; print_r($login); echo '</pre>';

			// echo '<script>

			// fncMatPreloader("on");
			// fncSweetAlert("loading", "loading...", "");

			// </script>';

			// $url = "admins?login=true&suffix=admin";
			// $method = "POST";
			// $fields = array(
			// 	"email_admin" => $_POST["email_admin"],
			// 	"password_admin" => $_POST["password_admin"]
			// );

			// $login = CurlController::request($url,$method,$fields);
			
			// if($login->status == 200){

			// 	$_SESSION["admin"] = $login->results[0];

			// 	echo '<script>

			// 	localStorage.setItem("token-admin","'.$login->results[0]->token_admin.'");
			// 	window.location = "/";

			// 	</script>';
			
			// }else{

			// 	echo '<script>

			// 		fncFormatInputs();
			// 		fncMatPreloader("off");
			// 		fncToastr("error", "'.$login->results.'");

			// 	</script>';
			// }

		}

	}

}
