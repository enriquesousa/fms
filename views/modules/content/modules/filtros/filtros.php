<!--=== 'Filtros' ===-->
<div class="col-12 col-lg-5 mt-3">
    <div class="d-flex flex-row-reverse">

        <!-- Vista Lista o Cuadricula -->
        <div class="btn-group rounded">
            <!-- Botón Cuadricula -->
            <button type="button" class="btn btn-default border rounded-start text-secondary changeView" module="grid">
                <i class="bi bi-grid-3x3-gap-fill"></i>
            </button>

            <!-- Botón Lista -->
            <button type="button" class="btn btn-default border rounded-end bg-dark changeView text-white" module="list">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <!-- Ordenar por -->
        <select class="form-select rounded mx-2" id="sortBy">
            <option value="">Ordenar por</option>
            <option value="date_updated_file-DESC">Nuevo primero</option>
            <option value="date_updated_file-ASC">Antiguo primero</option>
            <option value="size_file-DESC">Mas grande primero</option>
            <option value="size_file-ASC">Mas chico primero</option>
            <option value="name_file-ASC">A-Z</option>
            <option value="name_file-DESC">Z-A</option>
        </select>

        <!-- Filtrar por -->
        <select class="form-select rounded" id="filterBy">
            <option value="">Filtrar por</option>
            <option value="ALL">Todos</option>
            <option value="images/JPG">imágenes/JPG</option>
            <option value="video/mp4">video/mp4</option>
            <option value="application/pdf">aplicación/pdf</option>
            <option value="application/zip">aplicación/zip</option>
        </select>

    </div>
</div>