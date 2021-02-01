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
                <!-- Row -->
                <div class="row">
                <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center mb-2">
                                    <h4 class="card-title"><b>Modulo:</b> <?php echo $cursos_info->titulo; ?></h4>
                                    
                                </div>
                                <div class="d-flex no-block align-items-center mb-2">
                                    Profesores:
                                </div>
                                <div class="d-flex no-block align-items-center mb-4">
                                    <div class="col-lg-6 col-xl-6 col-md-6">
                                        <div class="message-widget contact-widget">
                                            <?php if( $cursos_info->oid_profesor){ ?>
                                                <!-- Profesor -->
                                                <a href="#" class="py-3 px-2 border-bottom d-flex align-items-center text-decoration-none">
                                                    <!-- <div class="user-img position-relative d-inline-block mr-2"> <span class="round text-white d-inline-block text-center rounded-circle bg-info"><?php echo $cursos_info->nombres[0]; ?></span>
                                                        <span class="profile-status pull-right d-inline-block position-absolute bg-warning rounded-circle"></span>
                                                    </div> -->
                                                    <div class="user-img position-relative d-inline-block mr-2"> <img
                                                            src="<?php echo base_url(fotoPerfil($cursos_info->oid_profesor)); ?>" alt="user"
                                                            class="rounded-circle" width="45px" height="45px">
                                                    </div>

                                                    <div class="w-75 d-inline-block v-middle pl-2">
                                                        <h5 class="my-1"><?php echo $cursos_info->nombres . ', '.$cursos_info->apellidos; ?></h5> <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><?php echo $cursos_info->email;?></span>
                                                    </div>
                                                </a>
                                            <?php } if( $cursos_info->oid_profesor2){ ?>
                                                <!-- Profesor -->
                                                <a href="#" class="py-3 px-2 border-bottom d-flex align-items-center text-decoration-none">
                                                    <div class="user-img position-relative d-inline-block mr-2"> <img
                                                            src="<?php echo base_url(fotoPerfil($cursos_info->oid_profesor2)); ?>" alt="user"
                                                            class="rounded-circle" width="45px" height="45px">
                                                    </div>
                                                    <div class="w-75 d-inline-block v-middle pl-2">
                                                        <h5 class="my-1"><?php echo $cursos_info->nombres2 . ', '.$cursos_info->apellidos2; ?></h5> <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><?php echo $cursos_info->email2;?></span>
                                                    </div>
                                                </a>
                                            <?php } if( $cursos_info->oid_profesor3){ ?>
                                                <!-- Profesor -->
                                                <a href="#" class="py-3 px-2 border-bottom d-flex align-items-center text-decoration-none">
                                                    <div class="user-img position-relative d-inline-block mr-2"> <img
                                                            src="<?php echo base_url(fotoPerfil($cursos_info->oid_profesor3)); ?>" alt="user"
                                                            class="rounded-circle" width="45px" height="45px">
                                                    </div>
                                                    <div class="w-75 d-inline-block v-middle pl-2">
                                                        <h5 class="my-1"><?php echo $cursos_info->nombres3 . ', '.$cursos_info->apellidos3; ?></h5> <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><?php echo $cursos_info->email3;?></span>
                                                    </div>
                                                </a>
                                            <?php } if( $cursos_info->oid_profesor4){ ?>
                                                <!-- Profesor -->
                                                <a href="#" class="py-3 px-2 d-flex align-items-center text-decoration-none">
                                                    <div class="user-img position-relative d-inline-block mr-2"> <img
                                                            src="<?php echo base_url(fotoPerfil($cursos_info->oid_profesor4)); ?>" alt="user"
                                                            class="rounded-circle" width="45px" height="45px">
                                                    </div>
                                                    <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h5 class="my-1"><?php echo $cursos_info->nombres4 . ', '.$cursos_info->apellidos4; ?></h5> <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><?php echo $cursos_info->email4;?></span>
                                                    </div>
                                                </a>
                                            <?php } if( $cursos_info->oid_profesor5){ ?>
                                                <!-- Profesor -->
                                                <a href="#" class="py-3 px-2 d-flex align-items-center text-decoration-none">
                                                    <div class="user-img position-relative d-inline-block mr-2"> <img
                                                            src="<?php echo base_url(fotoPerfil($cursos_info->oid_profesor5)); ?>" alt="user"
                                                            class="rounded-circle" width="45px" height="45px">
                                                    </div>
                                                    <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h5 class="my-1"><?php echo $cursos_info->nombres5 . ', '.$cursos_info->apellidos5; ?></h5> <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><?php echo $cursos_info->email5;?></span>
                                                    </div>
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xl-6 col-md-6">
                                        <div class="message-widget contact-widget">
                                            <?php if( $cursos_info->oid_profesor6){ ?>
                                                <!-- Profesor -->
                                                <a href="#" class="py-3 px-2 border-bottom d-flex align-items-center text-decoration-none">
                                                    <div class="user-img position-relative d-inline-block mr-2"> <img
                                                            src="<?php echo base_url(fotoPerfil($cursos_info->oid_profesor6)); ?>" alt="user"
                                                            class="rounded-circle" width="45px" height="45px">
                                                    </div>
                                                    <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h5 class="my-1"><?php echo $cursos_info->nombres6 . ', '.$cursos_info->apellidos6; ?></h5> <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><?php echo $cursos_info->email6;?></span>
                                                    </div>
                                                </a>
                                            <?php } if( $cursos_info->oid_profesor7){ ?>
                                                <!-- Profesor -->
                                                <a href="#" class="py-3 px-2 border-bottom d-flex align-items-center text-decoration-none">
                                                    <div class="user-img position-relative d-inline-block mr-2"> <img
                                                            src="<?php echo base_url(fotoPerfil($cursos_info->oid_profesor7)); ?>" alt="user"
                                                            class="rounded-circle" width="45px" height="45px">
                                                    </div>
                                                    <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h5 class="my-1"><?php echo $cursos_info->nombres7 . ', '.$cursos_info->apellidos7; ?></h5> <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><?php echo $cursos_info->email7;?></span>
                                                    </div>
                                                </a>
                                            <?php } if( $cursos_info->oid_profesor8){ ?>
                                                <!-- Profesor -->
                                                <a href="#" class="py-3 px-2 border-bottom d-flex align-items-center text-decoration-none">
                                                    <div class="user-img position-relative d-inline-block mr-2"> <img
                                                            src="<?php echo base_url(fotoPerfil($cursos_info->oid_profesor8)); ?>" alt="user"
                                                            class="rounded-circle" width="45px" height="45px">
                                                    </div>
                                                    <div class="w-75 d-inline-block v-middle pl-2">
                                                        <h5 class="my-1"><?php echo $cursos_info->nombres8 . ', '.$cursos_info->apellidos8; ?></h5> <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><?php echo $cursos_info->email8;?></span>
                                                    </div>
                                                </a>
                                            <?php } if( $cursos_info->oid_profesor9){ ?>
                                                <!-- Profesor -->
                                                <a href="#" class="py-3 px-2 d-flex align-items-center text-decoration-none">
                                                    <div class="user-img position-relative d-inline-block mr-2"> <img
                                                            src="<?php echo base_url(fotoPerfil($cursos_info->oid_profesor9)); ?>" alt="user"
                                                            class="rounded-circle" width="45px" height="45px">
                                                    </div>
                                                    <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h5 class="my-1"><?php echo $cursos_info->nombres9 . ', '.$cursos_info->apellidos9; ?></h5> <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><?php echo $cursos_info->email9;?></span>
                                                    </div>
                                                </a>
                                            <?php } if( $cursos_info->oid_profesor10){ ?>
                                                <!-- Profesor -->
                                                <a href="#" class="py-3 px-2 d-flex align-items-center text-decoration-none">
                                                    <div class="user-img position-relative d-inline-block mr-2"> <img
                                                            src="<?php echo base_url(fotoPerfil($cursos_info->oid_profesor10)); ?>" alt="user"
                                                            class="rounded-circle" width="45px" height="45px">
                                                    </div>
                                                    <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h5 class="my-1"><?php echo $cursos_info->nombres10 . ', '.$cursos_info->apellidos10; ?></h5> <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><?php echo $cursos_info->email10;?></span>
                                                    </div>
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="table-responsive">
                                    <div class="dt-buttons">  
                                    <?  $session = session();
                                    if($session->menu['permisos']->rol != 'ALU'){ ?>        
                                        <a href="<?php echo base_url('public/cursos/asistencia/'.$oid_curso); ?>" class="btn btn-secondary waves-effect waves-light" type="button"><span class="btn-label"><i class="icon-user"></i></span>
                                            Asistencia</a>
                                        <a <? if(MostrarElemento(array('cursos/add_etiqueta'))){?> href="<?php echo base_url('public/cursos/add_etiqueta/'.$oid_curso); ?>"  <?}?> class="btn btn-success waves-effect waves-light"  type="button"><span class="btn-label"><i class="icon-tag"></i></span>
                                            Etiqueta</a>
                                        <a <? if(MostrarElemento(array('cursos/add_objeto_aprendizaje'))){?> href="<?php echo base_url('public/cursos/add_objeto_aprendizaje/'.$oid_curso); ?>" <?}?> class="btn btn-info waves-effect waves-light" type="button"><span class="btn-label"><i class="icon-book-open"></i></span>
                                            Objeto de Aprendizaje</a>
                                        <a <? if(MostrarElemento(array('cursos/add_evaluacion'))){?> href="<?php echo base_url('public/cursos/add_evaluacion/'.$oid_curso); ?>" <?}?> class="btn btn-primary waves-effect waves-light" type="button"><span class="btn-label"><i class="icon-list"></i></span>
                                            Evaluación</a>
                                        <a <? if(MostrarElemento(array('cursos/add_apuntes'))){?> href="<?php echo base_url('public/cursos/add_apuntes/'.$oid_curso); ?>" <?}?> class="btn btn-danger waves-effect waves-light" type="button"><span class="btn-label"><i class="icon-folder-alt"></i></span>
                                            Documento</a>
                                        <a <? if(MostrarElemento(array('cursos/add_pizarra'))){?> href="<?php echo base_url('public/cursos/add_pizarra/'.$oid_curso); ?>" <?}?>class="btn btn-warning waves-effect waves-light" type="button"><span class="btn-label"><i class="icon-frame"></i></span>
                                            Pizarra</a>
                                    <? } ?>
                                    </div>
                                    <br>
                                    <?php foreach ($cursos_ordenado as $value) { ?>
                                            <? if ($value['tipo'] == "PIZARRA") { ?>
                                                <div class="alert alert-light bg-light text-dark border-0" role="alert" style="margin-left: 40px; border-left: 3px solid #ffb22b !important;">
                                                    <h4 class="alert-heading"><i class="icon-frame" style="color: #ffb22b;"></i> <?=$value['titulo']?></h4>
                                                    <p><?=$value['texto']?></p>
                                                    <p class="mb-0">
                                                    <? if(MostrarElemento(array('cursos/edit_pizarra'))){?>
                                                    <button onclick="modalSwal('<?= $value['oid'] ?>', 'eliminarPizarra')" type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i> Eliminar</button>
                                                    <a href="<?php echo base_url('public/cursos/edit_pizarra/'.$oid_curso.'/'.$value['oid']); ?>" type="button" class="btn btn-success"><i class="fas fa-edit"></i> Editar</a>
                                                    <?}?>
                                                    </p>
                                                </div>
                                            <? }elseif ($value['tipo']=="APUNTES"){ ?>
                                                <div class="alert alert-light bg-light text-dark border-0" role="alert" style="margin-left: 40px;border-left: 3px solid #fc4b6c !important;">
                                                    <h4 class="alert-heading"><i class="icon-folder-alt" style="color: #fc4b6c;"></i> <?=$value['titulo']?></h4>
                                                    <p><b>Documento: <?=$value['archivo']?></p>
                                                    <p><?=$value['texto']?></p>
                                                    <hr>
                                                    <p class="mb-0">
                                                    <? if(MostrarElemento(array('cursos/edit_apuntes'))){?>
                                                    <a href="<?php echo base_url('public/cursos/edit_apuntes/'.$oid_curso.'/'.$value['oid']); ?>" type="button" class="btn btn-success"><i class="fas fa-edit"></i> Editar</a>
                                                    <?}?>
                                                    <a type="button" href="<?php echo base_url('assets/uploads/apuntes/'.$value['archivo']); ?>" class="btn btn-secondary" download><i class="fas fa-download"></i>
                                                    Descargar</a>
                                                    </p>
                                                </div>
                                            <? }elseif ($value['tipo'] == "EVALREG" || $value['tipo'] == "EVALTLI") { ?>
                                                <div class="alert alert-light bg-light text-dark border-0" role="alert" style="margin-left: 40px;border-left: 3px solid #7460ee !important;">
                                                    <h4 class="alert-heading"><i class="icon-list" style="color: #7460ee;"></i> <?=$value['titulo']?></h4>
                                                    <p><?=$value['texto']?></p>
                                                    <? if($value['ponderacion'] != '0'){ ?>
                                                        <p><b>Ponderación:</b> <?=$value['ponderacion']?>%</p>
                                                    <? } ?>

                                                    <?if (trim($value['nota']) != "") {
                                                        if ($cursos_info->escala == 0)
                                                            $value['nota'] = trim(sprintf("%3.1f", $value['nota']));
                                                        else
                                                            $value['nota'] = trim(sprintf("%3.0f", $value['nota']));
                                                    } else
                                                        $value['nota'] = "---";
                                                    ?>
                                                    <?  date_default_timezone_set('America/Santiago');
                                                        $fecha_actual = date('Y-m-d H:i:s');
                                                        if((($fecha_actual >= $value['finicio']) && ($fecha_actual <= $value['ftermino']))){ ?>
                                                        <?if($value['instrucciones']!=""){?>
                                                            <p><b>Instrucciones:</b> <a href="<?php echo base_url('assets/uploads/miscursos/evaluaciones/'.$value['instrucciones']); ?>" download><i class="icon-link"></i>
                                                                Descargar</a></p>
                                                        <?}?>
                                                    <? } ?>
                                                    <? if($session->menu['permisos']->rol == 'ALU'){ ?> 
                                                        <p><b>Nota:</b> <?=$value['nota']?></p>
                                                    <? } ?>

                                                    <?if ($value['cta_oid'] != "") { ?>
                                                        <p><b>Documento Recibido:</b> <?=$value['cta_archivo']?></p>
                                                        <p><b>Fecha Recepción:</b> <?=$value['cta_fecha']?></p>
                                                        <a href="<?php echo site_url('Cursos/descargarRespuesta/'.$value['cta_archivo']); ?>" title="Descargar" download>
                                                            <i class="fas fa-download"></i> Descargar 
                                                        </a>
                                                    <? }else{ ?>
                                                        <?  $session = session();
                                                        if($session->menu['permisos']->rol == 'ALU' && $value['tipo'] == 'EVALREG'){ ?>
                                                            <?  date_default_timezone_set('America/Santiago');
                                                                // $fecha_actual = date('Y-m-d H:i:s');
                                                                if((($fecha_actual >= $value['finicio']) && ($fecha_actual <= $value['ftermino'])) || ($value['es_formativa'])){ ?>
                                                                    <!-- <a href="" title="" class="attach-buttons-accesar obj1"> Acceder</a> -->

                                                                    <form class="pl-3 pr-3" action="<?php echo base_url('public/Cursos/subirRespuestaAlumno'); ?>" name="respuesta_alumno" id="respuesta_alumno" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                                                        <div class="form-group" hidden>
                                                                            <label for="grupo_id">curso_evaluacion_alumno</label>
                                                                            <input value="<?= $value['oid'] ?>" class="form-control" type="text" name="evaluacion" id="evaluacion" required="">
                                                                        </div>
                                                                        <div class="form-group" hidden>
                                                                            <label for="grupo_id">oid_grupo</label>
                                                                            <input value="<?= $cursos_info->oid ?>" class="form-control" type="text" name="cursos_info" id="cursos_info" required="">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="col-md-12">
                                                                                <div class="input-group">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text">Archivo</span>
                                                                                    </div>
                                                                                    <div class="custom-file">
                                                                                        <input type="file" class="custom-file-input" name="archivo" id="inputGroupFile01" accept="image/gif,image/jpeg,image/jpg,image/png,.doc,.docx,.xlsx,.xls,application/msword,application/pdf,application/vnd.ms-excel,application/vnd.ms-powerpoint" required>
                                                                                        <label class="custom-file-label" for="inputGroupFile01">Seleccionar archivo</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <button type="submit" class="btn btn-success" aria-label="">Enviar</button>
                                                                    </form>

                                                            <?  }else{
                                                                    if($fecha_actual > $value['ftermino']){
                                                                        #enviar correos y grabar en la base de datos
                                                                    } 
                                                                $session = session();
                                                            ?>
                                                                <a title="" class="attach-buttons-accesar" style="width: 95px;"> No disponible</a>
                                                            <? } ?>
                                                        <? } ?>
                                                        <? if($session->menu['permisos']->rol == 'ALU' && $value['tipo'] == 'EVALTLI'){ ?>
                                                            <p><b># de Accesos:</b> <?=$value['hits']?></p>
                                                            <p><b>Último Acceso:</b> <?=$value['fecha']?></p>
                                                            <?date_default_timezone_set('America/Santiago');
                                                            $fecha_actual = date('Y-m-d H:i:s');
                                                            if((($fecha_actual >= $value['finicio']) && ($fecha_actual <= $value['ftermino'])) || ($value['es_formativa'])){ ?>
                                                                <?if (trim($value['nota']) != "---") {?>
                                                                    <a title="" class="attach-buttons-accesar" style="width: 95px;"><i class="fas fa-cog"></i> No disponible, ya ha sido contestada</a>
                                                                <? }else{ ?>
                                                                    <a href="<?php echo site_url('Cursos/testTLIiniciar/'.$value['oid_test'].'/'.$value['oid'].'/'.$oid_curso); ?>" title="Acceder" >
                                                                        <i class="fas fa-cog"></i> Acceder 
                                                                    </a>
                                                                <? } ?>
                                                            <? }else{ ?>
                                                                <a title="" class="attach-buttons-accesar" style="width: 95px;"><i class="fas fa-cog"></i> No disponible</a>
                                                            <? } ?>
                                                        <? } ?>
                                                    <? } ?>
                                                    
                                                    <hr>

                                                    <!-- <? if($value['instrucciones']!=""){ ?> -->
                                                    <!-- <?//if( $uid_rol=="ALU" && $obj->tipo=="TLI" && $obj->disponible_test && ($obj->nota=="" || $obj->es_formativa) ){?>
                                                    <? } ?> -->

                                                    <p class="mb-0">
                                                        <? if(MostrarElemento(array('cursos/edit_evaluaciones'))){?>
                                                            <!-- <button onclick="eliminarEvaluacion('<?= $oid_curso ?>', '<?= $value['oid'] ?>')" type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i> Eliminar</button> -->
                                                            <button onclick="modalSwal('<?= $value['oid'] ?>', 'eliminarEvaluacion')" type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i> Eliminar</button>
                                                            <a href="<?php echo base_url('public/cursos/edit_evaluaciones/'.$oid_curso.'/'.$value['oid']); ?>" type="button" class="btn btn-info"><i class="fas fa-edit"></i> Editar</a>
                                                            <a href="<?php echo base_url('public/cursos/add_notas_evaluacion/'.$oid_curso.'/'.$value['oid']); ?>" type="button" class="btn btn-secondary"><i class="far fa-file-alt"></i> Notas</a>
                                                            <a href="#" type="button" class="btn btn-success"><i class="far fa-file-excel"></i> Exportar XLS</a>
                                                        <?}?>
                                                        
                                                        


                                                        <? if($value['archivo'] != ""){ ?>
                                                            <p><b>Retroalimentación</b> </p>
                                                            <a type="button" href="<?php echo base_url('assets/uploads/apuntes/'.$value['archivo']); ?>" class="btn btn-secondary" download><i class="fas fa-download"></i>
                                                            Descargar</a>
                                                        <? } ?>
                                                    </p>
                                                </div>
                                            <? }elseif ($value['tipo'] == "SCORM" || $value['tipo'] == "MICROSITIO") { ?>
                                                <div class="alert alert-light bg-light text-dark border-0" role="alert" style="margin-left: 40px; border-left: 3px solid #1e88e5 !important; ">
                                                    <h4 class="alert-heading"><i class="icon-book-open" style="color: #1e88e5;"></i> <?=$value['titulo']?></h4>
                                                    
                                                    <p><b>Objeto de aprendizaje:</b> <?=$value['ss_objeto']?></p>
                                                    <p><?=$value['texto']?></p>
                                                    <hr>
                                                    <p class="mb-0">
                                                    <? if(MostrarElemento(array('cursos/edit_objeto_aprendizaje'))){?>
                                                        <a href="<?php echo base_url('public/cursos/edit_objeto_aprendizaje/'.$oid_curso.'/'.$value['oid']); ?>" type="button" class="btn btn-success"><i class="fas fa-edit"></i> Editar</a>
                                                    <?}?>    
                                                    <button type="button" class="btn btn-secondary"><i class="fas fa-arrow-right"></i> Acceder</button>
                                                    </p>
                                                </div>
                                            <? }elseif ($value['tipo']=="ETIQUETA"){ ?>
                                            <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show"> <i class="icon-tag"></i> <a <? if(MostrarElemento(array('cursos/edit_etiqueta'))){?>href="<?php echo base_url('public/cursos/edit_etiqueta/'.$oid_curso.'/'.$value['oid']); ?>" <?}?> style="color:#fff;"><?=$value['titulo']?></a>
                                                <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button> -->
                                                
                                                </div>
                                            <? } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

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
                                        <button onclick="botonEliminar()" id="boton_eliminar" type="button" class="swal2-confirm swal2-styled" aria-label="">Eliminar</button>
                                        <button onclick="modalClose()" type="button" class="swal2-cancel swal2-styled" aria-label="">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal delete -->

                    </div>
                </div>
                <!-- Row -->
                <!-- Row -->
                <!-- Row -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- <div class="modal fade" id="createmodel" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <h5 class="modal-title" id="createModalLabel"><i class="ti-marker-alt mr-2"></i> Create
                                    New Contact</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info"><i
                                            class="ti-user text-white"></i></button>
                                    <input type="text" class="form-control" placeholder="Enter Name Here"
                                        aria-label="name">
                                </div>
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info"><i
                                            class="ti-more text-white"></i></button>
                                    <input type="text" class="form-control" placeholder="Enter Mobile Number Here"
                                        aria-label="no">
                                </div>
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info"><i
                                            class="ti-import text-white"></i></button>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose Image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success"><i class="ti-save"></i> Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> -->
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
    <!--Custom JavaScript -->
    <script src="<?php echo base_url() ?>/assets/libs/sweetalert2/dist/sweetalert2.all.js"></script>
    <script src="<?php echo base_url() ?>/assets/extra-libs/sweetalert2/sweet-alert.init.js"></script>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <?php echo view('dgac/scripts'); ?>
    <script src="<?php echo base_url() ?>/assets/libs/dragula/dist/dragula.min.js"></script>
    <script>
    $(function() {
        dragula([document.getElementById("draggable-area")]),
            dragula([document.getElementById("card-colors")]).on("drag", function(e) {
                e.className = e.className.replace("card-moved", "")
            }).on("drop", function(e) {
                e.className += " card-moved"
            }).on("over", function(e, t) {
                t.className += " card-over"
            }).on("out", function(e, t) {
                t.className = t.className.replace("card-over", "")
            }), dragula([document.getElementById("copy-left"), document.getElementById("copy-right")], {
                copy: !0
            }), dragula([document.getElementById("left-handles"), document.getElementById("right-handles")], {
                moves: function(e, t, n) {
                    return n.classList.contains("handle")
                }
            }), dragula([document.getElementById("left-titleHandles"), document.getElementById("right-titleHandles")], {
                moves: function(e, t, n) {
                    return n.classList.contains("titleArea")
                }
            })
    });

    function modalSwal(id_evaluacion, url){
        document.querySelector("#modalDelete #swal2-content").innerHTML = "¿Está seguro que quiere eliminar el elemento? <br>¡Esta acción no se puede deshacer!";
        document.querySelector("#modalDelete #boton_eliminar").onclick = function onclick(event) {
                    eliminarEvaluacion(id_evaluacion, url)
                };
        document.querySelector("#modalDelete").style.display = "block";
    }
    function modalClose(){
        // document.querySelector("#modalSuccess").style.display = "none";
        document.querySelector("#modalDelete").style.display = "none";
        // document.querySelector("#modalError").style.display = "none";
        // document.querySelector("#modalFeedback").style.display = "none";
    }

    function eliminarEvaluacion(id_evaluacion, url){
        var checked = {
            oid_evaluacion: id_evaluacion
        };

        var url = "<?php echo base_url('public/cursos/') ?>" + "/" + url;
        console.log(url, checked);
        $.post(url, checked, function(data, status){
            if (status){
                location.reload();
                // document.querySelector("#modalDelete").style.display = "none";
                // document.querySelector("#modalSuccess").style.display = "block";
            }else{
                console.log("ERROR");
            }
        });
    }

    </script>
</body>

</html>