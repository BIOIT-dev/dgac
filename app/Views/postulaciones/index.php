<?php //echo view('dgac/headers'); ?>
<?php echo $headers['headersView']; ?>

<!-- This Page CSS -->
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/libs/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css"> -->
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
        <?php //echo view('dgac/leftsidebar'); ?>
        <div id="remainingSeconds">1000</div>
        <div id="countdown">1000</div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style="padding-top: 80px;">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <?php //echo view('dgac/breadcrum'); ?>
            <h3 class="pl-3">Postulación Carreras</h3>
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
                            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                                <?php $flagActive = TRUE; ?>
                                <?php foreach($r_periodos as $periodo) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link <?php echo $flagActive ? "active": "" ?>" id="pills-<?= $periodo->oid ?>-tab" data-toggle="pill" href="#tab-table-<?= $periodo->oid ?>" role="tab" aria-controls="pills-<?= $periodo->oid ?>" aria-selected="<?php echo $flagActive ? "true": "false" ?>">Periodo <?= $periodo->peri_nombre ?></a>
                                    </li>
                                    <?php $flagActive = FALSE; ?>
                                <?php } ?>
                            </ul>
                            <!-- Tabs -->
                            <div class="tab-content" id="pills-tabContent">
                                <?php $flagActive = TRUE; ?>
                                <?php foreach($r_periodos as $periodo) { ?>
                                    <div class="tab-pane fade <?php echo $flagActive ? "show active": "" ?>" id="tab-table-<?= $periodo->oid ?>" role="tabpanel" aria-labelledby="pills-<?= $periodo->oid ?>-tab">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table name="tabla_<?= $periodo->oid ?>" id="tabla_<?= $periodo->oid ?>" class="table table-striped table-bordered display" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">ID</th>
                                                            <th scope="col">Carrera</th>
                                                            <th scope="col">Duración</th>
                                                            <th scope="col">Horas</th>
                                                            <th scope="col">Acción</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th scope="col">ID</th>
                                                            <th scope="col">Carrera</th>
                                                            <th scope="col">Duración</th>
                                                            <th scope="col">Horas</th>
                                                            <th scope="col">Acción</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $flagActive = FALSE; ?>
                                <?php } ?>
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
                                            <h2 class="swal2-title" id="swal2-title" style="display: flex;">Consultar Registro</h2>
                                            <button onclick="modalClose()" type="button" class="swal2-close" aria-label="Close this dialog">×</button>
                                        </div>
                                        <div class="swal2-content">
                                            <div id="swal2-content" style="display: block;">
                                                <!-- Mensaje contenido -->
                                            </div>
                                            <form class="pl-3 pr-3" action="<?php echo base_url('public/Postulaciones/usuario_nuevo'); ?>" name="buscar_usuario" id="buscar_usuario" method="post" accept-charset="utf-8">
                                                <div class="form-group" hidden>
                                                    <label for="grupo_id">Grupo ID</label>
                                                    <input value="acá viendo el valor de grupo" class="form-control" type="text" name="grupo_id" id="grupo_id" required="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="username">Fecha</label>
                                                    <input class="form-control" type="text" name="rut" id="rut" required="" maxlength="10" placeholder="Ej: 12345678-9">
                                                </div>
                                                <div class="swal2-actions" style="display: flex;">
                                                    <button id="botonEliminar" type="submit" class="swal2-confirm swal2-styled" aria-label="">Consultar</button>
                                                    <button onclick="modalClose()" type="button" class="swal2-cancel swal2-styled" aria-label="">Cancelar</button>
                                                </div>
                                            </form>
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
    <!-- Validaciones Usuario -->
    <script src="<?php echo base_url() ?>/assets/dist/js/validaciones-usuario.js"></script>
    <!-- <script type="text/javascript" charset="utf8" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/js/dataTables.checkboxes.min.js"></script> -->

    <script>
        var dataGrupos = []
        <?php $i = 0 ?>
        <?php foreach($r_periodos as $periodo) { ?>
            <?php for($j = 0; $j < count($r_grupos[$i]); $j++) { ?>
                dataGrupos.push([
                    '<?= $r_grupos[$i][$j]->oid ?>','<?= $r_grupos[$i][$j]->nombre ?>','<?= $r_grupos[$i][$j]->duracion ?>','<?= $r_grupos[$i][$j]->horas ?>',
                    '<button onclick="modalSwal('+"'"+'<?= $r_grupos[$i][$j]->oid ?>'+"'"+')" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm" aria-label=""">Vigencia</button>'
                    // '<a href="<?php //echo site_url('progPresencial/editar/'); ?>" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm" aria-label=""">Postular</a>'
                ]);
            <?php } ?>
            crearTablaSimple('#tabla_<?= $periodo->oid ?>', dataGrupos);
            <?php $i++ ?>
            dataGrupos = []
        <?php } ?>

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
            console.log(tabla);
            document.querySelector("#modalError #botonEliminar").onclick = function onclick(event) {botonEliminar(tabla)}
            document.querySelector("#modalError #grupo_id").value = tabla;
            document.querySelector("#modalError").style.display = "block";
        }

        function modalClose(){
            document.querySelector("#modalDelete").style.display = "none";
            document.querySelector("#modalError").style.display = "none";
        }

        function botonEliminar(tabla){
            console.log("tabla ", tabla);
            
        }
    </script>
</body>

</html>