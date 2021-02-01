<?php //echo view('dgac/headers'); ?>
<?php echo $headers['headersView']; ?>


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
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <!-- Tabs -->
                            <!-- Tabs -->
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center mb-4">
                                    <h4 class="card-title">Nuevo Modulo de Aprendizaje</h4>
                                    <!-- <div class="ml-auto">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-dark" data-url="<?php echo base_url('public/cursos/add'); ?>">
                                                Crear nuevo modulo
                                            </button>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
                                        <div class="card-body">
                                            <form action="<?php echo base_url('public/cursos/add'); ?>" name="cursos_add" id="cursos_add" method="post" accept-charset="utf-8" class="form-horizontal form-material">
                                                <div class="form-group" hidden>
                                                    <small><label class="col-md-12">oid</label></small>
                                                    <div class="col-md-12">
                                                        <input name="oid_usuario" type="text" class="form-control form-control-line" value="<?= $profile_data['oid'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <small><label class="col-md-12">Titulo</label></small>
                                                    <div class="col-md-12">
                                                        <input name="titulo" type="text" placeholder="" class="form-control form-control-line" size="50" required >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <small><label class="col-md-12">Descripción</label></small>
                                                    <div class="col-md-12">
                                                        <textarea name="descripcion" type="text" placeholder="" class="form-control form-control-line" size="50" required ></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <small><label class="col-md-12">Instrucciones</label></small>
                                                    <div class="col-md-12">
                                                        <textarea name="instrucciones" type="text" placeholder="" class="form-control form-control-line" size="50" required ></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <small><label class="col-md-12">Ponderación</label></small>
                                                    <div class="col-md-12">
                                                        <input name="ponderacion" type="text" placeholder="" class="form-control form-control-line" size="50" id="demo1" required >
                                                        <!-- <script>
                                                            $("input[name='demo1']").TouchSpin({
                                                                min: 0,
                                                                max: 100,
                                                                step: 0.1,
                                                                decimals: 2,
                                                                boostat: 5,
                                                                maxboostedstep: 10,
                                                                postfix: '%'
                                                            });
                                                        </script> -->
                                                        <span class="help-block text-muted"><small>A block of help text that breaks onto a
                                                new line and may extend beyond one line.</small></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <small><label class="col-md-12">Nivel de Formación</label></small>
                                                    <div class="col-md-12">
                                                        <select id="nivel_formacion" name="nivel_formacion" class="form-control form-control-line">
                                                            <option value="PROFESIONAL">Profesional</option>
                                                            <option value="TECNICO">Técnico</option>
                                                            <option value="CAPACITACION">Capacitación</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <button type="submit" class="btn btn-success">Guardar</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
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
    <script src="<?php echo base_url() ?>/assets/libs/ckeditor/ckeditor.js"></script>
    <!-- <script src="<?php echo base_url() ?>/assets/libs/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script> -->
</body>

</html>