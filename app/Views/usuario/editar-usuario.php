<?php //echo view('dgac/headers'); ?>
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
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="mt-4"> <img src="<?php echo base_url(fotoPerfil($profile_data_edit['oid'])); ?>" class="rounded-circle" width="150" />
                                    <h4 class="card-title mt-2"><?= $profile_data_edit['nombres'].' '.$profile_data_edit['apellidos']?></h4>
                                    <h6 class="card-subtitle"><?= $profile_data_edit['empresa_cargo'] ?></h6>
                                    <div class="row text-center justify-content-md-center">
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium">254</font></a></div>
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i> <font class="font-medium">54</font></a></div>
                                    </div>
                                </center>
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body"> <small class="text-muted">Correo electrónico </small>
                                <h6><?= $profile_data_edit['email']; ?></h6> <small class="text-muted pt-4 db">Teléfono</small>
                                <h6><?= $profile_data_edit['fono'] ?></h6> <small class="text-muted pt-4 db">Dirección</small>
                                <h6><?= $profile_data_edit['direccion'] ?></h6>
                                <!-- <div class="map-box">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508" width="100%" height="150" frameborder="0" style="border:0" allowfullscreen></iframe>
                                </div> -->
                                <small class="text-muted pt-4 db">Redes Sociales</small> 
                                <br/>
                                <button class="btn btn-circle btn-secondary"><i class="fab fa-facebook-f"></i></button>
                                <button class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></button>
                                <button class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Tabs -->
                            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-timeline-tab" data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-timeline" aria-selected="true">Perfil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-profile" aria-selected="false">Información</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">Setting</a>
                                </li> -->
                            </ul>
                            <!-- Tabs -->
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
                                    <div class="card-body">
                                        <form class="form-horizontal form-material" action="<?php echo base_url('public/Usuario/editar/'.$profile_data_edit['oid']); ?>" name="user_edit" id="user_edit" method="post" accept-charset="utf-8">
                                            <div class="form-group" hidden>
                                                <small><label class="col-md-12">oid</label></small>
                                                <div class="col-md-12">
                                                    <input name="oid" type="text" placeholder="" class="form-control form-control-line" value="<?= $profile_data_edit['oid'] ?>">
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <small><label class="col-md-12">Autentificación</label></small>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <input name="inactivo"  class="with-gap material-inputs" type="radio" id="radio_1" <?= ($profile_data_edit['inactivo']=='0')?'checked':'' ?> disabled/>
                                                            <label for="radio_1">En la Plataforma</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="inactivo" class="with-gap material-inputs" type="radio" id="radio_2" <?= ($profile_data_edit['inactivo']=='1')?'checked':'' ?> disabled/>
                                                            <label for="radio_2">Externa a la Plataforma</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Userid</label></small>
                                                <div class="col-md-12">
                                                    <input name="userid" type="text" placeholder="" class="form-control form-control-line" value="<?= $profile_data_edit['userid'] ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Nueva Clave</label></small>
                                                <div class="col-md-12">
                                                    <input type="password" value="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Reingrese Nueva Clave</label></small>
                                                <div class="col-md-12">
                                                    <input type="password" value="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">RUT</label></small>
                                                <div class="col-md-12">
                                                    <input name="rut" oninput="checkRut(this)" type="text" placeholder="" class="form-control form-control-line" value="<?= $profile_data_edit['rut'] ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Nombre</label></small>
                                                <div class="col-md-12">
                                                    <input name="nombres" type="text" placeholder="" class="form-control form-control-line" value="<?= $profile_data_edit['nombres'] ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Apellido Paterno</label></small>
                                                <div class="col-md-12">
                                                    <input name="apellido_paterno" type="text" placeholder="" class="form-control form-control-line" value="<?= $profile_data_edit['apellido_paterno'] ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Apellido Materno</label></small>
                                                <div class="col-md-12">
                                                    <input name="apellido_materno" type="text" placeholder="" class="form-control form-control-line" value="<?= $profile_data_edit['apellido_materno'] ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Sexo</label></small>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <input name="sexo"  class="with-gap material-inputs" type="radio" id="sexo_m" <?= ($profile_data_edit['sexo']=='m')?'checked':'' ?>/>
                                                            <label for="sexo_m">Masculino</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="sexo" class="with-gap material-inputs" type="radio" id="sexo_f" <?= ($profile_data_edit['sexo']=='f')?'checked':'' ?>/>
                                                            <label for="sexo_f">Femenino</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Fecha de Nacimiento</label></small>
                                                <div class="col-md-12">
                                                    <input name="fecnac" type="date" placeholder="" class="form-control form-control-line" value='<?= date($profile_data_edit['fecnac']) ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Profesión</label></small>
                                                <div class="col-md-12">
                                                    <input name="profesion" type="text" placeholder="" class="form-control form-control-line" value='<?= $profile_data_edit['profesion'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Correo Electrónico</label></small>
                                                <div class="col-md-12">
                                                    <input type="email" placeholder="" class="form-control form-control-line" name="email" id="email" value='<?= $profile_data_edit['email'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Skype</label></small>
                                                <div class="col-md-12">
                                                    <input name="skype" type="text" placeholder="" class="form-control form-control-line" value='<?= $profile_data_edit['skype'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">MSN</label></small>
                                                <div class="col-md-12">
                                                    <input name="msn" type="text" placeholder="" class="form-control form-control-line" value='<?= $profile_data_edit['msn'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Teléfono</label></small>
                                                <div class="col-md-12">
                                                    <input name="fono" type="text" placeholder="" class="form-control form-control-line" value='<?= $profile_data_edit['fono'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Dirección</label></small>
                                                <div class="col-md-12">
                                                    <input name="direccion" type="text" placeholder="" class="form-control form-control-line" value='<?= $profile_data_edit['direccion'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Comuna</label></small>
                                                <div class="col-md-12">
                                                    <input name="comuna" type="text" placeholder="" class="form-control form-control-line" value='<?= $profile_data_edit['comuna'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Ciudad</label></small>
                                                <div class="col-md-12">
                                                    <input name="ciudad" type="text" placeholder="" class="form-control form-control-line" value='<?= $profile_data_edit['ciudad'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Empresa</label></small>
                                                <div class="col-md-12">
                                                    <input name="oid_empresa" type="text" placeholder="" class="form-control form-control-line" value='<?= $profile_data_edit['oid_empresa'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Cargo</label></small>
                                                <div class="col-md-12">
                                                    <input name="empresa_cargo" type="text" placeholder="" class="form-control form-control-line" value='<?= $profile_data_edit['empresa_cargo'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Teléfono Empresa</label></small>
                                                <div class="col-md-12">
                                                    <input name="empresa_telefono" type="text" placeholder="" class="form-control form-control-line" value='<?= $profile_data_edit['empresa_telefono'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Unidad</label></small>
                                                <div class="col-md-12">
                                                    <input name="empresa_unidad" type="text" placeholder="" class="form-control form-control-line" value='<?= $profile_data_edit['empresa_unidad'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Dirección Empresa</label></small>
                                                <div class="col-md-12">
                                                    <input name="empresa_direccion" type="text" placeholder="" class="form-control form-control-line" value='<?= $profile_data_edit['empresa_direccion'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Comuna Empresa</label></small>
                                                <div class="col-md-12">
                                                    <input name="empresa_comuna" type="text" placeholder="" class="form-control form-control-line" value='<?= $profile_data_edit['empresa_comuna'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Ciudad Empresa</label></small>
                                                <div class="col-md-12">
                                                    <input name="empresa_ciudad" type="text" placeholder="" class="form-control form-control-line" value='<?= $profile_data_edit['empresa_ciudad'] ?>'>
                                                </div>
                                            </div>
                                            <!-- <div class="form-group">
                                                <small><label class="col-md-12">Profesión</label></small>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="" class="form-control form-control-line" value='<?= $profile_data_edit['profesion'] ?>'>
                                                </div>
                                            </div> -->
                                            <div class="form-group">
                                                <small><label class="col-md-12">Estado Civil</label></small>
                                                <div class="col-md-12">
                                                    <select name="estado_civil" class="form-control form-control-line">
                                                        <option>Selecciona Estado Civil</option>
                                                        <option value="Soltero" <?= ($profile_data_edit['estado_civil']=='Soltero')?'selected':'' ?> >Soltero</option>
                                                        <option value="Casado" <?= ($profile_data_edit['estado_civil']=='Casado')?'selected':'' ?> >Casado</option>
                                                        <option value="Viudo" <?= ($profile_data_edit['estado_civil']=='Viudo')?'selected':'' ?> >Viudo</option>
                                                        <option value="Divorciado" <?= ($profile_data_edit['estado_civil']=='Divorciado')?'selected':'' ?> >Divorciado</option>
                                                        <option value="AUC" <?= ($profile_data_edit['estado_civil']=='AUC')?'selected':'' ?> >AUC</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Trienios</label></small>
                                                <div class="col-md-12">
                                                    <select name="trienios" class="form-control form-control-line">
                                                        <option value="0" <?= ($profile_data_edit['trienios']=='0')?'selected':'' ?> >0</option>
                                                        <option value="1" <?= ($profile_data_edit['trienios']=='1')?'selected':'' ?> >1</option>
                                                        <option value="2" <?= ($profile_data_edit['trienios']=='2')?'selected':'' ?> >2</option>
                                                        <option value="3" <?= ($profile_data_edit['trienios']=='3')?'selected':'' ?> >3</option>
                                                        <option value="4" <?= ($profile_data_edit['trienios']=='4')?'selected':'' ?> >4</option>
                                                        <option value="5" <?= ($profile_data_edit['trienios']=='5')?'selected':'' ?> >5</option>
                                                        <option value="6" <?= ($profile_data_edit['trienios']=='6')?'selected':'' ?> >6</option>
                                                        <option value="7" <?= ($profile_data_edit['trienios']=='7')?'selected':'' ?> >7</option>
                                                        <option value="8" <?= ($profile_data_edit['trienios']=='8')?'selected':'' ?> >8</option>
                                                        <option value="9" <?= ($profile_data_edit['trienios']=='9')?'selected':'' ?> >9 ó más</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Especialidad</label></small>
                                                <div class="col-md-12">
                                                    <input name="especialidad" type="text" placeholder="" class="form-control form-control-line" value='<?= $profile_data_edit['especialidad'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Sistema Previsional</label></small>
                                                <div class="col-md-12">
                                                    <input name="sistema_previsional" type="text" placeholder="" class="form-control form-control-line" value='<?= $profile_data_edit['sistema_previsional'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Sistema de Salud</label></small>
                                                <div class="col-md-12">
                                                    <input name="sistema_salud" type="text" placeholder="" class="form-control form-control-line" value='<?= $profile_data_edit['sistema_salud'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Asignación Académica</label></small>
                                                <div class="col-md-12">
                                                    <select name="asignacion_academica" class="form-control form-control-line">
                                                        <option value="Doctor" <?= ($profile_data_edit['asignacion_academica']=='Doctor')?'selected':'' ?> >Doctor</option>
                                                        <option value="Magister" <?= ($profile_data_edit['asignacion_academica']=='Magister')?'selected':'' ?> >Magister</option>
                                                        <option value="Postítulo" <?= ($profile_data_edit['asignacion_academica']=='Postítulo')?'selected':'' ?> >Postítulo</option>
                                                        <option value="Sin Postítulo" <?= ($profile_data_edit['asignacion_academica']=='Sin Postítulo')?'selected':'' ?> >Sin Postítulo</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Pensionado</label></small>
                                                <div class="col-md-12">
                                                    <select name="pensionado" class="form-control form-control-line">
                                                        <option value="Si" <?= ($profile_data_edit['pensionado']=='Si')?'selected':'' ?> >Si</option>
                                                        <option value="No" <?= ($profile_data_edit['pensionado']=='No')?'selected':'' ?> >No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Reliquidado</label></small>
                                                <div class="col-md-12">
                                                    <select name="reliquidado" class="form-control form-control-line">
                                                        <option value="Si" <?= ($profile_data_edit['reliquidado']=='Si')?'selected':'' ?> >Si</option>
                                                        <option value="No" <?= ($profile_data_edit['reliquidado']=='No')?'selected':'' ?> >No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- Panel de permisos -->
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <fieldset>
                                                            <legend>Niveles de Acceso</legend>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AccesoModal">
                                                            <i class="mdi mdi-plus"></i>
                                                            Agregar
                                                        </button>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <table class="table table-striped table-bordered display dataTable">
                                                            <tr>
                                                                <td>Comunidades</td>
                                                                <td>Roles</td>
                                                            </tr>
                                                            <?php foreach ($access_users as $key => $value) { ?>
                                                            <?php $role = $value->clave; ?>
                                                            <tr>
                                                                <td><?php echo $value->grupo; ?></td>
                                                                <td>
                                                                    <input type="hidden" name="grupos_id[]" value="<?php echo $value->oid_grupo; ?>">
                                                                    <select class="form-control" name="roles_id[]">
                                                                        <?php foreach ($roles as $key => $value) { ?>
                                                                        <?php 
                                                                            if( $role == $value->clave ){
                                                                                $selected = "selected";
                                                                            }else{
                                                                                $selected = "";
                                                                            }
                                                                        ?>
                                                                        <option <?php echo $selected; ?> value="<?php echo $value->clave; ?>">
                                                                            <?php echo $value->name; ?>
                                                                        </option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
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
                                <div class="tab-pane fade" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="card-body">
                                        <div class="border p-3">
                                            <div id="editor2" contenteditable="true" class="inline-editor">
                                            <?= $profile_data_edit['quien_soy'] ?>
                                            </div>
                                        </div>
                                        <!-- <hr>
                                        <h4 class="font-medium mt-4">Skill Set</h4>
                                        <hr>
                                        <h5 class="mt-4">Wordpress <span class="pull-right">80%</span></h5>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                                        </div>
                                        <h5 class="mt-4">HTML 5 <span class="pull-right">90%</span></h5>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                                        </div>
                                        <h5 class="mt-4">jQuery <span class="pull-right">50%</span></h5>
                                        <div class="progress">
                                            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                                        </div>
                                        <h5 class="mt-4">Photoshop <span class="pull-right">70%</span></h5>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                                        </div> -->
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
    <!-- Modal -->
    <div class="modal fade" id="AccesoModal" tabindex="-1" role="dialog" aria-labelledby="AccesoModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="AccesoModalLabel">Agregar nivel de acceso</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="frm-usuario" action="<?php echo base_url('public/Usuario/crear_usuario_permisos'); ?>" method="POST">
              <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="usuario_ids" value="<?php echo $profile_data_edit['oid']; ?>" />
                            <input class="form-control" id="grupo_name" type="text" placeholder="Comunidad">
                            <div class="show-li"></div>
                            <input type="hidden" id="grupo_id" name="grupo_id">
                        </div>
                        <div class="col-md-12 mt-3">
                            <select class="form-control" id="role_id" name="role_id" required="">
                                <?php foreach ($roles as $key => $value) { ?>
                                <option value="<?php echo $value->clave; ?>"><?php echo $value->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn btn-primary" value="Guardar" />
              </div>
          </form>
        </div>
      </div>
    </div>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <?php echo view('dgac/scripts'); ?>
    <script src="<?php echo base_url() ?>/assets/libs/ckeditor/ckeditor.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/js/pages/forms/jasny-bootstrap.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/js/validaciones-usuario.js"></script>
    <script type="text/javascript">
        function comunidad( grupo_id , grupo_name ){
            $("#grupo_id").val(grupo_id);
            $("#grupo_name").val(grupo_name);
            $('div.show-li').hide();
        }
    </script>
    <script type="text/javascript">
        $( document ).ready(function() {

            var form = $('#frm-usuario');
            var url  = form.attr( 'action' );

            form.submit( function(e) {
                e.preventDefault();
                $.ajax( {
                  dataType: "json",
                  type: "POST",
                  url: url,
                  data: form.serialize(),
                  success: function( response ) {
                    if( response.res == 'success' ){
                        alert(response.message);
                        location.reload();
                        //$("#grupo_id,#grupo_name").val("");
                        //$('#AccesoModal').modal('hide');
                    }else{
						alert(response.message);
					}
                  }
                } );
              } );



            $( "#grupo_name" ).keydown(function() {
              var grupo_name = $(this).val();
              $('div.show-li').show();

              $.ajax( {
                  dataType: "json",
                  type: "POST",
                  url: "<?php echo base_url('public/Usuario/find_grupo'); ?>",
                  data: {'grupo_name':grupo_name} ,
                  success: function( response ) {
                    var option = "";
                    $.each(response, function (i,o) {
                        var nombre = '"'+o.nombre+'"';
                        option += "<div onclick='comunidad("+o.oid+","+nombre+")' >"+o.nombre+"</div>";
                    });
                    $('div.show-li').html(option);
                  }
                } );

            });

            


              


              

        });
    </script>
</body>

</html>
