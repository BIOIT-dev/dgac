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
                                                            <?php
                                                                if(isset($id_categoria)){
                                                                    session()->id = $id_categoria;
                                                                }

                                                            ?>
                                                            <a title="Volver" onclick="return window.history.back();">
                                                                <button class="btn btn-success">
                                                                    <i class="mdi mdi-keyboard-return"></i>
                                                                </button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-12">
                                                            <div class="alert alert-success">Agregar Categoría de Documentos</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <form action="<?php echo base_url('public/bibliotecas/biblioCateAdd') ?><?if($oid_padre>0){ echo "/".$oid_padre; }?>" method="POST"  enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="nombre">Nombre</label>
                                                        <input required="" class="form-control" type="text" size="50" name="nombre"  />
                                                    </div>
                                                </div>
                                                <input type="hidden" name="oid_padre" value="<?=$oid_padre?>">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="descripcion">Descripción</label>
                                                        <textarea required="" class="form-control" name="descripcion" rows="12" cols="80"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="icono">Icono</label><br>
                                                        <input type="radio" name="icono" value="FOLDER_IMAGES"  />
                                                        <input type="radio" name="icono" value="FOLDER_IMPORTANT"  />
                                                        <input type="radio" name="icono" value="FOLDER_LINKS"  />
                                                        <input type="radio" name="icono" value="FOLDER_SOUND"  />
                                                        <input type="radio" name="icono" value="FOLDER_TAR"  />
                                                        <input type="radio" name="icono" value="FOLDER_TEXT"  />
                                                        <input type="radio" name="icono" value="FOLDER_VIDEO"  />
                                                        <input type="radio" name="icono" value="FOLDER_DEFAULT" checked="checked"  />
                                                        <input type="radio" name="icono" value="FOLDER_MICROSITIO"  />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="orden">Despliegue de Contenido</label><br>
                                                        <input type="radio" name="orden" value="0" checked="checked"  />
                                                        Orden Alfabético de los Documentos<br>
                                                        <input type="radio" name="orden" value="1"  />
                                                        Fecha de Ingreso/Modificación de los Documentos
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="oid_team">Equipo Propietario</label>
                                                        <select class="form-control" name="oid_team" id="oid_team">
                                                            <option value="0" selected="selected">Sin Especificar</option>
                                                            <option value="9">Equipo "adc"</option>
                                                            <option value="5">Equipo "AVSEC AMB"</option>
                                                            <option value="7">Equipo "Curso Inducción"</option>
                                                            <option value="1">Equipo "Encargado E-learning"</option>
                                                            <option value="10">Equipo "test equipo"</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="url">Permisos de Acceso</label><br>
                                                        <input type="radio" name="privado_team" value="0" checked="checked">
                                                        Acceso para toda la Comunidad<br>
                                                        <input type="radio" name="privado_team" value="1">
                                                        Acceso sólo para Publicadores y Equipo Propietario
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="global">Visibilidad:</label><br>
                                                        <input type="radio" name="global" value="0" checked="checked">
                                                        Esta Comunidad<br>
                                                        <input type="radio" name="global" value="1">
                                                        Todas las Comunidades
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