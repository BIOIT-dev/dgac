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
            <?php //echo view('dgac/breadcrum'); ?>
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
                    
                    <!-- Fin Panel de noticias  -->
                    <!-- ============================================================== -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                
                                <div class="swal2-container swal2-center swal2-fade swal2-shown" style="overflow-y: auto;">
                                    <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
                                        <div class="swal2-header">
                                            <ul class="swal2-progress-steps" style="display: none;"></ul>
                                            <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;">
                                            <span class="swal2-x-mark">
                                                <span class="swal2-x-mark-line-left"></span>
                                                <span class="swal2-x-mark-line-right"></span>
                                            </span>
                                        </div>
                                        <div class="swal2-icon swal2-question" style="display: none;"></div>
                                        <div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: none;"></div>
                                        <div class="swal2-icon swal2-info" style="display: none;"></div>
                                        <div class="swal2-icon swal2-success " style="display: none;">
                                            <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                                            <span class="swal2-success-line-tip"></span> 
                                            <span class="swal2-success-line-long"></span>
                                            <div class="swal2-success-ring"></div> 
                                            <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                            <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                                        </div><img class="swal2-image" style="display: none;">
                                        <h2 class="swal2-title" id="swal2-title" style="display: flex;">Error!</h2>
                                        <button type="button" class="swal2-close" aria-label="Close this dialog" style="display: none;">×</button>
                                    </div>
                                    <div class="swal2-content">
                                        <div id="swal2-content" style="display: block;"><?php echo $mensaje_servidor; ?></div>
                                        <input class="swal2-input" style="display: none;">
                                        <input type="file" class="swal2-file" style="display: none;">
                                        <div class="swal2-range" style="display: none;">
                                            <input type="range"><output></output></div>
                                            <select class="swal2-select" style="display: none;"></select>
                                            <div class="swal2-radio" style="display: none;"></div>
                                            <label for="swal2-checkbox" class="swal2-checkbox" style="display: none;">
                                                <input type="checkbox"><span class="swal2-label"></span>
                                            </label>
                                            <textarea class="swal2-textarea" style="display: none;"></textarea>
                                            <div class="swal2-validation-message" id="swal2-validation-message" style="display: none;"></div>
                                        </div>
                                       <div class="swal2-actions" style="display: flex;">
                                            <?php
                                            
                                            $url_retorno_t = 'profile/administracion';
                                            if(isset($url_retorno)){
                                                $url_retorno_t = $url_retorno;
                                            }else{
                                                $url_retorno_t = 'profile/administracion';
                                            }
                                            ?>
                                            <a href="<?php echo site_url($url_retorno_t); ?>" type="button" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block; border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);">OK</a>
                                            <button type="button" class="swal2-cancel swal2-styled" aria-label="" style="display: none;">Cancel</button>
                                        </div>
                                        <div class="swal2-footer" style="display: none;"></div>
                                    </div>
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
    <!--Custom JavaScript -->
    <script src="<?php echo base_url() ?>/assets/libs/sweetalert2/dist/sweetalert2.all.js"></script>
    <script src="<?php echo base_url() ?>/assets/extra-libs/sweetalert2/sweet-alert.init.js"></script>
</body>

</html>