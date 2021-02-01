<div class="col-lg-12 col-md-12">
    <div class="card">
        <!-- Tabs -->
        <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-tab-titulacion-profesionales1" data-toggle="pill" href="#tab-table-titulacion-profesionales1" role="tab" aria-controls="pills-profile" aria-selected="false">Carreras de 8 semestres</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-tab-titulacion-profesionales2" data-toggle="pill" href="#tab-table-titulacion-profesionales2" role="tab" aria-controls="pills-profile" aria-selected="false">Carreras de 6 semestres</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-tab-titulacion-profesionales3" data-toggle="pill" href="#tab-table-titulacion-profesionales3" role="tab" aria-controls="pills-profile" aria-selected="false">Carreras de 3 semestres</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-tab-titulacion-profesionales4" data-toggle="pill" href="#tab-table-titulacion-profesionales4" role="tab" aria-controls="pills-profile" aria-selected="false">Carreras de 2 semestres</a>
            </li>
        </ul>
        <!-- Tabs -->
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="tab-table-titulacion-profesionales1" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="card-body">
                <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm m-2 ml-0"
                                                            onclick='mostrarGrafico("titulacion_formacion_8sem")'>Ver Gráfico</button>
                    <!-- Start table -->
                    <div class="table-responsive">
                        <table name="tabla_titulacion_nivel_formacion1" id="tabla_titulacion_nivel_formacion1" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Cohorte</th>
                                    <?php $fecha_actual = date('Y'); ?>
                                    <?php for($i = $fecha_actual-6; $i <= $fecha_actual; $i++){
                                        echo '<th scope="col">'.$i.'</th>';
                                    }?>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Cohorte</th>
                                    <?php for($i = $fecha_actual-6; $i <= $fecha_actual; $i++){
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
                <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm m-2 ml-0"
                                                            onclick='mostrarGrafico("titulacion_formacion_6sem")'>Ver Gráfico</button>
                    <!-- Start table -->
                    <div class="table-responsive">
                        <table name="tabla_titulacion_nivel_formacion2" id="tabla_titulacion_nivel_formacion2" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Cohorte</th>
                                    <?php $fecha_actual = date('Y'); ?>
                                    <?php for($i = $fecha_actual-6; $i <= $fecha_actual; $i++){
                                        echo '<th scope="col">'.$i.'</th>';
                                    }?>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Cohorte</th>
                                    <?php for($i = $fecha_actual-6; $i <= $fecha_actual; $i++){
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
                <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm m-2 ml-0"
                                                            onclick='mostrarGrafico("titulacion_formacion_3sem")'>Ver Gráfico</button>
                    <!-- Start table -->
                    <div class="table-responsive">
                        <table name="tabla_titulacion_nivel_formacion3" id="tabla_titulacion_nivel_formacion3" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Cohorte</th>
                                    <?php $fecha_actual = date('Y'); ?>
                                    <?php for($i = $fecha_actual-6; $i <= $fecha_actual; $i++){
                                        echo '<th scope="col">'.$i.'</th>';
                                    }?>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Cohorte</th>
                                    <?php for($i = $fecha_actual-6; $i <= $fecha_actual; $i++){
                                        echo '<th scope="col">'.$i.'</th>';
                                    }?>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- End table -->
                </div>
            </div>
            <div class="tab-pane fade" id="tab-table-titulacion-profesionales4" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="card-body">
                <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm m-2 ml-0"
                                                            onclick='mostrarGrafico("titulacion_formacion_2sem")'>Ver Gráfico</button>
                    <!-- Start table -->
                    <div class="table-responsive">
                        <table name="tabla_titulacion_nivel_formacion4" id="tabla_titulacion_nivel_formacion4" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Cohorte</th>
                                    <?php $fecha_actual = date('Y'); ?>
                                    <?php for($i = $fecha_actual-6; $i <= $fecha_actual; $i++){
                                        echo '<th scope="col">'.$i.'</th>';
                                    }?>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Cohorte</th>
                                    <?php for($i = $fecha_actual-6; $i <= $fecha_actual; $i++){
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