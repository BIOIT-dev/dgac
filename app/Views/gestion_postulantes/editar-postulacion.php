<?php //echo view('dgac/headers'); ?>
<?php echo $headers['headersView']; ?>

<!-- This Page CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/libs/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css">
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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Postular a: <?php echo $profile_data_edit['nombre'] ?></h4>
                            </div>
                            <hr>
                            <form class="form-horizontal">
                                <div class="card-body">
                                    <h4 class="card-title">Datos Personales</h4>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="fname2" class="col-sm-3 text-right control-label col-form-label">RUT</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="fname2" placeholder="" value="<?php echo $info_postulacion['rut'] ?>" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="lname2" class="col-sm-3 text-right control-label col-form-label">Nombres</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="lname2" placeholder="Last Name Here" value="<?php echo $info_postulacion['nombres'] ?>" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="uname1" class="col-sm-3 text-right control-label col-form-label">A. Paterno</label>
                                                <div class="col-sm-9">
                                                    <input type="email" class="form-control" id="uname1" placeholder="Username Here" value="<?php echo $info_postulacion['apellido_paterno'] ?>" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="nname" class="col-sm-3 text-right control-label col-form-label">A. Materno</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="nname" placeholder="Nick Name Here" value="<?php echo $info_postulacion['apellido_materno'] ?>" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="uname1" class="col-sm-3 text-right control-label col-form-label">Sexo</label>
                                                <div class="col-sm-9">
                                                    <?php ($info_postulacion['sexo']=='f' ? $sexo_usuario='Femenino': $sexo_usuario='') ?>
                                                    <?php ($info_postulacion['sexo']=='m' ? $sexo_usuario='Masculino': $sexo_usuario=$sexo_usuario) ?>
                                                    <input type="email" class="form-control" id="uname1" placeholder="Username Here" value="<?php echo $sexo_usuario ?>" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="nname" class="col-sm-3 text-right control-label col-form-label">Fech. Nac</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="nname" placeholder="Nick Name Here" value="<?php echo $info_postulacion['fecnac'] ?>" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="ciudad" class="col-sm-3 text-right control-label col-form-label">Región</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="ciudad" value="<?php echo $info_postulacion['ciudad'] ?>" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="nname" class="col-sm-3 text-right control-label col-form-label">Comuna</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="nname" placeholder="Nick Name Here" value="<?php echo $info_postulacion['comuna'] ?>" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="uname1" class="col-sm-3 text-right control-label col-form-label">Dirección</label>
                                                <div class="col-sm-9">
                                                    <input type="email" class="form-control" id="uname1" placeholder="Username Here" value="<?php echo $info_postulacion['direccion'] ?>" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="nname" class="col-sm-3 text-right control-label col-form-label">Teléfono</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="nname" placeholder="Nick Name Here" value="<?php echo $info_postulacion['fono'] ?>" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="uname1" class="col-sm-3 text-right control-label col-form-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="email" class="form-control" id="uname1" placeholder="Username Here" value="<?php echo $info_postulacion['email'] ?>" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="nname" class="col-sm-3 text-right control-label col-form-label">Sede</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="nname" placeholder="Nick Name Here" value="<?php echo $info_postulacion['sede_nombre'] ?>" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <hr>
                                <div class="card-body">
                                    <div class="form-group mb-0 text-right">
                                        <button type="submit" class="btn btn-info waves-effect waves-light">Guardar</button>
                                    </div>
                                </div> -->
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Puntajes</h4>
                                <form action="<?php echo base_url('public/gestionPostulantes/editarPuntajes/'.$id_grupo.'/'.$id_postulacion); ?>" name="editar_nem" id="editar_nem" method="post" accept-charset="utf-8" class="form-horizontal pt-3">
                                    <div class="form-group row">
                                        <label for="post_mat" class="col-sm-3 control-label">Matemática</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="post_mat" name="post_mat" value="<?php echo $info_postulacion['post_mat'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="post_len" class="col-sm-3 control-label">Lenguaje</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="post_len" name="post_len" value="<?php echo $info_postulacion['post_len'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="post_nem" class="col-sm-3 control-label">NEM</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="post_nem" name="post_nem" value="<?php echo $info_postulacion['post_nem'] ?>">
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
                        </div>
                    </div>
                    <div class="col-lg-6">
                    <div class="card bg-info">
                            <div class="card-body">
                                <div class="text-center text-white">
                                    <h4 class="card-title text-white">PUNTAJE PONDERADO</h4>
                                    <h5 class="font-weight-light text-white">-</h5>
                                    <div class="mt-4">
                                        <!-- <span class="display-5 text-white"><i class="wi wi-day-rain-mix"></i></span> -->
                                        <div class="d-inline-block mt-5">
                                            <h1 class="text-white"><?= ($info_postulacion['post_mat']*($profile_data_edit['grup_mat']/100))+($info_postulacion['post_len']*($profile_data_edit['grup_len']/100))+($info_postulacion['post_nem']*($profile_data_edit['grup_nem']/100)) ?></h1>
                                            <h4 class="font-weight-light text-white">PUNTOS</h4>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="row text-center">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Comprobantes</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table name="tabla_comprobantes" id="tabla_comprobantes" class="table table-striped table-bordered display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Archivo</th>
                                                <th scope="col">Tipo</th>
                                                <th scope="col">Acción</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Archivo</th>
                                                <th scope="col">Tipo</th>
                                                <th scope="col">Acción</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Exámenes</h4>
                            </div>
                            <!-- Tabs -->
                            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-evaluados-tab" data-toggle="pill" href="#evaluados-tab-table" role="tab" aria-controls="pills-timeline" aria-selected="true">Evaluados</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-pendientes-tab" data-toggle="pill" href="#pendientes-tab-table" role="tab" aria-controls="pills-profile" aria-selected="false">Pendientes</a>
                                </li>
                            </ul>
                            <!-- Tabs -->
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="evaluados-tab-table" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="card-body">
                                        <!-- Start table -->
                                        <div class="table-responsive">
                                            <table name="tabla_examenes" id="tabla_examenes" class="table table-striped table-bordered display" style="width:100%">
                                                <!-- <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm m-1 ml-0"
                                                                    onclick='modalSwal("tabla_borrador")'>Eliminar Borrador</button>
                                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm m-1 ml-0"
                                                                    onclick="location.href='<?php //echo site_url('progPresencial/agregar_profesor/'.$profile_data_edit['oid']); ?>'">Agregar Profesor</button> -->
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Exámen</th>
                                                        <th scope="col">Respuesta</th>
                                                        <th scope="col">Comentario</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Exámen</th>
                                                        <th scope="col">Respuesta</th>
                                                        <th scope="col">Comentario</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- End table -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pendientes-tab-table" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="card-body">
                                        <!-- Start table -->
                                        <div class="table-responsive">
                                            <table name="tabla_pendientes" id="tabla_pendientes" class="table table-striped table-bordered display" style="width:100%">
                                                <!-- <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm m-1 ml-0"
                                                                    onclick='modalSwal("tabla_enviadas")'>Eliminar Profesor</button>
                                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm m-1 ml-0"
                                                                    onclick="location.href='<?php //echo site_url('progPresencial/agregar_profesor/'.$profile_data_edit['oid']); ?>'">Agregar Profesor</button> -->
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Exámen</th>
                                                        <th scope="col">Respuesta</th>
                                                        <th scope="col">Comentario</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Exámen</th>
                                                        <th scope="col">Respuesta</th>
                                                        <th scope="col">Comentario</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- End table -->
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
                                                <button id="botonEliminar" onclick="botonEliminar('tabla_borrador')" type="button" class="swal2-confirm swal2-styled" aria-label="">Eliminar</button>
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
                                                <!-- Mensaje contenido -->
                                            </div>
                                            <div class="swal2-actions" style="display: flex;">
                                                <button onclick="modalClose()" type="button" class="swal2-confirm swal2-styled" aria-label="">OK</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal error -->
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- Row -->
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Estados de la Postulación</h4>
                                <hr>
                                <?php if($info_postulacion['oid_poes']=='0'){ ?>
                                    <div class="input-group mb-3 col-lg-6">
                                        <input type="text" class="form-control" placeholder="Aceptar" disabled>
                                        <div class="input-group-append">
                                            <button onClick="cambiarEstadoPostulacion('1')" class="btn btn-success" type="button">Enviada</button>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3 col-lg-6">
                                        <input type="text" class="form-control" placeholder="Próximo" disabled>
                                        <div class="input-group-append">
                                            <button class="btn btn-warning" type="button" disabled>Preseleccionado 1era etapa</button>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if($info_postulacion['oid_poes']=='1'){ ?>
                                    <div class="input-group mb-3 col-lg-6">
                                        <input type="text" class="form-control" placeholder="Actual" disabled>
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button" disabled>Enviada</button>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3 col-lg-6">
                                        <input type="text" class="form-control" placeholder="Aceptar" disabled>
                                        <div class="input-group-append">
                                            <button onClick="cambiarEstadoPostulacion('2')" class="btn btn-success" type="button">Preseleccionado 1era etapa</button>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3 col-lg-6">
                                        <input type="text" class="form-control" placeholder="Próximo" disabled>
                                        <div class="input-group-append">
                                            <button class="btn btn-warning" type="button" disabled>Preseleccionado 2da etapa</button>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if($info_postulacion['oid_poes']=='2'){ ?>
                                    <div class="input-group mb-3 col-lg-6">
                                        <input type="text" class="form-control" placeholder="Actual" disabled>
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button" disabled>Preseleccionado 1era etapa</button>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3 col-lg-6">
                                        <input type="text" class="form-control" placeholder="Aceptar" disabled>
                                        <div class="input-group-append">
                                            <button onClick="cambiarEstadoPostulacion('3')" class="btn btn-success" type="button">Preseleccionado 2da etapa</button>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3 col-lg-6">
                                        <input type="text" class="form-control" placeholder="Próximo" disabled>
                                        <div class="input-group-append">
                                            <button class="btn btn-warning" type="button" disabled>Preseleccionado 3era etapa</button>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if($info_postulacion['oid_poes']=='3'){ ?>
                                    <div class="input-group mb-3 col-lg-6">
                                        <input type="text" class="form-control" placeholder="Actual" disabled>
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button" disabled>Preseleccionado 2da etapa</button>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3 col-lg-6">
                                        <input type="text" class="form-control" placeholder="Aceptar" disabled>
                                        <div class="input-group-append">
                                            <button onClick="cambiarEstadoPostulacion('4')" class="btn btn-success" type="button">Preseleccionado 3era etapa</button>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3 col-lg-6">
                                        <input type="text" class="form-control" placeholder="Próximo" disabled>
                                        <div class="input-group-append">
                                            <button class="btn btn-warning" type="button" disabled>Seleccionado</button>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if($info_postulacion['oid_poes']=='4'){ ?>
                                    <div class="input-group mb-3 col-lg-6">
                                        <input type="text" class="form-control" placeholder="Actual" disabled>
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button" disabled>Preseleccionado 3era etapa</button>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3 col-lg-6">
                                        <input type="text" class="form-control" placeholder="Aceptar" disabled>
                                        <div class="input-group-append">
                                            <button onClick="cambiarEstadoPostulacion('5')" class="btn btn-success" type="button">Seleccionado</button>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3 col-lg-6">
                                        <input type="text" class="form-control" placeholder="Próximo" disabled>
                                        <div class="input-group-append">
                                            <button class="btn btn-warning" type="button" disabled>Matriculado</button>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if($info_postulacion['oid_poes']=='5'){ ?>
                                    <!-- <form class="mt-3"> -->
                                        <div class="form-group row">
                                            <label for="oid_carreras" class="col-sm-3 control-label">Carrera</label>
                                            <div class="col-sm-9">
                                                <select name="oid_carreras" id="oid_carreras" class="form-control">
                                                    <option value="null" >----</option>
                                                    <?php foreach($r_carreras as $carrera) { ?>
                                                        <option value="<?= $carrera->oid ?>"><?= $carrera->nombre ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="card-body">
                                            <div class="form-group mb-0 text-right">
                                                <button onClick="<?= "cambiarEstadoPostulacion('6','".$info_postulacion['oid_usuario']."')" ?>" class="btn btn-info waves-effect waves-light">Matricular</button>
                                            </div>
                                        </div>
                                    <!-- </form> -->
                                <?php } ?>
                                <?php if($info_postulacion['oid_poes']=='6'){ ?>
                                    <?php foreach ($r_matriculado as $rm){ ?>
                                        <div class="input-group mb-3 col-lg-12">
                                            <input type="text" class="form-control" value="Matriculado en " disabled>
                                            <div class="input-group-append">
                                                <button class="btn btn-warning" type="button" disabled><?= $rm->nombre; ?></button>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
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
    <script type="text/javascript" charset="utf8" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/js/dataTables.checkboxes.min.js"></script>
    <script>
    $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
    var radioswitch = function() {
        var bt = function() {
            $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioState")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
            })
        };
        return {
            init: function() {
                bt()
            }
        }
    }();
    $(document).ready(function() {
        radioswitch.init()
    });
    </script>
    <script>
        //Dataset para crear la tabla Asignaturas
        var dataComprobantes = []
        <?php foreach($r_comprobantes as $rp) { ?>
            dataComprobantes.push(['<?= $rp->oid_pa ?>','<?= $rp->name ?>','<?= $rp->tiar_nombre ?>', 
                        // '<button onclick="descargarDoc('+'<?= $rp->oid ?>'+')" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm" aria-label=""">Descargar</button>']);
                        '<a href="<?php echo site_url('gestionPostulantes/descargar/'.$id_postulacion.'/'.$rp->oid.'/'.$rp->name); ?>" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm" aria-label=""">Descargar</a>']);
        <?php } ?>
        crearTablaSimple('#tabla_comprobantes', dataComprobantes);

        //Dataset para crear la tabla
        var dataExamenes = []
        <?php foreach($r_exam_postulaciones as $rp) { ?>
            dataExamenes.push(['<?= $rp->oid_pe ?>','<?= $rp->preg_nombre ?>','<?= $rp->resp_nombre ?>','<?= $rp->exam_comentario ?>',
                        '<button onclick="editarPostExamen('+'<?= $rp->oid_pe.',' ?>'+')" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm" aria-label=""">Editar</button>'+'<button onclick="cambiarVigencia('+'<?= $rp->oid_pe.',' ?>'+')" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm" aria-label=""">Vigencia</button>']);
        <?php } ?>
        crearTablaSimple('#tabla_examenes', dataExamenes);

        //Dataset para crear la tabla
        var dataPendientes = []
        <?php foreach($r_pendientes as $rp) { ?>
            dataPendientes.push(['<?= $rp->oid_gp ?>','<?= $rp->preg_nombre ?>','','',   
                        '<button onclick="editarPostPend('+'<?= $rp->oid_gp.',' ?>'+')" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm" aria-label=""">Editar</button>']);
        <?php } ?>
        crearTablaSimple('#tabla_pendientes', dataPendientes);

        

        
        /******************************************************************/
        function crearDataTable(nombreTabla, datosTabla){
            $(document).ready(function() {
                var table = $(nombreTabla).DataTable({
                    data: datosTabla,
                    columnDefs: [{
                        'targets': 0,
                        'checkboxes': {
                            'selectRow': true,
                        }
                    }],
                    select: {
                        style: 'multi'
                    },
                    order: [[1, 'asc']],
                    language: {
                        lengthMenu: "Mostrando _MENU_ datos por página",
                        zeroRecords: "No se encontraron elementos",
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
        }

        function crearTablaSimple(nombreTabla, datosTabla){
            $(document).ready(function() {
                var table = $(nombreTabla).DataTable({
                    data: datosTabla,
                    select: {
                        style: 'multi'
                    },
                    // order: [[1, 'desc']],
                    language: {
                        lengthMenu: "Mostrando _MENU_ datos por página",
                        zeroRecords: "No se encontraron elementos",
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
        }
        
    </script>
    <script>
        function modalSwal(tabla){
            cant_usuarios_checked = $('#'+tabla).DataTable().column(0).checkboxes.selected().length;
            if(tabla=="tabla_borrador") var index = "profesor"+(cant_usuarios_checked>1?'es':'');
            if(tabla=="tabla_asignaturas") var index = "asignatura"+(cant_usuarios_checked>1?'s':'');
            if(tabla=="tabla_examenes") var index = "exámen"+(cant_usuarios_checked>1?'es':'');
            if(tabla=="tabla_carreras") var index = "carrera"+(cant_usuarios_checked>1?'s':'');
            if (cant_usuarios_checked > 0){
                document.querySelector("#modalDelete #swal2-content").innerHTML = "¿Está seguro que quiere eliminar "+cant_usuarios_checked+" "+index+"?";
                document.querySelector("#modalDelete").style.display = "block";
                document.querySelector("#modalDelete #botonEliminar").onclick = function onclick(event) {botonEliminar(tabla)}
            }else{
                document.querySelector("#modalError #swal2-content").innerHTML = "Selecciona al menos 1 "+index+" para eliminar";
                document.querySelector("#modalError").style.display = "block";
            }
        }

        function modalClose(){
            document.querySelector("#modalDelete").style.display = "none";
            document.querySelector("#modalError").style.display = "none";
        }

        function botonEliminar(tabla){
            var checked = {};
            var list_checked = $('#'+tabla).DataTable().column(0).checkboxes.selected();
            for (var i = 0; i < list_checked.length; i++){
                checked[i] = list_checked[i];
            }
            if(tabla=="tabla_borrador"){
                var url = "<?php echo base_url('public/progPresencial/eliminar_profesor/'.$profile_data_edit['oid']); ?>";
            }else if(tabla=="tabla_asignaturas"){
                var url = "<?php echo base_url('public/progPresencial/eliminar_asignatura/'.$profile_data_edit['oid']); ?>";
            }else if(tabla=="tabla_examenes"){
                var url = "<?php echo base_url('public/admisionCarrera/eliminar_examen'); ?>";
            }else if(tabla=="tabla_carreras"){
                var url = "<?php echo base_url('public/admisionCarrera/eliminar_carrera'); ?>";
            }

            $.post(url, checked, function(data, status){
                if (status){
                    console.log(data, status)
                    window.location = "<?php echo base_url('public/admisionCarrera/editar/'.$profile_data_edit['oid']); ?>";
                }else{
                    console.log("ERROR");
                }
            });
        }

        function cambiarVigencia(id_post_examen){
            
            var url = "<?php echo base_url('public/gestionPostulantes/cambiarVigencia/'); ?>";
            // console.log(url, oid, inactivo);
            $.post(url, {id_postulacion:id_post_examen}, function(data, status){
                if (status){
                    console.log(data);
                    window.location = "<?php echo base_url('public/gestionPostulantes/editar_postulacion/'.$id_grupo."/".$id_postulacion); ?>";
                }else{
                    console.log("ERROR");
                }
            });
        }

        function cambiarEstadoPostulacion(oid_poes, oid_usuario){
            var url = "<?php echo base_url('public/GestionPostulantes/cambiarEstado'); ?>";
            try{
                var oid_grupo = document.getElementById('oid_carreras').value;
            }catch(err){
                var oid_grupo = "null";
            }
            $.post(url, {oid_poes:oid_poes, oid_postulacion:'<?php echo $id_postulacion ?>', oid_usuario:oid_usuario, oid_grupo:oid_grupo}, function(data, status){
                if (status){
                    // console.log(data);
                    location.reload();
                }else{
                    console.log("ERROR");
                }
            });
        }

        function ponderacionValidation(){
            var c1 = document.getElementById('grup_nem');
            var c2 = document.getElementById('grup_len');
            var c3 = document.getElementById('grup_mat');
            console.log(parseInt(c1.value) + parseInt(c2.value) + parseInt(c3.value));
            if( (parseInt(c1.value) + parseInt(c2.value) + parseInt(c3.value)) > 100 ){ 
                c1.setCustomValidity("NEM+LEN+MAT Excede la ponderación total máxima de 100%");  
                c2.setCustomValidity("NEM+LEN+MAT Excede la ponderación total máxima de 100%"); 
                c3.setCustomValidity("NEM+LEN+MAT Excede la ponderación total máxima de 100%"); 
                return false; 
            }
            c1.setCustomValidity('');
            c2.setCustomValidity('');
            c3.setCustomValidity('');
        }

        function editarPostExamen(id_post_examen){
            console.log(id_post_examen);
            var id_grupo = "<?php echo $id_grupo ?>";
            window.location = "<?php echo base_url('public/gestionPostulantes/editar_examen_postulacion/'); ?>"+"/"+id_post_examen+"/"+id_grupo;
        }
        function editarPostPend(id_post_examen){
            console.log(id_post_examen);
            var id_grupo = "<?php echo $id_grupo ?>";
            var id_postulacion = "<?php echo $id_postulacion ?>";
            window.location = "<?php echo base_url('public/gestionPostulantes/editar_pend_postulacion/'); ?>"+"/"+id_post_examen+"/"+id_grupo+"/"+id_postulacion;
        }
        function descargarDoc(id_doc){
            console.log(id_doc);
        }
        
    </script>
</body>

</html>