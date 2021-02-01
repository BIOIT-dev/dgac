<?php
    if( isset($_COOKIE['userid']) && isset($_COOKIE['password']) ){
        $userid   = $_COOKIE['userid'];
        $password = $_COOKIE['password'];
    }else{
        $userid   = '';
        $password = '';
    }
?>
<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>/assets/images/favicon-dgac.ico">
    <title>Inicio de Sesión - Sistema DGAC</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/monsteradmin/" />
    <!-- Custom CSS -->
    <link href="<?php echo base_url() ?>/assets/dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(<?php echo base_url() ?>/assets/images/background/login-back-dgac.jpg) no-repeat center center; background-size: cover;">
            <div class="auth-box on-sidebar p-4 bg-white m-0">
                <div id="loginform">
                    <div class="logo text-center">
                        <span class="db">
                            <!-- <img src="<?php echo base_url() ?>/assets/images/logo-icon.png" alt="logo" /><br/> -->
                            <img src="<?php echo base_url() ?>/assets/images/logoETA.png" alt="Home" /></span>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                                <?php 
                                    if( isset($mensaje_servidor) ){
                                        echo '<div class="alert alert-danger">';
                                            echo $mensaje_servidor;
                                        echo '</div>';
                                    }
                                ?>
                            <form method="POST" class="form-horizontal mt-3 form-material" id="loginform" action="<?php echo base_url('public/Usuario/iniciar_login'); ?>">
                                <div class="form-group mb-3">
                                    <div class="col-xs-12">
                                        <input class="form-control" id="userid" name="userid" type="text" required="" placeholder="Usuario" value="<?php echo $userid; ?>"> </div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="col-xs-12">
                                        <input class="form-control" id="clave" name="clave" type="password" required="" placeholder="Contraseña" value="<?php echo $password; ?>"> </div>
                                </div>
                                <div class="form-group">
                                    <div class="d-flex">
                                        <div class="checkbox checkbox-info float-left pt-0">
                                            <input id="checkbox-signup" name="checkbox-signup" type="checkbox" class="material-inputs chk-col-indigo" value="1">
                                            <label for="checkbox-signup"> Recuérdame </label>
                                        </div> 
                                        <div class="ml-auto">
                                            <a id="to-recover" class="text-muted float-right"><i class="fa fa-lock mr-1"></i> Olvidaste Contraseña?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center mt-3">
                                    <div class="col-xs-12">
                                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Ingresar</button>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 mt-2 text-center">
                                        <div class="social mb-3">
                                            <a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip" title="Login with Facebook"> <i aria-hidden="true" class="fab fa-facebook-f"></i> </a>
                                            <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip" title="Login with Google"> <i aria-hidden="true" class="fab fa-google-plus"></i> </a>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="form-group mb-0">
                                    <div class="col-sm-12 justify-content-center d-flex">
                                        <p>No tienes cuenta? <a href="authentication-register1.html" class="text-info font-weight-normal ml-1">Crear una</a></p>
                                    </div>
                                </div> -->
                            </form>
                        </div>
                    </div>
                </div>
                <div id="recoverform">
                    <div class="logo">
                        <h3 class="font-weight-medium mb-3">Recuperar Contraseña</h3>
                        <span>Ingresa tu correo electrónico y te enviaremos las instrucciones para cambiar tu contraseña.</span>
                    </div>
                    <div class="row mt-3">
                        <!-- Form -->
                        <form class="col-12 form-material" method="POST" action="<?php echo base_url('public/Usuario/recover_user'); ?>">
                            <!-- email -->
                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" type="email" name="email_user" required="" placeholder="Correo electrónico" value="jesusgerard2008@gmail.com">
                                </div>
                            </div>
                            <!-- pwd -->
                            <div class="row mt-3">
                                <div class="col-12">                                   
                                    <button class="btn btn-block btn-lg btn-primary text-uppercase" type="submit" name="action">Recuperar</button>
                                </div>
                            </div>
                        </form>
                        <!-- <button id="to-login" class="btn btn-block btn-lg btn-primary text-uppercase" name="action">Volver</button> -->
                    </div>
                </div>
                <div id="recoverusers" style="display: none;">
                    <div class="logo">
                        <h3 class="font-weight-medium mb-3">Cambiar Contraseña</h3>
                    </div>
                    <div class="row mt-3">
                        <!-- Form -->
                        <form class="col-12 form-material" method="POST" action="<?php echo base_url('public/Usuario/change_password'); ?>">
                            <!-- email -->
                            <div class="form-group row">
                                <div class="col-12">
                                    <input type="hidden" name="email_user" value="<?php if( isset($_GET['email_user']) ){ echo $_GET['email_user']; } ?>">
                                    <input class="form-control" type="password" name="password_one" required="" placeholder="Contraseña">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" type="password" name="password_two" required="" placeholder="Repita de nuevo su contraseña">
                                </div>
                            </div>
                            <!-- pwd -->
                            <div class="row mt-3">
                                <div class="col-12">                                   
                                    <button class="btn btn-block btn-lg btn-primary text-uppercase" type="submit" name="action">Cambiar contraseña</button>
                                </div>
                            </div>
                        </form>
                        <!-- <button id="to-login" class="btn btn-block btn-lg btn-primary text-uppercase" name="action">Volver</button> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url() ?>/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url() ?>/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();

    var token = '<?php if( isset($_GET['token']) ){ echo $_GET['token']; } ?>';
    if( token != "" ){
        $("#loginform").slideUp();
        $("#recoverform").slideUp();
        $("#recoverusers").fadeIn();
    }

    // ============================================================== 
    // Login and Recover Password 
    // ============================================================== 
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });

    // $('#to-login').on("click", function() {
    //     $("#recoverform").fadeOut();
    //     $("#loginform").fadeIn();
    //     $(".preloader").fadeOut();
        
    // });
    </script>
</body>

</html>