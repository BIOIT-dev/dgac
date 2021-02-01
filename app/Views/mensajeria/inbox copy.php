<?php echo $headers['headersView']; ?>

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
                <div class="left-part">
                    <a class="ti-menu ti-close btn btn-success show-left-part d-block d-md-none" href="javascript:void(0)"></a>
                    <div class="scrollable" style="height:100%;">
                        <div class="p-3">
                            <a id="compose_mail" class="waves-effect waves-light btn btn-danger d-block" href="javascript: void(0)">Redactar</a>
                        </div>
                        <div class="divider"></div>
                        <ul class="list-group">
                            <li>
                                <small class="p-3 grey-text text-lighten-1 db">Listados</small>
                            </li>
                            <li class="list-group-item border-0 p-0">
                                <a href="javascript:void(0)" class="active list-group-item-action d-block"><i class="font-18 align-middle mr-1 mdi mdi-inbox"></i> Mis mensajes <span class="badge py-1 badge-success float-right">6</span></a>
                            </li>
                            <li class="list-group-item border-0 p-0">
                                <a href="javascript:void(0)" class="list-group-item-action d-block"> <i class="font-18 align-middle mr-1 mdi mdi-star"></i> Mensajes enviados </a>
                            </li>
                            <li class="list-group-item border-0 p-0">
                                <a href="javascript:void(0)" class="list-group-item-action d-block"> <i class="font-18 align-middle mr-1 mdi mdi-star"></i> Correos enviados </a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Right Part -->
                <!-- ============================================================== -->
                <div class="right-part mail-list bg-white overflow-auto">
                    <!-- <div class="p-3 border-bottom">
                        <div class="d-flex align-items-center">
                            <div>
                                <h4>Mailbox </h4>
                                <span>Here is the list of mail</span>
                            </div>
                            <div class="ml-auto">
                                <input placeholder="Search Mail" id="" type="text" class="form-control">
                            </div>
                        </div>
                    </div> -->
                    <!-- Action part -->
                    <!-- Button group part -->
                    <div class="bg-light p-3 d-flex align-items-center do-block">
                        <div class="btn-group mt-1 mb-1">
                            <div class="checkbox checkbox-info">
                                <input type="checkbox" class="sl-all material-inputs" id="cstall">
                                <label for="cstall"> <span>Seleccionar</span> </label>
                            </div>
                        </div>
                        <div class="ml-auto">
                            <div class="btn-group mr-2" role="group" aria-label="Button group with nested dropdown">
                                <!-- <button type="button" class="btn btn-outline-secondary font-18"><i class="mdi mdi-reload"></i></button> -->
                                <button type="button" class="btn btn-outline-secondary font-18"><i class="mdi mdi-alert-octagon"></i></button>
                                <button type="button" class="btn btn-outline-secondary font-18"><i class="mdi mdi-delete"></i></button>
                            </div>
                            
                        </div>
                    </div>
                    <!-- Action part -->
                    <!-- Mail list-->
                    <div class="table-responsive">
                        <table class="table email-table no-wrap table-hover v-middle">
                            <tbody>
                                <!-- row -->
                                <? foreach($mis_mensajes as $valor){?>
                                <? if($valor->leido==0){?>
                                    <tr class="unread">
                                <?}else{?>
                                    <tr class="">
                                <?}?>
                                    <!-- label -->
                                    <td class="chb">
                                        <div class="checkbox checkbox-info">
                                            <input type="checkbox" class="material-inputs" id="cst1">
                                            <label for="cst1"  class="mb-0"> <span>&nbsp;</span> </label>
                                        </div>
                                    </td>
                                    <!-- star -->
                                    <!-- <td class="starred px-1 py-3"><i class="far fa-star"></i></td> -->
                                    <!-- User -->
                                    <!-- <td class="user-image px-1 py-3"><img src="../assets/images/users/1.jpg" alt="user" class="rounded-circle" width="30"></td> -->
                                    <td class="user-name px-1 py-3">
                                        <h6 class="mb-0 text-truncate no-wrap"><?=$valor->nombres?></h6>
                                    </td>
                                    <!-- Message -->
                                    <td class="max-texts text-truncate px-1 py-3 no-wrap"> 
                                    <a class="link" href="javascript: void(0)">
                                    <!-- <span class="badge py-1 badge-danger mr-2">Work</span> -->
                                    <span class="blue-grey-text text-darken-4"><?php echo substr(strip_tags($valor->texto),0,50); ?></td>
                                    <!-- Attachment -->
                                    <!-- <td class="clip px-1  py-3"><i class="fa fa-paperclip"></i></td> -->
                                    <!-- Time -->
                                    <?
                                    $sec = strtotime($valor->fecha);  
                                    //converts seconds into a specific format  
                                    $newdate = date ("Y/d/m", $sec);  
                                    ?>
                                    <td class="time text-right"><?=$newdate;?></td>
                                </tr>
                                <? } ?>
                                
                            </tbody>
                        </table>
                    </div>
                    <!-- <div class="p-3 mt-4">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item"><a class="page-link" href="javascript:void(0)">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0)">1</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0)">Next</a></li>
                            </ul>
                        </nav>
                    </div> -->
                </div>
                <!-- ============================================================== -->
                <!-- Right Part  Mail Compose -->
                <!-- ============================================================== -->
                <div class="right-part mail-compose bg-white overflow-auto" style="display: none;">
                    <div class="p-3 border-bottom">
                        <div class="d-flex align-items-center">
                            <div>
                                <h4>Compose</h4>
                                <span>create new message</span>
                            </div>
                            <div class="ml-auto">
                                <button id="cancel_compose" class="btn btn-dark">Back</button>
                            </div>
                        </div>
                    </div>
                    <!-- Action part -->
                    <!-- Button group part -->
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <input type="email" id="example-email" name="example-email" class="form-control" placeholder="To">
                            </div>
                            <div class="form-group">
                                <input type="text" id="example-subject" name="example-subject" class="form-control" placeholder="Subject">
                            </div>
                            <div id="summernote"></div>
                            <h4>Attachment</h4>
                            <div class="dropzone" id="dzid">
                                <div class="fallback">
                                    <input name="file" type="file" multiple />
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success mt-3"><i class="far fa-envelope"></i> Send</button>
                            <button type="submit" class="btn btn-dark mt-3">Discard</button>
                        </form>
                        <!-- Action part -->
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Right Part  Mail detail -->
                <!-- ============================================================== -->
                <div class="right-part mail-details bg-white overflow-auto" style="display: none;">
                    <div class="card-body bg-light">
                        <button type="button" id="back_to_inbox" class="btn btn-outline-secondary font-18 mr-2"><i class="mdi mdi-arrow-left"></i></button>
                        <div class="btn-group mr-2" role="group" aria-label="Button group with nested dropdown">
                            <!-- <button type="button" class="btn btn-outline-secondary font-18"><i class="mdi mdi-reply"></i></button> -->
                            <button type="button" class="btn btn-outline-secondary font-18"><i class="mdi mdi-alert-octagon"></i></button>
                            <button type="button" class="btn btn-outline-secondary font-18"><i class="mdi mdi-delete"></i></button>
                        </div>
                        
                    </div>
                    <div class="card-body border-bottom">
                        <h4 class="mb-0">Your Message title goes here</h4>
                    </div>
                    <div class="card-body border-bottom">
                        <div class="d-flex no-block align-items-center mb-5">
                            <div class="mr-2"><img src="../assets/images/users/1.jpg" alt="user" class="rounded-circle" width="45"></div>
                            <div class="">
                                <h5 class="mb-0 font-16 font-medium">Hanna Gover <small> ( hgover@gmail.com )</small></h5><span>to Suniljoshi19@gmail.com</span>
                            </div>
                        </div>
                        <h4 class="mb-3">Hey Hi,</h4>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.</p>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.</p>
                    </div>
                    <div class="card-body">
                        <h4><i class="fa fa-paperclip mr-2 mb-2"></i> Attachments <span>(3)</span></h4>
                        <div class="row">
                            <div class="col-md-2">
                                <a href="javascript:void(0)"> <img class="img-thumbnail img-fluid" alt="attachment" src="../assets/images/big/img1.jpg"> </a>
                            </div>
                            <div class="col-md-2">
                                <a href="javascript:void(0)"> <img class="img-thumbnail img-fluid" alt="attachment" src="../assets/images/big/img2.jpg"> </a>
                            </div>
                            <div class="col-md-2">
                                <a href="javascript:void(0)"> <img class="img-thumbnail img-fluid" alt="attachment" src="../assets/images/big/img3.jpg"> </a>
                            </div>
                        </div>
                        <div class="border mt-3 p-3">
                            <p class="pb-3">click here to <a href="javascript:void(0)">Reply</a> or <a href="javascript:void(0)">Forward</a></p>
                        </div>
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
    <script>
    $('#summernote').summernote({
        placeholder: 'Mensaje',
        tabsize: 2,
        height: 250
    });
    // Dropzone.autoDiscover = false;
    // Dropzone.options.dropzoneForm = {
    //     autoProcessQueue: false
    // };
    // $("#dzid").dropzone({ url: "/file/post" });
    </script>
</body>

</html>