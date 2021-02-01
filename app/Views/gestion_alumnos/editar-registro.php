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
                            <form action="<?php echo base_url('public/gestionAlumnos/editar_registro/'.$usuario_id.'/'.$grupo_id); ?>" name="editar_registro" id="editar_registro" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="card-body">
                                    <h4 class="card-title">Datos Personales</h4>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6" hidden>
                                            <div class="form-group row">
                                                <label for="oid_usuario" class="col-sm-3 text-right control-label col-form-label">oid_usuario</label>
                                                <div class="col-sm-9">
                                                    <input value="<?php echo $usuario_id ?>" name="oid_usuario" type="text" class="form-control" id="oid_usuario" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6" hidden>
                                            <div class="form-group row">
                                                <label for="oid_grupo" class="col-sm-3 text-right control-label col-form-label">oid_grupo</label>
                                                <div class="col-sm-9">
                                                    <input value="<?php echo $grupo_id ?>" name="oid_grupo" type="text" class="form-control" id="oid_grupo" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="oid_esal" class="col-sm-3 text-right control-label col-form-label">Estado</label>
                                                <div class="col-sm-9">
                                                    <select name="oid_esal" id="oid_esal" class="form-control">
                                                        <option value="0" selected='selected'>--</option>
                                                        <?php foreach($estados_alumno as $ra) { ?>
                                                            <option value="<?php echo $ra->oid ?>" id="estado<?php echo $ra->oid ?>"><?php echo $ra->esal_nombre ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="oid_semestre" class="col-sm-3 text-right control-label col-form-label">Semestre</label>
                                                <div class="col-sm-9">
                                                    <select name="oid_semestre" id="oid_semestre" class="form-control">
                                                        <option value="0" selected='selected'>--</option>
                                                        <?php foreach($r_semestres as $ra) { ?>
                                                            <option value="<?php echo $ra->oid ?>" id="semestre<?php echo $ra->oid ?>"><?php echo $ra->nombre ?></option>
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
                                                        <option value="0">No</option>
                                                        <option value="1" selected='selected'>Si</option>
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
                                    <table name="tabla_carreras" id="tabla_carreras" class="table table-striped table-bordered display" style="width:100%">
                                        <!-- <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm m-1 ml-0"
                                                            onclick='modalSwal()'>Agregar Profesores</button> -->
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Estado</th>
                                                <th scope="col">Semestre</th>
                                                <th scope="col">Año</th>
                                                <th scope="col">Fecha</th>
                                                <th scope="col">Activo</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Estado</th>
                                                <th scope="col">Semestre</th>
                                                <th scope="col">Año</th>
                                                <th scope="col">Fecha</th>
                                                <th scope="col">Activo</th>
                                            </tr>
                                        </tfoot>
                                    </table>
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
    <!-- <script src="<?php echo base_url() ?>/assets/dist/js/pages/datatable/datatable-basic.init.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script> -->

    <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script> -->
    <script type="text/javascript" charset="utf8" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/js/dataTables.checkboxes.min.js"></script>

    <!-- This Page JS -->
    <!-- <script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/bootstrap-table/dist/bootstrap-table.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/bootstrap-table/dist/bootstrap-table-locale-all.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/bootstrap-table/dist/extensions/export/bootstrap-table-export.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/js/pages/tables/bootstrap-table.init.js"></script> -->
    <script>
        //Dataset para crear la tabla
        var dataSet = []
        <?php foreach($info_historial as $rp) { ?>
            dataSet.push(['<?= $rp->oid_ha ?>', '<?= $rp->esal_nombre ?>','<?= $rp->nombre ?>','<?= $rp->hial_anio ?>','<?= $rp->hial_fecha ?>',
                        '<?= ($rp->activo==1)?'<span class="badge py-1 badge-danger">Inactivo</span>':'<span class="badge py-1 badge-success text-white">Activo</span>' ?>',
                        // '<div class="btn-group-sm">'+
                        //     '<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acción</button>'+
                        //     '<div class="dropdown-menu">'+
                        //         '<a class="dropdown-item" href="<?php echo site_url('gestionAlumnos/revisar_registro/'.$rp->oid_ha); ?>"><i class="fa fa-edit"></i> Revisar Registro</a>'+
                        //         '<a class="dropdown-item" href="<?php echo site_url('gestionAlumnos/editar_registro/'.$rp->oid_ha); ?>"><i class="fa fa-edit"></i> Editar</a>'+
                        //     '</div>'+
                        // '</div>'
                    ]);
        <?php } ?>
        
        $(document).ready(function() {
            var table = $('#tabla_carreras').DataTable({
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
                order: [[1, 'asc']],
                language: {
                    lengthMenu: "Mostrando _MENU_ datos por página",
                    zeroRecords: "No hay datos para mostrar",
                    info: "Mostrando página _PAGE_ de _PAGES_",
                    infoEmpty: "No hay datos disponibles.",
                    infoFiltered: "(filtrado de _MAX_ elementos)",
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
            cant_usuarios_checked = $('#tabla_profesores').DataTable().column(0).checkboxes.selected().length;
            //console.log(cant_usuarios_checked);//

            if (cant_usuarios_checked > 0){
                document.querySelector("#modalDelete #swal2-content").innerHTML = "¿Está seguro que quiere eliminar "+cant_usuarios_checked+" carreras? <br>¡Esta acción no se puede deshacer!";
                document.querySelector("#modalDelete").style.display = "block";
            }else{
                document.querySelector("#modalError").style.display = "block";
            }
        }

        function modalClose(){
            document.querySelector("#modalDelete").style.display = "none";
            document.querySelector("#modalError").style.display = "none";
        }


        function copiarValue(){
            var asignatura = document.getElementById("asignatura").value;
            document.getElementById("titulo").value = document.getElementById("asignatura"+asignatura).innerHTML;
        }

        function validarFecha(fecha){
            if (fecha == "termino"){
                document.getElementById("finicio").max = document.getElementById("ftermino").value;
            }else if(fecha == "inicio"){
                document.getElementById("ftermino").min = document.getElementById("finicio").value;
            }else{
                console.log("ERROR");
            }
        }
    </script>
</body>

</html>