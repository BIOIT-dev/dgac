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
                            <!-- <div class="card-body">
                                <h4 class="card-title">Employee Profile</h4>
                                <h6 class="card-subtitle">This is the employee profile form with labels on left and form controls on right in one line two controls. To use add class <code>form-horizontal</code> to the form tag and give class <code>row</code> with form-group.</h6>
                            </div> -->
                            <!-- <hr> -->
                            <form action="<?php echo base_url('public/gestionResumenEncuestas/index/0'); ?>" name="index_gestion_resumen" id="index_gestion_resumen" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="card-body">
                                    <h4 class="card-title">Agregar Nuevo Resumen de Encuestas</h4>
                                    <div class="row">
                                        
                                        <!-- <div class="col-sm-12 col-lg-6" hidden>
                                            <div class="form-group row">
                                                <label for="peri_activo" class="col-sm-3 text-right control-label col-form-label">Estado</label>
                                                <div class="col-sm-9">
                                                    <input value="1" name="peri_activo" type="text" class="form-control" id="peri_activo" required>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="grupo_oid" class="col-sm-3 text-right control-label col-form-label">Comunidad</label>
                                                <div class="col-sm-9">
                                                    <select name="grupo_oid" id="grupo_oid" class="form-control" onchange="ajaxGetCarreras()">
                                                        <option value"">------</option>
                                                        <?php foreach($r_comunidad as $rcom){?>
                                                            <option value="<?=$rcom->oid?>"><?= $rcom->nombre ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="carrera_oid" class="col-sm-3 text-right control-label col-form-label">Carrera</label>
                                                <div class="col-sm-9">
                                                    <select name="carrera_oid" id="carrera_oid" class="form-control" onchange="ajaxGetSemestres()">
                                                        <!-- <option value"">------</option> -->
                                                        <?php foreach($r_carrera as $rcar){?>
                                                            <option value="<?=$rcar->oid?>"><?= $rcar->nombre ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="semestres" class="col-sm-3 text-right control-label col-form-label">Semestres de Asignaturas</label>
                                                <div class="col-sm-9">
                                                    <select name="semestres" id="semestres" class="form-control" onchange="ajaxGetAsignaturas()">
                                                        <!-- <option value"">------</option> -->
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="curso_oid" class="col-sm-3 text-right control-label col-form-label">Asignatura</label>
                                                <div class="col-sm-9">
                                                    <select name="curso_oid" id="curso_oid" class="form-control">
                                                        <!-- <option value"">------</option> -->
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="profesor_oid" class="col-sm-3 text-right control-label col-form-label">Profesor</label>
                                                <div class="col-sm-9">
                                                    <select name="profesor_oid" id="profesor_oid" class="form-control">
                                                        <!-- <option value"">------</option> -->
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="semestres" class="col-sm-3 text-right control-label col-form-label">Semestre de aplicación</label>
                                                <div class="col-sm-9">
                                                    <select name="semestre" id="semestre" class="form-control">
                                                        <option value="1">Primero</option>
                                                        <option value="2">Segundo</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="anio_aplicacion" class="col-sm-3 text-right control-label col-form-label">Año de aplicación</label>
                                                <div class="col-sm-9">
                                                    <select name="anio_aplicacion" id="anio_aplicacion" class="form-control" >
                                                    <?php for($i = date("Y"); $i <= date("Y") + 9; $i++){ ?>
                                                            <option value="<?php echo $i ?>" id="anio_aplicacion<?php echo $i ?>"><?php echo $i ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="nivel_formacion" class="col-sm-3 text-right control-label col-form-label">Nivel de Formación</label>
                                                <div class="col-sm-9">
                                                    <select name="nivel_formacion" id="nivel_formacion" class="form-control">
                                                        <option value="PROFESIONAL">Profesional</option>
                                                        <option value="TECNICO">Técnico</option>
                                                        <option value="CAPACITACION">Capacitación</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="jornada" class="col-sm-3 text-right control-label col-form-label">Jornada</label>
                                                <div class="col-sm-9">
                                                    <select name="jornada" id="jornada" class="form-control" >
                                                        <option value="DIURNO">Diurno</option>
                                                        <option value="VESPERTINO">Vespertino</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="blk1" class="col-sm-3 text-right control-label col-form-label">Puntaje Dimensión 1</label>
                                                <div class="col-sm-9">
                                                    <input value="" name="blk1" type="text" class="form-control" id="blk1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="blk2" class="col-sm-3 text-right control-label col-form-label">Puntaje Dimensión 2</label>
                                                <div class="col-sm-9">
                                                    <input value="" name="blk2" type="text" class="form-control" id="blk2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="blk3" class="col-sm-3 text-right control-label col-form-label">Puntaje Dimensión 3</label>
                                                <div class="col-sm-9">
                                                    <input value="" name="blk3" type="text" class="form-control" id="blk3">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="blk4" class="col-sm-3 text-right control-label col-form-label">Puntaje Dimensión 4</label>
                                                <div class="col-sm-9">
                                                    <input value="" name="blk4" type="text" class="form-control" id="blk4">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="blk5" class="col-sm-3 text-right control-label col-form-label">Puntaje Dimensión 5</label>
                                                <div class="col-sm-9">
                                                    <input value="" name="blk5" type="text" class="form-control" id="blk5">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <div class="form-group mb-0 text-right">
                                        <a onclick="habilitarRegistros()" class="btn btn-info waves-effect waves-light text-white">
                                            <?php echo ($estado_habilitar != "1" ? "Habilitar Registros Históricos" : "Deshabilitar Registros Históricos") ?>
                                        </a>
                                        <button type="submit" class="btn btn-info waves-effect waves-light">Guardar</button>
                                        <!-- <button onclick="window.location.href='<?php //echo site_url('progPresencial/editar/'.$oid_grupo); ?>'" class="btn btn-dark waves-effect waves-light">Cancelar</button> -->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <h4 class="card-title">Listado de Resumen de Encuentas</h4>
                                    <table name="tabla_carreras" id="tabla_carreras" class="table table-striped table-bordered display" style="width:100%">
                                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm m-1 ml-0"
                                                            onclick='modalSwal()'>Eliminar</button>
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th scope="col">ID</th>
                                                <th scope="col">Comunidad</th>
                                                <th scope="col">Carrera</th>
                                                <th scope="col">Profesor</th>
                                                <th scope="col">Asignatura</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th scope="col">ID</th>
                                                <th scope="col">Comunidad</th>
                                                <th scope="col">Carrera</th>
                                                <th scope="col">Profesor</th>
                                                <th scope="col">Asignatura</th>
                                            </tr>
                                        </tfoot>
                                    </table>
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
                                                    <button onclick="botonEliminar()" type="button" class="swal2-confirm swal2-styled" aria-label="">Eliminar</button>
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
                                                    No hay elementos seleccionados para eliminar
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
                                                    ¡Elementos eliminados correctamente!
                                                </div>
                                                <div class="swal2-actions" style="display: flex;">
                                                    <a href="<?php echo site_url('gestionResumenEncuestas/index/0'); ?>" type="button" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block; border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);">OK</a>
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
    <script src="<?php echo base_url() ?>/assets/libs/sweetalert2/dist/sweetalert2.all.js"></script>
    <script src="<?php echo base_url() ?>/assets/extra-libs/sweetalert2/sweet-alert.init.js"></script>

    <!-- This Page JS -->

    <script src="<?php echo base_url() ?>/assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/js/pages/datatable/custom-datatable.js"></script>
    <script type="text/javascript" charset="utf8" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/js/dataTables.checkboxes.min.js"></script>  
    <script>
        // function copiarValue(){
        //     var peri_anio = document.getElementById("peri_anio").value;
        //     var peri_semestre = document.getElementById("peri_semestre").value;
        //     document.getElementById("peri_nombre").value = document.getElementById("peri_anio"+peri_anio).innerHTML+'/'+document.getElementById("peri_semestre"+peri_semestre).innerHTML;
        //     document.getElementById("periodo_vista").value = document.getElementById("peri_anio"+peri_anio).innerHTML+'/'+document.getElementById("peri_semestre"+peri_semestre).innerHTML;
        // }

        // function validarFecha(fecha){
        //     if (fecha == "termino"){
        //         document.getElementById("peri_inicio").max = document.getElementById("peri_termino").value;
        //     }else if(fecha == "inicio"){
        //         document.getElementById("peri_termino").min = document.getElementById("peri_inicio").value;
        //     }else{
        //         console.log("ERROR");
        //     }
        // }

        function ajaxGetCarreras(){
            <?php if($estado_habilitar != 1){ ?>
                var checked = { 'idcomunidad': document.getElementById('grupo_oid').value};
                var url = "<?php echo base_url('public/gestionResumenEncuestas/obtenercarreras'); ?>";
                console.log(checked);
                $.get(url, checked, function(data, status){
                    if (status){
                        var respuestaAjax = JSON.parse(data);
                        var datos = "<option value='null'>Seleccionar</option>";
                        for(var i = 0; i < respuestaAjax.length; i++){
                            datos += "<option value='"+respuestaAjax[i]['carrera_id']+"'>"+respuestaAjax[i]['carrera_nombre']+"</option>";
                        }
                        console.log(respuestaAjax);
                        console.log(datos);
                        $("#carrera_oid").html(datos);
                    }else{
                        console.log("ERROR");
                    }
                });
            <?php } ?>
            ajaxGetProfesores();
        }

        function ajaxGetSemestres(){
            var checked = { 'idcarrera': document.getElementById('carrera_oid').value};
            var url = "<?php echo base_url('public/gestionResumenEncuestas/obtenersemestres'); ?>";
            $.get(url, checked, function(data, status){
                if (status){
                    var respuestaAjax = JSON.parse(data);
                    var datos = "<option value='null'>Seleccionar</option>";
                    for(var i = 0; i < respuestaAjax.length; i++){
                        datos += "<option value='"+respuestaAjax[i]['semestre']+"'>"+respuestaAjax[i]['semestre']+"</option>";
                    }
                    $("#semestres").html(datos);
                }else{
                    console.log("ERROR");
                }
            });
            ajaxGetAsignaturas();
        }

        function ajaxGetAsignaturas(){
            var checked = { 'semestres': document.getElementById('semestres').value,
                            'idcarrera': document.getElementById('carrera_oid').value,
                            'estado_habilitar': "<?php echo $estado_habilitar; ?>"};
            var url = "<?php echo base_url('public/gestionResumenEncuestas/obtenerasignaturas'); ?>";
            $.get(url, checked, function(data, status){
                if (status){
                    var respuestaAjax = JSON.parse(data);
                    var datos = "<option value='null'>Seleccionar</option>";
                    for(var i = 0; i < respuestaAjax.length; i++){
                        datos += "<option value='"+respuestaAjax[i]['oid']+"'>"+respuestaAjax[i]['asignatura']+"</option>";
                    }
                    $("#curso_oid").html(datos);
                }else{
                    console.log("ERROR");
                }
            });
        }

        function ajaxGetProfesores(){
            var checked = { 'idcomunidad': document.getElementById('grupo_oid').value,
                            'idcarrera': document.getElementById('carrera_oid').value};
            var url = "<?php echo base_url('public/gestionResumenEncuestas/obtenerprofesores'); ?>";
            $.get(url, checked, function(data, status){
                if (status){
                    var respuestaAjax = JSON.parse(data);
                    console.log(respuestaAjax);
                    var datos = "<option value='null'>Seleccionar</option>";
                    for(var i = 0; i < respuestaAjax.length; i++){
                        datos += "<option value='"+respuestaAjax[i]['oid']+"'>"+respuestaAjax[i]['nombres']+" "+respuestaAjax[i]['apellido_paterno']+" "+respuestaAjax[i]['apellido_materno']+"</option>";
                    }
                    $("#profesor_oid").html(datos);
                }else{
                    console.log("ERROR");
                }
            });
        }

        function habilitarRegistros(){
            <?php if($estado_habilitar != 1){ ?>
                window.location = "<?php echo base_url('public/gestionResumenEncuestas/index/1') ?>";
                console.log("<?php echo base_url('public/gestionResumenEncuestas/index/1') ?>");
            <?php }else{ ?>
                window.location = "<?php echo base_url('public/gestionResumenEncuestas/index/0') ?>";
                console.log("<?php echo base_url('public/gestionResumenEncuestas/index/0') ?>");

            <?php } ?>
            
        }
    </script>

<script>
        //Dataset para crear la tabla
        var dataSet = []
        <?php foreach($resultado_busqueda as $rb) { ?>
            dataSet.push(['<?= $rb->oid_re ?>', '<?= $rb->oid_re ?>', '<?= $rb->nombre_grupo ?>', '<?= $rb->nombre_carrera ?>', '<?= $rb->nombre_profesor." ".$rb->apellido_profesor ?>', '<?= $rb->nombre_asignatura ?>']);
        <?php } ?>
        
        $(document).ready(function() {
            var table = $('#tabla_carreras').DataTable({
                data: dataSet,
                columnDefs: [
                    {
                        'targets': 0,
                        'checkboxes': {
                            'selectRow': true,
                        }
                    }
                ],
                select: {
                    style: 'multi'
                },
                // order: [[1, 'desc']],
                language: {
                    lengthMenu: "Mostrando _MENU_ datos por página",
                    zeroRecords: "Nothing found - sorry",
                    info: "Mostrando página _PAGE_ de _PAGES_",
                    infoEmpty: "No hay datos disponibles.",
                    infoFiltered: "(filtered from _MAX_ total records)",
                    search: "Buscar",
                    searchPlaceholder: "",
                    paginate: {
                        first: "Primero",
                        last: "Último",
                        next: "Siguiente",
                        previous: "Anterior"
                    },
                }
            });   
        });
    </script>
    <script>
        function modalSwal(){
            cant_usuarios_checked = $('#tabla_carreras').DataTable().column(0).checkboxes.selected().length;
            //console.log(cant_usuarios_checked);//

            if (cant_usuarios_checked > 0){
                document.querySelector("#modalDelete #swal2-content").innerHTML = "¿Está seguro que quiere eliminar "+cant_usuarios_checked+" elementos? <br>¡Esta acción no se puede deshacer!";
                document.querySelector("#modalDelete").style.display = "block";
            }else{
                document.querySelector("#modalError").style.display = "block";
            }
        }

        function modalClose(){
            document.querySelector("#modalDelete").style.display = "none";
            document.querySelector("#modalError").style.display = "none";
        }

        function botonEliminar(){
            var checked = {};
            var list_checked = $('#tabla_carreras').DataTable().column(0).checkboxes.selected();
            for (var i = 0; i < list_checked.length; i++){
                // checked.push(list_checked[i]);
                checked[i] = list_checked[i];
            }
            // console.log(checked); //
            // window.location = '<?php //echo base_url('public/Usuario/eliminar_usuario/'); ?>'+'/'+checked;
            var url = "<?php echo base_url('public/gestionResumenEncuestas/eliminar'); ?>";
            $.post(url, checked, function(data, status){
                //console.log("CARGANDO!", data, status);//
                if (status){
                    window.location = "<?php echo base_url('public/gestionResumenEncuestas/index/0') ?>";
                    // document.querySelector("#modalDelete").style.display = "none";
                    // document.querySelector("#modalSuccess").style.display = "block";
                    //console.log("BIEN");//
                }else{
                    console.log("ERROR");
                }
            });
        }
    </script>
</body>

<!-- </html> -->