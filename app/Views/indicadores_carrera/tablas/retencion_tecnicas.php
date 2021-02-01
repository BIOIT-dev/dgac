<div class="col-lg-12 col-md-12">
    <div class="card">
        <!-- Tabs -->
        <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-tab-retencion-tecnicas" data-toggle="pill" href="#tab-table-retencion-tecnicas1" role="tab" aria-controls="pills-profile" aria-selected="false">Tasa retención 1er semestre por cohorte</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-tab-retencion-tecnicas" data-toggle="pill" href="#tab-table-retencion-tecnicas2" role="tab" aria-controls="pills-profile" aria-selected="false">Tasa retención 2do semestre por cohorte</a>
            </li>
        </ul>
        <!-- Tabs -->
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="tab-table-retencion-tecnicas1" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="card-body">
                    <!-- Start table -->
                    <div class="table-responsive">
                        <table name="tabla_retencion_tecnicas1" id="tabla_retencion_tecnicas1" class="table table-striped table-bordered display" style="width:100%">
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
            <div class="tab-pane fade" id="tab-table-retencion-tecnicas2" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="card-body">
                    <!-- Start table -->
                    <div class="table-responsive">
                        <table name="tabla_retencion_tecnicas2" id="tabla_retencion_tecnicas2" class="table table-striped table-bordered display" style="width:100%">
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