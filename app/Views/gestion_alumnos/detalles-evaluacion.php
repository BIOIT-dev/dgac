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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
							<div class="card-body">
								<h4 class="card-title">Datos Generales</h4>
								<div class="row">
									<div class="col-sm-12 col-lg-6">
										<div class="form-group row">
											<label for="rut" class="col-sm-3 text-right control-label col-form-label">Encuesta</label>
											<div class="col-sm-9">
												<span><?php echo $data_encuesta->titulo_encuesta; ?></span>
											</div>
										</div>
									</div>
									<div class="col-sm-12 col-lg-6">
										<div class="form-group row">
											<label for="nombres" class="col-sm-3 text-right control-label col-form-label">Test</label>
											<div class="col-sm-9">
												<span><?php echo $data_encuesta->titulo_test; ?></span>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 col-lg-6">
										<div class="form-group row">
											<label for="apellido_paterno" class="col-sm-3 text-right control-label col-form-label">Año</label>
											<div class="col-sm-9">
												<span><?php echo $data_encuesta->agno ?></span>
											</div>
										</div>
									</div>
									<div class="col-sm-12 col-lg-6">
										<div class="form-group row">
											<label for="apellido_paterno" class="col-sm-3 text-right control-label col-form-label">Semestre</label>
											<div class="col-sm-9">
												<span><?php echo $data_encuesta->nombre_semestre; ?></span>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 col-lg-6">
										<div class="form-group row">
											<label for="apellido_paterno" class="col-sm-3 text-right control-label col-form-label">Carrera</label>
											<div class="col-sm-9">
												<span><?php echo $data_encuesta->nombre_grupo ?></span>
											</div>
										</div>
									</div>
									<div class="col-sm-12 col-lg-6">
										<div class="form-group row">
											<label for="apellido_paterno" class="col-sm-3 text-right control-label col-form-label">Curso</label>
											<div class="col-sm-9">
												<span><?php echo $data_encuesta->titulo_curso; ?></span>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 col-lg-6">
										<div class="form-group row">
											<label for="apellido_paterno" class="col-sm-3 text-right control-label col-form-label">Inicio</label>
											<div class="col-sm-9">
												<span><?php echo $data_encuesta->f_desde ?></span>
											</div>
										</div>
									</div>
									<div class="col-sm-12 col-lg-6">
										<div class="form-group row">
											<label for="apellido_paterno" class="col-sm-3 text-right control-label col-form-label">Término</label>
											<div class="col-sm-9">
												<span><?php echo $data_encuesta->f_hasta; ?></span>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 col-lg-6">
										<div class="form-group row">
											<label for="apellido_paterno" class="col-sm-3 text-right control-label col-form-label">Porcentaje</label>
											<div class="col-sm-9">
												<span><?php echo $data_encuesta->porcentaje ?></span>
											</div>
										</div>
									</div>
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
                                <div class="table-responsive">
                                    <table name="tabla_detalles" id="tabla_detalles" class="table table-striped table-bordered display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Pregunta</th>
                                                <th scope="col">Respuesta</th>
                                                <th scope="col">Detalles</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php foreach($detalles_encuesta as $detalle) { ?>
                                            <tr>
                                                <td scope="col"><?php echo $detalle->oid ?></td>
                                                <td scope="col"><?php echo $detalle->preg_nombre ?></td>
                                                <td scope="col"><?php echo $detalle->resp_nombre ?></td>
                                                <td scope="col"><?php echo $detalle->txt_respuesta ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Pregunta</th>
                                                <th scope="col">Respuesta</th>
                                                <th scope="col">Detalles</th>
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
        
        $(document).ready(function() {
            var table = $('#tabla_detalles').DataTable({
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
                order: [[0, 'asc']],
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
