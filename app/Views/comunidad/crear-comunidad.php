<?php //echo view('dgac/headers'); ?>
<?php echo $headers['headersView']; ?>

<!-- DatetimePicker CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

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
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <!-- Tabs -->
                            
                            <!-- Tabs -->
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
                                    <div class="card-body">
                                        <form action="<?php echo base_url('public/comunidad/crear_comunidad'); ?>" name="comunidad_crear" id="comunidad_crear" method="post" accept-charset="utf-8" class="form-horizontal">
                                            <div class="form-group">
                                                <small><label class="col-md-12">Nombre</label></small>
                                                <div class="col-md-12">
                                                    <input name="nombre" type="text" placeholder="" class="form-control form-control-line" size="50" required >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Nivel de Formación</label></small>
                                                <div class="col-md-12">
                                                    <select id="nivel_formacion" name="nivel_formacion" class="form-control form-control-line">
                                                        <option value="PROFESIONAL">Profesional</option>
                                                        <option value="TECNICO">Técnico</option>
                                                        <option value="CAPACITACION">Capacitación</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Carrera</label></small>
                                                <div class="col-md-12">
                                                    <select id="carrera" name="carrera" class="form-control form-control-line">
                                                        <?php foreach($r_carreras as $r){ ?>
                                                            <option value="<?= $r->oid ?>"><?= $r->nombre ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Jornada</label></small>
                                                <div class="col-md-12">
                                                    <select id="jornada" name="jornada" class="form-control form-control-line">
                                                        <option value="DIURNO">Diurno</option>
                                                        <option value="VESPERTINO">Vespertino</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Descripción</label></small>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea class="form-control" rows="3"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Email Webmaster</label></small>
                                                <div class="col-md-12">
                                                    <input name="webmaster_email" id="webmaster_email" type="text" size="50" class="form-control form-control-line" value="" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Tipo PAC</label></small>
                                                <div class="col-md-12">
                                                    <select id="is_pac" name="is_pac" class="form-control form-control-line">
                                                        <option value="0">No PAC</option>
                                                        <option value="1">PAC</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Tipo</label></small>
                                                <div class="col-md-12">
                                                    <select id="grti_cod" name="grti_cod" class="form-control form-control-line">
                                                        <?php foreach($r_grupotipo as $r){ ?>
                                                            <option value="<?= $r->grti_cod ?>"><?= $r->grti_nombre ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Número de Horas</label></small>
                                                <div class="col-md-12">
                                                    <input name="num_hora" type="number" min="0"  size="50" value="0" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Costos</label></small>
                                                <div class="col-md-12">
                                                    <input name="costos" type="number" min="0"  size="50" value="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Categoría</label></small>
                                                <div class="col-md-12">
                                                    <select id="oid_categoria" name="oid_categoria" class="form-control form-control-line">
                                                        <option value="0" selected="selected">Sin especificar</option>
                                                        <?php foreach($r_grupocategoria as $r){ ?>
                                                            <option value="<?=$r->oid?>"><?= $r->nombre ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Inicio/Término</label></small>
                                                <div class="col-md-12">
                                                    <div class="input-daterange input-group" id="date-range">
                                                        <input type="text" class="form-control" name="grup_finicio" />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text bg-info b-0 text-white">AL</span>
                                                        </div>
                                                        <input type="text" class="form-control" name="grup_ftermino" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Auto Incorporación</label></small>
                                                <div class="col-md-12">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input material-inputs" type="checkbox" id="autoincorporacion" value="1" name="autoincorporacion">
                                                        <label class="form-check-label" for="autoincorporacion"><small>Los usuarios pueden Incorporarse por sí mismos</small></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Aula Virtual</label></small>
                                                <div class="col-md-12">
                                                    <input name="aulavirtual" size="50" type="text" value="" placeholder="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Permisos Control Total</label></small>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Registro de Emociones</label></small>
                                                <div class="col-md-12">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input material-inputs" type="checkbox" id="registra_emocion" value="1" name="registra_emocion">
                                                        <label class="form-check-label" for="registra_emocion"><small>Habilita Registro de Emociones</small></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12"><b>Top 5</b></label>
                                                <div class="col-md-12">
                                                    <input class="form-check-input material-inputs" type="radio" name="top5_activo" id="top5_activo" value="0" checked="checked"
                                                        onclick="document.getElementById('top5_peso').style.display='none';" />
                                                    <label class="form-check-label" for="top5_activo"><small>Deshabilitado</small></label>

                                                    <input class="form-check-input material-inputs" type="radio" name="top5_activo" id="top5_activo2" value="1"
                                                        onclick="document.getElementById('top5_peso').style.display='block';" />
                                                    <label class="form-check-label" for="top5_activo2"><small>Habilitado</small></label>

                                                    <div id="top5_peso" style="display: none;">
                                                        <br /> 
                                                        <input class="" type="text" size="3" name="" value="70" />% Participación en los Foros <br /> 
                                                        <input class="" type="text" size="3" name="" value="10" />% Descargas Biblioteca <br /> 
                                                        <input class="" type="text" size="3" name="" value="10" />% Objetos SCORM Finalizados <br /> 
                                                        <input class="" type="text" size="3" name="" value="10" />% Clics
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12"><b>Apariencia</b></label>
                                                <div class="col-md-12">
                                                    <select id="oid_tema" name="oid_tema" class="form-control form-control-line">
                                                        <?php foreach($r_temas as $r){ ?>
                                                            <option value="<?=$r->oid?>" <?=$r->oid==1 ? "selected='selected'" : ""?>><?= $r->descripcion ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Idioma</label></small>
                                                <div class="col-md-12">
                                                    <select id="lang" name="lang" class="form-control form-control-line">
                                                        <option value="spanish">Español</option>
                                                        <option value="english">Inglés</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Código SENCE</label></small>
                                                <div class="col-md-12">
                                                    <input name="sence_curso" type="text" placeholder="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Clave SENCE</label></small>
                                                <div class="col-md-12">
                                                    <input name="sence_clave" type="text" placeholder="" class="form-control form-control-line">
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
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
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
    <!-- DatetimePicker JS -->
    <script src="<?php echo base_url() ?>/assets/libs/moment/moment.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script>

    
    </script>
    <script>
    // Date Picker
    jQuery('.mydatepicker, #datepicker, .input-group.date').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#date-range').datepicker({
        toggleActive: true,
        language: 'es'
    });
    jQuery('#datepicker-inline').datepicker({
        todayHighlight: true
    });
    </script>
</body>

</html>