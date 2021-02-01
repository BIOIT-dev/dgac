<?php $session = session(); ?>
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
                                <div class="d-flex no-block align-items-center mb-4">
                                    <h4 class="card-title">Mis módulos de aprendizaje 
                                    </h4>
                                    <? if(MostrarElemento(array('cursos/add'))){?>
                                    <div class="ml-auto">
                                        <div class="btn-group">
                                            <a class="btn btn-dark" href="<?php echo base_url('public/cursos/add'); ?>">
                                                Crear nuevo módulo
                                            </a>
                                        </div>
                                    </div>
                                    <?}?>
                                </div>
                                <div class="table-responsive">
                                    
                                    <div class="dt-buttons">   
                                        <? if(MostrarElemento(array('cursos/promedio_notas'))){?>       
                                        <button class="dt-button buttons-html5 btn btn-primary mr-1" ><span>Informe Asistencia</span>
                                        </button>
                                        <?}?>
                                        <? if(MostrarElemento(array('cursos/promedio_notas'))){?>
                                        <button class="dt-button buttons-html5 btn btn-primary mr-1" ><span>Informe de notas</span>
                                        </button> 
                                        <?}?>
                                        <? if(MostrarElemento(array('cursos/promedio_notas'))){?>
                                        <a class="dt-button buttons-html5 btn btn-primary mr-1" href="<?php echo base_url('public/cursos/promedio_notas/'); ?>"><span>Promedio de Notas</span>
                                        </a> 
                                        <?}?>
                                    </div>
                                    
                                    <?php foreach ($cursos as $key => $value) { ?>
                                        <? if($value->inactivo && $session->menu['permisos']->rol == 'ALU'){ 
                                            continue; ?>
                                        <? }else{?>
                                            <div class="list-group mt-4">
                                                <a class="list-group-item active" href="<?php echo base_url('public/cursos/curso_detalle/'.$value->oid); ?>">
                                                    <i class="ti-layers mr-2"></i> <?php echo $value->titulo; ?>
                                                </a>
                                                <a class="list-group-item"><i class="ti-bookmark mr-2"></i>
                                                    <?php echo $value->descripcion; ?>
                                                    <? if($value->inactivo){ ?>
                                                    <hr>
                                                        <label class="badge badge-pill badge-danger">Este módulo está inactivo</label>
                                                    <? } ?>
                                                </a>
                                                
                                                <? if(MostrarElemento(array('cursos/edit_curso'))){ ?>
                                                    <div class="dt-buttons" style="margin-top:5px;">
                                                        <a href="<?php echo base_url('public/cursos/edit_curso/'.$value->oid); ?>" type="button" class="btn btn-success"><i class="fa fa-edit"></i> Editar</a>
                                                        
                                                    </div>
                                                <?}?>
                                                <?php if( $value->oid_profesor || $value->oid_profesor2 || $value->oid_profesor3 || $value->oid_profesor4 || $value->oid_profesor5 || $value->oid_profesor6 || $value->oid_profesor7 || $value->oid_profesor8 || $value->oid_profesor9 || $value->oid_profesor10 ){?>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="timeline-heading">
                                                                <h4 class="timeline-title" style="text-align: center;margin-top: 10px;">Profesores</h4>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-xl-6 col-md-6">
                                                            <div class="message-widget contact-widget">
                                                                <?php if( $value->oid_profesor){ ?>
                                                                    <!-- Profesor -->
                                                                    <a href="#" class="py-3 px-2 border-bottom d-flex align-items-center text-decoration-none">
                                                                        <!-- <div class="user-img position-relative d-inline-block mr-2"> <span class="round text-white d-inline-block text-center rounded-circle bg-info"><?php echo $value->nombres[0]; ?></span>
                                                                            <span class="profile-status pull-right d-inline-block position-absolute bg-warning rounded-circle"></span>
                                                                        </div> -->
                                                                        <div class="user-img position-relative d-inline-block mr-2"> <img
                                                                                src="<?php echo base_url(fotoPerfil($value->oid_profesor)); ?>" alt="user"
                                                                                class="rounded-circle" width="45px" height="45px">
                                                                        </div>
                                                                        <div class="w-75 d-inline-block v-middle pl-2">
                                                                            <h5 class="my-1"><?php echo $value->nombres . ', '.$value->apellidos; ?></h5> <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><?php echo $value->email;?></span>
                                                                        </div>
                                                                    </a>
                                                                <?php } if( $value->oid_profesor2){ ?>
                                                                    <!-- Profesor -->
                                                                    <a href="#" class="py-3 px-2 border-bottom d-flex align-items-center text-decoration-none">
                                                                        <div class="user-img position-relative d-inline-block mr-2"> <img
                                                                                src="<?php echo base_url(fotoPerfil($value->oid_profesor2)); ?>" alt="user"
                                                                                class="rounded-circle" width="45px" height="45px">
                                                                        </div>
                                                                        <div class="w-75 d-inline-block v-middle pl-2">
                                                                            <h5 class="my-1"><?php echo $value->nombres2 . ', '.$value->apellidos2; ?></h5> <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><?php echo $value->email2;?></span>
                                                                        </div>
                                                                    </a>
                                                                <?php } if( $value->oid_profesor3){ ?>
                                                                    <!-- Profesor -->
                                                                    <a href="#" class="py-3 px-2 border-bottom d-flex align-items-center text-decoration-none">
                                                                        <div class="user-img position-relative d-inline-block mr-2"> <img
                                                                                src="<?php echo base_url(fotoPerfil($value->oid_profesor3)); ?>" alt="user"
                                                                                class="rounded-circle" width="45px" height="45px">
                                                                        </div>
                                                                        <div class="w-75 d-inline-block v-middle pl-2">
                                                                            <h5 class="my-1"><?php echo $value->nombres3 . ', '.$value->apellidos3; ?></h5> <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><?php echo $value->email3;?></span>
                                                                        </div>
                                                                    </a>
                                                                <?php } if( $value->oid_profesor4){ ?>
                                                                    <!-- Profesor -->
                                                                    <a href="#" class="py-3 px-2 d-flex align-items-center text-decoration-none">
                                                                        <div class="user-img position-relative d-inline-block mr-2"> <img
                                                                                src="<?php echo base_url(fotoPerfil($value->oid_profesor4)); ?>" alt="user"
                                                                                class="rounded-circle" width="45px" height="45px">
                                                                        </div>
                                                                        <div class="w-75 d-inline-block v-middle pl-2">
                                                                        <h5 class="my-1"><?php echo $value->nombres4 . ', '.$value->apellidos4; ?></h5> <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><?php echo $value->email4;?></span>
                                                                        </div>
                                                                    </a>
                                                                <?php } if( $value->oid_profesor5){ ?>
                                                                    <!-- Profesor -->
                                                                    <a href="#" class="py-3 px-2 d-flex align-items-center text-decoration-none">
                                                                        <div class="user-img position-relative d-inline-block mr-2"> <img
                                                                                src="<?php echo base_url(fotoPerfil($value->oid_profesor5)); ?>" alt="user"
                                                                                class="rounded-circle" width="45px" height="45px">
                                                                        </div>
                                                                        <div class="w-75 d-inline-block v-middle pl-2">
                                                                        <h5 class="my-1"><?php echo $value->nombres5 . ', '.$value->apellidos5; ?></h5> <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><?php echo $value->email5;?></span>
                                                                        </div>
                                                                    </a>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-xl-6 col-md-6">
                                                            <div class="message-widget contact-widget">
                                                                <?php if( $value->oid_profesor6){ ?>
                                                                    <!-- Profesor -->
                                                                    <a href="#" class="py-3 px-2 border-bottom d-flex align-items-center text-decoration-none">
                                                                        <div class="user-img position-relative d-inline-block mr-2"> <img
                                                                                    src="<?php echo base_url(fotoPerfil($value->oid_profesor6)); ?>" alt="user"
                                                                                    class="rounded-circle" width="45px" height="45px">
                                                                            </div>
                                                                        <div class="w-75 d-inline-block v-middle pl-2">
                                                                        <h5 class="my-1"><?php echo $value->nombres6 . ', '.$value->apellidos6; ?></h5> <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><?php echo $value->email6;?></span>
                                                                        </div>
                                                                    </a>
                                                                <?php } if( $value->oid_profesor7){ ?>
                                                                    <!-- Profesor -->
                                                                    <a href="#" class="py-3 px-2 border-bottom d-flex align-items-center text-decoration-none">
                                                                        <div class="user-img position-relative d-inline-block mr-2"> <img
                                                                                src="<?php echo base_url(fotoPerfil($value->oid_profesor7)); ?>" alt="user"
                                                                                class="rounded-circle" width="45px" height="45px">
                                                                        </div>
                                                                        <div class="w-75 d-inline-block v-middle pl-2">
                                                                        <h5 class="my-1"><?php echo $value->nombres7 . ', '.$value->apellidos7; ?></h5> <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><?php echo $value->email7;?></span>
                                                                        </div>
                                                                    </a>
                                                                <?php } if( $value->oid_profesor8){ ?>
                                                                    <!-- Profesor -->
                                                                    <a href="#" class="py-3 px-2 border-bottom d-flex align-items-center text-decoration-none">
                                                                        <div class="user-img position-relative d-inline-block mr-2"> <img
                                                                                    src="<?php echo base_url(fotoPerfil($value->oid_profesor8)); ?>" alt="user"
                                                                                    class="rounded-circle" width="45px" height="45px">
                                                                            </div>
                                                                        <div class="w-75 d-inline-block v-middle pl-2">
                                                                            <h5 class="my-1"><?php echo $value->nombres8 . ', '.$value->apellidos8; ?></h5> <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><?php echo $value->email8;?></span>
                                                                        </div>
                                                                    </a>
                                                                <?php } if( $value->oid_profesor9){ ?>
                                                                    <!-- Profesor -->
                                                                    <a href="#" class="py-3 px-2 d-flex align-items-center text-decoration-none">
                                                                        <div class="user-img position-relative d-inline-block mr-2"> <img
                                                                                    src="<?php echo base_url(fotoPerfil($value->oid_profesor9)); ?>" alt="user"
                                                                                    class="rounded-circle" width="45px" height="45px">
                                                                            </div>
                                                                        <div class="w-75 d-inline-block v-middle pl-2">
                                                                        <h5 class="my-1"><?php echo $value->nombres9 . ', '.$value->apellidos9; ?></h5> <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><?php echo $value->email9;?></span>
                                                                        </div>
                                                                    </a>
                                                                <?php } if( $value->oid_profesor10){ ?>
                                                                    <!-- Profesor -->
                                                                    <a href="#" class="py-3 px-2 d-flex align-items-center text-decoration-none">
                                                                        <div class="user-img position-relative d-inline-block mr-2"> <img
                                                                                    src="<?php echo base_url(fotoPerfil($value->oid_profesor10)); ?>" alt="user"
                                                                                    class="rounded-circle" width="45px" height="45px">
                                                                            </div>
                                                                        <div class="w-75 d-inline-block v-middle pl-2">
                                                                        <h5 class="my-1"><?php echo $value->nombres10 . ', '.$value->apellidos10; ?></h5> <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><?php echo $value->email10;?></span>
                                                                        </div>
                                                                    </a>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                <?php }?>
                                                
                                            </div>
                                            
                                        <? } ?>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
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
</body>

</html>