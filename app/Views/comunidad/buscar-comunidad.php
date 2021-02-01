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
            <?php $session = session();?>
            <div class="container-fluid">
                    <ul class="nav nav-pills p-3 bg-white mb-3 rounded-pill align-items-center">
                              <li class="nav-item"> <a class="nav-link rounded-pill note-link d-flex align-items-center active px-2 px-md-3 mr-0 mr-md-2" id="all-category">
                                <i class="icon-layers mr-1"></i><span class="d-none d-md-block">Acceso rapido a <?php echo $session->grupo_nombre; ?></span></a> 
                              </li>
                              <li class="nav-item ml-auto"> <a href="<?php echo site_url("comunidad/editar/".$session->grupo_id); ?>" class="nav-link btn-primary rounded-pill d-flex align-items-center px-3" id="add-notes">
                                <i class="icon-note m-1"></i><span class="d-none d-md-block font-14">Editar</span></a> 
                              </li>
                    </ul>
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
                            <form class="form-horizontal" name="comunidad_search" id="user_search" method="post" accept-charset="utf-8">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="nombre" class="col-sm-3 text-right control-label col-form-label">Nombres</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre de la comunidad">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nombre" class="col-sm-3 text-right control-label col-form-label">Categoria</label>
                                        <div class="col-sm-9">
                                        <select id="oid_categoria" name="oid_categoria" class="form-control form-control-line">
                                                        <option value="">Todas las categorias</option>
                                                        <option value="0">Sin especificar</option>
                                                        <?php foreach($r_grupocategoria as $r){ ?>
                                                            <option value="<?=$r->oid?>"><?= $r->nombre ?></option>
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
        // $(document).ready(function(){
        
        //     $('#comunidad_search').onsubmit(function(){
        //         console.log("HOLAAAAA")
        //         var username = $(this).val();
        //         $.ajax({
        //             url:'<?php echo base_url('public/comunidad/buscar_comunidad'); ?>',
        //             method: 'post',
        //             data: {username: username},
        //             dataType: 'json',
        //             success: function(response){
        //                 var len = response.length;
        //                 $('#suname,#sname,#semail').text('');
        //                 if(len > 0){
        //                     // Read values
        //                     var uname = response[0].username;
        //                     var name = response[0].name;
        //                     var email = response[0].email;
                    
        //                     $('#suname').text(uname);
        //                     $('#sname').text(name);
        //                     $('#semail').text(email);
        //                 }
        //             }
        //         });
        //     });
        // });
    </script>
</body>

</html>