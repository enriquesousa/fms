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