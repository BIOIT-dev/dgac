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
                                onclick="location.href='<?php echo site_url('indicadoresHistoricos/agregar_indicador_grupo'); ?>'">Agregar Indicador</button>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <!-- Tabs -->
                            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-matricula-tab" data-toggle="pill" href="#matricula-tab-table" role="tab" aria-controls="pills-profile" aria-selected="false">Matricula</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-ocupacion-tab" data-toggle="pill" href="#ocupacion-tab-table" role="tab" aria-controls="pills-setting" aria-selected="false">T. Ocupación</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-tecnicas-tab" data-toggle="pill" href="#tecnicas-tab-table" role="tab" aria-controls="pills-setting" aria-selected="false">T.R. Técnicas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profesionales-tab" data-toggle="pill" href="#profesionales-tab-table" role="tab" aria-controls="pills-setting" aria-selected="false">T.R. Profesionales</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-titulacionct-tab" data-toggle="pill" href="#titulacionct-tab-table" role="tab" aria-controls="pills-setting" aria-selected="false">Titulación C.T</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-titulacioncp-tab" data-toggle="pill" href="#titulacioncp-tab-table" role="tab" aria-controls="pills-setting" aria-selected="false">Titulación C.P.</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-inactivos-tab" data-toggle="pill" href="#inactivos-tab-table" role="tab" aria-controls="pills-setting" aria-selected="false">Inactivos</a>
                                </li>
                            </ul>
                            <!-- Tabs -->
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="matricula-tab-table" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="card-body">
                                        <!-- Start table -->
                                        <div class="table-responsive">
                                            <table name="tabla_matricula" id="tabla_matricula" class="table table-striped table-bordered display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Items/Carrera</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Items/Carrera</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            
                                        </div>
                                        <!-- End table -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="ocupacion-tab-table" role="tabpanel" aria-labelledby="pills-setting-tab">
                                    <div class="card-body">
                                        <!-- Start table -->
                                        <div class="table-responsive">
                                            <table name="tabla_ocupacion" id="tabla_ocupacion" class="table table-striped table-bordered display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Items/Carrera</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Items/Carrera</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- End table -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tecnicas-tab-table" role="tabpanel" aria-labelledby="pills-setting-tab">
                                    <div class="card-body">
                                        <!-- Start table -->
                                        <div class="table-responsive">
                                            <table name="tabla_tecnicas" id="tabla_tecnicas" class="table table-striped table-bordered display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Items/Carrera</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Items/Carrera</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- End table -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profesionales-tab-table" role="tabpanel" aria-labelledby="pills-setting-tab">
                                    <div class="card-body">
                                        <!-- Start table -->
                                        <div class="table-responsive">
                                            <table name="tabla_profesionales" id="tabla_profesionales" class="table table-striped table-bordered display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Items/Carrera</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Items/Carrera</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- End table -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="titulacionct-tab-table" role="tabpanel" aria-labelledby="pills-setting-tab">
                                    <div class="card-body">
                                        <!-- Start table -->
                                        <div class="table-responsive">
                                            <table name="tabla_titulacionct" id="tabla_titulacionct" class="table table-striped table-bordered display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Items/Carrera</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Items/Carrera</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- End table -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="titulacioncp-tab-table" role="tabpanel" aria-labelledby="pills-setting-tab">
                                    <div class="card-body">
                                        <!-- Start table -->
                                        <div class="table-responsive">
                                            <table name="tabla_titulacioncp" id="tabla_titulacioncp" class="table table-striped table-bordered display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Items/Carrera</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Items/Carrera</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- End table -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="inactivos-tab-table" role="tabpanel" aria-labelledby="pills-setting-tab">
                                    <div class="card-body">
                                        <!-- Start table -->
                                        <div class="table-responsive">
                                            <table name="tabla_inactivos" id="tabla_inactivos" class="table table-striped table-bordered display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Items/Carrera</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Items/Carrera</th>
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
        var dataMatricula = []
        var dataOcupacion = []
        var dataTecnicas = []
        var dataProfesionales = []
        var dataTitulacionct = []
        var dataTitulacioncp = []
        var dataInactivos = []
        <?php foreach($indicador_grupo as $rp) { ?>
            var indicador = ['<?= $rp->oid ?>', '<?= $rp->grupo ?>',
                        '<div class="btn-group-sm">'+
                            '<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acción</button>'+
                            '<div class="dropdown-menu">'+
                                '<button class="dropdown-item" onclick="cambiarVigencia('+'<?= $rp->oid.', 1' ?>'+')"><i class="fa fa-window-close"></i> Cambiar Vigencia</button>'+
                                '<a class="dropdown-item" href="<?php echo site_url('indicadoresHistoricos/listado_indicadores/'.$rp->oid); ?>"><i class="fa fa-warehouse"></i> Indicadores</a>'+
                                '<a class="dropdown-item" href="<?php echo site_url('indicadoresHistoricos/editar_indicador_grupo/'.$rp->oid); ?>"><i class="fa fa-edit"></i> Editar</a>'+
                            '</div>'+
                        '</div>'];
            if('<?= $rp->tipo ?>' == '1' && '<?= $rp->activo ?>' == '0'){
                dataMatricula.push(indicador);
            }else if('<?= $rp->tipo ?>' == '2' && '<?= $rp->activo ?>' == '0'){
                dataOcupacion.push(indicador);
            }else if('<?= $rp->tipo ?>' == '3' && '<?= $rp->activo ?>' == '0'){
                dataTecnicas.push(indicador);
            }else if('<?= $rp->tipo ?>' == '4' && '<?= $rp->activo ?>' == '0'){
                dataProfesionales.push(indicador);
            }else if('<?= $rp->tipo ?>' == '5' && '<?= $rp->activo ?>' == '0'){
                dataTitulacionct.push(indicador);
            }else if('<?= $rp->tipo ?>' == '6' && '<?= $rp->activo ?>' == '0'){
                dataTitulacioncp.push(indicador);
            }else if('<?= $rp->activo ?>' == '1'){
                dataInactivos.push(['<?= $rp->oid ?>', '<?= $rp->grupo ?>',
                        '<div class="btn-group-sm">'+
                            '<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acción</button>'+
                            '<div class="dropdown-menu">'+
                                '<button class="dropdown-item" onclick="cambiarVigencia('+'<?= $rp->oid.', 0' ?>'+')"><i class="fa fa-window-close"></i> Cambiar Vigencia</button>'+
                                '<a class="dropdown-item" href="<?php echo site_url('indicadoresHistoricos/listado_indicadores/'.$rp->oid); ?>"><i class="fa fa-warehouse"></i> Indicadores</a>'+
                                '<a class="dropdown-item" href="<?php echo site_url('indicadoresHistoricos/editar_indicador_grupo/'.$rp->oid); ?>"><i class="fa fa-edit"></i> Editar</a>'+
                            '</div>'+
                        '</div>']);
            }
        <?php } ?>
        crearTablaSimple('#tabla_matricula', dataMatricula);
        crearTablaSimple('#tabla_ocupacion', dataOcupacion);
        crearTablaSimple('#tabla_tecnicas', dataTecnicas);
        crearTablaSimple('#tabla_profesionales', dataProfesionales);
        crearTablaSimple('#tabla_titulacionct', dataTitulacionct);
        crearTablaSimple('#tabla_titulacioncp', dataTitulacioncp);
        crearTablaSimple('#tabla_inactivos', dataInactivos);
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
        function cambiarVigencia(id_indicador, estado){
            var url = "<?php echo base_url('public/indicadoresHistoricos/cambiarVigencia/') ?>";
            console.log(url, id_indicador, estado);
            $.post(url, {id_indicador:id_indicador,estado:estado}, function(data, status){
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