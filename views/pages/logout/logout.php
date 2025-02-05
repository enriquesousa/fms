<?php

// Destruir la session
session_destroy();

// Eliminar el token de la sesión
echo '<script>
        localStorage.removeItem("token-admin");
    </script>';

// También podemos eliminar el token de la sesión con:
// unset($_SESSION["token-admin"]);

// Regresar a la página principal
echo '<script>window.location = "/";</script>';
