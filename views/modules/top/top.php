<!-- Top Navbar -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark" id="top">
    <div class="container">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="/">File Manager System</a>
            </li>
        </ul>

        <!-- Botón Iniciar Sesión -->
        <?php if (isset($_SESSION["admin"])): ?>
            <div class="d-flex">
                <a href="/logout" class="ms-auto px-3 text-white">Cerrar sesión</a>
            </div>
        <?php else: ?>
            <div class="d-flex">
                <a href="#myLogin" class="ms-auto px-3 text-white" data-bs-toggle="modal">Iniciar sesión</a>
            </div>
        <?php endif ?>

    </div>
</nav>