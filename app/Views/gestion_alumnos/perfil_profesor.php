<?php //echo view('dgac/headers'); ?>
<?php echo $headers['headersView']; ?>
<!-- <link href="<?php echo base_url() ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet"> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<!-- <link href="<?php echo base_url() ?>/assets/libs/bootstrap-table/dist/bootstrap-table.min.css" rel="stylesheet" type="text/css" /> -->
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css"> -->

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <?php echo view('dgac/spinner'); ?>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php echo view('dgac/topbar'); ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php echo view('dgac/leftsidebar'); ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <?php echo view('dgac/breadcrum'); ?>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- Row -->
                <!-- Row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- <div class="card-body">
                                <h4 class="card-title">Employee Profile</h4>
                                <h6 class="card-subtitle">This is the employee profile form with labels on left and form controls on right in one line two controls. To use add class <code>form-horizontal</code> to the form tag and give class <code>row</code> with form-group.</h6>
                            </div> -->
                            <!-- <hr> -->
                            <form action="<?php echo base_url('public/gestionAlumnos/index_alumno/'); ?>" name="index_alumno" id="index_alumno" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="card-body">
                                    <h4 class="card-title">Datos Personales</h4>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6" hidden>
                                            <div class="form-group row">
                                                <label for="oid" class="col-sm-3 text-right control-label col-form-label">ID</label>
                                                <div class="col-sm-9">
                                                    <input value="<?php echo $info_alumno['usuario_id'] ?>" name="oid" type="text" class="form-control" id="oid" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="rut" class="col-sm-3 text-right control-label col-form-label">RUT</label>
                                                <div class="col-sm-9">
                                                    <input value="<?php echo $info_alumno['rut'] ?>" name="rut" type="text" class="form-control" id="rut" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="nombres" class="col-sm-3 text-right control-label col-form-label">Nombre</label>
                                                <div class="col-sm-9">
                                                    <input value="<?php echo $info_alumno['nombres'] ?>" name="nombres" type="text" class="form-control" id="nombres" placeholder="Campo Requerido*" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="apellido_paterno" class="col-sm-3 text-right control-label col-form-label">A. Paterno</label>
                                                <div class="col-sm-9">
                                                    <input value="<?php echo $info_alumno['apellido_paterno'] ?>" name="apellido_paterno" type="text" class="form-control" id="apellido_paterno" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="apellido_materno" class="col-sm-3 text-right control-label col-form-label">A. Materno</label>
                                                <div class="col-sm-9">
                                                    <input value="<?php echo $info_alumno['apellido_materno'] ?>" name="apellido_materno" type="text" class="form-control" id="apellido_materno" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="sexo" class="col-sm-3 text-right control-label col-form-label">Sexo</label>
                                                <div class="col-sm-9">
                                                    <select name="sexo" id="sexo" class="form-control">
                                                        <option value="m" <?= ($info_alumno['sexo']=='m')?'selected':'' ?>>Masculino</option>
                                                        <option value="f" <?= ($info_alumno['sexo']=='f')?'selected':'' ?>>Femenino</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="fecnac" class="col-sm-3 text-right control-label col-form-label">Fecha Nacimiento</label>
                                                <div class="col-sm-9">
                                                    <input value="<?php echo $info_alumno['fecnac'] ?>"  name="fecnac" type="date" min="" max="" class="form-control" id="fecnac" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="titulo" class="col-sm-3 text-right control-label col-form-label">Titulo *</label>
                                                <div class="col-sm-9">
                                                    <input name="titulo" type="text" class="form-control" id="titulo" placeholder="Campo Requerido*" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="horas_costo" class="col-sm-3 text-right control-label col-form-label">Horas Costo</label>
                                                <div class="col-sm-9">
                                                    <input name="horas_costo" type="number" min="0" class="form-control" id="horas_costo" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="direccion" class="col-sm-3 text-right control-label col-form-label">Dirección</label>
                                                <div class="col-sm-9">
                                                    <input value="<?php echo $info_alumno['direccion'] ?>" name="direccion" type="text" class="form-control" id="direccion" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="fono" class="col-sm-3 text-right control-label col-form-label">Teléfono</label>
                                                <div class="col-sm-9">
                                                    <input value="<?php echo $info_alumno['fono'] ?>" name="fono" type="text" class="form-control" id="fono" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="email" class="col-sm-3 text-right control-label col-form-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input value="<?php echo $info_alumno['email'] ?>" name="email" type="text" class="form-control" id="email" placeholder="Campo Requerido*" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <div class="form-group mb-0 text-right">
                                        <button type="submit" class="btn btn-info waves-effect waves-light">Aceptar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
								<h4 class="card-title">Carreras</h4>
                                <div class="table-responsive">
                                    <table name="tabla_carreras" id="tabla_carreras" class="table table-striped table-bordered display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Carrera</th>
                                                <th scope="col">Duración</th>
                                                <th scope="col">Horas</th>
                                                <th scope="col">Activo</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Carrera</th>
                                                <th scope="col">Duración</th>
                                                <th scope="col">Horas</th>
                                                <th scope="col">Activo</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                
                <!-- Row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
								<h4 class="card-title">Asignaturas</h4>
                                <div class="table-responsive">
                                    <table name="tabla_asignaturas" id="tabla_asignaturas" class="table table-striped table-bordered display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Asignatura</th>
                                                <th scope="col">Carrera</th>
                                                <th scope="col">Periodo</th>
                                                <th scope="col">Horas</th>
                                                <!--<th scope="col">Acción</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php foreach($listado_asignaturas as $asignatura) { ?>
                                            <tr>
                                                <td scope="col"><?php echo $asignatura->oid ?></td>
                                                <td scope="col"><?php echo $asignatura->titulo ?></td>
                                                <td scope="col"><?php echo $asignatura->nombre_grupo ?></td>
                                                <td scope="col"><?php echo $asignatura->peri_nombre ?></td>
                                                <td scope="col"><?php echo $asignatura->curs_horas ?></td>
                                                <!--<td scope="col">
													<div class="btn-group-sm">
														<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acción</button>
														<div class="dropdown-menu">
															<a class="dropdown-item" href="<?php echo site_url('gestionAlumnos/ver_notas/'.$info_alumno['usuario_id'].'/'.$asignatura->oid_grupo.'/'.$asignatura->oid); ?>"><i class="fa fa-edit"></i> Ver Notas</a>
															<a class="dropdown-item" href="<?php echo site_url('gestionAlumnos/ver_asistencias/'.$info_alumno['usuario_id'].'/'.$asignatura->oid_grupo.'/'.$asignatura->oid); ?>"><i class="fa fa-edit"></i> Ver Asistencias</a>
														</div>
													</div>
                                                </td>-->
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Asignatura</th>
                                                <th scope="col">Carrera</th>
                                                <th scope="col">Periodo</th>
                                                <th scope="col">Horas</th>
                                                <!--<th scope="col">Acción</th>-->
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                
                <!-- Row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
								<h4 class="card-title">Evaluaciones</h4>
                                <div class="table-responsive">
                                    <table name="tabla_evaluaciones" id="tabla_evaluaciones" class="table table-striped table-bordered display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Título</th>
                                                <th scope="col">Test</th>
                                                <th scope="col">Año</th>
                                                <th scope="col">Semestre</th>
                                                <th scope="col">Carrera</th>
                                                <th scope="col">Asignatura</th>
                                                <th scope="col">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php foreach($listado_encuestas as $encuesta) { ?>
                                            <tr>
                                                <td scope="col"><?php echo $encuesta->oid_encuesta ?></td>
                                                <td scope="col"><?php echo $encuesta->titulo_encuesta ?></td>
                                                <td scope="col"><?php echo $encuesta->titulo_test ?></td>
                                                <td scope="col"><?php echo $encuesta->agno ?></td>
                                                <td scope="col"><?php echo $encuesta->nombre_semestre ?></td>
                                                <td scope="col"><?php echo $encuesta->nombre_grupo ?></td>
                                                <td scope="col"><?php echo $encuesta->titulo_curso ?></td>
                                                <td scope="col">
													<div class="btn-group-sm">
														<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acción</button>
														<div class="dropdown-menu">
															<a class="dropdown-item" href="<?php echo site_url('gestionAlumnos/ver_detalles_encuesta/'.$encuesta->oid_encuesta); ?>"><i class="fa fa-edit"></i> Ver Detalles</a>
														</div>
													</div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Título</th>
                                                <th scope="col">Test</th>
                                                <th scope="col">Año</th>
                                                <th scope="col">Semestre</th>
                                                <th scope="col">Carrera</th>
                                                <th scope="col">Asignatura</th>
                                                <th scope="col">Acción</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php echo view('dgac/footer'); ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- customizer Panel -->
    <!-- ============================================================== -->
    <?php echo view('dgac/customizer'); ?>
    <div class="chat-windows"></div>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <?php echo view('dgac/scripts'); ?>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url() ?>/assets/libs/ckeditor/ckeditor.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/sweetalert2/dist/sweetalert2.all.js"></script>
    <script src="<?php echo base_url() ?>/assets/extra-libs/sweetalert2/sweet-alert.init.js"></script>

    <!-- This Page JS -->

    <script src="<?php echo base_url() ?>/assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/js/pages/datatable/custom-datatable.js"></script>
    <!-- <script src="<?php echo base_url() ?>/assets/dist/js/pages/datatable/datatable-basic.init.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script> -->

    <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script> -->
    <script type="text/javascript" charset="utf8" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/js/dataTables.checkboxes.min.js"></script>

    <!-- This Page JS -->
    <!-- <script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/bootstrap-table/dist/bootstrap-table.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/bootstrap-table/dist/bootstrap-table-locale-all.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/bootstrap-table/dist/extensions/export/bootstrap-table-export.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/js/pages/tables/bootstrap-table.init.js"></script> -->
    <script>
        //Dataset para crear la tabla
        var dataSet = []
        <?php foreach($listado_carreras as $rp) { ?>
            dataSet.push(['<?= $rp->oid ?>', '<?= $rp->nombre ?>','<?= $rp->duracion ?>','<?= $rp->horas ?>',   
                        '<?= ($rp->inactivo==1)?'<span class="badge py-1 badge-danger">Inactivo</span>':'<span class="badge py-1 badge-success text-white">Activo</span>' ?>']);
        <?php } ?>
        
        $(document).ready(function() {
            var table = $('#tabla_carreras').DataTable({
                data: dataSet,
                // columnDefs: [
                //     {
                //         'targets': 0,
                //         'checkboxes': {
                //             'selectRow': true,
                //         }
                //     }
                // ],
                select: {
                    style: 'multi'
                },
                order: [[1, 'asc']],
                language: {
                    lengthMenu: "Mostrando _MENU_ datos por página",
                    zeroRecords: "No hay datos para mostrar",
                    info: "Mostrando página _PAGE_ de _PAGES_",
                    infoEmpty: "No hay datos disponibles.",
                    infoFiltered: "(filtrado de _MAX_ elementos)",
                    search: "Buscar",
                    searchPlaceholder: "",
                    paginate: {
                        first: "Primero",
                        last: "Último",
                        next: "Siguiente",
                        previous: "Anterior"
                    },
                }
            });
            
            var table = $('#tabla_asignaturas').DataTable({
                select: {
                    style: 'multi'
                },
                //order: [[1, 'asc']],
                language: {
                    lengthMenu: "Mostrando _MENU_ datos por página",
                    zeroRecords: "No hay datos para mostrar",
                    info: "Mostrando página _PAGE_ de _PAGES_",
                    infoEmpty: "No hay datos disponibles.",
                    infoFiltered: "(filtrado de _MAX_ elementos)",
                    search: "Buscar",
                    searchPlaceholder: "",
                    paginate: {
                        first: "Primero",
                        last: "Último",
                        next: "Siguiente",
                        previous: "Anterior"
                    },
                }
            });
            
            var table = $('#tabla_evaluaciones').DataTable({
                select: {
                    style: 'multi'
                },
                //order: [[1, 'asc']],
                language: {
                    lengthMenu: "Mostrando _MENU_ datos por página",
                    zeroRecords: "No hay datos para mostrar",
                    info: "Mostrando página _PAGE_ de _PAGES_",
                    infoEmpty: "No hay datos disponibles.",
                    infoFiltered: "(filtrado de _MAX_ elementos)",
                    search: "Buscar",
                    searchPlaceholder: "",
                    paginate: {
                        first: "Primero",
                        last: "Último",
                        next: "Siguiente",
                        previous: "Anterior"
                    },
                }
            });
        });
    </script>
</body>

</html>
