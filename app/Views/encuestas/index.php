
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
                <? if(MostrarElemento(array('periodo/agregar_periodo'),array('ADM'))){?>
                <div class="row mb-2">
                    <div class="col-lg-3 col-md-3">
                        <?php //$session = session(); ?>
                        <?php //if($session->role_id == '6'){ ?>
                            <a onclick="habilitarRegistros()" class="btn btn-success waves-effect waves-light text-white">
                                <?php echo ($estado_habilitar != "1" ? "Habilitar Edición" : "Deshabilitar Edición") ?> <i class="fa fa-edit"></i>
                            </a>
                            <!-- <button type="button" class="btn waves-effect waves-light btn-success ml-0"
                                onclick="location.href='<?php echo site_url('periodo/agregar_periodo'); ?>'"><?php echo ($estado_habilitar != "1" ? "Habilitar Edición" : "Deshabilitar Edición") ?> <i class="fa fa-edit"></i></button> -->
                        <?php //} ?>    
                    </div>
                </div>
                <?}?>
                <!-- Row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table name="tabla_examen" id="tabla_examen" class="table table-striped table-bordered display" style="width:100%">
                                    <?php echo ($estado_habilitar != "1" ? 
                                        "":
                                        '<button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm m-1 ml-0"'.
                                            'onclick="modalSwal()">Eliminar <i class="fa fa-trash-alt"></i></button>'.
                                        '<button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm m-1 ml-0"'.
                                            'onclick="agregarEncuesta()">Agregar <i class="fa fa-plus"></i></button>') 
                                    ?>
                                        <!-- <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm m-1 ml-0"
                                                            onclick='modalSwal()'>Eliminar <i class="fa fa-trash-alt"></i></button>
                                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm m-1 ml-0"
                                                            onclick="location.href='<?php echo site_url('examen/crear'); ?>'">Agregar <i class="fa fa-plus"></i></button> -->
                                        <hr>
                                        <?= ($estado_habilitar != "1" ? 
                                            "<thead>".
                                                "<tr>".
                                                    '<th scope="col">Encuesta</th>'.
                                                    '<th scope="col">Ver</th>'.
                                                "</tr>".
                                            "</thead>".
                                            "<tfoot>".
                                                "<tr>".
                                                    '<th scope="col">Encuesta</th>'.
                                                    '<th scope="col">Ver</th>'.
                                                "</tr>".
                                            "</tfoot>" :
                                            /****************************************/ 
                                            "<thead>".
                                                "<tr>".
                                                    "<th></th>".
                                                    '<th scope="col">Encuesta</th>'.
                                                    '<th scope="col">Ver</th>'.
                                                    '<th scope="col">Acción</th>'.
                                                "</tr>".
                                            "</thead>".
                                            "<tfoot>".
                                                "<tr>".
                                                    "<th></th>".
                                                    '<th scope="col">Encuesta</th>'.
                                                    '<th scope="col">Ver</th>'.
                                                    '<th scope="col">Acción</th>'.
                                                "</tr>".
                                            "</tfoot>") 
                                        ?>
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
                                                    No hay encuestas seleccionadas para eliminar
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
                                                    ¡Encuestas eliminadas correctamente!
                                                </div>
                                                <div class="swal2-actions" style="display: flex;">
                                                    <a href="<?php echo site_url('encuestas/index'); ?>" type="button" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block; border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);">OK</a>
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
    <script type="text/javascript" charset="utf8" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/js/dataTables.checkboxes.min.js"></script>

    <script>
        //Dataset para crear la tabla
        var dataSet = []
        var estadoHabilitar = '<?php echo $estado_habilitar ?>';
        <?php foreach($resultado_busqueda as $rb) { ?>
            if(estadoHabilitar!="1"){
                <?php if($rb->disponible && $rb->respondida==0){ ?>
                    dataSet.push(['<?= $rb->titulo ?>', 
                            '<a href="<?php echo site_url('encuestas/encuestarun/'.$rb->oid); ?>" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm" aria-label=""">Ver Encuesta</a>']);
                <?php } ?>
            }else{ 
                dataSet.push(['<?= $rb->oid ?>','<?= $rb->titulo ?>', 
                        <?php if($rb->disponible && $rb->respondida==0){ ?>
                            '<a href="<?php echo site_url('encuestas/encuestarun/'.$rb->oid); ?>" type="button" class="btn waves-effect waves-light btn-rounded btn-success btn-sm" aria-label="">Ver Encuesta</a>'
                        <?php }else{ ?>
                            '<?= '<button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-secondary btn-sm" disabled>Ver Encuesta</button>' ?>'
                        <?php } ?>,
                        '<div class="btn-group-sm">'+
                            '<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acción</button>'+
                            '<div class="dropdown-menu">'+
                                '<a class="dropdown-item" href="<?php echo site_url('periodo/sedes_periodo/'.$rb->oid); ?>"><i class="fa fa-file-excel"></i> Exportar XLS</a>'+
                                '<a class="dropdown-item" href="<?php echo site_url('encuestas/editar/'.$rb->oid); ?>"><i class="fa fa-edit"></i> Editar</a>'+
                            '</div>'+
                        '</div>']);
            }
        <?php } ?>
        
        $(document).ready(function() {
            var table = $('#tabla_examen').DataTable({
                data: dataSet,
                columnDefs: [
                    (estadoHabilitar!="1" ? "":
                        {
                            'targets': 0,
                            'checkboxes': {
                                'selectRow': true,
                            }
                        }
                    )
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
            cant_usuarios_checked = $('#tabla_examen').DataTable().column(0).checkboxes.selected().length;

            if (cant_usuarios_checked > 0){
                document.querySelector("#modalDelete #swal2-content").innerHTML = "¿Está seguro que quiere eliminar "+cant_usuarios_checked+" encuestas? <br>¡Esta acción no se puede deshacer!";
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
            var list_checked = $('#tabla_examen').DataTable().column(0).checkboxes.selected();
            for (var i = 0; i < list_checked.length; i++){
                checked[i] = list_checked[i];
            }
            
            var url = "<?php echo base_url('public/encuestas/eliminar'); ?>";
            $.post(url, checked, function(data, status){
                if (status){
                    document.querySelector("#modalDelete").style.display = "none";
                    document.querySelector("#modalSuccess").style.display = "block";
                }else{
                    console.log("ERROR");
                }
            });
        }

        function habilitarRegistros(){
            <?php if($estado_habilitar != 1){ ?>
                window.location = "<?php echo base_url('public/encuestas/index/1') ?>";
            <?php }else{ ?>
                window.location = "<?php echo base_url('public/encuestas/index/0') ?>";
            <?php } ?>
        }

        function agregarEncuesta(){
            window.location = "<?php echo base_url('public/encuestas/add_encuesta') ?>";
        }
    </script>
</body>

</html>