<div class="col-lg-12 col-md-12">
    <div class="card">
        <!-- Tabs -->
        <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-tab-2014" data-toggle="pill" href="#tab-table-2014" role="tab" aria-controls="pills-profile" aria-selected="false">2014</a>
            </li>
            <?php $anio_actual = date('Y'); ?>
            <?php for($i = 0; $i < $anio_actual-2014; $i++){
                echo    '<li class="nav-item">
                            <a class="nav-link" id="pills-tab-'.(2015+$i).'" data-toggle="pill" href="#tab-table-'.(2015+$i).'" role="tab" aria-controls="pills-setting" aria-selected="false">'.(2015+$i).'</a>
                        </li>';
            } ?>
        </ul>
        <!-- Tabs -->
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="tab-table-2014" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="card-body">
                    <!-- Start table -->
                    <div class="table-responsive">
                        <table name="tabla_matricula_2014" id="tabla_matricula_2014" class="table table-striped table-bordered display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Item/Carrera</th>
                                        <th scope="col">Nuevos</th>
                                        <th scope="col">Antiguos</th>
                                        <th scope="col">Reincorporados</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Item/Carrera</th>
                                    <th scope="col">Nuevos</th>
                                    <th scope="col">Antiguos</th>
                                    <th scope="col">Reincorporados</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </tfoot>
                        </table>
                        
                    </div>
                    <!-- End table -->
                </div>
            </div>
            <?php for($i = 0; $i < $anio_actual-2014; $i++){
                echo    '<div class="tab-pane fade" id="tab-table-'.(2015+$i).'" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <!-- Start table -->
                                <div class="table-responsive">
                                    <table name="tabla_matricula_'.(2015+$i).'" id="tabla_matricula_'.(2015+$i).'" class="table table-striped table-bordered display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Item/Carrera</th>
                                                <th scope="col">Nuevos</th>
                                                <th scope="col">Antiguos</th>
                                                <th scope="col">Reincorporados</th>
                                                <th scope="col">Total</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Item/Carrera</th>
                                                <th scope="col">Nuevos</th>
                                                <th scope="col">Antiguos</th>
                                                <th scope="col">Reincorporados</th>
                                                <th scope="col">Total</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- End table -->
                            </div>
                        </div>';
            } ?>
        </div>
    </div>
</div>