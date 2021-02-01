

<?php //echo view('dgac/headers'); ?>
<?php 
   $session   = session();
   if(isset($session->accesos)){
   $accesos   = $session->accesos;
   $lectura   = $accesos['lectura'];
   $escritura = $accesos['escritura'];
   $eliminar  = $accesos['eliminar'];
    }
   ?>
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
                    <div class="col-lg-12 col-xl-12 col-md-12">
                        <div class="card" style="background-color: transparent;margin-bottom: 0px;">
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center">
                                    <!-- <h4 class="card-title"><?php echo $headers['ubicacion']; ?></h4> -->
                                    <? if(MostrarElemento(array('Noticias/noticiaAdd'))){?>
                                        <div class="ml-auto">
                                            <div class="btn-group">
                                                <a class="btn btn-dark" href="<?php echo base_url('public/Noticias/noticiaAdd') ?>">
                                                    Agregar Noticia
                                                </a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-columns">
                            <?php foreach ($noticias as $key => $value) { ?>
                                <div class="card" >
                                    <?php if ($value->foto_chica){
                                        $imagen = base_url("assets/uploads/noticias/$value->foto_chica");
                                        ?>
                                        <img class="card-img-top img-fluid" src="<?php echo $imagen;?>" alt="Card image cap">
                                        <?php
                                    }else{
                                        $imagen = base_url("assets/images/not_image.png");
                                    } ?>
                                    
                                    <div class="card-body">
                                        <h4 class="card-title"><?php echo $value->titulo; ?></h4>
                                        <p class="card-text"><?php echo strip_tags($value->resumen); ?></p>
                                        <?php if( !isset($lectura) ||  $lectura == 1  || false ){ ?>
                                            <a href="<?php echo base_url('public/Noticias/noticiaPreview/'.$value->oid); ?>">
                                                <span class="badge badge-info">Acceder</span>
                                            </a> 
                                        <?php } ?>
                                        <span class="action-icons">
                                            <? if(MostrarElemento(array('Noticias/noticiaDelete'))){?>
                                                <a title="Borrar" onclick="return confirm('¿Desea eliminar la noticia?')" href="<?php echo base_url('public/Noticias/noticiaDelete/'.$value->oid) ?>" class="pl-3">
                                                <i class="icon-trash"></i>
                                                </a>
                                            <?php } ?>
                                            <? if(MostrarElemento(array('Noticias/noticiaModificar'))){?>
                                                <a title="Editar" href="<?php echo base_url('public/Noticias/noticiaModificar/'.$value->oid) ?>" class="pl-3">
                                                <i class="ti-pencil-alt"></i>
                                                </a>
                                            <?php } ?>
                                        </span>
                                            <!-- <a href="javascript:void(0)" class="pl-3"><i class="ti-heart"></i></a> -->
                                    </div>
                                </div>
                            <?php } ?>
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
   <script src="<?php echo base_url() ?>/assets/libs/ckeditor/ckeditor.js"></script>
   <script type="text/javascript">
      $( "#tipo" ).change(function() {
          var tipo = $(this).val();
          if( tipo == 2 ){
              $("#nombre_panel").prop( "readonly" , false );
          }else{
              $("#nombre_panel").val("");
              $("#nombre_panel").prop( "readonly" , true );
          }
      });
   </script>
</body>
</html>

