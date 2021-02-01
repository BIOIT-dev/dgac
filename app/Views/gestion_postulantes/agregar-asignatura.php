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
                            <form action="<?php echo base_url('public/progPresencial/agregar_asignatura/'.$oid_grupo); ?>" name="agregar_asignatura" id="agregar_asignatura" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="card-body">
                                    <h4 class="card-title">Crear Asignatura</h4>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6" hidden>
                                            <div class="form-group row">
                                                <label for="oid_grupo" class="col-sm-3 text-right control-label col-form-label">ID Grupo</label>
                                                <div class="col-sm-9">
                                                    <input value="<?php echo $oid_grupo ?>" name="oid_grupo" type="text" class="form-control" id="oid_grupo" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="titulo" class="col-sm-3 text-right control-label col-form-label">Titulo *</label>
                                                <div class="col-sm-9">
                                                    <input name="titulo" type="text" class="form-control" id="titulo" placeholder="Campo Requerido*" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="curs_horas" class="col-sm-3 text-right control-label col-form-label">Horas *</label>
                                                <div class="col-sm-9">
                                                    <?php $total_horas_actuales = 0 ?>
                                                    <?php foreach($r_cursos as $rcurso) { ?>
                                                        <?php $total_horas_actuales = $total_horas_actuales + $rcurso->curs_horas ?>
                                                    <?php } ?>
                                                    <input name="curs_horas" min="0" max="<?php echo (intval($r_duraciongrupo[0]->horas) - intval($total_horas_actuales)) ?>" type="number" class="form-control" id="curs_horas" placeholder="Máximo Posible <?php echo (intval($r_duraciongrupo[0]->horas) - intval($total_horas_actuales)) ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="uname1" class="col-sm-3 text-right control-label col-form-label">Asignatura</label>
                                                <div class="col-sm-9">
                                                    <select id="asignatura" class="form-control" onchange="copiarValue()">
                                                        <option value="0" selected='selected'>Sin Asignaturas</option>
                                                        <?php foreach($r_asignaturas as $ra) { ?>
                                                            <option value="<?php echo $ra->oid ?>" id="asignatura<?php echo $ra->oid ?>"><?php echo $ra->asignatura ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="escala" class="col-sm-3 text-right control-label col-form-label">Escala</label>
                                                <div class="col-sm-9">
                                                    <select name="escala" id="escala" class="form-control">
                                                        <option value="0" selected='selected'>1.0 - 7.0</option>
                                                        <option value="1">0% - 100%</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="anual" class="col-sm-3 text-right control-label col-form-label">Duración</label>
                                                <div class="col-sm-9">
                                                    <select name="anual" id="anual" class="form-control">
                                                        <option value="0" selected='selected'>Semestral</option>
                                                        <option value="1">Anual</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="formacion" class="col-sm-3 text-right control-label col-form-label">Formación</label>
                                                <div class="col-sm-9">
                                                    <select name="formacion" id="formacion" class="form-control">
                                                        <option value="0" selected='selected'>Presencial</option>
                                                        <option value="1">E-Learning</option>
                                                        <option value="2">B-Learning</option>
                                                        <option value="3">R-Learning</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="semestre" class="col-sm-3 text-right control-label col-form-label">Semestre Inicio</label>
                                                <div class="col-sm-9">
                                                    <select name="semestre" id="semestre" class="form-control">
                                                        <?php for($i = 1; $i <= $r_duraciongrupo[0]->duracion; $i++){ ?>
                                                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="horas_costo" class="col-sm-3 text-right control-label col-form-label">Horas Costo</label>
                                                <div class="col-sm-9">
                                                    <input name="horas_costo" type="number" min="0" class="form-control" id="horas_costo" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="curs_coeficiente" class="col-sm-3 text-right control-label col-form-label">Coeficiente</label>
                                                <div class="col-sm-9">
                                                    <input name="curs_coeficiente" type="number" class="form-control" id="curs_coeficiente" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="inactivo" class="col-sm-3 text-right control-label col-form-label">Estado</label>
                                                <div class="col-sm-9">
                                                    <select name="inactivo" id="inactivo" class="form-control">
                                                        <option value="0" selected='selected'>Activo</option>
                                                        <option value="1">Inactivo</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="Anio" class="col-sm-3 text-right control-label col-form-label">Año</label>
                                                <div class="col-sm-9">
                                                    <select name="Anio" id="Anio" class="form-control">
                                                        <?php for($i = date("Y") - 1; $i <= date("Y") + 2; $i++){ ?>
                                                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="pac" class="col-sm-3 text-right control-label col-form-label">¿PAC?</label>
                                                <div class="col-sm-9">
                                                    <select name="pac" id="pac" class="form-control">
                                                        <option value="0">No</option>
                                                        <option value="1" selected='selected'>Si</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="finicio" class="col-sm-3 text-right control-label col-form-label">Fecha Inicio</label>
                                                <div class="col-sm-9">
                                                    <input name="finicio" type="date" min="" max="" class="form-control" id="finicio" placeholder="" onchange="validarFecha('inicio')">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="ftermino" class="col-sm-3 text-right control-label col-form-label">Fecha Término</label>
                                                <div class="col-sm-9">
                                                    <input name="ftermino" type="date" min="" max="" class="form-control" id="ftermino" placeholder="" onchange="validarFecha('termino')">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $i = 0 ?>
                                    <?php while($i < 10){ ?>
                                        <div class="row">
                                            <div class="col-sm-12 col-lg-6">
                                                <div class="form-group row">
                                                    <label for="oid_profesor<?= $i==0?'':$i+1 ?>" class="col-sm-3 text-right control-label col-form-label">Profesor <?= $i+1 ?></label>
                                                    <div class="col-sm-9">
                                                        <select name="oid_profesor<?= $i==0?'':$i+1 ?>" id="oid_profesor<?= $i==0?'':$i+1 ?>" class="form-control">
                                                            <option value="0" selected='selected'>Sin Profesores</option>
                                                            <?php foreach($r_profesores as $rp) { ?>
                                                                <option value="<?php echo $rp->oid ?>"><?php echo $rp->nombres." ".$rp->apellidos ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-6">
                                                <div class="form-group row">
                                                    <label for="oid_profesor<?= $i+2 ?>" class="col-sm-3 text-right control-label col-form-label">Profesor <?= $i+2 ?></label>
                                                    <div class="col-sm-9">
                                                        <select name="oid_profesor<?= $i+2 ?>" id="oid_profesor<?= $i+2 ?>" class="form-control">
                                                            <option value="0" selected='selected'>Sin Profesores</option>
                                                            <?php foreach($r_profesores as $rp) { ?>
                                                                <option value="<?php echo $rp->oid ?>"><?php echo $rp->nombres." ".$rp->apellidos ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $i = $i+2 ?>
                                    <?php } ?>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="descripcion" class="col-sm-3 text-right control-label col-form-label">Descripción</label>
                                                <div class="col-sm-9">
                                                    <textarea name="descripcion" id="descripcion" class="form-control" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="instrucciones" class="col-sm-3 text-right control-label col-form-label">Instrucciones</label>
                                                <div class="col-sm-9">
                                                    <textarea name="instrucciones" id="instrucciones" class="form-control" rows="3"></textarea>
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
        <?php foreach($r_profesores as $rp) { ?>
            dataSet.push(['<?= $rp->oid ?>', '<?= $rp->oid ?>','<?= $rp->rut ?>','<?= $rp->nombres ?>','<?= $rp->apellido_paterno ?>','<?= $rp->apellido_materno ?>',    
                        '<?= ($rp->inactivo==1)?'<span class="badge py-1 badge-danger">Inactivo</span>':'<span class="badge py-1 badge-success text-white">Activo</span>' ?>',
                        '<a href="<?php echo site_url('progPresencial/editar/'.$rp->oid); ?>" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm" aria-label=""">Editar</a>']);
        <?php } ?>
        
        $(document).ready(function() {
            var table = $('#tabla_profesores').DataTable({
                data: dataSet,
                columnDefs: [
                    {
                        'targets': 0,
                        'checkboxes': {
                            'selectRow': true,
                        }
                    }
                ],
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

        // Se envían todos los id de usuarios a ser eliminados
        function checkboxTest(){
            var checked = [];
            var list_checked = $('#tabla_profesores').DataTable().column(0).checkboxes.selected();
            for (var i = 0; i < list_checked.length; i++){
                checked.push(list_checked[i]);
            }
            console.log(checked);


            
        }
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

        function botonAgregar(){
            var checked = {};
            var list_checked = $('#tabla_profesores').DataTable().column(0).checkboxes.selected();
            for (var i = 0; i < list_checked.length; i++){
                // checked.push(list_checked[i]);
                checked[i] = list_checked[i];
            }
            // console.log(checked); //
            // window.location = '<?php //echo base_url('public/Usuario/eliminar_usuario/'); ?>'+'/'+checked;
            var url = "<?php echo base_url('public/progPresencial/agregar_profesor/'.$oid_grupo); ?>";
            console.log(url);
            $.post(url, checked, function(data, status){
                // console.log("CARGANDO!", data, status);
                if (status){
                    window.location = "<?php echo base_url('public/progPresencial/editar/'.$oid_grupo); ?>";
                    // document.querySelector("#modalDelete").style.display = "none";
                    // document.querySelector("#modalSuccess").style.display = "block";
                    //console.log("BIEN");//
                }else{
                    console.log("ERROR");
                }
            });
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