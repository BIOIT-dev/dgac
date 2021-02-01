<?php echo $headers['headersView']; ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

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
                            <!-- <hr> -->
                            <form action="<?php echo base_url('public/encuestas/add_encuesta'); ?>" name="add_encuesta" id="add_encuesta" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="card-body">
                                    <h4 class="card-title">Agregar Encuesta de Observación</h4>
                                    <div class="form-group row">
                                        <label for="titulo" class="col-md-2 col-form-label">Titulo</label>
                                        <div class="col-sm-10">
                                            <input name="titulo" type="text" class="form-control" id="titulo" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="oid_test" class="col-md-2 col-form-label">Encuesta</label>
                                        <div class="col-md-10">
                                            <select name="oid_test" id="oid_test" class="form-control" required>
                                                <option value="">-- Seleccione Encuesta --</option>
                                                <?php foreach($r_encuestas as $ra) { ?>
                                                    <?php 
                                                        if( !$ra->cnt ) continue;
                                                        if( $ra->tipo=="EDO" ) $tipo = "Obser.";
                                                        elseif( $ra->tipo=="EVD" ) $tipo = "EvalDoc";
                                                        else $tipo = "a y b %";
                                                    ?>
                                                    <option value="<?php echo $ra->oid ?>" id="oid_test<?php echo $ra->oid ?>"><?php echo '['.$tipo.'] '.$ra->titulo ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="porcentaje" class="col-md-2 col-form-label">Porcentaje Rendimiento</label>
                                        <div class="col-md-2">
                                            <input name="porcentaje" type="number" min="0" max="100" class="form-control" id="porcentaje" value="70">
                                        </div>
                                        <label for="porcentaje" class="col-md-8 col-form-label">% (Sólo será utilizado en encuesta del tipo a/b con Porcentaje)</label>
                                    </div>
                                    <div class="form-group row">
                                        <label for="disponible" class="col-md-2 col-form-label">Estado</label>
                                        <div class="col-md-10">
                                            <select name="disponible" id="disponible" class="form-control">
                                                <option value="1" selected='selected'>Disponible</option>
                                                <option value="0">No Disponible</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="f_desde" class="col-sm-3 col-form-label">Fecha Inicio</label>
                                                <div class="col-sm-9">
                                                    <input name="f_desde" type="date" min="<?= date('Y-m-d') ?>" max="" class="form-control" id="f_desde" placeholder="" onchange="validarFecha('inicio')" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="f_hasta" class="col-sm-3 col-form-label">Fecha Término</label>
                                                <div class="col-sm-9">
                                                    <input name="f_hasta" type="date" min="" max="" class="form-control" id="f_hasta" placeholder="" onchange="validarFecha('termino')" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="agno" class="col-md-2 col-form-label">Año</label>
                                        <div class="col-md-10">
                                            <select name="agno" id="agno" class="form-control">
                                                <?php for($i = date("Y"); $i >= "1950"; $i--){ ?>
                                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="semestre" class="col-md-2 col-form-label">Semestre de Aplicación</label>
                                        <div class="col-md-10">
                                            <select name="semestre" id="semestre" class="form-control" required>
                                                <option value="">-- Selecciona Semestre --</option>
                                                <option value="1">Primer Semestre</option>
                                                <option value="2">Segundo Semestre</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="oid_curso" class="col-md-2 col-form-label">Asignatura</label>
                                        <div class="col-md-10">
                                            <select name="oid_curso" id="oid_curso" class="form-control" onchange="cargarProfesores()" required>
                                                <option value="" selected='selected'>-- Seleccionar --</option>
                                                <?php foreach($r_asignaturas as $ra) { ?>
                                                    <option value="<?php echo $ra->oid ?>" id="oid_curso<?php echo $ra->oid ?>"><?php echo $ra->titulo ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="oid_profesor" class="col-md-2 col-form-label">Profesor</label>
                                        <div class="col-md-10">
                                            <select name="oid_profesor" id="oid_profesor" class="form-control">
                                                <option value="null" selected='selected'>-- Seleccionar --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Mostrar en la Home</label>
                                        <div class="col-md-10">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input name="zona_home" value="" class="with-gap material-inputs" type="radio" checked/>
                                                    <label for="radio_1">No mostrar</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input name="zona_home" value="LNK" class="with-gap material-inputs" type="radio"/>
                                                    <label for="radio_2">En la Zona de Links</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <div class="form-group mb-0 text-right">
                                        <button type="submit" class="btn btn-info waves-effect waves-light">Guardar</button>
                                    </div>
                                </div>
                            </form>
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
    <script type="text/javascript" charset="utf8" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/js/dataTables.checkboxes.min.js"></script>

    <script>
        function validarFecha(fecha){
            if (fecha == "termino"){
                document.getElementById("f_desde").max = document.getElementById("f_hasta").value;
            }else if(fecha == "inicio"){
                document.getElementById("f_hasta").min = document.getElementById("f_desde").value;
            }else{
                console.log("ERROR");
            }
        }

        function cargarProfesores(){
            let reg = document.getElementById('oid_curso').value;
            var checked = {oid_curso:reg};
            var url = "<?php echo base_url('public/encuestas/getProfesores'); ?>";
            $.post(url, checked, function(data, status){
                if (status){
                    $("#oid_profesor").html(data);
                }else{
                    console.log("ERROR");
                }
            });
        }
    </script>
</body>
</html>