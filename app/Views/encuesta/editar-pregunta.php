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
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card">
                            <!-- Tabs -->
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
                                    <div class="card-body">
                                        <form action="<?php echo base_url('public/encuesta/editar_pregunta/'.$profile_data_edit['oid'].'/'.$id_pregunta); ?>" name="user_create" id="user_create" method="post" accept-charset="utf-8" class="form-horizontal form-material">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h3 class="card-title">Encuesta de Observación: <?= $profile_data_edit['titulo'] ?></h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Pregunta</h4>
                                                        <textarea cols="80" id="texto_pregunta" name="texto_pregunta" rows="10" data-sample="1" data-sample-short>
                                                            <?= $pregunta_edit->texto ?>
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <?if($pregunta_edit->tipo == 'ALT'){ ?>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <div class="row mt-3">
                                                            <?php $letter = ord("A"); ?>
                                                            <?php foreach($opciones_preguntas as $rp) { ?>
                                                                <?php $mark = ($rp->correcta == "S" ? "checked='checked'" : ""); ?>
                                                                <div class="col-md-12">
                                                                    <input name="correcta" value="<?= $rp->oid ?>" class="with-gap material-inputs" type="radio" id="radio_<?= $rp->oid ?>" <?= $mark ?>/>
                                                                    <label for="radio_<?= $rp->oid ?>"> <?=chr( $letter++ )?>)  </label>
                                                                    <input name="text<?= $rp->oid ?>" type="text" class="form-control" value="<?= $rp->texto ?>">
                                                                    </br>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?if($pregunta_edit->tipo == 'MUL'){ ?>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <div class="row mt-3">
                                                            <?php $letter = ord("A"); ?>
                                                            <?php foreach($opciones_preguntas as $rp) { ?>
                                                                <?php $mark = ($rp->correcta == "S" ? "checked='checked'" : ""); ?>
                                                                <div class="col-md-12">
                                                                    <input name="correcta<?= $rp->oid ?>" value="<?= $rp->oid ?>" class="material-inputs filled-in" type="checkbox" id="checkbox<?= $rp->oid ?>" <?= $mark ?>/>
                                                                    <label for="checkbox<?= $rp->oid ?>"> <?=chr( $letter++ )?>)  </label>
                                                                    <input name="text<?= $rp->oid ?>" type="text" class="form-control" value="<?= $rp->texto ?>">
                                                                    </br>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-success">Guardar</button>
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
    <script src="<?php echo base_url() ?>/assets/dist/js/pages/forms/jasny-bootstrap.js"></script>
    <!-- Validaciones Usuario -->
    <script src="<?php echo base_url() ?>/assets/dist/js/validaciones-usuario.js"></script>

        <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url() ?>/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url() ?>/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <script src="<?php echo base_url() ?>/assets/dist/js/app.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/js/app.init.horizontal.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/js/app-style-switcher.horizontal.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo base_url() ?>/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url() ?>/assets/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo base_url() ?>/assets/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url() ?>/assets/dist/js/custom.min.js"></script>
    <script data-sample="1">
        CKEDITOR.replace('texto_pregunta', {
            height: 150
        });
    </script>
</body>

</html>