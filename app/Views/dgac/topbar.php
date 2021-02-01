<?php $session = session(); ?>
<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-lg navbar-dark">
        <div class="navbar-header">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-lg-none" href="javascript:void(0)"><i
                    class="ti-menu ti-close"></i></a>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="<?php echo site_url('Home'); ?>">
                <!-- Logo icon -->
                <b class="logo-icon">
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <!-- <img src="<?php echo base_url() ?>/assets/images/logo-icon.png" alt="homepage" class="dark-logo" /> -->
                    <!-- Light Logo icon -->
                    <!-- <img src="<?php echo base_url() ?>/assets/images/logo-light-icon.png" alt="homepage" class="light-logo" /> -->
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span class="logo-text">
                    <!-- dark Logo text -->
                    <img src="<?php echo base_url() ?>/assets/images/logoETA.png" alt="homepage" class="dark-logo"  width="50"/>
                    <!-- Light Logo text -->
                    <img src="<?php echo base_url() ?>/assets/images/logoETA.png" class="light-logo" alt="homepage" width="50"/>
                </span>
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-lg-none waves-effect waves-light" href="javascript:void(0)"
                data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                    class="ti-more"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto float-left">
                <!-- This is  -->
                <!--   <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li> -->
                <!-- ============================================================== -->
                <!-- Search -->
                <!-- ============================================================== -->
                <!-- <li class="nav-item d-none d-md-block search-box"> <a
                        class="nav-link d-none d-md-block waves-effect waves-dark" href="javascript:void(0)"><i
                            class="ti-search"></i></a>
                    <form class="app-search">
                        <input type="text" class="form-control" placeholder="Search & enter"> 
                        <a class="srh-btn"><i class="ti-close"></i></a> 
                    </form>
                </li> -->
                <!-- ============================================================== -->
                <!-- Mega Menu -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown mega-dropdown" hidden> <a
                        class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-view-grid"></i></a>
                    <div class="dropdown-menu scale-up-left">
                        <ul class="mega-dropdown-menu row p-0 m-0 list-inline">
                            <li class="col-lg-3 col-xlg-2 mb-4">
                                <h4 class="mb-3">CAROUSEL</h4>
                                <!-- CAROUSEL -->
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner" role="listbox">
                                        <div class="carousel-item active">
                                            <div class="container"> <img class="d-block img-fluid"
                                                    src="<?php echo base_url() ?>/assets/images/big/img1.jpg" alt="First slide"></div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="container"><img class="d-block img-fluid"
                                                    src="<?php echo base_url() ?>/assets/images/big/img2.jpg" alt="Second slide">
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="container"><img class="d-block img-fluid"
                                                    src="<?php echo base_url() ?>/assets/images/big/img3.jpg" alt="Third slide"></div>
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleControls"
                                        role="button" data-slide="prev"> <span
                                            class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span> </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls"
                                        role="button" data-slide="next"> <span
                                            class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span> </a>
                                </div>
                                <!-- End CAROUSEL -->
                            </li>
                            <li class="col-lg-3 mb-4">
                                <h4 class="mb-3">ACCORDION</h4>
                                <!-- Accordian -->
                                <div id="accordion" class="nav-accordion" role="tablist"
                                    aria-multiselectable="true">
                                    <div class="card mb-1">
                                        <div class="card-header" role="tab" id="headingOne">
                                            <h5 class="mb-0">
                                                <a data-toggle="collapse" data-parent="#accordion"
                                                    href="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    Collapsible Group Item #1
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseOne" class="collapse show" role="tabpanel"
                                            aria-labelledby="headingOne">
                                            <div class="card-body"> Anim pariatur cliche reprehenderit, enim
                                                eiusmod high. </div>
                                        </div>
                                    </div>
                                    <div class="card mb-1">
                                        <div class="card-header" role="tab" id="headingTwo">
                                            <h5 class="mb-0">
                                                <a class="collapsed" data-toggle="collapse"
                                                    data-parent="#accordion" href="#collapseTwo"
                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                    Collapsible Group Item #2
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse" role="tabpanel"
                                            aria-labelledby="headingTwo">
                                            <div class="card-body"> Anim pariatur cliche reprehenderit, enim
                                                eiusmod high life accusamus terry richardson ad squid. </div>
                                        </div>
                                    </div>
                                    <div class="card mb-0">
                                        <div class="card-header" role="tab" id="headingThree">
                                            <h5 class="mb-0">
                                                <a class="collapsed" data-toggle="collapse"
                                                    data-parent="#accordion" href="#collapseThree"
                                                    aria-expanded="false" aria-controls="collapseThree">
                                                    Collapsible Group Item #3
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseThree" class="collapse" role="tabpanel"
                                            aria-labelledby="headingThree">
                                            <div class="card-body"> Anim pariatur cliche reprehenderit, enim
                                                eiusmod high life accusamus terry richardson ad squid. </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-lg-3  mb-4">
                                <h4 class="mb-3">CONTACT US</h4>
                                <!-- Contact -->
                                <form>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="exampleInputname1"
                                            placeholder="Enter Name"> </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" id="exampleTextarea" rows="3"
                                            placeholder="Message"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-info">Submit</button>
                                </form>
                            </li>
                            <li class="col-lg-3 col-xlg-4 mb-4">
                                <h4 class="mb-3">List style</h4>
                                <!-- List style -->
                                <ul class="list-style-none">
                                    <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
                                            You can give link</a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
                                            Give link</a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
                                            Another Give link</a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
                                            Forth link</a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
                                            Another fifth link</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- End Mega Menu -->
                <!-- ============================================================== -->
            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-right">
                <!-- ============================================================== -->
                <!-- Comment -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- End Comment -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Messages -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- End Messages -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Profile -->
                <!-- ============================================================== -->

                <?php if( isset($session->user_id) ){ ?>
                    <?=generarNotificaciones($session->grupo_id,$session->user_id)?>
                    <?=generarNotificacionesCorreo($session->grupo_id,$session->user_id)?>
                    
                    

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <img src="<?php echo base_url(fotoPerfil($session->user_id)); ?>" alt="user" width="35" class="profile-pic rounded-circle" />
                        </a>
                        <div class="dropdown-menu mailbox dropdown-menu-right scale-up">
                            <ul class="dropdown-user list-style-none">
                                <li>
                                    <div class="dw-user-box p-3 d-flex">
                                        <div class="u-img"><img src="<?php echo base_url(fotoPerfil($session->user_id)); ?>" alt="user" class="rounded" width="80"></div>
                                        <div class="u-text ml-2">
                                            <h4 class="mb-0"><?php echo NombrePerfil($session->user_id); ?> </h4>
                                            <!-- <p class="text-muted mb-1 font-14"><?php echo $profile_data['email'] ?></p> -->
                                            <a href="<?php echo site_url('Profile'); ?>" class="btn btn-rounded btn-danger btn-sm text-white d-inline-block">
                                                Ver Perfil</a>
                                        </div>
                                    </div>
                                </li>
                                <li role="separator" class="dropdown-divider"></li>
                                <li class="user-list"><a class="px-3 py-2" href="<?php echo site_url('Profile'); ?>"><i class="ti-user"></i> Mi Perfil</a></li>
                                <li class="user-list"><a class="px-3 py-2" href="<?php echo site_url('comunidad'); ?>"><i class="ti-wallet"></i> Mis Comunidades</a></li>
                                <? if(MostrarElemento(array('Profile/administracion'))){?><li class="user-list"><a class="px-3 py-2" href="<?php echo site_url('Profile/administracion'); ?>"><i class="ti-settings"></i> Administración</a></li><?}?>
                                <li role="separator" class="dropdown-divider"></li>
                                <li class="user-list"><a class="px-3 py-2" href="<?php echo base_url('public/Mensajeria/inbox') ?>"><i class="ti-email"></i> Mis mensajes</a></li>
                                <li role="separator" class="dropdown-divider"></li>
                                <li class="user-list"><a class="px-3 py-2" href="<?php echo base_url('public/Usuario/cerrar') ?>"><i class="fa fa-power-off"></i> Salir</a></li>
                            </ul>
                        </div>
                    </li>
                <?php }else{ ?>
                    <li class="user-list"><a style="color: #FFF;" class="px-3 py-2" href="<?php echo base_url('public/login') ?>"><i class="fa fa-power-off"></i> Iniciar</a></li>
                <?php } ?>
                <!-- ============================================================== -->
                <!-- Language -->
                <!-- ============================================================== -->
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href=""
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                            class="flag-icon flag-icon-cl"></i></a>
                    <div class="dropdown-menu dropdown-menu-right scale-up"> <a class="dropdown-item"
                            href="#"><i class="flag-icon flag-icon-us"></i> Inglés</a> <a class="dropdown-item"
                            href="#"><i class="flag-icon flag-icon-fr"></i> French</a> <a class="dropdown-item"
                            href="#"><i class="flag-icon flag-icon-cn"></i> China</a> <a class="dropdown-item"
                            href="#"><i class="flag-icon flag-icon-de"></i> Dutch</a> </div>
                </li> -->
            </ul>
        </div>
    </nav>
</header>