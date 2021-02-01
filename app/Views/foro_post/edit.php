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
                            <div class="card-body">
                                <form action="<?php echo base_url('public/Post/edit/'.$resultado_busqueda->oid); ?>" method="post" enctype="multipart/form-data">
                                    <input size="50" name="oid" value="<?php echo $resultado_busqueda->oid; ?>" type="hidden" class="form-control">
                                    <div class="form-group">
                                        <label class="col-md-12" >Asunto</label>
                                        <div class="col-md-12">
                                            <input size="50" type="text" class="form-control" value="<?php echo $category_name; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12" >Foro</label>
                                        <div class="col-md-12">
                                            <input size="50" type="text" class="form-control" value="<?php echo $foro_name; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12" >Tema</label>
                                        <div class="col-md-12">
                                            <input size="50" name="asunto" type="text" class="form-control" value="<?php echo $resultado_busqueda->asunto; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Detalle</label>
                                        <div class="col-md-12">
                                            <textarea name="texto" class="form-control" required=""><?php echo $resultado_busqueda->texto; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12" >Documento Adjunto</label>
                                        <div class="col-md-12">
                                            <input size="50" name="archivo" type="file" class="form-control">
                                            <small><?php echo $resultado_busqueda->archivo; ?></small>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Equipo</label>
                                        <div class="col-md-12 mt-3">
                                            <input type="radio" checked="" id="zona_home_1" name="zona_home[]" class="material-inputs filled-in chk-col-pink" value="<?php if($resultado_busqueda->zona_home == 1){ echo 'checked'; } ?>">
                                            <label for="zona_home_1">No mostrar</label>
                                            <br>
                                            <input type="radio" id="zona_home_2" name="zona_home[]" class="material-inputs filled-in chk-col-pink" value="<?php if($resultado_busqueda->zona_home == 2){ echo 'checked'; } ?>">
                                            <label for="zona_home_2">En la Zona de Reflexión</label>
                                            <br>
                                            <input type="radio" id="zona_home_3" name="zona_home[]" class="material-inputs filled-in chk-col-pink" value="<?php if($resultado_busqueda->zona_home == 3){ echo 'checked'; } ?>">
                                            <label for="zona_home_3">En la Zona de Links</label>
                                            <br>
                                            <input type="radio" id="zona_home_4" name="zona_home[]" class="material-inputs filled-in chk-col-pink" value="<?php if($resultado_busqueda->zona_home == 4){ echo 'checked'; } ?>">
                                            <label for="zona_home_3">En la Zona de Experiencias de Aprendizaje</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="oid_team">Equipo</label>
                                            <select class="form-control" name="oid_team" id="oid_team">
                                                <option value="0" <?php if($resultado_busqueda->oid_team == 0){ echo 'selected'; } ?> >Disponible para toda la comunidad</option>
                                                <option value="9" <?php if($resultado_busqueda->oid_team == 9){ echo 'selected'; } ?> >Disponible para "adc"</option>
                                                <option value="5" <?php if($resultado_busqueda->oid_team == 5){ echo 'selected'; } ?> >Disponible para "AVSEC AMB"</option>
                                                <option value="7" <?php if($resultado_busqueda->oid_team == 7){ echo 'selected'; } ?> >Disponible para "Curso Inducción"</option>
                                                <option value="1" <?php if($resultado_busqueda->oid_team == 1){ echo 'selected'; } ?> >Disponible para "Encargado E-learning"</option>
                                                <option value="10" <?php if($resultado_busqueda->oid_team == 10){ echo 'selected'; } ?> >Disponible para "test equipo"</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="inactivo">Notificar</label>
                                            <br>
                                            <br>
                                            <input type="checkbox" id="inactivo" name="inactivo" class="material-inputs filled-in chk-col-pink" value="1" <?php if($resultado_busqueda->inactivo == 1){ echo 'checked'; } ?> >
                                            <label for="inactivo">Enviar Correo a toda la Comunidad o Equipo Especificado</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="submit" class="btn btn-success" value="Guardar">
                                        </div>
                                    </div>
                                </form>
                            </div>
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
    <script src="<?php echo base_url() ?>/assets/libs/sweetalert2/dist/sweetalert2.all.js"></script>
    <script src="<?php echo base_url() ?>/assets/extra-libs/sweetalert2/sweet-alert.init.js"></script>

    <!-- This Page JS -->

    <script src="<?php echo base_url() ?>/assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/js/pages/datatable/custom-datatable.js"></script>
    
    <script type="text/javascript" charset="utf8" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/js/dataTables.checkboxes.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('texto', {
          language: 'es'
        });
    </script>

    
</body>

</html>