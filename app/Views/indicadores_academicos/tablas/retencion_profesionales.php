<div class="col-lg-12 col-md-12">
    <div class="card">
        <!-- Tabs -->
        <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-tab-retencion-profesionales" data-toggle="pill" href="#tab-table-retencion-profesionales1" role="tab" aria-controls="pills-profile" aria-selected="false">Ratios de Ocupación Total Institución</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-tab-retencion-profesionales" data-toggle="pill" href="#tab-table-retencion-profesionales2" role="tab" aria-controls="pills-profile" aria-selected="false">Ratios de Ocupación Total Institución por Nivel de Formación</a>
            </li>
        </ul>
        <!-- Tabs -->
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="tab-table-retencion-profesionales1" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="card-body">
                    <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm m-2 ml-0"
                                                            onclick='mostrarGrafico("ratios_ocupacion_institucion")'>Ver Gráfico</button>
                    <!-- Start table -->
                    <div class="table-responsive">
                        <table name="tabla_ratio_ocup_institucion" id="tabla_ratio_ocup_institucion" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <?php $fecha_actual = date('Y'); ?>
                                    <?php for($i = $fecha_actual-6; $i <= $fecha_actual; $i++){
                                        echo '<th scope="col">'.$i.'</th>';
                                    }?>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
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
            <div class="tab-pane fade" id="tab-table-retencion-profesionales2" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="card-body">
                    <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm m-2 ml-0"
                                                            onclick='mostrarGrafico("ratios_ocupacion_formacion")'>Ver Gráfico</button>
                    <!-- Start table -->
                    <div class="table-responsive">
                        <table name="tabla_ratio_ocup_formacion" id="tabla_ratio_ocup_formacion" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <?php $fecha_actual = date('Y'); ?>
                                    <?php for($i = $fecha_actual-6; $i <= $fecha_actual; $i++){
                                        echo '<th scope="col">'.$i.'</th>';
                                    }?>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col"></th>
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