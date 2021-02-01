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
                                <form action="<?php echo base_url('public/Foro/add/'.$oid_categoria); ?>" name="add_etiqueta" id="add_etiqueta" method="post" accept-charset="utf-8">
                                    <input size="50" name="oid_usuario" value="<?=$oid_usuario?>" type="hidden" class="form-control">
                                    <input size="50" name="oid_categoria" value="<?=$oid_categoria?>" type="hidden" class="form-control">
                                    <div class="form-group">
                                        <label class="col-md-12" >Categoria</label>
                                        <div class="col-md-12">
                                            <input size="50" type="text" value="<?php echo $category_name; ?>" class="form-control" readonly="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12" >Nombre</label>
                                        <div class="col-md-12">
                                            <input size="50" name="nombre" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12" >Descripción</label>
                                        <div class="col-md-12">
                                            <textarea name="descripcion" class="form-control" required></textarea>
                                            <small>Caracteres Disponibles: 16384 / Ruta:</small>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12" >Seleccione el tipo de Usuarios que pueden crear Temas:</label>
                                        <div class="col-md-12">
                                            <?php foreach ($grupo as $key => $value) { ?>
                                                <input <?php if( $value->clave == 'ALU' ){ echo 'checked'; } ?> type="checkbox" name="permisos[]" value="<?php echo $value->clave; ?>" id="permisos-<?php echo $value->id; ?>">
                                                <span for="permisos-<?php echo $value->id; ?>"><?php echo $value->name; ?></span>
                                                <br>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <input class="btn btn-success" type="submit" value="Guardar">
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
    <script src="<?php echo base_url() ?>/assets/libs/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('descripcion', {
          language: 'es'
        });
    </script>
    <script src="<?php echo base_url() ?>/assets/libs/sweetalert2/dist/sweetalert2.all.js"></script>
    <script src="<?php echo base_url() ?>/assets/extra-libs/sweetalert2/sweet-alert.init.js"></script>

    <!-- This Page JS -->

    <script src="<?php echo base_url() ?>/assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/js/pages/datatable/custom-datatable.js"></script>
    
    <script type="text/javascript" charset="utf8" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/js/dataTables.checkboxes.min.js"></script>

    
</body>

</html>