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
                    <div class="col-lg-3 col-md-3">
                        <div class="card">
                            <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm m-1 ml-0"
                                onclick="location.href='<?php echo site_url('periodo/agregar_sede/'.$id_periodo); ?>'">Agregar Sede</button>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <!-- Tabs -->
                            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-abierto-tab" data-toggle="pill" href="#abierto-tab-table" role="tab" aria-controls="pills-profile" aria-selected="false">Activas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-gestion-tab" data-toggle="pill" href="#gestion-tab-table" role="tab" aria-controls="pills-setting" aria-selected="false">Inactivas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-inactivo-tab" data-toggle="pill" href="#inactivo-tab-table" role="tab" aria-controls="pills-setting" aria-selected="false">Disponibles</a>
                                </li>
                            </ul>
                            <!-- Tabs -->
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="abierto-tab-table" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="card-body">
                                        <!-- Start table -->
                                        <div class="table-responsive">
                                            <table name="tabla_periodos_abierto" id="tabla_periodos_abierto" class="table table-striped table-bordered display" style="width:100%">
                                                <!-- <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm m-1 ml-0"
                                                                    onclick='modalSwal("tabla_periodos_abierto")'>Eliminar Profesor</button>
                                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm m-1 ml-0"
                                                                    onclick="location.href='<?php echo site_url('progPresencial/agregar_profesor/')//.$profile_data_edit['oid']); ?>'">Agregar Profesor</button> -->
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Nombre</th>
                                                        <th scope="col">Activo</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Nombre</th>
                                                        <th scope="col">Activo</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            
                                        </div>
                                        <!-- End table -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="gestion-tab-table" role="tabpanel" aria-labelledby="pills-setting-tab">
                                    <div class="card-body">
                                        <!-- Start table -->
                                        <div class="table-responsive">
                                            <table name="tabla_periodos_gestion" id="tabla_periodos_gestion" class="table table-striped table-bordered display" style="width:100%">
                                                <!-- <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm m-1 ml-0"
                                                                    onclick='modalSwal("tabla_periodos_gestion")'>Eliminar Asignatura</button>
                                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm m-1 ml-0"
                                                                    onclick="location.href='<?php echo site_url('progPresencial/agregar_asignatura/')//.$profile_data_edit['oid']); ?>'">Agregar Asignatura</button> -->
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Nombre</th>
                                                        <th scope="col">Activo</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Nombre</th>
                                                        <th scope="col">Activo</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- End table -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="inactivo-tab-table" role="tabpanel" aria-labelledby="pills-setting-tab">
                                    <div class="card-body">
                                        <!-- Start table -->
                                        <div class="table-responsive">
                                            <table name="tabla_periodos_inactivo" id="tabla_periodos_inactivo" class="table table-striped table-bordered display" style="width:100%">
                                                <!-- <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm m-1 ml-0"
                                                                    onclick='modalSwal("tabla_periodos_inactivo")'>Eliminar Exámen</button>
                                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm m-1 ml-0"
                                                                    onclick="location.href='<?php echo site_url('admisionCarrera/agregar_examen/')//.$profile_data_edit['oid']); ?>'">Agregar Exámen</button> -->
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Nombre</th>
                                                        <th scope="col">Activo</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Nombre</th>
                                                        <th scope="col">Activo</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- End table -->
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
        //Dataset para crear la tabla
        var dataPeriodosAbierto = []
        var dataPeriodosGestion = []
        var dataPeriodosInactivo = []
        <?php foreach($r_periodos as $rp) { ?>
            if('<?= $rp->sepe_activo ?>' == '1'){
                dataPeriodosAbierto.push(['<?= $rp->oid ?>', '<?= $rp->sede_nombre ?>',
                        '<?= ($rp->sepe_activo==1)?'<span class="badge py-1 badge-success">Activo</span>':'<span class="badge py-1 badge-danger text-white">Inactivo</span>' ?>',
                        '<button class="btn btn-success btn-sm" onclick="cambiarVigenciaSede('+'<?= $rp->oid.', 0' ?>'+')"><i class="fa fa-window-close"></i> Cambiar Vigencia</button>']);
            }else if('<?= $rp->sepe_activo ?>' == '0'){
                dataPeriodosGestion.push(['<?= $rp->oid ?>', '<?= $rp->sede_nombre ?>',
                        '<?= ($rp->sepe_activo==1)?'<span class="badge py-1 badge-success">Activo</span>':'<span class="badge py-1 badge-danger text-white">Inactivo</span>' ?>',
                        '<button class="btn btn-success btn-sm" onclick="cambiarVigenciaSede('+'<?= $rp->oid.', 1' ?>'+')"><i class="fa fa-window-close"></i> Cambiar Vigencia</button>']);
            }
        <?php } ?>
        <?php foreach($disponibles as $rp) { ?>
            dataPeriodosInactivo.push(['<?= $rp->oid ?>', '<?= $rp->sede_nombre ?>',
                        '<?= ($rp->inactivo==0)?'<span class="badge py-1 badge-success">Activo</span>':'<span class="badge py-1 badge-danger text-white">Inactivo</span>' ?>',
                        '<button class="btn btn-success btn-sm" onclick="agregarRegistro('+'<?= $rp->oid.','.$id_periodo ?>'+')"><i class="fa fa-window-close"></i> Agregar Registro</button>']);
        <?php } ?>
        crearTablaSimple('#tabla_periodos_abierto', dataPeriodosAbierto);
        crearTablaSimple('#tabla_periodos_gestion', dataPeriodosGestion);
        crearTablaSimple('#tabla_periodos_inactivo', dataPeriodosInactivo);
        /******************************************************************/
        function crearTablaSimple(nombreTabla, datosTabla){
            $(document).ready(function() {
                var table = $(nombreTabla).DataTable({
                    data: datosTabla,
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
        }
        
    </script>
    <script>
        function cambiarVigenciaSede(id_sede, estado){
            var url = "<?php echo base_url('public/periodo/cambiarVigenciaSede/') ?>";
            console.log(url, id_sede, estado);
            $.post(url, {id_sede:id_sede,estado:estado}, function(data, status){
                if (status){
                    window.location = "<?php //echo base_url('public/periodo/index/') ?>";
                }else{
                    console.log("ERROR");
                }
            });
        }

        function agregarRegistro(id_sede, id_periodo){
            var url = "<?php echo base_url('public/periodo/agregarRegistro/') ?>";
            console.log(url, id_sede, id_periodo);
            $.post(url, {id_sede:id_sede,id_periodo:id_periodo}, function(data, status){
                if (status){
                    window.location = "<?php //echo base_url('public/periodo/index/') ?>";
                }else{
                    console.log("ERROR");
                }
            });
        }
    </script>
</body>

</html>