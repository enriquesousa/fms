<!--=== Tabla Cuadriculado ===-->
<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 row-cols-xl-5 my-4 px-2 modules" id="grid" style="display: none;">

    <?php for ($i = 0; $i < 10; $i++): ?>

        <div class="col">
            <!-- Card -->
            <div class="card rounded p-3 border-0 shadow my-3">

                <!-- Card Header -->
                <div class="card-header bg-white border-0 p-0">
                    <div class="d-flex justify-content-between mb-2">
                        <!-- Upload Button -->
                        <div class="bg-white">
                            <i class="bi bi-box-arrow-up-right ps-2 btn p-0"></i>
                        </div>
                        <!-- Copy Button and Trash -->
                        <div class="bg-white m-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16" style="cursor:pointer">
                                <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z" />
                            </svg>
                            <i class="bi bi-trash p-0 ps-2 btn"></i>
                        </div>
                    </div>
                </div>

                <img src="https://placehold.co/100x100" class="card-img-top rounded">

                <!-- Card Body -->
                <div class="card-body p-1">
                    <p class="card-text">

                        <!-- File Name -->
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="lorem_ipsum">
                        <span class="input-group-text">.jpg</span>
                    </div>

                    <!-- File Size and Server -->
                    <div class="d-flex justify-content-between mt-3">
                        <div class="bg-white">
                            <p class="small mt-1">415.2 MB</p>
                        </div>
                        <div class="bg-white m-0">
                            <span class="badge bg-dark border rounded px-3 py-2 text-white">Mailchimp</span>
                        </div>
                    </div>

                    <!-- Date -->
                    <h6 class="float-end my-0 py-0">
                        <small>2024-07-05, 12:07:00</small>
                    </h6>

                    </p>
                </div>

            </div>
        </div>
        
    <?php endfor ?>

</div>