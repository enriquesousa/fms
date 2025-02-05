<!-- Contenido -->
<div class="container-fluid p-4 min-vh-100" id="content">
    <div class="container bg-white border rounded">

        <!--=== SEARCH & BUTTONS ===-->
        <div class="row py-4 px-4 pb-2">

            <!--=== 'BUSCADOR' ===-->
            <?php include "modules/search/search.php"; ?>

            <!--=== 'BOTONES' ===-->
            <?php include "modules/buttons/buttons.php"; ?>

        </div>

        

        <!--=== Carpetas y Filtros ===-->
        <div class="row pb-4 px-4 py-1">

            <!--=== Carpetas ===-->
            <?php include "modules/folders/folders.php"; ?>

            <!--=== 'Filtros' ===-->
            <?php include "modules/filtros/filtros.php"; ?>

        </div>

        <!--=== Drag and Drop ===-->
        <?php include "modules/drag_drop/drag_drop.php"; ?>

        <!--=== Tabla Listado ===-->
        <?php include "modules/list/list.php"; ?>

        <!--=== Tabla Cuadriculado ===-->
        <?php include "modules/grid/grid.php"; ?>

    </div>
</div>