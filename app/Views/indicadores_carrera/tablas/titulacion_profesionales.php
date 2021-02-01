<div class="col-lg-12 col-md-12">
    <div class="card">
        <!-- Tabs -->
        <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-tab-titulacion-profesionales1" data-toggle="pill" href="#tab-table-titulacion-profesionales1" role="tab" aria-controls="pills-profile" aria-selected="false">Al 3er semestre, por cohorte</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-tab-titulacion-profesionales2" data-toggle="pill" href="#tab-table-titulacion-profesionales2" role="tab" aria-controls="pills-profile" aria-selected="false">Oportuna por cohorte</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-tab-titulacion-profesionales3" data-toggle="pill" href="#tab-table-titulacion-profesionales3" role="tab" aria-controls="pills-profile" aria-selected="false">Tiempo real titulación por cohorte</a>
            </li>
        </ul>
        <!-- Tabs -->
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="tab-table-titulacion-profesionales1" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="card-body">
                    <!-- Start table -->
                    <div class="table-responsive">
                        <table name="tabla_titulacion_profesionales1" id="tabla_titulacion_profesionales1" class="table table-striped table-bordered display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Item/Carrera</th>
                                        <?php for($i = 2013; $i <= 2019; $i++){
                                            echo '<th scope="col">'.$i.'</th>';
                                        }?>
                                    </tr>
                                </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Item/Carrera</th>
                                    <?php for($i = 2013; $i <= 2019; $i++){
                                        echo '<th scope="col">'.$i.'</th>';
                                    }?>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- End table -->
                </div>
            </div>
            <div class="tab-pane fade" id="tab-table-titulacion-profesionales2" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="card-body">
                    <!-- Start table -->
                    <div class="table-responsive">
                        <table name="tabla_titulacion_profesionales2" id="tabla_titulacion_profesionales2" class="table table-striped table-bordered display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Item/Carrera</th>
                                        <?php for($i = 2013; $i <= 2019; $i++){
                                            echo '<th scope="col">'.$i.'</th>';
                                        }?>
                                    </tr>
                                </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Item/Carrera</th>
                                    <?php for($i = 2013; $i <= 2019; $i++){
                                        echo '<th scope="col">'.$i.'</th>';
                                    }?>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- End table -->
                </div>
            </div>
            <div class="tab-pane fade" id="tab-table-titulacion-profesionales3" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="card-body">
                    <!-- Start table -->
                    <div class="table-responsive">
                        <table name="tabla_titulacion_profesionales3" id="tabla_titulacion_profesionales3" class="table table-striped table-bordered display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Item/Carrera</th>
                                        <?php for($i = 2013; $i <= 2019; $i++){
                                            echo '<th scope="col">'.$i.'</th>';
                                        }?>
                                    </tr>
                                </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Item/Carrera</th>
                                    <?php for($i = 2013; $i <= 2019; $i++){
                                        echo '<th scope="col">'.$i.'</th>';
                                    }?>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- End table -->
                </div>
            </div>
        </div>
    </div>
</div>