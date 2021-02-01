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
                                <center class="mt-4"> <img src="<?php echo base_url(fotoPerfil($profile_data['oid'])); ?>" class="rounded-circle" width="150" />
                                    <h4 class="card-title mt-2"><?php echo $profile_data['nombres'].' '.$profile_data['apellidos']?></h4>
                                    <h6 class="card-subtitle"><?php echo $profile_data['empresa_cargo'] ?></h6>
                                    <div class="row text-center justify-content-md-center">
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium">254</font></a></div>
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i> <font class="font-medium">54</font></a></div>
                                    </div>
                                </center>
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body"> <small class="text-muted">Correo electrónico </small>
                                <h6><?php echo $profile_data['email']; ?></h6> <small class="text-muted pt-4 db">Teléfono</small>
                                <h6><?php echo $profile_data['fono'] ?></h6> <small class="text-muted pt-4 db">Dirección</small>
                                <h6><?php echo $profile_data['direccion'] ?></h6>
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
                                        <form class="form-horizontal form-material" enctype="multipart/form-data" method="POST" action="<?php echo base_url('public/Profile/send_profile'); ?>" >
                                            <input type="hidden" name="oid" value="<?php echo $profile_data['oid'] ?>">
                                            <div class="form-group">
                                                <small><label class="col-md-12">Autentificación</label></small>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <input name="inactivo"  class="with-gap material-inputs" type="radio" id="radio_1" value="0" <?php echo ($profile_data['inactivo']=='0')?'checked':'' ?>/>
                                                            <label for="inactivo_1">En la Plataforma</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="inactivo" class="with-gap material-inputs" type="radio" id="radio_2" value="1" <?php echo ($profile_data['inactivo']=='1')?'checked':'' ?>/>
                                                            <label for="inactivo_2">Externa a la Plataforma</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Foto de Perfil</label></small>
                                                <div class="col-md-12">
                                                    <input name="foto" class="with-gap material-inputs" type="file" id="foto" accept="image/*"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Userid</label></small>
                                                <div class="col-md-12">
                                                    <input type="text" name="userid" class="form-control form-control-line" value="<?php echo $profile_data['userid'] ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Nueva Clave</label></small>
                                                <div class="col-md-12">
                                                    <input type="password" name="clave" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group" hidden="">
                                                <small><label class="col-md-12">Reingrese Nueva Clave</label></small>
                                                <div class="col-md-12">
                                                    <input type="password" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">RUT</label></small>
                                                <div class="col-md-12">
                                                    <input type="text" name="rut" class="form-control form-control-line" value="<?php echo $profile_data['rut'] ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Nombre</label></small>
                                                <div class="col-md-12">
                                                    <input type="text" name="nombres" class="form-control form-control-line" value="<?php echo $profile_data['nombres'] ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Apellido Paterno</label></small>
                                                <div class="col-md-12">
                                                    <input type="text" name="apellido_paterno" class="form-control form-control-line" value="<?php echo $profile_data['apellido_paterno'] ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Apellido Materno</label></small>
                                                <div class="col-md-12">
                                                    <input type="text" name="apellido_materno" class="form-control form-control-line" value="<?php echo $profile_data['apellido_materno'] ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Sexo</label></small>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <input name="sexo"  class="with-gap material-inputs" type="radio" id="sexo_m" <?php echo ($profile_data['sexo']=='m')?'checked':'' ?> disabled/>
                                                            <label for="sexo_1">Masculino</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="sexo" class="with-gap material-inputs" type="radio" id="sexo_f" <?php echo ($profile_data['sexo']=='f')?'checked':'' ?> disabled/>
                                                            <label for="sexo_2">Femenino</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Fecha de Nacimiento</label></small>
                                                <div class="col-md-12">
                                                    <input type="date" name="fecnac" class="form-control form-control-line" value='<?php echo date($profile_data['fecnac']) ?>' name="fecnac">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Profesión</label></small>
                                                <div class="col-md-12">
                                                    <input type="text" name="profesion" class="form-control form-control-line" value='<?php echo $profile_data['profesion'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Correo Electrónico</label></small>
                                                <div class="col-md-12">
                                                    <input type="email" name="email" class="form-control form-control-line" name="example-email" id="example-email" value='<?php echo $profile_data['email'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Skype</label></small>
                                                <div class="col-md-12">
                                                    <input type="text" name="skype" class="form-control form-control-line" value='<?php echo $profile_data['skype'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">MSN</label></small>
                                                <div class="col-md-12">
                                                    <input type="text" name="msn" class="form-control form-control-line" value='<?php echo $profile_data['msn'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Teléfono</label></small>
                                                <div class="col-md-12">
                                                    <input type="text" name="fono" class="form-control form-control-line" value='<?php echo $profile_data['fono'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Dirección</label></small>
                                                <div class="col-md-12">
                                                    <input type="text" name="direccion" class="form-control form-control-line" value='<?php echo $profile_data['direccion'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Comuna</label></small>
                                                <div class="col-md-12">
                                                    <input type="text" name="comuna" class="form-control form-control-line" value='<?php echo $profile_data['comuna'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Ciudad</label></small>
                                                <div class="col-md-12">
                                                    <input type="text" name="ciudad" class="form-control form-control-line" value='<?php echo $profile_data['ciudad'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Empresa</label></small>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="" class="form-control form-control-line" value='<?php echo $profile_data['oid_empresa'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Cargo</label></small>
                                                <div class="col-md-12">
                                                    <input type="text" name="empresa_cargo" class="form-control form-control-line" value='<?php echo $profile_data['empresa_cargo'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Teléfono Empresa</label></small>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="" class="form-control form-control-line" value='<?php echo $profile_data['empresa_telefono'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Unidad</label></small>
                                                <div class="col-md-12">
                                                    <input type="text" name="empresa_telefono" class="form-control form-control-line" value='<?php echo $profile_data['empresa_unidad'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Dirección Empresa</label></small>
                                                <div class="col-md-12">
                                                    <input type="text" name="empresa_direccion" class="form-control form-control-line" value='<?php echo $profile_data['empresa_direccion'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Comuna Empresa</label></small>
                                                <div class="col-md-12">
                                                    <input type="text" name="empresa_comuna" class="form-control form-control-line" value='<?php echo $profile_data['empresa_comuna'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Ciudad Empresa</label></small>
                                                <div class="col-md-12">
                                                    <input type="text" name="empresa_ciudad" class="form-control form-control-line" value='<?php echo $profile_data['empresa_ciudad'] ?>'>
                                                </div>
                                            </div>
                                            <!-- <div class="form-group">
                                                <small><label class="col-md-12">Profesión</label></small>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="" class="form-control form-control-line" value='<?php echo $profile_data['profesion'] ?>'>
                                                </div>
                                            </div> -->
                                            <div class="form-group">
                                                <small><label class="col-md-12">Estado Civil</label></small>
                                                <div class="col-md-12">
                                                    <select class="form-control form-control-line" name="estado_civil">
                                                        <option>Selecciona Estado Civil</option>
                                                        <option value="Soltero" <?php echo ($profile_data['estado_civil']=='Soltero')?'selected':'' ?> >Soltero</option>
                                                        <option value="Casado" <?php echo ($profile_data['estado_civil']=='Casado')?'selected':'' ?> >Casado</option>
                                                        <option value="Viudo" <?php echo ($profile_data['estado_civil']=='Viudo')?'selected':'' ?> >Viudo</option>
                                                        <option value="Divorciado" <?php echo ($profile_data['estado_civil']=='Divorciado')?'selected':'' ?> >Divorciado</option>
                                                        <option value="AUC" <?php echo ($profile_data['estado_civil']=='AUC')?'selected':'' ?> >AUC</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Trienios</label></small>
                                                <div class="col-md-12">
                                                    <select class="form-control form-control-line" name="trienios">
                                                        <option value="0" <?php echo ($profile_data['trienios']=='0')?'selected':'' ?> >0</option>
                                                        <option value="1" <?php echo ($profile_data['trienios']=='1')?'selected':'' ?> >1</option>
                                                        <option value="2" <?php echo ($profile_data['trienios']=='2')?'selected':'' ?> >2</option>
                                                        <option value="3" <?php echo ($profile_data['trienios']=='3')?'selected':'' ?> >3</option>
                                                        <option value="4" <?php echo ($profile_data['trienios']=='4')?'selected':'' ?> >4</option>
                                                        <option value="5" <?php echo ($profile_data['trienios']=='5')?'selected':'' ?> >5</option>
                                                        <option value="6" <?php echo ($profile_data['trienios']=='6')?'selected':'' ?> >6</option>
                                                        <option value="7" <?php echo ($profile_data['trienios']=='7')?'selected':'' ?> >7</option>
                                                        <option value="8" <?php echo ($profile_data['trienios']=='8')?'selected':'' ?> >8</option>
                                                        <option value="9" <?php echo ($profile_data['trienios']=='9')?'selected':'' ?> >9 ó más</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Especialidad</label></small>
                                                <div class="col-md-12">
                                                    <input type="text" name="especialidad" class="form-control form-control-line" value='<?php echo $profile_data['especialidad'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Sistema Previsional</label></small>
                                                <div class="col-md-12">
                                                    <input type="text" name="sistema_previsional" class="form-control form-control-line" value='<?php echo $profile_data['sistema_previsional'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Sistema de Salud</label></small>
                                                <div class="col-md-12">
                                                    <input type="text" name="sistema_salud" class="form-control form-control-line" value='<?php echo $profile_data['sistema_salud'] ?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Asignación Académica</label></small>
                                                <div class="col-md-12">
                                                    <select class="form-control form-control-line" name="asignacion_academica">
                                                        <option value="Doctor" <?php echo ($profile_data['asignacion_academica']=='Doctor')?'selected':'' ?> >Doctor</option>
                                                        <option value="Magister" <?php echo ($profile_data['asignacion_academica']=='Magister')?'selected':'' ?> >Magister</option>
                                                        <option value="Postítulo" <?php echo ($profile_data['asignacion_academica']=='Postítulo')?'selected':'' ?> >Postítulo</option>
                                                        <option value="Sin Postítulo" <?php echo ($profile_data['asignacion_academica']=='Sin Postítulo')?'selected':'' ?> >Sin Postítulo</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Pensionado</label></small>
                                                <div class="col-md-12">
                                                    <select class="form-control form-control-line" name="pensionado">
                                                        <option value="Si" <?php echo ($profile_data['pensionado']=='Si')?'selected':'' ?> >Si</option>
                                                        <option value="No" <?php echo ($profile_data['pensionado']=='No')?'selected':'' ?> >No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Reliquidado</label></small>
                                                <div class="col-md-12">
                                                    <select class="form-control form-control-line" name="reliquidado">
                                                        <option value="Si" <?php echo ($profile_data['reliquidado']=='Si')?'selected':'' ?> >Si</option>
                                                        <option value="No" <?php echo ($profile_data['reliquidado']=='No')?'selected':'' ?> >No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-success">Guardar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div> 
                                </div>
                                <div class="tab-pane fade" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="card-body">
                                        <div class="border p-3">
                                            <div id="editor2" contenteditable="true" class="inline-editor">
                                            <?php echo $profile_data['quien_soy'] ?>
                                            </div>
                                        </div>
                                        <hr>
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
    <script src="<?php echo base_url() ?>/assets/libs/ckeditor/ckeditor.js"></script>
</body>

</html>