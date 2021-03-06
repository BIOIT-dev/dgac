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
                                    <a class="nav-link active" id="pills-timeline-tab" data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-timeline" aria-selected="true">Agregar Objeto de Aprendizaje</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#current-modulos" role="tab" aria-controls="pills-profile" aria-selected="false">Gestion de Modulos</a>
                                </li> -->
                                <!-- <li class="nav-item">
                                    <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">Setting</a>
                                </li> -->
                            </ul>
                            <!-- Tabs -->
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
                                    <div class="card-body">
                                        <form action="<?php echo base_url('public/scorm/agregar/'); ?>" name="agregar_scorm" id="agregar_scorm" method="post" accept-charset="utf-8" class="form-horizontal" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <small><label class="col-md-12">Título<code>*</code></label></small>
                                                <div class="col-md-12">
                                                    <input name="titulo" type="text" value="" class="form-control form-control-line" size="50" required >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Descripción</label></small>
                                                <div class="col-md-12">
                                                    <textarea name="descripcion" id="descripcion" class="form-control" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Archivo ZIP</label></small>
                                                <div class="col-md-12">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="archivo" id="archivo" accept=".zip" required>
                                                        <label class="custom-file-label" for="archivo">Elegir Archivo</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">SCORM</label></small>
                                                <div class="col-md-12">
                                                    <!-- <input type="text" value="El Objeto es un Paquete SCORM" class="form-control form-control-line" size="50" disabled > -->
                                                    <input class="form-check-input material-inputs" type="checkbox" id="is_scorm" name="is_scorm" onchange="requiredHome()">
                                                    <label class="form-check-label" for="is_scorm">El Objeto es un Paquete SCORM</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Home</label></small>
                                                <div class="col-md-12">
                                                    <input name="home" id="home" type="text" value="" class="form-control form-control-line" size="50" required>
                                                    <label class="form-check-label" for="home">Si el Paquete no es SCORM 1.2, deberá ingresar el punto de entrada en este campo</label>
                                                    
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Ancho Ventana</label></small>
                                                <div class="col-md-12">
                                                    <input name="win_ancho" type="text" value="640" class="form-control form-control-line" size="50" required >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Alto Ventana</label></small>
                                                <div class="col-md-12">
                                                    <input name="win_alto" type="text" value="480" class="form-control form-control-line" size="50" required >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Auto Incorporación</label></small>
                                                <div class="col-md-12">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input material-inputs" type="checkbox" id="attr_scrollbar" value="1" name="attr_scrollbar">
                                                        <label class="form-check-label" for="attr_scrollbar"><small>Barra de Scroll</small></label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input material-inputs" type="checkbox" id="attr_toolbar" value="1" name="attr_toolbar">
                                                        <label class="form-check-label" for="attr_toolbar"><small>Barra de Herramientas</small></label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input material-inputs" type="checkbox" id="attr_statusbar" value="1" name="attr_statusbar">
                                                        <label class="form-check-label" for="attr_statusbar"><small>Barra de Estado</small></label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input material-inputs" type="checkbox" id="attr_menubar" value="1" name="attr_menubar">
                                                        <label class="form-check-label" for="attr_menubar"><small>Barra de Menú</small></label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input material-inputs" type="checkbox" id="attr_linkbar" value="1" name="attr_linkbar">
                                                        <label class="form-check-label" for="attr_linkbar"><small>Barra de Links</small></label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input material-inputs" type="checkbox" id="attr_resizable" value="1" name="attr_resizable">
                                                        <label class="form-check-label" for="attr_resizable"><small>Tamaño Ventana Modificable</small></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Visibilidad</label></small>
                                                <div class="col-md-12">
                                                    <select id="oid_grupo" name="oid_grupo" class="form-control form-control-line">
                                                        <option value="0" selected="selected">Todas las categorías</option>
                                                        <?php foreach($r_grupos as $r){ ?>
                                                            <option value="<?=$r->oid?>"><?= $r->nombre ?></option>
                                                        <?php } ?>
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
                                <div class="tab-pane fade show active" id="current-modulos" role="tabpanel" aria-labelledby="pills-timeline-tab">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <!-- <table name="tabla_comunidades" id="tabla_comunidades" class="table table-striped table-bordered display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th scope="col">Comunidad</th>
                                                        <th scope="col">Estatus</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th></th>
                                                        <th scope="col">Comunidad</th>
                                                        <th scope="col">Estatus</th>
                                                    </tr>
                                                </tfoot>
                                            </table> -->
                                            <!-- <button onclick='modalSave()' class="btn btn-rounded btn-success">Guardar</button> -->
                                            <!-- Modal delete -->
                                    <div id="modalDelete" class="swal2-container swal2-center swal2-fade swal2-shown" style="overflow-y: auto; display: none;">
                                        <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
                                            <div class="swal2-header">
                                                <div id="swal2-icon-modal" class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;">
                                                    <span class="swal2-x-mark">
                                                        <span class="swal2-x-mark-line-left"></span>
                                                        <span class="swal2-x-mark-line-right"></span>
                                                    </span>
                                                </div>
                                                <h2 class="swal2-title" id="swal2-title" style="display: flex;">¿Estás seguro?</h2>
                                                <button onclick="modalClose()" type="button" class="swal2-close" aria-label="Close this dialog">×</button>
                                            </div>
                                            <div class="swal2-content">
                                                <div id="swal2-content" style="display: block;">
                                                 <!-- Mensaje contenido -->
                                                </div>
                                                <div class="swal2-actions" style="display: flex;">
                                                    <!-- <a href="<?php //echo base_url('public/Usuario/eliminar_usuario/1234124124'); ?>" type="button" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block; border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);">Eliminar</a> -->
                                                    <button onclick="GuardarModulos()" type="button" class="swal2-confirm swal2-styled" aria-label="">Guardar</button>
                                                    <button onclick="modalClose()" type="button" class="swal2-cancel swal2-styled" aria-label="">Cancelar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal delete -->
                                    <!-- Modal error -->
                                    <div id="modalError" class="swal2-container swal2-center swal2-fade swal2-shown" style="overflow-y: auto; display: none;">
                                        <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
                                            <div class="swal2-header">
                                                <div id="swal2-icon-modal" class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;">
                                                    <span class="swal2-x-mark">
                                                        <span class="swal2-x-mark-line-left"></span>
                                                        <span class="swal2-x-mark-line-right"></span>
                                                    </span>
                                                </div>
                                                <h2 class="swal2-title" id="swal2-title" style="display: flex;">Error</h2>
                                                <button onclick="modalClose()" type="button" class="swal2-close" aria-label="Close this dialog">×</button>
                                            </div>
                                            <div class="swal2-content">
                                                <div id="swal2-content" style="display: block;">
                                                    No hay modulos seleccionados
                                                </div>
                                                <div class="swal2-actions" style="display: flex;">
                                                    <button onclick="modalClose()" type="button" class="swal2-confirm swal2-styled" aria-label="">OK</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal error -->
                                    <!-- Modal success -->
                                    <div id="modalSuccess" class="swal2-container swal2-center swal2-fade swal2-shown" style="overflow-y: auto; display: none;">
                                        <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
                                            <div class="swal2-header">
                                                <div id="swal2-icon-modal" class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex;">
                                                    <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>    
                                                    <span class="swal2-success-line-tip"></span>
                                                    <span class="swal2-success-line-long"></span>
                                                    <div class="swal2-success-ring"></div> 
                                                    <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                                    <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                                                </div>
                                                <h2 class="swal2-title" id="swal2-title" style="display: flex;">Éxito</h2>
                                                <!-- <button onclick="modalClose()" type="button" class="swal2-close" aria-label="Close this dialog">×</button> -->
                                            </div>
                                            <div class="swal2-content">
                                                <div id="swal2-content" style="display: block;">
                                                    Se actualizo la informacion de los modulos
                                                </div>
                                                <div class="swal2-actions" style="display: flex;">
                                                    <a href="" type="button" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block; border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);">OK</a>
                                                    <!-- <button onclick="modalClose()" type="button" class="swal2-confirm swal2-styled" aria-label="">OK</button> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal success -->
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
    <!--Custom JavaScript -->
    <script src="<?php echo base_url() ?>/assets/libs/sweetalert2/dist/sweetalert2.all.js"></script>
    <script src="<?php echo base_url() ?>/assets/extra-libs/sweetalert2/sweet-alert.init.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/ckeditor/ckeditor.js"></script>
    <!-- This Page JS -->

    <script src="<?php echo base_url() ?>/assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/js/pages/datatable/custom-datatable.js"></script>
    <!-- <script src="<?php echo base_url() ?>/assets/dist/js/pages/datatable/datatable-basic.init.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script> -->

    <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script> -->
    <script type="text/javascript" charset="utf8" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/js/dataTables.checkboxes.min.js"></script>

    <script>
        function requiredHome(){
            if(document.getElementById('is_scorm').checked)
                document.getElementById('home').required = false;
            else
                document.getElementById('home').required = true;
        }



        function modalClose(){
            document.querySelector("#modalDelete").style.display = "none";
            document.querySelector("#modalError").style.display = "none";
        }

        function modalSave(){
            cant_comuni_checked = $('#tabla_comunidades').DataTable().column(0).checkboxes.selected().length;
            //console.log(cant_usuarios_checked);//

            if (cant_comuni_checked > 0){
                document.querySelector("#modalDelete #swal2-content").innerHTML = "¿Está seguro que quiere habilitar/deshabilitar los modulos en esta comunidad comunidades?";
                document.querySelector("#modalDelete").style.display = "block";
            }else{
                document.querySelector("#modalError").style.display = "block";
            }
        }

        function GuardarModulos(){
            var checked = {};
            var list_checked = $('#tabla_comunidades').DataTable().column(0).checkboxes.selected();
            for (var i = 0; i < list_checked.length; i++){
                // checked.push(list_checked[i]);
                checked[i] = list_checked[i];
            }
            console.log(checked); //
            // window.location = '<?php //echo base_url('public/Usuario/eliminar_usuario/'); ?>'+'/'+checked;
            var url = "";
            $.post(url, checked, function(data, status){
                //console.log("CARGANDO!", data, status);//
                if (status){
                    // window.location = "https://stackoverflow.com";
                    document.querySelector("#modalDelete").style.display = "none";
                    document.querySelector("#modalSuccess").style.display = "block";
                    //console.log("BIEN");//
                }else{
                    console.log("ERROR");
                }
            });
        }
        </script>
</body>

</html>