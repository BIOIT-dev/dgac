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
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table name="tabla_encuesta" id="tabla_encuesta" class="table table-striped table-bordered display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th scope="col">Encuesta o Banco de Preguntas</th>
                                                <th scope="col">Tipo</th>
                                                <th scope="col">Comunidad</th>
                                                <th scope="col">Estado</th>
                                                <th scope="col">Acción</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th scope="col">Encuesta o Banco de Preguntas</th>
                                                <th scope="col">Tipo</th>
                                                <th scope="col">Comunidad</th>
                                                <th scope="col">Estado</th>
                                                <th scope="col">Acción</th>
                                            </tr>
                                        </tfoot>
                                    </table>                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
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
    <script src="<?php echo base_url() ?>/assets/libs/sweetalert2/dist/sweetalert2.all.js"></script>
    <script src="<?php echo base_url() ?>/assets/extra-libs/sweetalert2/sweet-alert.init.js"></script>

    <!-- This Page JS -->

    <script src="<?php echo base_url() ?>/assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/js/pages/datatable/custom-datatable.js"></script>
    <!-- <script src="<?php echo base_url() ?>/assets/dist/js/pages/datatable/datatable-basic.init.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script> -->

    <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script> -->
    <script type="text/javascript" charset="utf8" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/js/dataTables.checkboxes.min.js"></script>

    <script>
        //Dataset para crear la tabla
        var dataSet = []
        <?php foreach($resultado_busqueda as $rb) { ?>
            // var tipo_encuesta;
            // switch('<?= $rb->tipo ?>'){
            //     case 'TLI':
            //         tipo_encuesta = "Banco de Preguntas para Evaluaciones";
            //         break;
            //     case 'EDO':
            //         tipo_encuesta = "Encuesta de Observación";
            //         break;
            //     case 'EPO':
            //         tipo_encuesta = "Encuesta de Observación (a y b con Porcentaje)";
            //         break;
            //     case 'EVD':
            //         tipo_encuesta = "Encuesta de Observación (Evaluación Docente)";
            //         break;
            //     default:
            //         tipo_encuesta = "";
            // }
            
            dataSet.push(['<?= $rb->oid ?>', '<?= $rb->titulo ?>', '<?= $rb->tipo ?>', 
                        '<?= $rb->oid_grupo == '0' ? 'Todas' : $rb->nombre ?>',
                        '<?= ($rb->estado==1)?'<span class="badge py-1 badge-danger">Inactivo</span>':'<span class="badge py-1 badge-success text-white">Activo</span>' ?>',
                        // '<a href="<?php echo site_url('encuesta/editar/'.$rb->oid); ?>" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm" aria-label=""">Editar</a>']);
                        '<button onclick="cambiarVigencia('+'<?= $rb->oid.','.$rb->estado ?>'+')" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm" aria-label=""">Vigencia</button>']);
        <?php } ?>
        
        $(document).ready(function() {
            var table = $('#tabla_encuesta').DataTable({
                data: dataSet,
                // columnDefs: [
                //     {
                //         'targets': 0,
                //         'checkboxes': {
                //             'selectRow': true,
                //         }
                //     }
                // ],
                select: {
                    style: 'multi'
                },
                order: [[2, 'asc']],
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
        function cambiarVigencia(oid, estado){
            var url = "<?php echo base_url('public/encuesta/cambiar_vigencia/'); ?>";
            // console.log(url, oid, estado);
            $.post(url, {oid:oid,estado:estado}, function(data, status){
                if (status){
                    window.location = "<?php echo base_url('public/encuesta/administrar_encuestas/'); ?>";
                }else{
                    console.log("ERROR");
                }
            });
        }
    </script>
</body>

</html>