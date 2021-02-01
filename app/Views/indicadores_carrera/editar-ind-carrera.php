<?php //echo view('dgac/headers'); ?>
<?php echo $headers['headersView']; ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

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
                            <form action="<?php echo base_url('public/indicadoresCarreras/editar/'.$r_indicador['oid_ic']); ?>" name="editar_indicador" id="editar_indicador" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="card-body">
                                    <h4 class="card-title">Editar Indicador de Carrera</h4>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6" hidden>
                                            <div class="form-group row">
                                                <label for="oid" class="col-sm-3 text-right control-label col-form-label">ID Grupo</label>
                                                <div class="col-sm-9">
                                                    <input value="<?php echo $r_indicador['oid_ic'] ?>" name="oid" type="text" class="form-control" id="oid" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="cohorte" class="col-sm-3 text-right control-label col-form-label">Cohorte</label>
                                                <div class="col-sm-9">
                                                    <input value="<?php echo $r_indicador['cohorte'] ?>" name="cohorte" type="text" class="form-control" id="cohorte" required disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="nivel_formacion" class="col-sm-3 text-right control-label col-form-label">Nivel de Formación</label>
                                                <div class="col-sm-9">
                                                    <input value="<?php echo $r_indicador['nivel_formacion'] ?>" name="nivel_formacion" type="text" class="form-control" id="nivel_formacion" required disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="nombre" class="col-sm-3 text-right control-label col-form-label">Carrera</label>
                                                <div class="col-sm-9">
                                                    <input value="<?php echo $r_indicador['nombre'] ?>" name="nombre" type="text" class="form-control" id="nombre" required disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="jornada" class="col-sm-3 text-right control-label col-form-label">Jornada</label>
                                                <div class="col-sm-9">
                                                    <input value="<?php echo $r_indicador['jornada'] ?>" name="jornada" type="text" class="form-control" id="jornada" required disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="duracion_semestre" class="col-sm-3 text-right control-label col-form-label">Duración en Semestres</label>
                                                <div class="col-sm-9">
                                                    <input value="<?php echo $r_indicador['duracion_semestre'] ?>" name="duracion_semestre" type="text" class="form-control" id="duracion_semestre">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="insc_alumn_nuev" class="col-sm-3 text-right control-label col-form-label">Inscritos Alumnos Nuevos</label>
                                                <div class="col-sm-9">
                                                    <input value="<?php echo $r_indicador['insc_alumn_nuev'] ?>" name="insc_alumn_nuev" type="text" class="form-control" id="insc_alumn_nuev">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="vaca_alumn_nuev" class="col-sm-3 text-right control-label col-form-label">Vacantes Alumnos Nuevos</label>
                                                <div class="col-sm-9">
                                                    <input value="<?php echo $r_indicador['vaca_alumn_nuev'] ?>" name="vaca_alumn_nuev" type="text" class="form-control" id="vaca_alumn_nuev">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="num_egresados" class="col-sm-3 text-right control-label col-form-label">Número de egresados</label>
                                                <div class="col-sm-9">
                                                    <input value="<?php echo $r_indicador['num_egresados'] ?>" name="num_egresados" type="text" class="form-control" id="num_egresados">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="num_titulados" class="col-sm-3 text-right control-label col-form-label">Número de titulados</label>
                                                <div class="col-sm-9">
                                                    <input value="<?php echo $r_indicador['num_titulados'] ?>" name="num_titulados" type="text" class="form-control" id="num_titulados">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="rematricula2" class="col-sm-3 text-right control-label col-form-label">Rematricula año 2</label>
                                                <div class="col-sm-9">
                                                    <input value="<?php echo $r_indicador['rematricula2'] ?>" name="rematricula2" type="text" class="form-control" id="rematricula2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="rematricula3" class="col-sm-3 text-right control-label col-form-label">Rematricula año 3</label>
                                                <div class="col-sm-9">
                                                    <input value="<?php echo $r_indicador['rematricula3'] ?>" name="rematricula3" type="text" class="form-control" id="rematricula3">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="rematricula4" class="col-sm-3 text-right control-label col-form-label">Rematricula año 4</label>
                                                <div class="col-sm-9">
                                                    <input value="<?php echo $r_indicador['rematricula4'] ?>" name="rematricula4" type="text" class="form-control" id="rematricula4">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <div class="form-group mb-0 text-right">
                                        <button type="submit" class="btn btn-info waves-effect waves-light">Guardar</button>
                                        <button onclick="window.location.href='<?php echo site_url('indicadoresCarreras/index/'); ?>'" class="btn btn-dark waves-effect waves-light">Cancelar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Row -->
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
    <script type="text/javascript" charset="utf8" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/js/dataTables.checkboxes.min.js"></script>
</body>

</html>