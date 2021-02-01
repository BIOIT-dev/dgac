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
                                                            <div class="alert alert-success">Modificar Documento</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="<?php echo base_url('public/bibliotecas/biblioFileEdit/'.$edit['oid']) ?>" method="POST"  enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="titulo">Título</label>
                                                        <input required="" class="form-control" type="text" size="50" name="titulo" value="<?php echo $edit['titulo']; ?>"  />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="archivo">Documento</label><br>
                                                        <input type="file" name="archivo">
                                                        <small style="color: #263300;font-weight: bold;">(2M Tamaño Máximo)</small>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="archivo">Documento Actual</label><br>
                                                        <img style="width: 200px;height: 204px;" src="<?php echo base_url('/assets/uploads/bibliotecas/doc/'.$edit['archivo']) ?>"><br>
                                                        <a download href='<?php echo base_url("assets/uploads/bibliotecas/doc/".$edit['archivo']); ?>'>
                                                            Descargar
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="descripcion">Descripción</label><br>
                                                        <textarea maxlength="16380" required="" class="form-control" name="descripcion" rows="12" cols="80"><?php echo $edit['descripcion']; ?></textarea>
                                                        <small style="color: #263300;font-weight: bold;">Caracteres Disponibles: 16380</small>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                    <label for="grupo_ids">Ubicado en</label><br>
                                                        <select class="form-control" id="oid_categoria" name="oid_categoria">
                                                            <?php foreach ($biblio_categoria as $key => $value) { ?>
                                                            <option value="<?php echo $value->oid; ?>">
                                                                <?php echo $value->nombre; ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="global">Mostrar en la Home</label><br>
                                                        <input type="radio" name="zona_home" <?php if($edit['zona_home'] == ""){ echo "checked='checked'"; } ?> >
                                                        No mostrar<br>
                                                        <input type="radio" name="zona_home" <?php if($edit['zona_home'] == "LNK"){ echo "checked='checked'"; } ?>>
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
    <input type="hidden" id="value_oid_categoria" value="<?php echo $edit['oid_categoria']; ?>">
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <?php echo view('dgac/scripts'); ?>
    <script src="<?php echo base_url() ?>/assets/libs/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('descripcion', {
          language: 'es'
        });
      </script>
    <script type="text/javascript">
        var value_oid_categoria = $("#value_oid_categoria").val();
        $("#oid_categoria").val([value_oid_categoria]);
    </script>
</body>

</html>