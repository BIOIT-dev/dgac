<?php echo $headers['headersView']; ?>

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
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card">
                            <!-- Tabs -->
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
                                    <div class="card-body">
                                        <form action="<?php echo base_url('public/Usuario/crear_usuario'); ?>" name="user_create" id="user_create" method="post" accept-charset="utf-8" class="form-horizontal form-material">
                                            <div class="form-group">
                                                <small><label class="col-md-12">Autentificación</label></small>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <input checked name="inactivo" value="0" class="with-gap material-inputs" type="radio" id="radio_1" />
                                                            <label for="radio_1">En la Plataforma</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="inactivo" value="1" class="with-gap material-inputs" type="radio" id="radio_2" />
                                                            <label for="radio_2">Externa a la Plataforma</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Userid</label></small>
                                                <div class="col-md-12">
                                                    <input name="userid" type="text" placeholder="" class="form-control form-control-line" required >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Nueva Clave</label></small>
                                                <div class="col-md-12">
                                                    <input id="clave" name="clave" type="password" value="" class="form-control form-control-line" oninput="passValidation()" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Reingrese Nueva Clave</label></small>
                                                <div class="col-md-12">
                                                    <input id="clave2" type="password" value="" class="form-control form-control-line" oninput="passValidation()" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">RUT</label></small>
                                                <div class="col-md-12">
                                                    <input id="rut" name="rut" type="text" oninput="checkRut(this)" maxlength="10" placeholder="" class="form-control form-control-line" required >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Nombre</label></small>
                                                <div class="col-md-12">
                                                    <input name="nombres" type="text" placeholder="" class="form-control form-control-line" value="" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Apellido Paterno</label></small>
                                                <div class="col-md-12">
                                                    <input name="apellido_paterno" type="text" placeholder="" class="form-control form-control-line" value="" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Apellido Materno</label></small>
                                                <div class="col-md-12">
                                                    <input name="apellido_materno" type="text" placeholder="" class="form-control form-control-line" value="" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Sexo</label></small>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <input name="sexo"  class="with-gap material-inputs" type="radio" id="sexo_m" value="m" />
                                                            <label for="sexo_m">Masculino</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="sexo" class="with-gap material-inputs" type="radio" id="sexo_f" value="f" />
                                                            <label for="sexo_f">Femenino</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Fecha de Nacimiento</label></small>
                                                <div class="col-md-12">
                                                    <input name="fecnac" type="date" placeholder="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Foto Perfil</label></small>
                                                <div class="col-md-12 fileinput fileinput-new input-group" data-provides="fileinput">
                                                    <div class="form-control" data-trigger="fileinput"> <i
                                                            class="glyphicon glyphicon-file fileinput-exists"></i> <span
                                                            class="fileinput-filename"></span></div> <span
                                                        class="input-group-addon btn btn-default btn-file"> <span
                                                            class="fileinput-new">Seleccionar</span> <span
                                                            class="fileinput-exists">Cambiar</span>
                                                        <!-- Acá abajo en el input va el "name" -->
                                                        <input type="file"> </span> <a href="#"
                                                        class="input-group-addon btn btn-default fileinput-exists"
                                                        data-dismiss="fileinput">Eliminar</a>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Profesión</label></small>
                                                <div class="col-md-12">
                                                    <input name="profesion" type="text" placeholder="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Correo Electrónico</label></small>
                                                <div class="col-md-12">
                                                    <input type="email" placeholder="" class="form-control form-control-line" name="email" id="email" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Skype</label></small>
                                                <div class="col-md-12">
                                                    <input name="skype" type="text" placeholder="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">MSN</label></small>
                                                <div class="col-md-12">
                                                    <input name="msn" type="text" placeholder="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Teléfono</label></small>
                                                <div class="col-md-12">
                                                    <input name="fono" type="text" placeholder="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Dirección</label></small>
                                                <div class="col-md-12">
                                                    <input name="direccion" type="text" placeholder="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Comuna</label></small>
                                                <div class="col-md-12">
                                                    <input name="comuna" type="text" placeholder="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Ciudad</label></small>
                                                <div class="col-md-12">
                                                    <input name="ciudad" type="text" placeholder="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Empresa</label></small>
                                                <div class="col-md-12">
                                                    <input name="oid_empresa" type="text" placeholder="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Cargo</label></small>
                                                <div class="col-md-12">
                                                    <input name="empresa_cargo" type="text" placeholder="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Teléfono Empresa</label></small>
                                                <div class="col-md-12">
                                                    <input name="empresa_telefono" type="text" placeholder="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Unidad</label></small>
                                                <div class="col-md-12">
                                                    <input name="empresa_unidad" type="text" placeholder="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Dirección Empresa</label></small>
                                                <div class="col-md-12">
                                                    <input name="empresa_direccion" type="text" placeholder="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Comuna Empresa</label></small>
                                                <div class="col-md-12">
                                                    <input name="empresa_comuna" type="text" placeholder="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Ciudad Empresa</label></small>
                                                <div class="col-md-12">
                                                    <input name="empresa_ciudad" type="text" placeholder="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Estado Civil</label></small>
                                                <div class="col-md-12">
                                                    <select name="estado_civil" class="form-control form-control-line">
                                                        <option>Selecciona Estado Civil</option>
                                                        <option value="Soltero">Soltero</option>
                                                        <option value="Casado">Casado</option>
                                                        <option value="Viudo">Viudo</option>
                                                        <option value="Divorciado">Divorciado</option>
                                                        <option value="AUC">AUC</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Trienios</label></small>
                                                <div class="col-md-12">
                                                    <select name="trienios" class="form-control form-control-line">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9 ó más</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Especialidad</label></small>
                                                <div class="col-md-12">
                                                    <input name="especialidad" type="text" placeholder="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Sistema Previsional</label></small>
                                                <div class="col-md-12">
                                                    <input name="sistema_previsional" type="text" placeholder="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Sistema de Salud</label></small>
                                                <div class="col-md-12">
                                                    <input name="sistema_salud" type="text" placeholder="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Asignación Académica</label></small>
                                                <div class="col-md-12">
                                                    <select name="asignacion_academica" class="form-control form-control-line">
                                                        <option value="Doctor">Doctor</option>
                                                        <option value="Magister">Magister</option>
                                                        <option value="Postítulo">Postítulo</option>
                                                        <option selected value="Sin Postítulo">Sin Postítulo</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Pensionado</label></small>
                                                <div class="col-md-12">
                                                    <select name="pensionado" class="form-control form-control-line">
                                                        <option value="Si">Si</option>
                                                        <option selected value="No">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Reliquidado</label></small>
                                                <div class="col-md-12">
                                                    <select name="reliquidado" class="form-control form-control-line">
                                                        <option value="Si">Si</option>
                                                        <option selected value="No">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-success">Guardar</button>
                                                </div>
                                            </div>
                                        </form>
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
    <script src="<?php echo base_url() ?>/assets/libs/ckeditor/ckeditor.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/js/pages/forms/jasny-bootstrap.js"></script>
    <!-- Validaciones Usuario -->
    <script src="<?php echo base_url() ?>/assets/dist/js/validaciones-usuario.js"></script>
</body>

</html>