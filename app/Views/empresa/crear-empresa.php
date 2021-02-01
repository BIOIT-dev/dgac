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
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
                                    <div class="card-body">
                                        <form action="<?php echo base_url('public/empresa/crear_empresa'); ?>" name="empresa_create" id="empresa_create" method="post" accept-charset="utf-8" class="form-horizontal form-material">
                                            <div class="form-group" hidden>
                                                <small><label class="col-md-12">oid</label></small>
                                                <div class="col-md-12">
                                                    <input name="oid_usuario" type="text" class="form-control form-control-line" value="<?= $profile_data['oid'] ?>">
                                                </div>
                                            </div>  
                                            <div class="form-group">
                                                <small><label class="col-md-12">RUT</label></small>
                                                <div class="col-md-12">
                                                    <input name="rut" type="text" size="14" value="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Nombre</label></small>
                                                <div class="col-md-12">
                                                    <input name="nombre" type="text" size="50" class="form-control form-control-line" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Dirección</label></small>
                                                <div class="col-md-12">
                                                    <input name="direccion" type="text" size="50" class="form-control form-control-line" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Comuna</label></small>
                                                <div class="col-md-12">
                                                    <input name="comuna" type="text" size="50" class="form-control form-control-line" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Ciudad</label></small>
                                                <div class="col-md-12">
                                                    <input name="ciudad" type="text" size="50" class="form-control form-control-line" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Teléfono</label></small>
                                                <div class="col-md-12">
                                                    <input name="fono" type="text" size="50" class="form-control form-control-line" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Fax</label></small>
                                                <div class="col-md-12">
                                                    <input name="fax" type="text" size="50" class="form-control form-control-line" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Correo Electrónico</label></small>
                                                <div class="col-md-12">
                                                    <input name="email" type="email" size="50" class="form-control form-control-line" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Contacto</label></small>
                                                <div class="col-md-12">
                                                    <input name="contacto" type="text" size="50" class="form-control form-control-line" value="">
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
</body>

</html>