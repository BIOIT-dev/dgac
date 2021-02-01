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
                <div class="chat-application">
                <!-- ============================================================== -->
                <!-- Left Part  -->
                <!-- ============================================================== -->
                <div class="left-part bg-white fixed-left-part user-chat-box">
                    <!-- Mobile toggle button -->
                    <a class="ti-menu ti-close btn btn-success show-left-part d-block d-md-none" href="javascript:void(0)"></a>
                    <!-- Mobile toggle button -->
                    <div class="p-3">
                        <h4>Chat Sidebar</h4>
                    </div>
                    <div class="scrollable position-relative" style="height:100%;">
                        <div class="p-3 border-bottom">
                            <h5 class="card-title">Search Contact</h5>
                            <form>
                                <div class="searchbar">
                                    <input class="form-control" type="text" placeholder="Search Contact">
                                </div>
                            </form>
                        </div>
                        <ul class="mailbox list-style-none app-chat">
                            <li>
                                <div class="message-center chat-scroll chat-users">
                                    <a href="javascript:void(0)" class="chat-user message-item align-items-center border-bottom px-3 py-2" id='chat_user_1' data-user-id='1'>
                                        <span class="user-img position-relative d-inline-block"> 
                                            <img src="<?php echo base_url() ?>/assets/images/users/1.jpg" alt="user" class="rounded-circle w-100"> 
                                            <span class="profile-status online rounded-circle pull-right"></span> 
                                        </span>
                                        <div class="mail-contnet w-75 d-inline-block v-middle pl-2">
                                            <h5 class="message-title mb-0 mt-1" data-username="Pavan kumar">Pavan kumar</h5> 
                                            <span class="font-12 text-nowrap d-block text-muted text-truncate">Just see the my admin!</span> <span class="font-12 text-nowrap d-block text-muted">9:30 AM</span> 
                                        </div>
                                    </a>
                                    <!-- Message -->
                                    <a href="javascript:void(0)" class="chat-user message-item align-items-center border-bottom px-3 py-2" id='chat_user_2' data-user-id='2'>
                                        <span class="user-img position-relative d-inline-block"> 
                                            <img src="<?php echo base_url() ?>/assets/images/users/2.jpg" alt="user" class="rounded-circle w-100"> 
                                            <span class="profile-status busy rounded-circle pull-right"></span> 
                                        </span>
                                        <div class="mail-contnet w-75 d-inline-block v-middle pl-2">
                                            <h5 class="message-title mb-0 mt-1" data-username="Sonu Nigam">Sonu Nigam</h5> 
                                            <span class="font-12 text-nowrap d-block text-muted text-truncate">I've sung a song! See you at</span> <span class="font-12 text-nowrap d-block text-muted">9:10 AM</span> 
                                        </div>
                                    </a>
                                    <!-- Message -->
                                    <a href="javascript:void(0)" class="chat-user message-item align-items-center border-bottom px-3 py-2" id='chat_user_3' data-user-id='3'>
                                        <span class="user-img position-relative d-inline-block"> 
                                            <img src="<?php echo base_url() ?>/assets/images/users/3.jpg" alt="user" class="rounded-circle w-100">
                                             <span class="profile-status away rounded-circle pull-right"></span> 
                                         </span>
                                        <div class="mail-contnet w-75 d-inline-block v-middle pl-2">
                                            <h5 class="message-title mb-0 mt-1" data-username="Arijit Sinh">Arijit Sinh</h5> 
                                            <span class="font-12 text-nowrap d-block text-muted text-truncate">I am a singer!</span> <span class="font-12 text-nowrap d-block text-muted">9:08 AM</span> 
                                        </div>
                                    </a>
                                    <!-- Message -->
                                    <a href="javascript:void(0)" class="chat-user message-item align-items-center border-bottom px-3 py-2" id='chat_user_4' data-user-id='4'>
                                        <span class="user-img position-relative d-inline-block">
                                            <img src="<?php echo base_url() ?>/assets/images/users/4.jpg" alt="user" class="rounded-circle w-100"> 
                                            <span class="profile-status offline rounded-circle pull-right"></span> 
                                        </span>
                                        <div class="mail-contnet w-75 d-inline-block v-middle pl-2">
                                            <h5 class="message-title mb-0 mt-1" data-username="Nirav Joshi">Nirav Joshi</h5> 
                                            <span class="font-12 text-nowrap d-block text-muted text-truncate">Just see the my admin!</span> <span class="font-12 text-nowrap d-block text-muted">9:02 AM</span> 
                                        </div>
                                    </a>
                                    <!-- Message -->
                                    <!-- Message -->
                                    <a href="javascript:void(0)" class="chat-user message-item align-items-center border-bottom px-3 py-2" id='chat_user_5' data-user-id='5'>
                                        <span class="user-img position-relative d-inline-block"> 
                                            <img src="<?php echo base_url() ?>/assets/images/users/5.jpg" alt="user" class="rounded-circle w-100"> 
                                            <span class="profile-status offline rounded-circle pull-right"></span> 
                                        </span>
                                        <div class="mail-contnet w-75 d-inline-block v-middle pl-2">
                                            <h5 class="message-title mb-0 mt-1" data-username="Sunil Joshi">Sunil Joshi</h5> 
                                            <span class="font-12 text-nowrap d-block text-muted text-truncate">Just see the my admin!</span> <span class="font-12 text-nowrap d-block text-muted">9:02 AM</span> 
                                        </div>
                                    </a>
                                    <!-- Message -->
                                    <!-- Message -->
                                    <a href="javascript:void(0)" class="chat-user message-item align-items-center border-bottom px-3 py-2" id='chat_user_6' data-user-id='6'>
                                        <span class="user-img position-relative d-inline-block"> 
                                            <img src="<?php echo base_url() ?>/assets/images/users/6.jpg" alt="user" class="rounded-circle w-100"> 
                                            <span class="profile-status offline rounded-circle pull-right"></span> 
                                        </span>
                                        <div class="mail-contnet w-75 d-inline-block v-middle pl-2">
                                            <h5 class="message-title mb-0 mt-1" data-username="Akshay Kumar">Akshay Kumar</h5> 
                                            <span class="font-12 text-nowrap d-block text-muted text-truncate">Just see the my admin!</span> <span class="font-12 text-nowrap d-block text-muted">9:02 AM</span>
                                        </div>
                                    </a>
                                    <!-- Message -->
                                    <!-- Message -->
                                    <a href="javascript:void(0)" class="chat-user message-item align-items-center border-bottom px-3 py-2" id='chat_user_7' data-user-id='7'>
                                        <span class="user-img position-relative d-inline-block"> 
                                            <img src="<?php echo base_url() ?>/assets/images/users/7.jpg" alt="user" class="rounded-circle w-100"> 
                                            <span class="profile-status offline rounded-circle pull-right"></span>
                                        </span>
                                        <div class="mail-contnet w-75 d-inline-block v-middle pl-2">
                                            <h5 class="message-title mb-0 mt-1" data-username="Pavan kumar">Pavan kumar</h5>
                                            <span class="font-12 text-nowrap d-block text-muted text-truncate">Just see the my admin!</span> <span class="font-12 text-nowrap d-block text-muted">9:02 AM</span> 
                                         </div>
                                    </a>
                                    <!-- Message -->
                                    <!-- Message -->
                                    <a href="javascript:void(0)" class="chat-user message-item align-items-center border-bottom px-3 py-2" id='chat_user_8' data-user-id='8'>
                                        <span class="user-img position-relative d-inline-block"> 
                                            <img src="<?php echo base_url() ?>/assets/images/users/8.jpg" alt="user" class="rounded-circle w-100"> 
                                            <span class="profile-status offline rounded-circle pull-right"></span> 
                                        </span>
                                        <div class="mail-contnet w-75 d-inline-block v-middle pl-2">
                                            <h5 class="message-title mb-0 mt-1" data-username="Varun Dhavan">Varun Dhavan</h5> 
                                            <span class="font-12 text-nowrap d-block text-muted text-truncate">Just see the my admin!</span> 
                                            <span class="font-12 text-nowrap d-block text-muted">9:02 AM</span> 
                                        </div>
                                    </a>
                                    <!-- Message -->
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Left Part  -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right Part  Mail Compose -->
                <!-- ============================================================== -->
                <div class="right-part chat-container">
                    <div class="chat-box-inner-part">
                        <div class="chat-not-selected">
                            <div class="text-center">
                                <span class="display-5 text-info"><i class="mdi mdi-comment-outline"></i></span>
                                <h5>Open chat from the list</h5>
                            </div>
                        </div>
                        <div class="card chatting-box mb-0">
                            <div class="card-body">
                                <div class="chat-meta-user pb-3 border-bottom">
                                    <div class="current-chat-user-name">
                                        <span>
                                            <img src="<?php echo base_url() ?>/assets/images/users/1.jpg" alt="dynamic-image" class="rounded-circle" width="45">
                                            <span class="name font-weight-bold ml-2"></span>
                                        </span>
                                    </div>
                                </div>
                                <!-- <h4 class="card-title">Chat Messages</h4> -->
                                <div class="chat-box scrollable" style="height:calc(100vh - 300px); overflow:auto; display:flex; flex-direction:column-reverse;">
                                    <!--User 1 -->
                                    <ul class="chat-list chat" data-user-id="1">
                                        <!--chat Row -->
                                        <li class="mt-4">
                                            <div class="chat-img d-inline-block align-top"><img src="<?php echo base_url() ?>/assets/images/users/1.jpg" alt="user" class="rounded-circle" /></div>
                                            <div class="chat-content pl-3 d-inline-block">
                                                <h5 class="text-muted">James Anderson</h5>
                                                <div class="box mb-2 d-inline-block text-dark rounded p-2 bg-light-info">Lorem Ipsum is simply dummy text of the printing & type setting industry.</div>
                                            </div>
                                            <div class="chat-time d-inline-block text-right text-muted">10:56 am</div>
                                        </li>
                                        <!--chat Row -->
                                        <li class="mt-4">
                                            <div class="chat-img d-inline-block align-top"><img src="<?php echo base_url() ?>/assets/images/users/2.jpg" alt="user" class="rounded-circle" /></div>
                                            <div class="chat-content pl-3 d-inline-block">
                                                <h5 class="text-muted">Bianca Doe</h5>
                                                <div class="box mb-2 d-inline-block text-dark rounded p-2 bg-light-success">It’s Great opportunity to work.</div>
                                            </div>
                                            <div class="chat-time d-inline-block text-right text-muted">10:57 am</div>
                                        </li>
                                        <!--chat Row -->
                                        <li class="odd mt-4">
                                            <div class="chat-content pl-3 d-inline-block text-right">
                                                <div class="box mb-2 d-inline-block text-dark rounded p-2 bg-light-inverse">I would love to join the team.</div>
                                                <br/>
                                            </div>
                                            <div class="chat-time d-inline-block text-right text-muted">10:58 am</div>
                                        </li>
                                        <!--chat Row -->
                                        <li class="odd mt-4">
                                            <div class="chat-content pl-3 d-inline-block text-right">
                                                <div class="box mb-2 d-inline-block text-dark rounded p-2 bg-light-inverse">Whats budget of the new project.</div>
                                                <br/>
                                            </div>
                                            <div class="chat-time d-inline-block text-right text-muted">10:59 am</div>
                                        </li>
                                        <!--chat Row -->
                                        <li class="mt-4">
                                            <div class="chat-img d-inline-block align-top"><img src="<?php echo base_url() ?>/assets/images/users/3.jpg" alt="user" class="rounded-circle" /></div>
                                            <div class="chat-content pl-3 d-inline-block">
                                                <h5 class="text-muted">Angelina Rhodes</h5>
                                                <div class="box mb-2 d-inline-block text-dark rounded p-2 bg-light-primary">Well we have good budget for the project</div>
                                            </div>
                                            <div class="chat-time d-inline-block text-right text-muted">11:00 am</div>
                                        </li>
                                        <li class="mt-4">
                                            <div class="chat-img d-inline-block align-top"><img src="<?php echo base_url() ?>/assets/images/users/3.jpg" alt="user" class="rounded-circle" /></div>
                                            <div class="chat-content pl-3 d-inline-block">
                                                <h5 class="text-muted">Angelina Rhodes</h5>
                                                <div class="box mb-2 d-inline-block text-dark rounded p-2 bg-light-primary">Well we have good budget for the project</div>
                                            </div>
                                            <div class="chat-time d-inline-block text-right text-muted">11:00 am</div>
                                        </li>
                                        <!--chat Row -->
                                    </ul>
                                    <!--User 2 -->
                                    <ul class="chat-list chat" data-user-id="2">
                                        <!--chat Row -->
                                        <li class="mt-4">
                                            <div class="chat-img d-inline-block align-top"><img src="<?php echo base_url() ?>/assets/images/users/1.jpg" alt="user" class="rounded-circle" /></div>
                                            <div class="chat-content pl-3 d-inline-block">
                                                <h5 class="text-muted">James Anderson</h5>
                                                <div class="box mb-2 d-inline-block text-dark rounded p-2 bg-light-info">Lorem Ipsum is simply dummy text of the printing & type setting industry.</div>
                                            </div>
                                            <div class="chat-time d-inline-block text-right text-muted">10:56 am</div>
                                        </li>
                                        <!--chat Row -->
                                        <li class="mt-4">
                                            <div class="chat-img d-inline-block align-top"><img src="<?php echo base_url() ?>/assets/images/users/2.jpg" alt="user" class="rounded-circle" /></div>
                                            <div class="chat-content pl-3 d-inline-block">
                                                <h5 class="text-muted">Bianca Doe</h5>
                                                <div class="box mb-2 d-inline-block text-dark rounded p-2 bg-light-success">It’s Great opportunity to work.</div>
                                            </div>
                                            <div class="chat-time d-inline-block text-right text-muted">10:57 am</div>
                                        </li>
                                        <!--chat Row -->
                                        <li class="odd mt-4">
                                            <div class="chat-content pl-3 d-inline-block text-right">
                                                <div class="box mb-2 d-inline-block text-dark rounded p-2 bg-light-inverse">I would love to join the team.</div>
                                                <br/>
                                            </div>
                                            <div class="chat-time d-inline-block text-right text-muted">10:58 am</div>
                                        </li>
                                        <!--chat Row -->
                                        <li class="odd mt-4">
                                            <div class="chat-content pl-3 d-inline-block text-right">
                                                <div class="box mb-2 d-inline-block text-dark rounded p-2 bg-light-inverse">Whats budget of the new project.</div>
                                                <br/>
                                            </div>
                                            <div class="chat-time d-inline-block text-right text-muted">10:59 am</div>
                                        </li>
                                        <!--chat Row -->
                                        <li class="mt-4">
                                            <div class="chat-img d-inline-block align-top"><img src="<?php echo base_url() ?>/assets/images/users/3.jpg" alt="user" class="rounded-circle" /></div>
                                            <div class="chat-content pl-3 d-inline-block">
                                                <h5 class="text-muted">Angelina Rhodes</h5>
                                                <div class="box mb-2 d-inline-block text-dark rounded p-2 bg-light-primary">Well we have good budget for the project</div>
                                            </div>
                                            <div class="chat-time d-inline-block text-right text-muted">11:00 am</div>
                                        </li>
                                        <li class="mt-4">
                                            <div class="chat-img d-inline-block align-top"><img src="<?php echo base_url() ?>/assets/images/users/3.jpg" alt="user" class="rounded-circle" /></div>
                                            <div class="chat-content pl-3 d-inline-block">
                                                <h5 class="text-muted">Angelina Rhodes</h5>
                                                <div class="box mb-2 d-inline-block text-dark rounded p-2 bg-light-primary">Well we have good budget for the project</div>
                                            </div>
                                            <div class="chat-time d-inline-block text-right text-muted">11:00 am</div>
                                        </li>
                                        <!--chat Row -->
                                    </ul>
                                    <!--User 3 -->
                                    <ul class="chat-list chat" data-user-id="3">
                                        <!--chat Row -->
                                        <li class="mt-4">
                                            <div class="chat-img d-inline-block align-top"><img src="<?php echo base_url() ?>/assets/images/users/1.jpg" alt="user" class="rounded-circle" /></div>
                                            <div class="chat-content pl-3 d-inline-block">
                                                <h5 class="text-muted">James Anderson</h5>
                                                <div class="box mb-2 d-inline-block text-dark rounded p-2 bg-light-info">Lorem Ipsum is simply dummy text of the printing & type setting industry.</div>
                                            </div>
                                            <div class="chat-time d-inline-block text-right text-muted">10:56 am</div>
                                        </li>
                                        <!--chat Row -->
                                        <li class="mt-4">
                                            <div class="chat-img d-inline-block align-top"><img src="<?php echo base_url() ?>/assets/images/users/2.jpg" alt="user" class="rounded-circle" /></div>
                                            <div class="chat-content pl-3 d-inline-block">
                                                <h5 class="text-muted">Bianca Doe</h5>
                                                <div class="box mb-2 d-inline-block text-dark rounded p-2 bg-light-success">It’s Great opportunity to work.</div>
                                            </div>
                                            <div class="chat-time d-inline-block text-right text-muted">10:57 am</div>
                                        </li>
                                        <!--chat Row -->
                                        <li class="odd mt-4">
                                            <div class="chat-content pl-3 d-inline-block text-right">
                                                <div class="box mb-2 d-inline-block text-dark rounded p-2 bg-light-inverse">I would love to join the team.</div>
                                                <br/>
                                            </div>
                                            <div class="chat-time d-inline-block text-right text-muted">10:58 am</div>
                                        </li>
                                        <!--chat Row -->
                                        <li class="odd mt-4">
                                            <div class="chat-content pl-3 d-inline-block text-right">
                                                <div class="box mb-2 d-inline-block text-dark rounded p-2 bg-light-inverse">Whats budget of the new project.</div>
                                                <br/>
                                            </div>
                                            <div class="chat-time d-inline-block text-right text-muted">10:59 am</div>
                                        </li>
                                        <!--chat Row -->
                                        <li class="mt-4">
                                            <div class="chat-img d-inline-block align-top"><img src="<?php echo base_url() ?>/assets/images/users/3.jpg" alt="user" class="rounded-circle" /></div>
                                            <div class="chat-content pl-3 d-inline-block">
                                                <h5 class="text-muted">Angelina Rhodes</h5>
                                                <div class="box mb-2 d-inline-block text-dark rounded p-2 bg-light-primary">Well we have good budget for the project</div>
                                            </div>
                                            <div class="chat-time d-inline-block text-right text-muted">11:00 am</div>
                                        </li>
                                        <!--chat Row -->
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body border-top border-bottom">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-field mt-0 mb-0">
                                            <input id="textarea1" placeholder="Type and hit enter" style="font-family:Arial, FontAwesome" class="message-type-box form-control border-0" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    <script src="<?php echo base_url() ?>/assets/dist/js/pages/chat/chat.js"></script>
    <script>
        // $("body").on('keypress', document.getElementById('textarea1'), function(e) {
        //     console.log(document.getElementById('textarea1').value);
        //     mensaje = document.getElementById('textarea1').value;
        //     if (e.keyCode == 13) {
        //         console.log(mensaje);
        //         var id = $(this).attr("data-user-id");
        //         var msg = $(this).val();
        //         msg = msg_sent(msg);
        //         console.log(msg);
        //         $(".chat-windows #user-chat" + id + " .chat-body .chat-list").append(msg);
        //         $(this).val("");
        //         $(this).focus();
        //         console.log("HAKIIIIIIIHA");
        //     }
        // });
        // Send Messages

        function enviarMensaje(mensaje){
            var url = "<?php echo base_url('public/chat/enviar_mensaje'); ?>";
            $.post(url, mensaje, function(data, status){
                if (status){
                    console.log("SUCCESS", status, data);
                }else{
                    console.log("ERROR");
                }
            });
        }

        $('.message-type-box').on('keydown', function(event) {
            console.log("mensajetypeboc");
            if(event.key === 'Enter') {
                // Start getting time
                var now = new Date();
                var hh = now.getHours();
                var min = now.getMinutes();
                        
                var ampm = (hh>=12)?'pm':'am';
                hh = hh%12;
                hh = hh?hh:12;
                hh = hh<10?'0'+hh:hh;
                min = min<10?'0'+min:min;
                        
                var time = hh+" : "+min+" "+ampm;
                // End

                var chatInput = $(this);
                var chatMessageValue = chatInput.val();
                console.log(chatMessageValue+"123123");
                enviarMensaje(chatMessageValue);
                if (chatMessageValue === '') { return; }
                $messageHtml = '<li class="odd mt-4"> <div class="chat-content pl-3 d-inline-block text-right"> <div class="box mb-2 d-inline-block text-dark rounded p-2 bg-light-inverse">' + chatMessageValue + '<br> </div></div> <div class="chat-time d-inline-block text-right text-muted">' +  time +'</div> </li>';
                var appendMessage = $(this).parents('.chat-application').find('.active-chat').append($messageHtml);
                var clearChatInput = chatInput.val('');
            }
        })
    </script>
</body>

</html>