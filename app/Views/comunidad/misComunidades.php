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
                    <!-- Column -->

                    <!-- Inicio Panel de noticias  -->
                    <!-- ============================================================== -->
                    <div class="col-lg-12 col-md-12">
                        <div class="row">
                        <div id="accordion" class="custom-accordion mb-4 col-12">
                            <?php $bandera = ""; ?>
                            <?php $bandera1 = 0; ?>
                            <?php foreach($query as $que) { ?>
                                <?php if(!isset($que->categoria_oid)){ $que->categoria = "Sin Especificar";$que->categoria_oid="x1";}?>
                                <?php if($bandera!=$que->categoria_oid){?>
                                <?php if ($bandera1==0){?>
                                    <?php $bandera1=1;?>
                                <?php }else{?>
                                    </div>
                                    </div>
                                </div> <!-- end card-->
                                <?php }?>
                                <?php $bandera = $que->categoria_oid; ?>
                                <div class="card mb-0" style="margin-bottom: 10px !important;">
                                    <div class="card-header" id="headingOne<?php echo $que->categoria_oid;?>" style="background-color: #1e88e5;">
                                        <h5 class="m-0">
                                            <a style="color:white;" class="custom-accordion-title d-block pt-2 pb-2" data-toggle="collapse" href="#collapseOne_<?php echo $que->categoria_oid;?>" aria-expanded="true" aria-controls="collapseOne_<?php echo $que->categoria_oid;?>">
                                                <?php echo $que->categoria; ?> <span class="float-right"><i class="mdi mdi-chevron-down accordion-arrow"></i></span>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseOne_<?php echo $que->categoria_oid;?>" class="collapse" aria-labelledby="headingOne<?php echo $que->categoria_oid;?>" data-parent="#accordion" style="">
                                        <div class="card-body">
                                <?php }?>
                                <div class="card border-warning w-100">
                                <a href='<?php echo base_url("public/Comunidad/iniciar_comunidad/$que->grupo_id"); ?>'>
                                    <div class="card-header bg-warning">
                                        <h4 class="mb-0 text-white"><?php echo $que->nombre_grupo ?> - </h4>
                                    </div>
                                </a>

                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="row">
                                                <div class="card-body">
                                                    <p class="card-text"><?php echo $que->descripcion ?></p>
                                                    <!-- <button type="button" class="btn btn-danger" disabled>Finalizada</button> -->

                                                    <!--<p class="card-text"><b>Categoría:</b> <?php //echo $que->nombre ?></p>-->

                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="row">
                                                <div class="card-body text-right">
                                                    <h6 class="card-title"><?php //echo $que->conexiones ?> Conexiones Realizadas</h6>
                                                    <p class="card-text">Última Conexión <?php //echo $que->ultima_conexion ?></p>
                                                    <!-- <span class="badge py-1 badge-warning text-white">Activo</span> -->
                                                    <!-- <span class="badge py-1 <?php //echo ($que['activa']=='Activa')?'badge-success">Activo':'badge-warning text-white">Inactivo' ?></span> -->
                                                    <?php //echo ($que->inactivo=='0')?'<span class="badge py-1 badge-success">Activo</span>':'<span class="badge py-1 badge-warning text-white">Inactivo</span>' ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php } ?>

                        </div>
                        </div>

                    </div>
                    <!-- Fin Panel de noticias  -->
                    <!-- ============================================================== -->

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
