<?php //echo view('dgac/headers'); ?>
<?php echo $headers['headersView']; ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/libs/select2/dist/css/select2.min.css">
<style type="text/css">
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #1e88e5 !important;
        border: 1px solid #422323 !important;
        border-radius: 4px;
        cursor: default;
        float: left;
        margin-right: 5px;
        margin-top: 5px;
        padding: 0 5px;
    }
</style>
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
                    <div class="col-lg-12 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Tabs -->
                            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                                <li class="nav-item" hidden="">
                                    <a class="nav-link active" id="pills-timeline-tab" data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-timeline" aria-selected="true">Habilitar Edicion</a>
                                </li>
                            </ul>
                            <!-- Tabs -->
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
                                    <div class="card-body">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12" style="text-align: right;">
                                                            <a onclick="return window.history.back();">
                                                                <button class="btn btn-success">
                                                                    <i class="mdi mdi-keyboard-return"></i>
                                                                </button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-12">
                                                            <div class="alert alert-success">Agregar Documento</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="<?php echo base_url('public/bibliotecas/biblioFileAdd/'.$oid_categoria) ?>" method="POST"  enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="titulo">Título</label>
                                                        <input required="" class="form-control" type="text" size="50" name="titulo"  />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="archivo">Documento</label><br>
                                                        <input required="" type="file" name="archivo">
                                                        <small style="color: #263300;font-weight: bold;">(2M Tamaño Máximo)</small>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="descripcion">Descripción</label><br>
                                                        <textarea maxlength="16380" required="" class="form-control" name="descripcion" rows="12" cols="80"></textarea>
                                                        <small style="color: #263300;font-weight: bold;">Caracteres Disponibles: 16380</small>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                    <label for="grupo_ids">Notificar</label><br>
                                                        <?php foreach ($grupo as $key => $value) { ?>
                                                            <input type="checkbox" name="grupo_ids[]" value="<?php echo $value->clave; ?>" id="grupo_ids-<?php echo $value->id; ?>">
                                                            <span for="grupo_ids-<?php echo $value->id; ?>"><?php echo $value->name; ?></span>
                                                            <br>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="form-group content-comunidades">
                                                    <div class="col-md-12">
                                                        <label for="grupo_ids">Comunidades</label>
                                                        <div class="form-group">
                                                            <select required="" style="width: 100% !important" multiple="" class="form-control" id="comunidad_ids" name="comunidad_ids[]">
                                                                <option value="" disabled="">----------</option>
                                                                <option value="all">A todos las comunidades</option>
                                                                <option value="0">Solo esta comunidad</option>
                                                                <?php foreach ($comunidad as $key => $value) {?>
                                                                    <option value="<?php echo $value->oid; ?>"><?php echo $value->nombre; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="global">Mostrar en la Home</label><br>
                                                        <input type="radio" name="zona_home" value="" checked="checked">
                                                        No mostrar<br>
                                                        <input type="radio" name="zona_home" value="LNK">
                                                        En la Zona de Links
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
    <script type="text/javascript" src="<?php echo base_url() ?>/assets/libs/select2/dist/js/select2.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('descripcion', {
          language: 'es'
        });

        $("select#comunidad_ids").select2({
          tags: true
        });
        
      </script>
    <script type="text/javascript">
        $( "#tipo" ).change(function() {
            var tipo = $(this).val();
            if( tipo == 2 ){
                $("#nombre_panel").prop( "readonly" , false );
            }else{
                $("#nombre_panel").val("");
                $("#nombre_panel").prop( "readonly" , true );
            }
        });
    </script>
</body>

</html>