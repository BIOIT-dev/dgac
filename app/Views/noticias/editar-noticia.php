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
                                                            <div class="alert alert-success">Agregar Noticia</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="<?php echo base_url('public/Noticias/noticiaModificar/'.$edit['oid']) ?>" method="POST"  enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="titulo">Título</label>
                                                        <input required="" class="form-control" type="text" size="50" name="titulo" value="<?php echo $edit['titulo']; ?>"  />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="resumen">Resumen</label>
                                                        <textarea required="" class="form-control" name="resumen" rows="12" cols="80"><?php echo $edit['resumen']; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="foto_chica">Foto Pequeña</label>
                                                        <input class="form-control" type="file" size="30" name="foto_chica"  />
                                                        <small style="color: red;"><?php echo $edit['foto_chica']; ?></small>

                                                        <div class="col-lg-4">
                                                            <img src="<?= base_url('assets/uploads/noticias/'.$edit['foto_chica']); ?>" alt="image" class="img-thumbnail" width="290">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="contenido">Detalle</label>
                                                        <textarea required="" class="form-control" name="contenido" rows="12" cols="80"><?php echo $edit['contenido']; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="foto_grande">Foto Grande</label>
                                                        <input class="form-control" type="file" size="30" name="foto_grande"  />
                                                        <small style="color: red;"><?php echo $edit['foto_grande']; ?></small>
                                                        <div class="col-lg-4">
                                                            <img src="<?= base_url('assets/uploads/noticias/'.$edit['foto_grande']); ?>" alt="image" class="img-thumbnail" width="290">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="url">URL en Internet</label>
                                                        <input class="form-control" type="text" size="50" name="url" value="<?php echo $edit['url']; ?>"  />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="attach">Documento Adjunto</label>
                                                        <input class="form-control" type="file" size="30" name="attach"  />
                                                        <small style="color: red;"><?php echo $edit['attach']; ?></small>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="grupo_ids">Notificar</label>
                                                    <div class="col-md-12">
                                                        <?php foreach ($grupo as $key => $value) { ?>
                                                            <input type="checkbox" name="grupo_ids[]" value="<?php echo $value->id; ?>" id="checkbox-<?php echo $value->id; ?>">
                                                            <span for="grupo_ids-<?php echo $value->id; ?>"><?php echo $value->name; ?></span>
                                                            <br>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="grupo_ids">Visibilidad</label>
                                                        <div class="form-group">
                                                        <input type="radio" name="global" <?php if($edit['global'] == 0){ echo "checked='checked'"; } ?> value="0"  />
                                                        Esta Comunidad
                                                        &nbsp;
                                                        <input type="radio" name="global" <?php if($edit['global'] == 1){ echo "checked='checked'"; } ?> value="1" />
                                                        Todas las Comunidades
                                                        </div>
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

    <input type="hidden" id="value_grupo_ids" value="<?php echo $edit['grupo_ids']; ?>">

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <?php echo view('dgac/scripts'); ?>
    <script src="<?php echo base_url() ?>/assets/libs/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('resumen', {
          language: 'es'
        });

        CKEDITOR.replace('contenido', {
          language: 'es'
        });
      </script>
    <script type="text/javascript">
        var value_grupo_ids = $("#value_grupo_ids").val();
        $.each(value_grupo_ids.split(','), function( index, value ) {
          $( "#checkbox-" + value ).prop( "checked" , true );
        });
    </script>
</body>

</html>