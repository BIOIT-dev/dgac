<?php //echo view('dgac/headers'); ?>
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
                            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-timeline-tab" data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-timeline" aria-selected="true">Perfil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#current-modulos" role="tab" aria-controls="pills-profile" aria-selected="false">Gestion de Modulos</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">Setting</a>
                                </li> -->
                            </ul>
                            <!-- Tabs -->
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
                                    <div class="card-body">
                                        <form action="<?php echo base_url('public/comunidad/editar/'.$profile_data_edit['oid']); ?>" name="comunidad_crear" id="comunidad_crear" method="post" accept-charset="utf-8" class="form-horizontal">
                                            <div class="form-group" hidden>
                                                <small><label class="col-md-12">oid</label></small>
                                                <div class="col-md-12">
                                                    <input name="oid" type="text" placeholder="" class="form-control form-control-line" value="<?= $profile_data_edit['oid'] ?>">
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <small><label class="col-md-12">Nombre</label></small>
                                                <div class="col-md-12">
                                                    <input name="nombre" type="text" value="<?= $profile_data_edit['nombre'] ?>" class="form-control form-control-line" size="50" required >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Nivel de Formación</label></small>
                                                <div class="col-md-12">
                                                    <select id="nivel_formacion" name="nivel_formacion" class="form-control form-control-line">
                                                        <option value="PROFESIONAL" <?= ($profile_data_edit['nivel_formacion']=='PROFESIONAL')?'selected':'' ?>>Profesional</option>
                                                        <option value="TECNICO" <?= ($profile_data_edit['nivel_formacion']=='TECNICO')?'selected':'' ?>>Técnico</option>
                                                        <option value="CAPACITACION" <?= ($profile_data_edit['nivel_formacion']=='CAPACITACION')?'selected':'' ?>>Capacitación</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Carrera</label></small>
                                                <div class="col-md-12">
                                                    <select id="carrera" name="carrera" class="form-control form-control-line">
                                                        <?php foreach($r_carreras as $r){ ?>
                                                            <option value="<?= $r->oid ?>" <?= ($profile_data_edit['carrera']==$r->oid)?'selected':'' ?>><?= $r->nombre ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Jornada</label></small>
                                                <div class="col-md-12">
                                                    <select id="jornada" name="jornada" class="form-control form-control-line">
                                                        <option value="DIURNO" <?= ($profile_data_edit['jornada']=='DIURNO')?'selected':'' ?>>Diurno</option>
                                                        <option value="VESPERTINO" <?= ($profile_data_edit['nivel_formacion']=='VESPERTINO')?'selected':'' ?>>Vespertino</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Descripción</label></small>
                                                <div class="col-md-12">
                                                    <div class="border p-3">
                                                        <div name="descripcion" id="descripcion" contenteditable="true" class="inline-editor">
                                                            <?= $profile_data_edit['descripcion'] ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Reflexión</label></small>
                                                <div class="col-md-12">
                                                    <div class="border p-3">
                                                        <div name="reflexion" id="reflexion" contenteditable="true" class="inline-editor">
                                                            <?= $profile_data_edit['reflexion'] ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Email Webmaster</label></small>
                                                <div class="col-md-12">
                                                    <input name="webmaster_email" id="webmaster_email" value="<?= $profile_data_edit['webmaster_email'] ?>" type="text" size="50" class="form-control form-control-line" value="" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Tipo PAC</label></small>
                                                <div class="col-md-12">
                                                    <select id="is_pac" name="is_pac" class="form-control form-control-line">
                                                        <option value="0" <?= ($profile_data_edit['is_pac']=='0')?'selected':'' ?>>No PAC</option>
                                                        <option value="1" <?= ($profile_data_edit['is_pac']=='1')?'selected':'' ?>>PAC</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Tipo</label></small>
                                                <div class="col-md-12">
                                                    <select id="grti_cod" name="grti_cod" class="form-control form-control-line">
                                                        <?php foreach($r_grupotipo as $r){ ?>
                                                            <option value="<?= $r->grti_cod ?>" <?= ($profile_data_edit['grti_cod']==$r->grti_cod)?'selected':'' ?>><?= $r->grti_nombre ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Número de Horas</label></small>
                                                <div class="col-md-12">
                                                    <input name="num_hora" type="number" min="0" value="<?= $profile_data_edit['num_hora'] ?>" size="50" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Costos</label></small>
                                                <div class="col-md-12">
                                                    <input name="costos" type="number" min="0"  size="50" value="<?= $profile_data_edit['costos'] ?>" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Categoría</label></small>
                                                <div class="col-md-12">
                                                    <select id="oid_categoria" name="oid_categoria" class="form-control form-control-line">
                                                        <option value="0" <?= ($profile_data_edit['oid_categoria']=="0")?'selected':'' ?>>Sin especificar</option>
                                                        <?php foreach($r_grupocategoria as $r){ ?>
                                                            <option value="<?=$r->oid?>" <?= ($profile_data_edit['oid_categoria']==$r->oid)?'selected':'' ?>><?= $r->nombre ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Inicio/Término</label></small>
                                                <div class="col-md-12">
                                                    <div class="input-daterange input-group" id="date-range">
                                                        <input type="text" class="form-control" name="grup_finicio" value='<?= date($profile_data_edit['grup_finicio']) ?>'/>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text bg-info b-0 text-white">AL</span>
                                                        </div>
                                                        <input type="text" class="form-control" name="grup_ftermino" value='<?= date($profile_data_edit['grup_ftermino']) ?>'/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Auto Incorporación</label></small>
                                                <div class="col-md-12">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input material-inputs" type="checkbox" id="autoincorporacion" value="<?= $profile_data_edit['autoincorporacion'] ?>" name="autoincorporacion">
                                                        <label class="form-check-label" for="autoincorporacion"><small>Los usuarios pueden Incorporarse por sí mismos</small></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Aula Virtual</label></small>
                                                <div class="col-md-12">
                                                    <input name="aulavirtual" size="50" type="text" value="<?= $profile_data_edit['aulavirtual'] ?>" placeholder="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Permisos Control Total</label></small>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Estado</label></small>
                                                <div class="col-md-12">
                                                    <select id="inactivo" name="inactivo" class="form-control form-control-line">
                                                        <option value="0" <?= ($profile_data_edit['inactivo']=='0')?'selected':'' ?>>Activo</option>
                                                        <option value="1" <?= ($profile_data_edit['inactivo']!='0')?'selected':'' ?>>Inactivo</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Secciones</label></small>
                                                <div class="col-md-12">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input material-inputs" type="checkbox" id="registra_emocion" value="<?= $profile_data_edit['registra_emocion'] ?>" name="registra_emocion">
                                                        <label class="form-check-label" for="registra_emocion"><small>Habilita Registro de Emociones</small></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Palabra Alumnos</label></small>
                                                <div class="col-md-12">
                                                    <input name="palabra_alumnos" size="50" type="text" value="<?= $profile_data_edit['palabra_alumnos'] ?>" placeholder="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Palabra Tutores</label></small>
                                                <div class="col-md-12">
                                                    <input name="palabra_tutores" size="50" type="text" value="<?= $profile_data_edit['palabra_tutores'] ?>" placeholder="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Palabra Profesores</label></small>
                                                <div class="col-md-12">
                                                    <input name="palabra_profesores" size="50" type="text" value="<?= $profile_data_edit['palabra_profesores'] ?>" placeholder="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Palabra Publicadores</label></small>
                                                <div class="col-md-12">
                                                    <input name="palabra_publicadores" size="50" type="text" value="<?= $profile_data_edit['palabra_publicadores'] ?>" placeholder="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Registro de Emociones</label></small>
                                                <div class="col-md-12">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input material-inputs" type="checkbox" id="registra_emocion" value="<?= $profile_data_edit['registra_emocion'] ?>" name="registra_emocion">
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
                                                <small><label class="col-md-12">Apariencia</label></small>
                                                <div class="col-md-12">
                                                    <select id="oid_tema" name="oid_tema" class="form-control form-control-line">
                                                        <?php foreach($r_temas as $r){ ?>
                                                            <option value="<?=$r->oid?>" <?= ($profile_data_edit['oid_tema']==$r->oid)?'selected':'' ?>><?= $r->descripcion ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Idioma</label></small>
                                                <div class="col-md-12">
                                                    <select id="lang" name="lang" class="form-control form-control-line">
                                                        <option value="spanish" <?= ($profile_data_edit['lang']=='0')?'selected':'' ?>>Español</option>
                                                        <option value="english" <?= ($profile_data_edit['lang']!='0')?'selected':'' ?>>Inglés</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Código SENCE</label></small>
                                                <div class="col-md-12">
                                                    <input name="sence_curso" value="<?= $profile_data_edit['sence_curso'] ?>" type="text" placeholder="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Clave SENCE</label></small>
                                                <div class="col-md-12">
                                                    <input name="sence_clave" value="<?= $profile_data_edit['sence_clave'] ?>" type="text" placeholder="" class="form-control form-control-line">
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
                                <div class="tab-pane fade show active" id="current-modulos" role="tabpanel" aria-labelledby="pills-timeline-tab">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table name="tabla_comunidades" id="tabla_comunidades" class="table table-striped table-bordered display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th scope="col">Comunidad</th>
                                                        <th scope="col">Estatus</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th></th>
                                                        <th scope="col">Comunidad</th>
                                                        <th scope="col">Estatus</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <button onclick='modalSave()' class="btn btn-rounded btn-success">Guardar</button>
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
                                                    <button onclick="GuardarModulos()" type="button" class="swal2-confirm swal2-styled" aria-label="">Guardar</button>
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
                                                    No hay modulos seleccionados
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
                                                    Se actualizo la informacion de los modulos
                                                </div>
                                                <div class="swal2-actions" style="display: flex;">
                                                    <a href="<?php echo site_url('comunidad/editar/'.$profile_data_edit['oid']); ?>" type="button" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block; border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);">OK</a>
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
    <!--Custom JavaScript -->
    <script src="<?php echo base_url() ?>/assets/libs/sweetalert2/dist/sweetalert2.all.js"></script>
    <script src="<?php echo base_url() ?>/assets/extra-libs/sweetalert2/sweet-alert.init.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/ckeditor/ckeditor.js"></script>
    <!-- This Page JS -->

    <script src="<?php echo base_url() ?>/assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/js/pages/datatable/custom-datatable.js"></script>
    <!-- <script src="<?php echo base_url() ?>/assets/dist/js/pages/datatable/datatable-basic.init.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script> -->

    <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script> -->
    <script type="text/javascript" charset="utf8" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/js/dataTables.checkboxes.min.js"></script>

    <script>
        //Dataset para crear la tabla
        var dataSet = []
        <?php foreach($modulos as $rb) { ?>
            dataSet.push(['<?= $rb->id ?>', "<?=$rb->nombre ?>","<?=$rb->estatus ? "Activo" : "Inactivo"?>"]);
            // console.log(dataSet)
        <?php } ?>
        
        $(document).ready(function() {
            var table = $('#tabla_comunidades').DataTable({
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

        function modalClose(){
            document.querySelector("#modalDelete").style.display = "none";
            document.querySelector("#modalError").style.display = "none";
        }

        function modalSave(){
            cant_comuni_checked = $('#tabla_comunidades').DataTable().column(0).checkboxes.selected().length;
            //console.log(cant_usuarios_checked);//

            if (cant_comuni_checked > 0){
                document.querySelector("#modalDelete #swal2-content").innerHTML = "¿Está seguro que quiere habilitar/deshabilitar los modulos en esta comunidad comunidades?";
                document.querySelector("#modalDelete").style.display = "block";
            }else{
                document.querySelector("#modalError").style.display = "block";
            }
        }

        function GuardarModulos(){
            var checked = {};
            var list_checked = $('#tabla_comunidades').DataTable().column(0).checkboxes.selected();
            for (var i = 0; i < list_checked.length; i++){
                // checked.push(list_checked[i]);
                checked[i] = list_checked[i];
            }
            console.log(checked); //
            // window.location = '<?php //echo base_url('public/Usuario/eliminar_usuario/'); ?>'+'/'+checked;
            var url = "<?php echo base_url('public/comunidad/guardar_modulos/'.$profile_data_edit['oid']); ?>";
            $.post(url, checked, function(data, status){
                //console.log("CARGANDO!", data, status);//
                if (status){
                    // window.location = "https://stackoverflow.com";
                    document.querySelector("#modalDelete").style.display = "none";
                    document.querySelector("#modalSuccess").style.display = "block";
                    //console.log("BIEN");//
                }else{
                    console.log("ERROR");
                }
            });
        }
        </script>
</body>

</html>