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
                            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-timeline-tab" data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-timeline" aria-selected="true">Editar Objeto de Aprendizaje</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#current-modulos" role="tab" aria-controls="pills-profile" aria-selected="false">Gestion de Modulos</a>
                                </li> -->
                            </ul>
                            <!-- Tabs -->
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
                                    <div class="card-body">
                                        <form action="<?php echo base_url('public/scorm/editar/'.$r_scorm->scorm_id); ?>" name="editar_scorm" id="editar_scorm" method="post" accept-charset="utf-8" class="form-horizontal" enctype="multipart/form-data">
                                            <div class="form-group" hidden>
                                                <small><label class="col-md-12">oid</label></small>
                                                <div class="col-md-12">
                                                    <input name="oid" type="text" placeholder="" class="form-control form-control-line" value="<?= $r_scorm->scorm_id ?>">
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <small><label class="col-md-12">Título</label></small>
                                                <div class="col-md-12">
                                                    <input name="titulo" type="text" value="<?= $r_scorm->titulo ?>" class="form-control form-control-line" size="50" required >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Descripción</label></small>
                                                <div class="col-md-12">
                                                    <div class="border p-3">
                                                        <div name="descripcion" id="descripcion" contenteditable="true" class="inline-editor">
                                                            <?= $r_scorm->descripcion ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?= $r_scorm->is_scorm == 1?
                                                '<div class="form-group">
                                                    <small><label class="col-md-12">SCORM</label></small>
                                                    <div class="col-md-12">
                                                        <input type="text" value="El Objeto es un Paquete SCORM" class="form-control form-control-line" size="50" disabled >
                                                    </div>
                                                </div>':
                                                '<div class="form-group">
                                                    <small><label class="col-md-12">Archivo ZIP</label></small>
                                                    <div class="col-md-12">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="archivo" id="archivo" accept=".zip">
                                                            <label class="custom-file-label" for="archivo">Elegir Archivo</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <small><label class="col-md-12">Home</label></small>
                                                    <div class="col-md-12">
                                                        <input name="home" type="text" value="'."$r_scorm->home".'" class="form-control form-control-line" size="50" required>
                                                    </div>
                                                </div>'
                                            ?>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Ancho Ventana</label></small>
                                                <div class="col-md-12">
                                                    <input name="win_ancho" type="text" value="<?= $r_scorm->win_ancho ?>" class="form-control form-control-line" size="50" required >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Alto Ventana</label></small>
                                                <div class="col-md-12">
                                                    <input name="win_alto" type="text" value="<?= $r_scorm->win_alto ?>" class="form-control form-control-line" size="50" required >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Auto Incorporación</label></small>
                                                <div class="col-md-12">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input material-inputs" type="checkbox" id="attr_scrollbar" value="1" name="attr_scrollbar" <?= $r_scorm->attr_scrollbar==1?"checked":"" ?>>
                                                        <label class="form-check-label" for="attr_scrollbar"><small>Barra de Scroll</small></label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input material-inputs" type="checkbox" id="attr_toolbar" value="1" name="attr_toolbar" <?= $r_scorm->attr_toolbar==1?"checked":"" ?>>
                                                        <label class="form-check-label" for="attr_toolbar"><small>Barra de Herramientas</small></label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input material-inputs" type="checkbox" id="attr_statusbar" value="1" name="attr_statusbar" <?= $r_scorm->attr_statusbar==1?"checked":"" ?>>
                                                        <label class="form-check-label" for="attr_statusbar"><small>Barra de Estado</small></label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input material-inputs" type="checkbox" id="attr_menubar" value="1" name="attr_menubar" <?= $r_scorm->attr_menubar==1?"checked":"" ?>>
                                                        <label class="form-check-label" for="attr_menubar"><small>Barra de Menú</small></label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input material-inputs" type="checkbox" id="attr_linkbar" value="1" name="attr_linkbar" <?= $r_scorm->attr_linkbar==1?"checked":"" ?>>
                                                        <label class="form-check-label" for="attr_linkbar"><small>Barra de Links</small></label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input material-inputs" type="checkbox" id="attr_resizable" value="1" name="attr_resizable" <?= $r_scorm->attr_resizable==1?"checked":"" ?>>
                                                        <label class="form-check-label" for="attr_resizable"><small>Tamaño Ventana Modificable</small></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Visibilidad</label></small>
                                                <div class="col-md-12">
                                                    <input type="text" value="<?= $r_scorm->nombre==""?"Todas las comunidades":$r_scorm->nombre ?>" class="form-control form-control-line" size="50" disabled >
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
    <!--Custom JavaScript -->
    <script src="<?php echo base_url() ?>/assets/libs/sweetalert2/dist/sweetalert2.all.js"></script>
    <script src="<?php echo base_url() ?>/assets/extra-libs/sweetalert2/sweet-alert.init.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/ckeditor/ckeditor.js"></script>
    <!-- This Page JS -->

    <script src="<?php echo base_url() ?>/assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/js/pages/datatable/custom-datatable.js"></script>
    <script type="text/javascript" charset="utf8" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/js/dataTables.checkboxes.min.js"></script>
</body>

</html>