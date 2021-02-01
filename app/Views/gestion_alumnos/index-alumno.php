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
                                                    <span><?php echo $info_alumno['rut'] ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="nombres" class="col-sm-3 text-right control-label col-form-label">Nombre</label>
                                                <div class="col-sm-9">
                                                    <span><?php echo $info_alumno['nombres'] ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="apellido_paterno" class="col-sm-3 text-right control-label col-form-label">A. Paterno</label>
                                                <div class="col-sm-9">
                                                    <span><?php echo $info_alumno['apellido_paterno'] ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="apellido_materno" class="col-sm-3 text-right control-label col-form-label">A. Materno</label>
                                                <div class="col-sm-9">
                                                    <span><?php echo $info_alumno['apellido_materno'] ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="sexo" class="col-sm-3 text-right control-label col-form-label">Sexo</label>
                                                <div class="col-sm-9">
													<span>
													<?= ($info_alumno['sexo']=='m')?'Masculino':'' ?>
													<?= ($info_alumno['sexo']=='f')?'Femenino':'' ?>
													</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="fecnac" class="col-sm-3 text-right control-label col-form-label">Fecha Nacimiento</label>
                                                <div class="col-sm-9">
                                                    <span><?php echo $info_alumno['fecnac'] ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="direccion" class="col-sm-3 text-right control-label col-form-label">Dirección</label>
                                                <div class="col-sm-9">
                                                    <span><?php echo $info_alumno['direccion'] ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="fono" class="col-sm-3 text-right control-label col-form-label">Teléfono</label>
                                                <div class="col-sm-9">
                                                    <span><?php echo $info_alumno['fono'] ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="email" class="col-sm-3 text-right control-label col-form-label">Email</label>
                                                <div class="col-sm-9">
                                                    <span><?php echo $info_alumno['email'] ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
									<h4 class="card-title">¿Es becado?</h4>
                                    <div class="row">
                                        <?php if(!empty($info_beca)){ ?>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
												<label for="adjunto" class="col-sm-3 text-right control-label col-form-label">Archivo</label>
                                                <div class="col-sm-9">
													<a href="<?php echo base_url() ?>/assets/uploads/beca/<?php echo $info_beca->documento ?>" target="_blank">
														<?php echo $info_beca->documento; ?>
													</a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="comentario" class="col-sm-3 text-right control-label col-form-label">Comentarios</label>
                                                <div class="col-sm-9">
													<span><?php echo (!empty($info_beca)) ? $info_beca->comentario : ''; ?></span>
                                                </div>
                                            </div>
                                        </div>
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
                                <div class="d-flex no-block align-items-center mb-4">
                                    <h4 class="card-title">Perfiles del alumno</h4>
                                </div>
                                <div class="table-responsive">
                                    
                                    <div class="dt-buttons">
                                        <a class="dt-button buttons-html5 btn btn-primary mr-1" href="<?php echo base_url('public/gestionAlumnos/perfil_alumno/'.$info_alumno['rut']); ?>"><span>Perfil de Alummno</span>
                                        </a>
                                        <?php if(count($listado_carreras_fun) > 0){ ?>
                                        <a class="dt-button buttons-html5 btn btn-primary mr-1" href="<?php echo base_url('public/gestionAlumnos/perfil_funcionario/'.$info_alumno['rut']); ?>"><span>Perfil de Funcionario</span>
                                        </a>
                                        <?php } ?>
                                        <?php if(count($listado_carreras_pro) > 0){ ?>
                                        <a class="dt-button buttons-html5 btn btn-primary mr-1" href="<?php echo base_url('public/gestionAlumnos/perfil_profesor/'.$info_alumno['rut']); ?>"><span>Perfil de Profesor</span>
                                        </a>
                                        <?php } ?>
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
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
    
</body>

</html>
