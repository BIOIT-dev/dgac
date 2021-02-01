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
                    
                    <!-- Fin Panel de noticias  -->
                    <!-- ============================================================== -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                
                            <!-- <form class="form-horizontal" action="<?php //echo base_url('public/Usuario/buscar_usuario'); ?>" name="user_search" id="user_search" method="post" accept-charset="utf-8"> -->
                            <form class="form-horizontal" name="user_search" id="user_search" method="post" accept-charset="utf-8">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="titulo" class="col-sm-3 text-right control-label col-form-label">Título</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Título">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Comunidad</label>
                                        <div class="col-sm-9">
                                            <select name="oid_grupo" class="form-control">
                                                <option value="0" selected='selected'>Todas las Comunidades</option>
                                                <?php foreach($query as $que) { ?>
                                                    <option value="<?php echo $que->oid ?>"><?php echo $que->nombre ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <div class="form-group mb-0 text-right">
                                        <button type="submit" class="btn btn-success waves-effect waves-light">Buscar</button>
                                    </div>
                                </div>
                            </form>
                                
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
    <script type='text/javascript'>
        $(document).ready(function(){
        
            $('#user_search').onsubmit(function(){
                console.log("HOLAAAAA")
                var username = $(this).val();
                $.ajax({
                    url:'<?php echo base_url('public/Usuario/buscar_usuario'); ?>',
                    method: 'post',
                    data: {username: username},
                    dataType: 'json',
                    success: function(response){
                        var len = response.length;
                        $('#suname,#sname,#semail').text('');
                        if(len > 0){
                            // Read values
                            var uname = response[0].username;
                            var name = response[0].name;
                            var email = response[0].email;
                    
                            $('#suname').text(uname);
                            $('#sname').text(name);
                            $('#semail').text(email);
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>