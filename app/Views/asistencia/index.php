<?php date_default_timezone_set('America/Santiago'); ?>
<?php echo $headers['headersView']; ?>

<!-- This Page CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/libs/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
<!-- Custom CSS -->
<link href="<?php echo base_url() ?>/assets/dist/css/style.min.css" rel="stylesheet">

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
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <!-- Tabs -->
                            <div class="" >
                                <div class="" id="" role="" aria-labelledby="">
                                    <div class="card-body">
                                        <h3 class="card-title">Libro de Asistencia</h3>
                                        <form action="<?php echo base_url('public/progPresencial/editar/'.$profile_data_edit['oid']); ?>" name="editar_carrera_inactivo" id="editar_carrera_inactivo" method="post" accept-charset="utf-8" class="form-horizontal">
                                            <div class="form-group" hidden>
                                                <small><label class="col-md-12">oid</label></small>
                                                <div class="col-md-12">
                                                    <input name="oid" type="text" class="form-control form-control-line" value="<?= $profile_data_edit['oid'] ?>">
                                                </div>
                                            </div>
                                            <!-- <div class="form-group">
                                                <small><label class="col-md-12">Carrera</label></small>
                                                <div class="col-md-12">
                                                    <input type="text" size="50" class="form-control form-control-line" value="<?= $profile_data_edit['nombre'] ?>" disabled>
                                                </div>
                                            </div> -->
                                            <div class="form-group">
                                                <small><label class="col-md-12">Horas Asignadas<code>*</code></label></small>
                                                <div class="col-md-12">
                                                    <?php //$ponderacion = 0 ?>
                                                    <?php //foreach($r_cursos as $rponderacion) { ?>
                                                        <?php //$ponderacion = $ponderacion + $rponderacion->ponderacion ?>
                                                    <?php //} ?>
                                                    <input type="text" size="50" class="form-control form-control-line" value="<?= $datos_horas['horas_asignadas'] ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Horas Actuales</label></small>
                                                <div class="col-md-12">
                                                    <?php //$total_horas_actuales = 0 ?>
                                                    <?php //foreach($r_cursos as $rcurso) { ?>
                                                        <?php //$total_horas_actuales = $total_horas_actuales + $rcurso->curs_horas ?>
                                                    <?php //} ?>
                                                    <input type="number" size="50" class="form-control form-control-line" value="<?= $datos_horas['horas_actuales'] ?>" disabled>
                                                </div>
                                            </div>
                                            <!-- <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-info">Guardar</button>
                                                </div>
                                            </div> -->
                                        </form>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <!-- Tabs -->
                            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-profesores-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-profile" aria-selected="false">Asistencia</a>
                                </li>
                            </ul>
                            <!-- Tabs -->
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="card-body">
                                        <h4 class="card-title">Asistencia Diaria</h4>
                                        <!-- Start table -->
                                        <div class="table-responsive">
                                            <table name="tabla_profesores" id="tabla_profesores" class="table table-striped table-bordered display" style="width:100%">
                                                <button class="btn btn-danger waves-effect waves-light m-1 mb-3" type="button" data-toggle="modal"
                                                    data-target="#modal-atrasos"><span class="btn-label"><i class="fa fa-clock"></i></span>
                                                    Atrasos</button>
                                                <button class="btn btn-info waves-effect waves-light m-1 mb-3" type="button" data-toggle="modal"
                                                    data-target="#modal-justificaciones"><span class="btn-label"><i class="fa fa-comment"></i></span>
                                                    Justificaciones</button>
                                                <button class="btn btn-info waves-effect waves-light m-1 mb-3" type="button" data-toggle="modal"
                                                    data-target="#modal-asistencias"><span class="btn-label"><i class="fa fa-plus"></i></span>
                                                    Asistencia</button>
                                                <!-- <button onclick="editarAsistencia()" class="btn btn-info waves-effect waves-light m-1 mb-3" type="button" data-toggle="modal"
                                                    data-target="#modal-editar-asistencias"><span class="btn-label"><i class="fa fa-plus"></i></span>
                                                    Editar Asistencia</button> -->
                                                <!-- <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm m-1 ml-0"
                                                                    onclick='modalSwal("tabla_profesores")'>Eliminar Profesor</button>
                                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm m-1 ml-0"
                                                                    onclick="location.href='<?php //echo site_url('progPresencial/agregar_profesor/'.$profile_data_edit['oid']); ?>'">Agregar Profesor</button> -->
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Fecha</th>
                                                        <th scope="col">Horas</th>
                                                        <th scope="col">Inicio</th>
                                                        <th scope="col">Término</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Fecha</th>
                                                        <th scope="col">Horas</th>
                                                        <th scope="col">Inicio</th>
                                                        <th scope="col">Término</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- End table -->
                                    </div>
                                </div>
                                <!-- Modals -->
                                <?php echo view('asistencia/modals/modals_asistencia'); ?>
                                <!-- End Modals -->

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
                                                <button id="botonEliminar" onclick="botonEliminar('tabla_profesores')" type="button" class="swal2-confirm swal2-styled" aria-label="">Eliminar</button>
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
                                                <!-- Mensaje contenido -->
                                            </div>
                                            <div class="swal2-actions" style="display: flex;">
                                                <button onclick="modalClose()" type="button" class="swal2-confirm swal2-styled" aria-label="">OK</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal error -->
                                <div id="success-header-modal" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="success-header-modalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header modal-colored-header bg-success">
                                                <h4 class="modal-title text-white" id="success-header-modalLabel">Vigencia de registro
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- <h5 class="mt-0"></h5> -->
                                                <p>
                                                <div class="form-item">
                                                <label for="motivo" style="width: 120px;">Motivo de la Baja?</label>
                                                <table style="text-align: left;" id="tabla_motivos">
                                                <tbody>
                                                <tr>
                                                <td style="width:20px;"><input type="radio" name="motivo" value="Renuncia voluntaria"  onclick="cambiarValorMotivo('Renuncia voluntaria')"></td>
                                                <td>Renuncia voluntaria</td>
                                                </tr>
                                                <tr>
                                                <td><input onclick="cambiarValorMotivo('Postergación de estudios')" type="radio" name="motivo" value="Postergación de estudios"></td>
                                                <td>Postergación de estudios</td>
                                                </tr>
                                                <tr>
                                                <td><input onclick="cambiarValorMotivo('Cambio de carrera')" type="radio" name="motivo" value="Cambio de carrera"></td>
                                                <td>Cambio de carrera</td>
                                                </tr>
                                                <tr>
                                                <td><input onclick="cambiarValorMotivo('Inasistencias')" type="radio" name="motivo" value="Inasistencias"></td>
                                                <td>Inasistencias</td>
                                                </tr>
                                                <tr>
                                                <td><input onclick="cambiarValorMotivo('Disciplina')" type="radio" name="motivo" value="Disciplina"></td>
                                                <td>Disciplina</td>
                                                </tr>
                                                <tr>
                                                <td><input onclick="cambiarValorMotivo('Reprobación de asignatura')" type="radio" name="motivo" value="Reprobación de asignatura"></td>
                                                <td>Reprobación de asignatura</td>
                                                </tr>
                                                </tbody>
                                                </table>
                                                </div>
                                                <div class="form-item">
                                                <input type="hidden" id="vigencia_oid">
                                                <input type="hidden" id="motivo">
                                                <input type="hidden" id="vigencia_inactivo">
                                                <label for="UsuarioGrupoMotivoObs" style="width: 120px;">Observaciones?</label>
                                                <input id="motivo_obs" style="width:90%" class="form-text" maxlength="160" type="text" id="UsuarioGrupoMotivoObs">
                                                </div>
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" onclick="cambiarVigencia();" id="boton_guardar_vigencia" data-dismiss="modal" class="btn btn-success">Cambiar</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                <!-- End Modal error -->
                                <div id="modalInfo" class="swal2-container swal2-center swal2-fade swal2-shown" style="overflow-y: auto; display: none;">
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
                                                <!-- Mensaje contenido -->
                                            </div>
                                            <div class="swal2-actions" style="display: flex;">
                                                <button onclick="modalClose()" type="button" class="swal2-confirm swal2-styled" aria-label="">OK</button>
                                            </div>
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
    <?php //echo view('dgac/customizer'); ?>
    <div class="chat-windows"></div>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <?php echo view('dgac/scripts'); ?>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url() ?>/assets/libs/sweetalert2/dist/sweetalert2.all.js"></script>
    <script src="<?php echo base_url() ?>/assets/extra-libs/sweetalert2/sweet-alert.init.js"></script>
    <!-- This Page JS -->
    <script src="<?php echo base_url() ?>/assets/libs/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/js/pages/datatable/custom-datatable.js"></script>
    <script type="text/javascript" charset="utf8" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/js/dataTables.checkboxes.min.js"></script>
    <script>
        //Dataset para crear la tabla
        var dataAsistencias = []
        <?php foreach($asistencias as $rp) { ?>
            dataAsistencias.push(['<?= $rp->oid ?>','<?= $rp->asis_fecha ?>','<?= $rp->asis_horas ?>','<?= $rp->asis_inicio ?>','<?= $rp->asis_termino ?>',
                        '<div class="btn-group-sm">'+
                            '<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acción</button>'+
                            '<div class="dropdown-menu">'+
                                '<button class="dropdown-item" onclick="modalEliminar('+'<?= $rp->oid ?>'+')"><i class="fa fa-window-close"></i> Eliminar Asistencia</button>'+
                                '<a class="dropdown-item" href="<?php echo site_url('Cursos/asistencia_diaria/'.$id_curso.'/3/'.$rp->oid); ?>"><i class="fa fa-user"></i> Tomar Asistencia</a>'+
                                // '<a class="dropdown-item" href="<?php //echo site_url('indicadoresHistoricos/editar_indicador_grupo/'.$rp->oid); ?>"><i class="fa fa-edit"></i> Editar</a>'+
                                '<button onclick="editarAsistencia('+'<?= $rp->oid ?>'+')" class="dropdown-item" type="button" data-toggle="modal" data-target="#modal-editar-asistencias"><i class="fa fa-edit"></i> Editar Asistencia</button>'+
                            '</div>'+
                        '</div>']);
        <?php } ?>
        
        $(document).ready(function() {
            var table = $('#tabla_profesores').DataTable({
                data: dataAsistencias,
                select: {
                    style: 'multi'
                },
                order: [[0, 'desc']],
                language: {
                    lengthMenu: "Mostrando _MENU_ datos por página",
                    zeroRecords: "No se encontraron elementos",
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
        function modalSwal(tabla){
            cant_usuarios_checked = $('#'+tabla).DataTable().column(0).checkboxes.selected().length;
            if(tabla=="tabla_profesores") var index = "profesor"+(cant_usuarios_checked>1?'es':'');
            if(tabla=="tabla_asignaturas") var index = "asignatura"+(cant_usuarios_checked>1?'s':'');
            if (cant_usuarios_checked > 0){
                document.querySelector("#modalDelete #swal2-content").innerHTML = "¿Está seguro que quiere eliminar "+cant_usuarios_checked+" "+index+"?";
                document.querySelector("#modalDelete").style.display = "block";
                document.querySelector("#modalDelete #botonEliminar").onclick = function onclick(event) {botonEliminar(tabla)}
            }else{
                document.querySelector("#modalError #swal2-content").innerHTML = "Selecciona al menos 1 "+index+" para eliminar";
                document.querySelector("#modalError").style.display = "block";
            }
        }

        function modalClose(){
            document.querySelector("#modalDelete").style.display = "none";
            document.querySelector("#modalError").style.display = "none";
            document.querySelector("#modalInfo").style.display = "none";
        }

        // function actualizar_variables(oid, inactivo){
        //     document.getElementById('vigencia_inactivo').value=inactivo;
        //     document.getElementById('vigencia_oid').value=oid;
        //     document.getElementById('motivo_obs').value = "";
        //     document.getElementById('boton_guardar_vigencia').style.display = "block";
        // }

        // function mostrarMotivos(motivo, observacion){
        //     $('input[value="'+motivo+'"]').attr('checked', 'checked');
        //     document.getElementById('motivo_obs').value=observacion;
        //     document.getElementById('boton_guardar_vigencia').style.display = "none";
        // }
        
        // function cambiarValorMotivo(valor){
        //     document.getElementById('motivo').value=valor;
        // }

        // function botonEliminar(tabla){
        //     var checked = {};
        //     var list_checked = $('#'+tabla).DataTable().column(0).checkboxes.selected();
        //     for (var i = 0; i < list_checked.length; i++){
        //         checked[i] = list_checked[i];
        //     }
        //     if(tabla=="tabla_profesores"){
        //         var url = "<?php echo base_url('public/progPresencial/eliminar_profesor/'.$profile_data_edit['oid']); ?>";
        //     }else if(tabla=="tabla_asignaturas"){
        //         var url = "<?php echo base_url('public/progPresencial/eliminar_asignatura/'.$profile_data_edit['oid']); ?>";
        //     }

        //     $.post(url, checked, function(data, status){
        //         if (status){
        //             window.location = "<?php echo base_url('public/progPresencial/editar/'.$profile_data_edit['oid']); ?>";
        //         }else{
        //             console.log("ERROR");
        //         }
        //     });
        // }

        // function cambiarVigenciaProfesores(){
        //     var url = "<?php echo base_url('public/progPresencial/cambiarVigencia/'.$profile_data_edit['oid']); ?>";
        //     console.log(url, oid, inactivo);
        //     $.post(url, {oid:oid,inactivo:inactivo}, function(data, status){
        //         if (status){
        //             window.location = "<?php echo base_url('public/progPresencial/editar/'.$profile_data_edit['oid']); ?>";
        //         }else{
        //             console.log("ERROR");
        //         }
        //     });
        // }

        // function cambiarVigencia(){
        //     inactivo = document.getElementById('vigencia_inactivo').value;
        //     oid = document.getElementById('vigencia_oid').value;
        //     motivo_obs = document.getElementById('motivo_obs').value;
        //     motivo = document.getElementById('motivo').value;
        //     oid_grupo = <?=$profile_data_edit['oid']?>;
        //     // document.querySelector("#modalInfo").style.display = "block";
        //     var url = "<?php echo base_url('public/progPresencial/cambiarVigencia/'.$profile_data_edit['oid']); ?>";
        //     console.log(url, oid, inactivo);
        //     $.post(url, {oid:oid,inactivo:inactivo,motivo_obs:motivo_obs,motivo:motivo,oid_grupo:oid_grupo}, function(data, status){
        //         if (status){
        //             window.location = "<?php echo base_url('public/progPresencial/editar/'.$profile_data_edit['oid']); ?>";
        //         }else{
        //             console.log("ERROR");
        //         }
        //     });
        // }

        // function cambiarVigencia2(){
        //     inactivo = document.getElementById('vigencia_inactivo').value;
        //     oid = document.getElementById('vigencia_oid').value;
        //     motivo_obs = 'zxcv';
        //     motivo = '';
        //     oid_grupo = <?=$profile_data_edit['oid']?>;
        //     // document.querySelector("#modalInfo").style.display = "block";
        //     var url = "<?php echo base_url('public/progPresencial/cambiarVigencia/'.$profile_data_edit['oid']); ?>";
        //     console.log(url, oid, inactivo);
        //     $.post(url, {oid:oid,inactivo:inactivo,motivo_obs:motivo_obs,motivo:motivo,oid_grupo:oid_grupo}, function(data, status){
        //         if (status){
        //             window.location = "<?php echo base_url('public/progPresencial/editar/'.$profile_data_edit['oid']); ?>";
        //         }else{
        //             console.log("ERROR");
        //         }
        //     });
        // }

        // function ponderacionValidation(){
        //     var c1 = document.getElementById('grup_nem');
        //     var c2 = document.getElementById('grup_len');
        //     var c3 = document.getElementById('grup_mat');
        //     console.log(parseInt(c1.value) + parseInt(c2.value) + parseInt(c3.value));
        //     if( (parseInt(c1.value) + parseInt(c2.value) + parseInt(c3.value)) > 100 ){ 
        //         c1.setCustomValidity("NEM+LEN+MAT Excede la ponderación total máxima de 100%");  
        //         c2.setCustomValidity("NEM+LEN+MAT Excede la ponderación total máxima de 100%"); 
        //         c3.setCustomValidity("NEM+LEN+MAT Excede la ponderación total máxima de 100%"); 
        //         return false; 
        //     }
        //     c1.setCustomValidity('');
        //     c2.setCustomValidity('');
        //     c3.setCustomValidity('');
        // }

        function getFecha(){
            var id_usuario = document.getElementById('alumno_justificacion').value;
            var url = "<?php echo base_url('public/Cursos/getfecha/'); ?>";
            // console.log(url, oid, inactivo);
            $.post(url, {id_usuario:id_usuario, id_curso:<?= $id_curso ?>}, function(data, status){
                if (status){
                    console.log(data);
                    data = JSON.parse(data);
                    if(data != []){
                        var datos = "<option value='null'>--- Seleccionar ---</option>";
                        for(var i = 0; i < data.length; i++){
                            datos += "<option value='"+data[i].oid+"'>"+data[i].texto+"</option>";
                            console.log(data[i]);
                        }
                        $("#fecha_justificacion").html(datos);
                    }
                    // window.location = "<?php echo base_url('public/progPresencial/editar/'.$profile_data_edit['oid']); ?>";
                }else{
                    console.log("ERROR");
                }
            });
        }

        function getHorasJ(valorFecha){
            let horas = 0;
            if(valorFecha != '--- Seleccionar ---'){
                horas = valorFecha.substring(12);
                for(let i = 0; i < horas.length; i++){
                    if(horas[i] == 'H'){
                        horas = horas.substring(0, i);
                        continue;
                    }
                }
                // console.log(horas);
            }
            document.getElementById('horas_justificadas').max = horas;
        }
        /*****************************************************************/
        function getFechaAtraso(){
            var id_usuario = document.getElementById('alumno_atraso').value;
            var url = "<?php echo base_url('public/Cursos/getFechaAtraso/'); ?>";
            $.post(url, {id_usuario:id_usuario, id_curso:<?= $id_curso ?>}, function(data, status){
                if (status){
                    console.log(data);
                    data = JSON.parse(data);
                    if(data != []){
                        var datos = "<option value='null'>--- Seleccionar ---</option>";
                        for(var i = 0; i < data.length; i++){
                            datos += "<option value='"+data[i].oid+"'>"+data[i].texto+"</option>";
                            console.log(data[i]);
                        }
                        $("#fecha_atraso").html(datos);
                    }
                }else{
                    console.log("ERROR");
                }
            });
        }
        /*****************************************************************/
        function editarAsistencia(id_asistencia){
            var id_usuario = document.getElementById('alumno_atraso').value;
            var url = "<?php echo base_url('public/Cursos/get_asistencia/'); ?>";
            $.post(url, {id_asistencia:id_asistencia}, function(data, status){
                if (status){
                    data = JSON.parse(data);
                    document.getElementById('edit_id_asistencia').value = id_asistencia;
                    document.getElementById('edit_asis_fecha').value = data.asis_fecha;
                    document.getElementById('edit_asis_horas').value = data.asis_horas;
                    document.getElementById('edit_asis_inicio').value = data.asis_inicio;
                    document.getElementById('edit_asis_termino').value = data.asis_termino;
                    document.getElementById('edit_asis_content').value = data.asis_content;
                }else{
                    console.log("ERROR");
                }
            });
        }
        /*****************************************************************/
        function modalEliminar(id){
            document.querySelector("#modalDelete #swal2-content").innerHTML = "¿Está seguro que quiere eliminar la asistencia ID "+id+"?";
            document.querySelector("#modalDelete").style.display = "block";
            document.querySelector("#modalDelete #botonEliminar").onclick = function onclick(event) {botonEliminarAsistencia(id)}
        }

        function botonEliminarAsistencia(id){
            var url = "<?php echo base_url('public/Cursos/eliminar_asistencia/'); ?>";
            $.post(url, {id_asistencia: id}, function(data, status){
                if (status){
                    location.reload();
                }else{
                    console.log("ERROR");
                }
            });
        }
    </script>
</body>

</html>