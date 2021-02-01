<?php //echo view('dgac/headers'); ?>
<?php echo $headers['headersView']; ?>
<!-- <link href="<?php echo base_url() ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet"> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<!-- <link href="<?php echo base_url() ?>/assets/libs/bootstrap-table/dist/bootstrap-table.min.css" rel="stylesheet" type="text/css" /> -->
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css"> -->
<?php
  use App\Models\UsuarioModel;
  $usu = new UsuarioModel($db);
  $usuario = $usu->getUsuario2($p->oid_usuario);
  $texto = "<hr><p>En referencia a:</p>";
  $texto.=$post->ausnto;
?>
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
                <!-- Row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="card-title text-white">Enviar correo electronico</h4>
                            </div>
                            <div class="card-body">
                                <form action="<?php echo base_url('public/Post/mostrar_email')."/".$p->oid_foro."/".$p->oid; ?>" method="post" enctype="multipart/form-data">
                                   
                                   <input type="hidden" name="oid_tema" value="<?=$p->oid?>">
                                                        <input type="hidden" name="oid_padre" value="<?=$p->oid_padre?>">
                                                    
                                                        <input type="hidden" name="email_post" value="<?=$usuario->email?>">
                                                        <div class="form-group">
                                                            <p>
                                                            <label for=""><b>Para: </b> <?=NombrePerfil($p->oid_usuario)?></label>
                                                            </p>

                                                            <p>
                                                            <label for=""><b>Correo electronico: </b> <?=$usuario->email?></label>
                                                           </p>
                                                            <label for=""><b>Asunto</b></label>
                                                            <input type="text" class="form-control asunto" id="asunto" name="asunto" placeholder="RE:Tema" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label><b>Respuesta</b></label>
                                                            <textarea class="editor" cols="80"  name="texto" id="texo" rows="1" style="overflow:scroll; resize: none;" required value="<?=?>">           
                                                            </textarea>
                                                           
                                                        </div>
                                                        <div class="form-group">
                                                            <label for=""><b>Archivo</b></label>
                                                            <input type="file" class="form-control" id="archivo" name="archivo" >
                                                        </div>
                                                        
                                                      
                                                        <button type="submit" class="btn btn-info waves-effect waves-light text-center">Guardar</button>
                                                        <button  id="cancel_resp_hijo" data-id="<?=$p->oid?>" type="button" class=" btn btn-danger waves-effect waves-light cancel_resp_hijo">Cancelar</button>
                             
                                   
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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

    <!-- This Page JS -->

    <script src="<?php echo base_url() ?>/assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/js/pages/datatable/custom-datatable.js"></script>
    
    <script type="text/javascript" charset="utf8" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/js/dataTables.checkboxes.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('texto', {
          language: 'es'
        });
    </script>

    
</body>

</html>