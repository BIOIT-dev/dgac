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
                            <div class="" >
                                <div class="" id="" role="" aria-labelledby="">
                                    <div class="card-body">
                                        <form action="<?php echo base_url('public/progPresencial/editar_alumno/'.$oid_grupo.'/'.$oid_usuario); ?>" name="editar_alumno" id="editar_alumno" method="post" accept-charset="utf-8" class="form-horizontal">
                                            <div class="card-body">
                                                <h4 class="card-title"><?php echo $headers['ubicacion'] ?></h4>
                                                <div class="row">
                                                    <div class="col-sm-12 col-lg-6" hidden>
                                                        <div class="form-group row">
                                                            <label for="oid_grupo" class="col-sm-3 text-right control-label col-form-label">ID Grupo</label>
                                                            <div class="col-sm-9">
                                                                <input value="<?php echo $oid_grupo ?>" name="oid_grupo" type="text" class="form-control" id="oid_grupo" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-lg-6" hidden>
                                                        <div class="form-group row">
                                                            <label for="oid_usuario" class="col-sm-3 text-right control-label col-form-label">ID Usuario</label>
                                                            <div class="col-sm-9">
                                                                <input value="<?php echo $oid_usuario ?>" name="oid_usuario" type="text" class="form-control" id="oid_usuario" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-lg-6">
                                                        <div class="form-group row">
                                                            <label for="oid_esal" class="col-sm-3 text-right control-label col-form-label">Estado</label>
                                                            <div class="col-sm-9">
                                                                <select name="oid_esal" id="oid_esal" class="form-control" required>
                                                                    <option selected='selected'></option>
                                                                    <?php foreach($r_estadosalumnos as $esal) { ?>
                                                                        <option value="<?php echo $esal->oid ?>" id="oid_esal<?php echo $esal->oid ?>"><?php echo $esal->esal_nombre ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-lg-6">
                                                        <div class="form-group row">
                                                            <label for="oid_semestre" class="col-sm-3 text-right control-label col-form-label">Semestres</label>
                                                            <div class="col-sm-9">
                                                                <select name="oid_semestre" id="oid_semestre" class="form-control">
                                                                    <option value="0" selected='selected'>----</option>
                                                                    <?php foreach($r_semestres as $rs) { ?>
                                                                        <option value="<?php echo $rs->oid ?>" id="oid_semestre<?php echo $rs->oid ?>"><?php echo $rs->nombre ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 col-lg-6">
                                                        <div class="form-group row">
                                                            <label for="hial_anio" class="col-sm-3 text-right control-label col-form-label">Año</label>
                                                            <div class="col-sm-9">
                                                                <select name="hial_anio" id="hial_anio" class="form-control">
                                                                    <?php for($i = date("Y") - 10; $i <= date("Y") + 2; $i++){ ?>
                                                                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-lg-6">
                                                        <div class="form-group row">
                                                            <label for="nuevo" class="col-sm-3 text-right control-label col-form-label">Nuevo</label>
                                                            <div class="col-sm-9">
                                                                <select name="nuevo" id="nuevo" class="form-control">
                                                                    <option value="1">Sí</option>
                                                                    <option value="0">No</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <hr>
                                            <div class="card-body">
                                                <div class="form-group mb-0 text-right">
                                                    <button type="submit" class="btn btn-info waves-effect waves-light">Aceptar</button>
                                                    <button onclick="window.location.href='<?php echo site_url('progPresencial/editar/'.$oid_grupo); ?>'" class="btn btn-dark waves-effect waves-light">Cancelar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <!-- Tabs -->
                            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-profesores-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-profile" aria-selected="false">Historial</a>
                                </li>
                            </ul>
                            <!-- Tabs -->
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="card-body">
                                        <!-- Start table -->
                                        <div class="table-responsive">
                                            <table name="tabla_historial" id="tabla_historial" class="table table-striped table-bordered display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Estado</th>
                                                        <th scope="col">Semestre</th>
                                                        <th scope="col">Año</th>
                                                        <th scope="col">Fecha</th>
                                                        <th scope="col">Activo</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">Estado</th>
                                                        <th scope="col">Semestre</th>
                                                        <th scope="col">Año</th>
                                                        <th scope="col">Fecha</th>
                                                        <th scope="col">Activo</th>
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
        var data = []
        <?php foreach($r_alumno as $ra) { ?>
            data.push(['<?= $ra->esal_nombre ?>','<?= $ra->nombre ?>','<?= $ra->hial_anio ?>','<?= $ra->hial_fecha ?>',
            '<?= ($ra->hi_activo==0)?'<span class="badge py-1 badge-danger">Inactivo</span>':'<span class="badge py-1 badge-success text-white">Activo</span>' ?>']);
        <?php } ?>
        
        $(document).ready(function() {
            var table = $('#tabla_historial').DataTable({
                data: data,
                select: {
                    style: 'multi'
                },
                order: [[3, 'desc']],
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
</body>

</html>