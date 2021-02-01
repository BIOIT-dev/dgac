<?php echo $headers['headersView']; ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/libs/select2/dist/css/select2.min.css">

<body>
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
            <?php echo view('dgac/breadcrum'); ?>
            <!-- ============================================================== -->
            <!-- Email App Part -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12 col-xl-12 col-md-12">
                        <div class="email-app">
                            <!-- ============================================================== -->
                            <!-- Left Part -->
                            <!-- ============================================================== -->
                            
                            <!-- ============================================================== -->
                            <!-- Right Part  Mail Compose -->
                            <!-- ============================================================== -->
                            <div class="mail-compose bg-white overflow-auto">
                                <div class="p-3 border-bottom">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h4>Redactar</h4>
                                            <!-- <span>create new message</span> -->
                                        </div>
                                        
                                    </div>
                                </div>
                                <!-- Action part -->
                                <!-- Button group part -->
                                <div class="card-body">
                                <form action="<?php echo base_url('public/Mensajeria/mensaje_masivo'); ?>" name="mensajes_add" id="mensajes_add" method="post" accept-charset="utf-8">
                                        <div class="form-group">
                                            <?if(isset($rol)){?>
                                            <input type="hidden" name="rol_email" value="<?=$rol?>">
                                            <input type="email" id="para" value= "Enviar a <?=$rol_text?>" name="para" <?=$disabled?> class="form-control select2-data-ajax2" placeholder="Para">
                                            <?}else{?>
                                                <!-- <select class="select2-data-ajax2 form-control" id="select2-ajax" style="width: 100%;height: 36px;"></select> -->
                                            <?}?>
                                        </div>
                                        <? if($asunto){?>
                                        <div class="form-group">
                                            <input type="text" id="subject" name="subject" class="form-control" placeholder="Asunto">
                                        </div>
                                        <?}?>
                                        <textarea required="" class="form-control" name="mensaje" rows="12" cols="80"></textarea>
                                        <? if($adjunto){?>
                                        <h4>Adjuntos</h4>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Archivo adjunto</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" name="archivo" class="custom-file-input" id="inputGroupFile01">
                                                <label class="custom-file-label" for="inputGroupFile01">Seleccionar</label>
                                            </div>
                                        </div>
                                        <?}?>
                                        <button type="submit" class="btn btn-success mt-3"><i class="far fa-envelope"></i> Enviar</button>
                                        <!-- <button type="submit" class="btn btn-dark mt-3">Discard</button> -->
                                    </form>
                                    <!-- Action part -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
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
    
    <div class="chat-windows"></div>
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
    <!-- This Page JS -->
    <script src="<?php echo base_url() ?>/assets/dist/js/pages/email/email.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/summernote/dist/summernote-bs4.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/dropzone/dist/min/dropzone.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/select2/dist/js/select2.min.js"></script>
    <script>
    $('#summernote').summernote({
        placeholder: 'Mensaje',
        tabsize: 2,
        height: 250
    });
    // $(".select2").select2();
    $(".select2-data-ajax234").select2({
            placeholder: "Loading remote data",
            ajax: {
                url: "http://localhost/cvirtual/public/Mensajeria/json",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function(markup) { return markup; }, // let our custom formatter work
            minimumInputLength: 1,
            templateResult: formatRepo, // omitted for brevity, see the source of this page
            templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });

        function formatRepo(repo) {
            if (repo.loading) return repo.text;

            var markup = "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__avatar'></div>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'>" + repo.nombres + "</div>";

            markup += "</div></div>";

            return markup;
        }

        function formatRepoSelection(repo) {
            return repo.full_name || repo.text;
        }
    </script>
</body>

</html>