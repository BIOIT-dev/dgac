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
            <?php //echo view('dgac/breadcrum'); ?>
            <!-- <h3>Postulación Carreras</h3> -->
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
                    <div class="col-12">
                        <div class="card">
                            <form action="<?php echo base_url('public/Postulaciones/crear_usuario/'); ?>" onsubmit="loadFunction()" name="crear_usuario" id="crear_usuario" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="card-body">
                                    <h3 class="card-title">Datos Personales</h3>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6" hidden>
                                            <div class="form-group row">
                                                <label for="rut" class="col-sm-3 text-right control-label col-form-label">RUT<code>*</code></label>
                                                <div class="col-sm-9">
                                                    <input id="rut" name="rut" type="text" oninput="checkRut(this)" maxlength="10" class="form-control form-control-line" value="<?= $rut_usuario ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6" hidden>
                                            <div class="form-group row">
                                                <label for="grupo_id" class="col-sm-3 text-right control-label col-form-label">Grupo ID</label>
                                                <div class="col-sm-9">
                                                    <input id="grupo_id" name="grupo_id" type="text" class="form-control form-control-line" value="<?= $grupo_id ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="rut2" class="col-sm-3 text-right control-label col-form-label">RUT<code>*</code></label>
                                                <div class="col-sm-9">
                                                    <input id="rut2" name="rut2" type="text" oninput="checkRut(this)" maxlength="10" placeholder="Ej: 12345678-9" class="form-control form-control-line" value="<?= $rut_usuario ?>" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="periodo_vista" class="col-sm-3 text-right control-label col-form-label">Nombres<code>*</code></label>
                                                <div class="col-sm-9">
                                                <input name="nombres" type="text" placeholder="" class="form-control form-control-line" value="" onkeypress="return check(event)" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="periodo_vista" class="col-sm-3 text-right control-label col-form-label">A. Paterno<code>*</code></label>
                                                <div class="col-sm-9">
                                                    <input name="apellido_paterno" type="text" placeholder="Apellido Paterno" class="form-control form-control-line" value="" onkeypress="return check(event)" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="periodo_vista" class="col-sm-3 text-right control-label col-form-label">A. Materno<code>*</code></label>
                                                <div class="col-sm-9">
                                                    <input name="apellido_materno" type="text" placeholder="Apellido Materno" class="form-control form-control-line" value="" onkeypress="return check(event)" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="peri_semestre" class="col-sm-3 text-right control-label col-form-label">Sexo</label>
                                                <div class="col-sm-9">
                                                    <select name="sexo" id="sexo" class="form-control">
                                                        <option value="">--- Seleccionar ---</option>
                                                        <option value="m">Masculino</option>
                                                        <option value="f">Femenino</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="fecnac" class="col-sm-3 text-right control-label col-form-label">Fecha de Nacimiento<code>*</code></label>
                                                <div class="col-sm-9">
                                                    <input name="fecnac" type="date" placeholder="" class="form-control form-control-line" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="ciudad" class="col-sm-3 text-right control-label col-form-label">Región</label>
                                                <div class="col-sm-9">
                                                    <select name="ciudad" id="ciudad" class="form-control" onchange="cargarComunas()">
                                                        <option value="">--- Seleccionar ---</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="comuna" class="col-sm-3 text-right control-label col-form-label">Comuna</label>
                                                <div class="col-sm-9">
                                                    <select name="comuna" id="comuna" class="form-control">
                                                        <option value="">--- Seleccionar ---</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="peri_semestre" class="col-sm-3 text-right control-label col-form-label">Dirección<code>*</code></label>
                                                <div class="col-sm-9">
                                                    <input name="direccion" type="text" placeholder="" class="form-control form-control-line" onkeypress="return check(event)" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="periodo_vista" class="col-sm-3 text-right control-label col-form-label">Teléfono<code>*</code></label>
                                                <div class="col-sm-9">
                                                    <input name="fono" type="text" placeholder="" class="form-control form-control-line" onkeypress="return check(event)" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="peri_semestre" class="col-sm-3 text-right control-label col-form-label">Email<code>*</code></label>
                                                <div class="col-sm-9">
                                                    <input name="email" type="email" placeholder="" class="form-control form-control-line" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="oid_sedes" class="col-sm-3 text-right control-label col-form-label">Sede de rendición<code>*</code></label>
                                                <div class="col-sm-9">
                                                    <select name="oid_sedes" id="oid_sedes" class="form-control" required>
                                                        <option value="">--- Seleccionar ---</option>
                                                        <?php foreach($sedes_rendicion as $sr){?>
                                                            <option value="<?=$sr->oid?>"><?= $sr->sede_nombre ?></option>
                                                        <?php } ?>
                                                    </select>
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
                        <div id="centermodal" class="swal2-container swal2-center swal2-fade swal2-shown" style="overflow-y: auto; display: none;">
                            <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
                                <div class="swal2-header">
                                    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Enviando datos</h2>
                                    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Espera un momento...</h2>
                                    <div class="spinner-border text-success" style="width: 3rem; height: 3rem;" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <!-- Regiones/Comunas -->
    <script src="<?php echo base_url() ?>/assets/dist/regiones-comunas.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/regiones-comunas.js"></script>
    <script>
        window.onload = function(){
            var regionesJSON = regiones['regiones'];
            var datos = "<option value='null'>--- Seleccionar ---</option>";
            for(var i = 0; i < regionesJSON.length; i++){
                datos += "<option value='"+regionesJSON[i]['region']+"'>"+regionesJSON[i]['region']+"</option>";
            }
            $("#ciudad").html(datos);
        }

        function cargarComunas(){
            let regionesJSON = regiones['regiones'];
            let reg = document.getElementById('ciudad').value;
            let comunaJSON;
            for(var i = 0; i < regionesJSON.length; i++){
                if(regionesJSON[i]['region'] == reg){
                    comunaJSON = regionesJSON[i]['comunas'];
                }
            }
            var datos = "<option value='null'>--- Seleccionar ---</option>";
            for(var i = 0; i < comunaJSON.length; i++){
                datos += "<option value='"+comunaJSON[i]+"'>"+comunaJSON[i]+"</option>";
            }
            $("#comuna").html(datos);
        }
    </script>
    <script>
        function loadFunction(){
            document.querySelector("#centermodal").style.display = "flex";
        }
    </script>

</body>

</html>