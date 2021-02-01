<div class="col-lg-12 col-md-12">
    <div class="card">
        <!-- Tabs -->
        <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-tab-titulacion-tecnicas1" data-toggle="pill" href="#tab-table-titulacion-tecnicas1" role="tab" aria-controls="pills-profile" aria-selected="false">Carreras de 8 semestres</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-tab-titulacion-tecnicas2" data-toggle="pill" href="#tab-table-titulacion-tecnicas2" role="tab" aria-controls="pills-profile" aria-selected="false">Carreras de 6 semestres</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-tab-titulacion-tecnicas3" data-toggle="pill" href="#tab-table-titulacion-tecnicas3" role="tab" aria-controls="pills-profile" aria-selected="false">Carreras de 3 semestres</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-tab-titulacion-tecnicas4" data-toggle="pill" href="#tab-table-titulacion-tecnicas4" role="tab" aria-controls="pills-profile" aria-selected="false">Carreras de 2 semestres</a>
            </li>
        </ul>
        <!-- Tabs -->
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="tab-table-titulacion-tecnicas1" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="card-body">
                    <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm m-2 ml-0"
                                                            onclick='mostrarGrafico("cohorte_carrera_8sem")'>Ver Gráfico</button>
                    <!-- Start table -->
                    <div class="table-responsive">
                        <table name="tabla_titulacion_tecnicas1" id="tabla_titulacion_tecnicas1" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Cohorte</th>
                                    <th scope="col">Año 1</th>
                                    <th scope="col">Año 2</th>
                                    <th scope="col">Año 3</th>
                                    <th scope="col">Año 4</th>
                                    <th scope="col">Porcentaje Total de Retención (%)</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col">Cohorte</th>
                                    <th scope="col">Año 1</th>
                                    <th scope="col">Año 2</th>
                                    <th scope="col">Año 3</th>
                                    <th scope="col">Año 4</th>
                                    <th scope="col">Porcentaje Total de Retención (%)</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- End table -->
                </div>
            </div>
            <div class="tab-pane fade" id="tab-table-titulacion-tecnicas2" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="card-body">
                    <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm m-2 ml-0"
                                                            onclick='mostrarGrafico("cohorte_carrera_6sem")'>Ver Gráfico</button>
                    <!-- Start table -->
                    <div class="table-responsive">
                        <table name="tabla_titulacion_tecnicas2" id="tabla_titulacion_tecnicas2" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Cohorte</th>
                                    <th scope="col">Año 1</th>
                                    <th scope="col">Año 2</th>
                                    <th scope="col">Año 3</th>
                                    <th scope="col">Porcentaje Total de Retención (%)</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col">Cohorte</th>
                                    <th scope="col">Año 1</th>
                                    <th scope="col">Año 2</th>
                                    <th scope="col">Año 3</th>
                                    <th scope="col">Porcentaje Total de Retención (%)</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- End table -->
                </div>
            </div>
            <div class="tab-pane fade" id="tab-table-titulacion-tecnicas3" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="card-body">
                    <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm m-2 ml-0"
                                                            onclick='mostrarGrafico("cohorte_carrera_3sem")'>Ver Gráfico</button>
                    <!-- Start table -->
                    <div class="table-responsive">
                        <table name="tabla_titulacion_tecnicas3" id="tabla_titulacion_tecnicas3" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Cohorte</th>
                                    <th scope="col">Año 1</th>
                                    <th scope="col">Año 2</th>
                                    <th scope="col">Porcentaje Total de Retención (%)</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col">Cohorte</th>
                                    <th scope="col">Año 1</th>
                                    <th scope="col">Año 2</th>
                                    <th scope="col">Porcentaje Total de Retención (%)</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- End table -->
                </div>
            </div>
            <div class="tab-pane fade" id="tab-table-titulacion-tecnicas4" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="card-body">
                    <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm m-2 ml-0"
                                                            onclick='mostrarGrafico("cohorte_carrera_2sem")'>Ver Gráfico</button>
                    <!-- Start table -->
                    <div class="table-responsive">
                        <table name="tabla_titulacion_tecnicas4" id="tabla_titulacion_tecnicas4" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Cohorte</th>
                                    <th scope="col">Año 1</th>
                                    <th scope="col">Porcentaje Total de Retención (%)</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col">Cohorte</th>
                                    <th scope="col">Año 1</th>
                                    <th scope="col">Porcentaje Total de Retención (%)</th>
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