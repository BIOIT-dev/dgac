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
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <!-- Tabs -->
                            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-abierto-tab" data-toggle="pill" href="#abierto-tab-table" role="tab" aria-controls="pills-profile" aria-selected="false">Abierto</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-gestion-tab" data-toggle="pill" href="#gestion-tab-table" role="tab" aria-controls="pills-setting" aria-selected="false">En Gestión</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-inactivo-tab" data-toggle="pill" href="#inactivo-tab-table" role="tab" aria-controls="pills-setting" aria-selected="false">Inactivos</a>
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
                                                                    onclick="location.href='<?php echo site_url('progPresencial/agregar_profesor/'.$profile_data_edit['oid']); ?>'">Agregar Profesor</button> -->
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Periodo</th>
                                                        <th scope="col">Año</th>
                                                        <th scope="col">Semestre</th>
                                                        <th scope="col">Carreras</th>
                                                        <th scope="col">Inicio</th>
                                                        <th scope="col">Término</th>
                                                        <th scope="col">Activo</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Periodo</th>
                                                        <th scope="col">Año</th>
                                                        <th scope="col">Semestre</th>
                                                        <th scope="col">Carreras</th>
                                                        <th scope="col">Inicio</th>
                                                        <th scope="col">Término</th>
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
                                                                    onclick="location.href='<?php echo site_url('progPresencial/agregar_asignatura/'.$profile_data_edit['oid']); ?>'">Agregar Asignatura</button> -->
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Periodo</th>
                                                        <th scope="col">Año</th>
                                                        <th scope="col">Semestre</th>
                                                        <th scope="col">Carreras</th>
                                                        <th scope="col">Inicio</th>
                                                        <th scope="col">Término</th>
                                                        <th scope="col">Activo</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Periodo</th>
                                                        <th scope="col">Año</th>
                                                        <th scope="col">Semestre</th>
                                                        <th scope="col">Carreras</th>
                                                        <th scope="col">Inicio</th>
                                                        <th scope="col">Término</th>
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
                                                                    onclick="location.href='<?php echo site_url('admisionCarrera/agregar_examen/'.$profile_data_edit['oid']); ?>'">Agregar Exámen</button> -->
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Periodo</th>
                                                        <th scope="col">Año</th>
                                                        <th scope="col">Semestre</th>
                                                        <th scope="col">Carreras</th>
                                                        <th scope="col">Inicio</th>
                                                        <th scope="col">Término</th>
                                                        <th scope="col">Activo</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Periodo</th>
                                                        <th scope="col">Año</th>
                                                        <th scope="col">Semestre</th>
                                                        <th scope="col">Carreras</th>
                                                        <th scope="col">Inicio</th>
                                                        <th scope="col">Término</th>
                                                        <th scope="col">Activo</th>
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
                                                <button id="botonEliminar" onclick="botonEliminar('tabla_periodos_abierto')" type="button" class="swal2-confirm swal2-styled" aria-label="">Eliminar</button>
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
        var dataPeriodosAbierto = []
        var dataPeriodosGestion = []
        var dataPeriodosInactivo = []
        <?php foreach($r_periodos as $rp) { ?>
            if('<?= $rp->peri_activo ?>' == '1'){
                dataPeriodosAbierto.push(['<?= $rp->oid ?>', '<?= $rp->peri_nombre ?>','<?= $rp->peri_anio ?>','<?= $rp->peri_semestre ?>','<?= $rp->peri_carreras_postular ?>','<?= $rp->peri_inicio ?>','<?= $rp->peri_termino ?>',    
                        '<?= ($rp->peri_activo==0)?'<span class="badge py-1 badge-danger">Inactivo</span>':'<span class="badge py-1 badge-success text-white">Activo</span>' ?>',
                        '<a href="<?php echo site_url('gestionPostulantes/carreras_periodo/'.$rp->oid); ?>" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm" aria-label=""">Ver más</a>']);
            }else if('<?= $rp->peri_activo ?>' == '2'){
                dataPeriodosGestion.push(['<?= $rp->oid ?>', '<?= $rp->peri_nombre ?>','<?= $rp->peri_anio ?>','<?= $rp->peri_semestre ?>','<?= $rp->peri_carreras_postular ?>','<?= $rp->peri_inicio ?>','<?= $rp->peri_termino ?>',    
                        '<?= ($rp->peri_activo==0)?'<span class="badge py-1 badge-danger">Inactivo</span>':'<span class="badge py-1 badge-success text-white">Activo</span>' ?>',
                        '<a href="<?php echo site_url('gestionPostulantes/carreras_periodo/'.$rp->oid); ?>" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm" aria-label=""">Ver más</a>']);
            }else if('<?= $rp->peri_activo ?>' == '0'){
                dataPeriodosInactivo.push(['<?= $rp->oid ?>', '<?= $rp->peri_nombre ?>','<?= $rp->peri_anio ?>','<?= $rp->peri_semestre ?>','<?= $rp->peri_carreras_postular ?>','<?= $rp->peri_inicio ?>','<?= $rp->peri_termino ?>',    
                        '<?= ($rp->peri_activo==0)?'<span class="badge py-1 badge-danger">Inactivo</span>':'<span class="badge py-1 badge-success text-white">Activo</span>' ?>',
                        '<a href="<?php echo site_url('gestionPostulantes/carreras_periodo/'.$rp->oid); ?>" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm" aria-label=""">Ver más</a>']);
            }
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
        function modalSwal(tabla){
            cant_usuarios_checked = $('#'+tabla).DataTable().column(0).checkboxes.selected().length;
            if(tabla=="tabla_periodos_abierto") var index = "profesor"+(cant_usuarios_checked>1?'es':'');
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
            if(tabla=="tabla_periodos_abierto"){
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