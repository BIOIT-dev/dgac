<?php //echo view('dgac/headers'); ?>
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
                    <div class="col-lg-3 col-md-3">
                        <div class="card">
                            <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm m-1 ml-0"
                                onclick="javascript:void(0)">Exportar Inscritos</button>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <!-- Tabs -->
                            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-borrador-tab" data-toggle="pill" href="#borrador-tab-table" role="tab" aria-controls="pills-timeline" aria-selected="true">Borrador</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-enviadas-tab" data-toggle="pill" href="#enviadas-tab-table" role="tab" aria-controls="pills-profile" aria-selected="false">Enviadas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-etapa1-tab" data-toggle="pill" href="#etapa1-tab-table" role="tab" aria-controls="pills-setting" aria-selected="false">1era Etapa</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-etapa2-tab" data-toggle="pill" href="#etapa2-tab-table" role="tab" aria-controls="pills-setting" aria-selected="false">2da Etapa</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-etapa3-tab" data-toggle="pill" href="#etapa3-tab-table" role="tab" aria-controls="pills-setting" aria-selected="false">3era Etapa</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-seleccionado-tab" data-toggle="pill" href="#seleccionado-tab-table" role="tab" aria-controls="pills-setting" aria-selected="false">Seleccionado</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-matriculado-tab" data-toggle="pill" href="#matriculado-tab-table" role="tab" aria-controls="pills-setting" aria-selected="false">Matriculado</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-anulada-tab" data-toggle="pill" href="#anulada-tab-table" role="tab" aria-controls="pills-setting" aria-selected="false">Anulada</a>
                                </li>
                            </ul>
                            <!-- Tabs -->
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="borrador-tab-table" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="card-body">
                                        <!-- Start table -->
                                        <div class="table-responsive">
                                            <table name="tabla_borrador" id="tabla_borrador" class="table table-striped table-bordered display" style="width:100%">
                                                <!-- <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm m-1 ml-0"
                                                                    onclick='modalSwal("tabla_borrador")'>Eliminar Borrador</button>
                                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm m-1 ml-0"
                                                                    onclick="location.href='<?php //echo site_url('progPresencial/agregar_profesor/'.$profile_data_edit['oid']); ?>'">Agregar Profesor</button> -->
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">RUT</th>
                                                        <th scope="col">Nombres</th>
                                                        <th scope="col">Paterno</th>
                                                        <th scope="col">Materno</th>
                                                        <th scope="col">Puntaje</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">RUT</th>
                                                        <th scope="col">Nombres</th>
                                                        <th scope="col">Paterno</th>
                                                        <th scope="col">Materno</th>
                                                        <th scope="col">Puntaje</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- End table -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="enviadas-tab-table" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="card-body">
                                        <!-- Start table -->
                                        <div class="table-responsive">
                                            <table name="tabla_enviadas" id="tabla_enviadas" class="table table-striped table-bordered display" style="width:100%">
                                                <!-- <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm m-1 ml-0"
                                                                    onclick='modalSwal("tabla_enviadas")'>Eliminar Profesor</button>
                                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm m-1 ml-0"
                                                                    onclick="location.href='<?php //echo site_url('progPresencial/agregar_profesor/'.$profile_data_edit['oid']); ?>'">Agregar Profesor</button> -->
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">RUT</th>
                                                        <th scope="col">Nombres</th>
                                                        <th scope="col">Paterno</th>
                                                        <th scope="col">Materno</th>
                                                        <th scope="col">Puntaje</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">RUT</th>
                                                        <th scope="col">Nombres</th>
                                                        <th scope="col">Paterno</th>
                                                        <th scope="col">Materno</th>
                                                        <th scope="col">Puntaje</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- End table -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="etapa1-tab-table" role="tabpanel" aria-labelledby="pills-setting-tab">
                                    <div class="card-body">
                                        <!-- Start table -->
                                        <div class="table-responsive">
                                            <table name="tabla_etapa1" id="tabla_etapa1" class="table table-striped table-bordered display" style="width:100%">
                                                <!-- <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm m-1 ml-0"
                                                                    onclick='modalSwal("tabla_etapa1")'>Eliminar Asignatura</button>
                                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm m-1 ml-0"
                                                                    onclick="location.href='<?php //echo site_url('progPresencial/agregar_asignatura/'.$profile_data_edit['oid']); ?>'">Agregar Asignatura</button> -->
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">RUT</th>
                                                        <th scope="col">Nombres</th>
                                                        <th scope="col">Paterno</th>
                                                        <th scope="col">Materno</th>
                                                        <th scope="col">Puntaje</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">RUT</th>
                                                        <th scope="col">Nombres</th>
                                                        <th scope="col">Paterno</th>
                                                        <th scope="col">Materno</th>
                                                        <th scope="col">Puntaje</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- End table -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="etapa2-tab-table" role="tabpanel" aria-labelledby="pills-setting-tab">
                                    <div class="card-body">
                                        <!-- Start table -->
                                        <div class="table-responsive">
                                            <table name="tabla_etapa2" id="tabla_etapa2" class="table table-striped table-bordered display" style="width:100%">
                                                <!-- <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm m-1 ml-0"
                                                                    onclick='modalSwal("tabla_etapa2")'>Eliminar Exámen</button>
                                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm m-1 ml-0"
                                                                    onclick="location.href='<?php echo site_url('admisionCarrera/agregar_examen/'.$profile_data_edit['oid']); ?>'">Agregar Exámen</button> -->
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">RUT</th>
                                                        <th scope="col">Nombres</th>
                                                        <th scope="col">Paterno</th>
                                                        <th scope="col">Materno</th>
                                                        <th scope="col">Puntaje</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">RUT</th>
                                                        <th scope="col">Nombres</th>
                                                        <th scope="col">Paterno</th>
                                                        <th scope="col">Materno</th>
                                                        <th scope="col">Puntaje</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- End table -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="etapa3-tab-table" role="tabpanel" aria-labelledby="pills-setting-tab">
                                    <div class="card-body">
                                        <!-- Start table -->
                                        <div class="table-responsive">
                                            <table name="tabla_etapa3" id="tabla_etapa3" class="table table-striped table-bordered display" style="width:100%">
                                                <!-- <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm m-1 ml-0"
                                                                    onclick='modalSwal("tabla_etapa3")'>Eliminar Carrera</button>
                                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm m-1 ml-0"
                                                                    onclick="location.href='<?php //echo site_url('admisionCarrera/agregar_carrera/'.$profile_data_edit['oid']); ?>'">Agregar Carrera</button> -->
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">RUT</th>
                                                        <th scope="col">Nombres</th>
                                                        <th scope="col">Paterno</th>
                                                        <th scope="col">Materno</th>
                                                        <th scope="col">Puntaje</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">RUT</th>
                                                        <th scope="col">Nombres</th>
                                                        <th scope="col">Paterno</th>
                                                        <th scope="col">Materno</th>
                                                        <th scope="col">Puntaje</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- End table -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="seleccionado-tab-table" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="card-body">
                                        <!-- Start table -->
                                        <div class="table-responsive">
                                            <table name="tabla_seleccionado" id="tabla_seleccionado" class="table table-striped table-bordered display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">RUT</th>
                                                        <th scope="col">Nombres</th>
                                                        <th scope="col">Paterno</th>
                                                        <th scope="col">Materno</th>
                                                        <th scope="col">Puntaje</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">RUT</th>
                                                        <th scope="col">Nombres</th>
                                                        <th scope="col">Paterno</th>
                                                        <th scope="col">Materno</th>
                                                        <th scope="col">Puntaje</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- End table -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="matriculado-tab-table" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="card-body">
                                        <!-- Start table -->
                                        <div class="table-responsive">
                                            <table name="tabla_matriculado" id="tabla_matriculado" class="table table-striped table-bordered display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">RUT</th>
                                                        <th scope="col">Nombres</th>
                                                        <th scope="col">Paterno</th>
                                                        <th scope="col">Materno</th>
                                                        <th scope="col">Puntaje</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">RUT</th>
                                                        <th scope="col">Nombres</th>
                                                        <th scope="col">Paterno</th>
                                                        <th scope="col">Materno</th>
                                                        <th scope="col">Puntaje</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- End table -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="anulada-tab-table" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="card-body">
                                        <!-- Start table -->
                                        <div class="table-responsive">
                                            <table name="tabla_anulada" id="tabla_anulada" class="table table-striped table-bordered display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">RUT</th>
                                                        <th scope="col">Nombres</th>
                                                        <th scope="col">Paterno</th>
                                                        <th scope="col">Materno</th>
                                                        <th scope="col">Puntaje</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">RUT</th>
                                                        <th scope="col">Nombres</th>
                                                        <th scope="col">Paterno</th>
                                                        <th scope="col">Materno</th>
                                                        <th scope="col">Puntaje</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- End table -->
                                    </div>
                                </div>
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
                                                <button id="botonEliminar" onclick="botonEliminar('tabla_borrador')" type="button" class="swal2-confirm swal2-styled" aria-label="">Eliminar</button>
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
    <script src="<?php echo base_url() ?>/assets/libs/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/js/pages/datatable/custom-datatable.js"></script>
    <script type="text/javascript" charset="utf8" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/js/dataTables.checkboxes.min.js"></script>
    <script>
    $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
    var radioswitch = function() {
        var bt = function() {
            $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioState")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
            })
        };
        return {
            init: function() {
                bt()
            }
        }
    }();
    $(document).ready(function() {
        radioswitch.init()
    });
    </script>
    <script>
        //Dataset para crear la tabla
        var dataBorrador = []
        <?php foreach($r_borrador as $rp) { ?>
            dataBorrador.push(['<?= $rp->postulacion_oid ?>','<?= $rp->rut ?>','<?= $rp->nombres ?>','<?= $rp->apellido_paterno ?>','<?= $rp->apellido_materno ?>',    
                        '<?= ($rp->post_mat*($profile_data_edit['grup_mat']/100))+($rp->post_len*($profile_data_edit['grup_len']/100))+($rp->post_nem*($profile_data_edit['grup_nem']/100)) ?>',
                        '<button onClick="cambiarEstadoPostulacion('+"'"+'9'+"', "+"'"+'<?= $rp->postulacion_oid ?>'+"'"+');" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm">Vigencia</button>'+
                        '<a href="<?php echo site_url('gestionPostulantes/editar_postulacion/'.$profile_data_edit['oid'].'/'.$rp->postulacion_oid); ?>" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm" aria-label=""">Editar</a>']);
        <?php } ?>
        crearTablaSimple('#tabla_borrador', dataBorrador);

        //Dataset para crear la tabla
        var dataEnviadas = []
        <?php foreach($r_enviadas as $rp) { ?>
            dataEnviadas.push(['<?= $rp->postulacion_oid ?>','<?= $rp->rut ?>','<?= $rp->nombres ?>','<?= $rp->apellido_paterno ?>','<?= $rp->apellido_materno ?>',    
                        '<?= ($rp->post_mat*($profile_data_edit['grup_mat']/100))+($rp->post_len*($profile_data_edit['grup_len']/100))+($rp->post_nem*($profile_data_edit['grup_nem']/100)) ?>',
                        '<button onClick="cambiarEstadoPostulacion('+"'"+'9'+"', "+"'"+'<?= $rp->postulacion_oid ?>'+"'"+');" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm">Vigencia</button>'+
                        '<a href="<?php echo site_url('gestionPostulantes/editar_postulacion/'.$profile_data_edit['oid'].'/'.$rp->postulacion_oid); ?>" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm" aria-label=""">Editar</a>']);
        <?php } ?>
        crearTablaSimple('#tabla_enviadas', dataEnviadas);

        //Dataset para crear la tabla Asignaturas
        var dataEtapa1 = []
        <?php foreach($r_etapa1 as $rp) { ?>
            dataEtapa1.push(['<?= $rp->postulacion_oid ?>','<?= $rp->rut ?>','<?= $rp->nombres ?>','<?= $rp->apellido_paterno ?>','<?= $rp->apellido_materno ?>',    
                        '<?= ($rp->post_mat*($profile_data_edit['grup_mat']/100))+($rp->post_len*($profile_data_edit['grup_len']/100))+($rp->post_nem*($profile_data_edit['grup_nem']/100)) ?>',
                        '<button onClick="cambiarEstadoPostulacion('+"'"+'9'+"', "+"'"+'<?= $rp->postulacion_oid ?>'+"'"+');" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm">Vigencia</button>'+
                        '<a href="<?php echo site_url('gestionPostulantes/editar_postulacion/'.$profile_data_edit['oid'].'/'.$rp->postulacion_oid); ?>" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm" aria-label=""">Editar</a>']);
        <?php } ?>
        crearTablaSimple('#tabla_etapa1', dataEtapa1);

        //Dataset para crear la tabla Examenes
        var dataEtapa2 = []
        <?php foreach($r_etapa2 as $rp) { ?>
            dataEtapa2.push(['<?= $rp->postulacion_oid ?>','<?= $rp->rut ?>','<?= $rp->nombres ?>','<?= $rp->apellido_paterno ?>','<?= $rp->apellido_materno ?>',    
                        '<?= ($rp->post_mat*($profile_data_edit['grup_mat']/100))+($rp->post_len*($profile_data_edit['grup_len']/100))+($rp->post_nem*($profile_data_edit['grup_nem']/100)) ?>',
                        '<button onClick="cambiarEstadoPostulacion('+"'"+'9'+"', "+"'"+'<?= $rp->postulacion_oid ?>'+"'"+');" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm">Vigencia</button>'+
                        '<a href="<?php echo site_url('gestionPostulantes/editar_postulacion/'.$profile_data_edit['oid'].'/'.$rp->postulacion_oid); ?>" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm" aria-label=""">Editar</a>']);
        <?php } ?>
        crearTablaSimple('#tabla_etapa2', dataEtapa2);

        //Dataset para crear la tabla Examenes
        var dataEtapa3 = []
        <?php foreach($r_etapa3 as $rp) { ?>
            dataEtapa3.push(['<?= $rp->postulacion_oid ?>','<?= $rp->rut ?>','<?= $rp->nombres ?>','<?= $rp->apellido_paterno ?>','<?= $rp->apellido_materno ?>',    
                        '<?= ($rp->post_mat*($profile_data_edit['grup_mat']/100))+($rp->post_len*($profile_data_edit['grup_len']/100))+($rp->post_nem*($profile_data_edit['grup_nem']/100)) ?>',
                        '<button onClick="cambiarEstadoPostulacion('+"'"+'9'+"', "+"'"+'<?= $rp->postulacion_oid ?>'+"'"+');" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm">Vigencia</button>'+
                        '<a href="<?php echo site_url('gestionPostulantes/editar_postulacion/'.$profile_data_edit['oid'].'/'.$rp->postulacion_oid); ?>" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm" aria-label=""">Editar</a>']);
        <?php } ?>
        crearTablaSimple('#tabla_etapa3', dataEtapa3);

        var dataSeleccionado = []
        <?php foreach($r_seleccionado as $rp) { ?>
            dataSeleccionado.push(['<?= $rp->postulacion_oid ?>','<?= $rp->rut ?>','<?= $rp->nombres ?>','<?= $rp->apellido_paterno ?>','<?= $rp->apellido_materno ?>',    
                        '<?= ($rp->post_mat*($profile_data_edit['grup_mat']/100))+($rp->post_len*($profile_data_edit['grup_len']/100))+($rp->post_nem*($profile_data_edit['grup_nem']/100)) ?>',
                        '<button onClick="cambiarEstadoPostulacion('+"'"+'9'+"', "+"'"+'<?= $rp->postulacion_oid ?>'+"'"+');" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm">Vigencia</button>'+
                        '<a href="<?php echo site_url('gestionPostulantes/editar_postulacion/'.$profile_data_edit['oid'].'/'.$rp->postulacion_oid); ?>" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm" aria-label=""">Editar</a>']);
        <?php } ?>
        crearTablaSimple('#tabla_seleccionado', dataSeleccionado);

        var dataMatriculado = []
        <?php foreach($r_matriculado as $rp) { ?>
            dataMatriculado.push(['<?= $rp->postulacion_oid ?>','<?= $rp->rut ?>','<?= $rp->nombres ?>','<?= $rp->apellido_paterno ?>','<?= $rp->apellido_materno ?>',    
                        '<?= ($rp->post_mat*($profile_data_edit['grup_mat']/100))+($rp->post_len*($profile_data_edit['grup_len']/100))+($rp->post_nem*($profile_data_edit['grup_nem']/100)) ?>',
                        '<button onClick="cambiarEstadoPostulacion('+"'"+'9'+"', "+"'"+'<?= $rp->postulacion_oid ?>'+"'"+');" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm">Vigencia</button>'+
                        '<a href="<?php echo site_url('gestionPostulantes/editar_postulacion/'.$profile_data_edit['oid'].'/'.$rp->postulacion_oid); ?>" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm" aria-label=""">Editar</a>']);
        <?php } ?>
        crearTablaSimple('#tabla_matriculado', dataMatriculado);

        var dataAnulada = []
        <?php foreach($r_anulada as $rp) { ?>
            dataAnulada.push(['<?= $rp->postulacion_oid ?>','<?= $rp->rut ?>','<?= $rp->nombres ?>','<?= $rp->apellido_paterno ?>','<?= $rp->apellido_materno ?>',    
                        '<?= ($rp->post_mat*($profile_data_edit['grup_mat']/100))+($rp->post_len*($profile_data_edit['grup_len']/100))+($rp->post_nem*($profile_data_edit['grup_nem']/100)) ?>',
                        '<button onClick="cambiarEstadoPostulacion('+"'"+'0'+"', "+"'"+'<?= $rp->postulacion_oid ?>'+"'"+');" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm">Vigencia</button>'+
                        '<a href="<?php echo site_url('gestionPostulantes/editar_postulacion/'.$profile_data_edit['oid'].'/'.$rp->postulacion_oid); ?>" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm" aria-label=""">Editar</a>']);
        <?php } ?>
        crearTablaSimple('#tabla_anulada', dataAnulada);
        /******************************************************************/
        function crearDataTable(nombreTabla, datosTabla){
            $(document).ready(function() {
                var table = $(nombreTabla).DataTable({
                    data: datosTabla,
                    columnDefs: [{
                        'targets': 0,
                        'checkboxes': {
                            'selectRow': true,
                        }
                    }],
                    select: {
                        style: 'multi'
                    },
                    order: [[1, 'asc']],
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
        }

        function crearTablaSimple(nombreTabla, datosTabla){
            $(document).ready(function() {
                var table = $(nombreTabla).DataTable({
                    data: datosTabla,
                    select: {
                        style: 'multi'
                    },
                    // order: [[1, 'desc']],
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
        }
        
    </script>
    <script>
        function modalSwal(tabla){
            cant_usuarios_checked = $('#'+tabla).DataTable().column(0).checkboxes.selected().length;
            if(tabla=="tabla_borrador") var index = "profesor"+(cant_usuarios_checked>1?'es':'');
            if(tabla=="tabla_asignaturas") var index = "asignatura"+(cant_usuarios_checked>1?'s':'');
            if(tabla=="tabla_examenes") var index = "exámen"+(cant_usuarios_checked>1?'es':'');
            if(tabla=="tabla_carreras") var index = "carrera"+(cant_usuarios_checked>1?'s':'');
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
        }

        function botonEliminar(tabla){
            var checked = {};
            var list_checked = $('#'+tabla).DataTable().column(0).checkboxes.selected();
            for (var i = 0; i < list_checked.length; i++){
                checked[i] = list_checked[i];
            }
            if(tabla=="tabla_borrador"){
                var url = "<?php echo base_url('public/progPresencial/eliminar_profesor/'.$profile_data_edit['oid']); ?>";
            }else if(tabla=="tabla_asignaturas"){
                var url = "<?php echo base_url('public/progPresencial/eliminar_asignatura/'.$profile_data_edit['oid']); ?>";
            }else if(tabla=="tabla_examenes"){
                var url = "<?php echo base_url('public/admisionCarrera/eliminar_examen'); ?>";
            }else if(tabla=="tabla_carreras"){
                var url = "<?php echo base_url('public/admisionCarrera/eliminar_carrera'); ?>";
            }

            $.post(url, checked, function(data, status){
                if (status){
                    console.log(data, status)
                    window.location = "<?php echo base_url('public/admisionCarrera/editar/'.$profile_data_edit['oid']); ?>";
                }else{
                    console.log("ERROR");
                }
            });
        }

        function cambiarVigencia(oid, inactivo){
            
            var url = "<?php echo base_url('public/progPresencial/cambiarVigencia/'.$profile_data_edit['oid']); ?>";
            console.log(url, oid, inactivo);
            $.post(url, {oid:oid,inactivo:inactivo}, function(data, status){
                if (status){
                    window.location = "<?php echo base_url('public/progPresencial/editar/'.$profile_data_edit['oid']); ?>";
                }else{
                    console.log("ERROR");
                }
            });
        }

        function cambiarEstadoPostulacion(oid_poes, oid_postulacion){
            var url = "<?php echo base_url('public/gestionPostulantes/cambiarEstado/'); ?>";
            $.post(url, {oid_poes:oid_poes, oid_postulacion:oid_postulacion}, function(data, status){
                if (status){
                    window.location = "<?php echo base_url('public/gestionPostulantes/postulantes_carrera/'.$profile_data_edit['oid']); ?>";
                }else{
                    console.log("ERROR");
                }
            });
        }

        function ponderacionValidation(){
            var c1 = document.getElementById('grup_nem');
            var c2 = document.getElementById('grup_len');
            var c3 = document.getElementById('grup_mat');
            console.log(parseInt(c1.value) + parseInt(c2.value) + parseInt(c3.value));
            if( (parseInt(c1.value) + parseInt(c2.value) + parseInt(c3.value)) > 100 ){ 
                c1.setCustomValidity("NEM+LEN+MAT Excede la ponderación total máxima de 100%");  
                c2.setCustomValidity("NEM+LEN+MAT Excede la ponderación total máxima de 100%"); 
                c3.setCustomValidity("NEM+LEN+MAT Excede la ponderación total máxima de 100%"); 
                return false; 
            }
            c1.setCustomValidity('');
            c2.setCustomValidity('');
            c3.setCustomValidity('');
        }
    </script>
</body>

</html>