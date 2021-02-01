<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="tab-table-matriculados_nivel_formacion" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="card-body">
                    <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm m-2 ml-0"
                                                            onclick='mostrarGrafico("matricula_formacion")'>Ver Gráfico</button>
                    <!-- Start table -->
                    <div class="table-responsive">
                        <table name="tabla_matriculados_nivel_formacion" id="tabla_matriculados_nivel_formacion" class="table table-striped table-bordered display" style="width:100%">
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