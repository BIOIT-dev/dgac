<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="tab-table-matricula_nueva_carrera" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="card-body">
                    <!-- Start table -->
                    <div class="table-responsive">
                        <table name="tabla_matricula_nueva_carrera" id="tabla_matricula_nueva_carrera" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Carrera</th>
                                    <th scope="col">Jornada</th>
                                    <?php $fecha_actual = date('Y'); ?>
                                    <?php for($i = $fecha_actual-6; $i <= $fecha_actual; $i++){
                                        echo '<th scope="col">'.$i.'</th>';
                                    }?>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col">Carrera</th>
                                    <th scope="col">Jornada</th>
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