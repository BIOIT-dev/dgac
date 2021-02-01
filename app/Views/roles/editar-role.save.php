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
                    <div class="col-lg-12 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Tabs -->
                            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-timeline-tab" data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-timeline" aria-selected="true">Role</a>
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
                                            <?php 
                                                $session = session();

                                                if( isset($mensaje_servidor) ){
                                                    echo '<div class="alert alert-success">';
                                                        echo $mensaje_servidor;
                                                    echo '</div>';
                                                }
                                            ?>
                                        <form action="<?php echo base_url('public/Roles/editar_role/1'); ?>" name="crear_role" id="crear_role" method="post" accept-charset="utf-8" class="form-horizontal form-material">
                                            <input name="id" value="<?php echo  $role_data_edit['id']; ?>" class="with-gap material-inputs" type="hidden" id="user_id" />
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="name">Nombre</label>
                                                            <input value="<?php echo $role_data_edit['name'] ?>" name="name" class="with-gap material-inputs form-control" type="text" id="name" required="" />
                                                        </div><div class="col-md-6">
                                                            <label for="is_active">Estátus</label>
                                                            <select id="is_active" name="is_active" class="with-gap material-inputs form-control" required="">
                                                                <option value="">----------</option>
                                                                <?php 
                                                                    if( $role_data_edit['is_active'] == 1 ){
                                                                        echo '<option selected value="1">Activo</option>';
                                                                    }else{
                                                                        echo '<option value="1">Activo</option>';
                                                                    }

                                                                    if( $role_data_edit['is_active'] == 0 ){
                                                                        echo '<option selected value="0">Inactivo</option>';
                                                                    }else{
                                                                        echo '<option value="0">Inactivo</option>';
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-5">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="name">Módulo(s)</label>
                                                        </div>
                                                        <?php foreach ($role_modulos as $key => $value) { ?>
                                                            <div class="col-md-6 mt-5">
                                                                <div class="col-md-3" style="float: left;">
                                                                	<?php echo $value->id; ?>

                                                                    <input <?php echo $value->modulo; ?> type="checkbox" name="modulo_id[]" value="<?php echo $value->id; ?>">
                                                                    
                                                                    <?php echo $value->nombre; ?>
                                                                </div>
                                                                <div class="col-md-3" style="float: left;">

                                                                	<input type="hidden" name="role_permisos_id[]" value="<?php echo $value->role_permisos_id; ?>">

                                                                    <select style="width: 194%;" class="form-control" id="acceso" name="acceso[]">

                                                                    	<?php

                                                                    		$selected1 = ''; $selected2 = ''; $selected3 = '';
                                                                    		$selected4 = ''; $selected5 = ''; $selected6 = '';
                                                                    		$selected7 = '';


                                                                    		if( $value->acceso == '1,2,3' ){
                                                                    			$selected1 = 'selected';
                                                                    		}else if( $value->acceso == '1' ){
                                                                    			$selected2 = 'selected';
                                                                    		}else if( $value->acceso == '2' ){
                                                                    			$selected3 = 'selected';
                                                                    		}else if( $value->acceso == '3' ){
                                                                    			$selected4 = 'selected';
                                                                    		}else if( $value->acceso == '1,2' ){
                                                                    			$selected5 = 'selected';
                                                                    		}else if( $value->acceso == '1,3' ){
                                                                    			$selected6 = 'selected';
                                                                    		}else if( $value->acceso == '2,3' ){
                                                                    			$selected7 = 'selected';
                                                                    		}
                                                                    	?>

                                                                        <option <?php echo $selected1; ?> value="1,2,3">Todos los permisos</option>

                                                                        <option <?php echo  $selected2; ?> value="1">Lectura</option>
                                                                        <option <?php echo  $selected3; ?> value="2">Escritura</option>
                                                                        <option <?php echo  $selected4; ?> value="3">Eliminar</option>
                                                                        <option <?php echo  $selected5; ?> value="1,2">Lectura, Escritura</option>
                                                                        <option <?php echo  $selected6; ?> value="1,3">Lectura, Eliminar</option>
                                                                        <option <?php echo  $selected7; ?> value="2,3">Escritura, Eliminar</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <input type="submit" class="btn btn-success" value="Guardar">
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
    <script src="<?php echo base_url() ?>/assets/libs/ckeditor/ckeditor.js"></script>
</body>

</html>