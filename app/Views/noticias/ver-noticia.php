

<?php 
   function changeDateFormat($format = 'd-m-Y', $originalDate)
   {
       return date($format, strtotime($originalDate));
   }
   
   ?>
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
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <!-- Row -->
            <div class="row">
               <!-- Column -->
               <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="col-lg-12 col-xlg-12 col-12">
                            
                                <div class="card col-lg-12 col-xlg-12 col-12" >
                                    <?php if ($preview->foto_grande){
                                        $imagen = base_url("assets/uploads/noticias/$preview->foto_grande");
                                        ?>
                                        <img class="card-img-top img-fluid" src="<?php echo $imagen;?>" alt="Card image cap">
                                        <?php
                                    }else{
                                        $imagen = base_url("assets/images/not_image.png");
                                    } ?>
                                    
                                    <div class="card-body">
                                        <h4 class="card-title"><?php echo $preview->titulo; ?></h4>
                                          <span>
                                          Publicado por 
                                          <?php 
                                             echo $preview->nombres." ".$preview->apellidos
                                             ?>
                                          <?php 
                                             $datetime = explode(' ', $preview->datetime);
                                             echo '('.changeDateFormat('d/m/Y',$datetime[0])." ",$datetime[1].')';
                                             ?>
                                          </span>
                                        <p class="card-text"><?php echo ($preview->resumen); ?></p>

                                        <?php if($preview->attach !=""){ ?>
                                             <div class="row mt-5">
                                                <div class="col-md-12">
                                                   <hr>
                                                   <label>Documento Adjunto: </label>
                                                   <a download href='<?php echo base_url("assets/uploads/noticias/$preview->attach"); ?>'>
                                                   Descargar
                                                   </a>
                                                </div>
                                             </div>
                                             <?php } ?>
                                        
                                        <span class="action-icons">
                                        <? if(MostrarElemento(array('Noticias/noticiaDelete'))){?>
                                                <a title="Borrar" onclick="return confirm('¿Desea eliminar la noticia?')" href="<?php echo base_url('public/Noticias/noticiaDelete/'.$preview->oid) ?>" class="pl-3">
                                                <i class="icon-trash"></i>
                                                </a>
                                            <?php } ?>
                                            <? if(MostrarElemento(array('Noticias/noticiaModificar'))){?>
                                                <a title="Editar" href="<?php echo base_url('public/Noticias/noticiaModificar/'.$preview->oid) ?>" class="pl-3">
                                                <i class="ti-pencil-alt"></i>
                                                </a>
                                            <?php } ?>
                                        </span>
                                            <!-- <a href="javascript:void(0)" class="pl-3"><i class="ti-heart"></i></a> -->
                                    </div>
                                </div>

                                <div class="card col-lg-12 col-xlg-12 col-12">
                                <form action="<?php echo base_url('public/Noticias/noticiaComentario/'.$preview->oid) ?>" method="POST">
                                    <input type="hidden" name="seccion" value="NEWS">
                                    <div class="col-md-12 mt-2">
                                       <div class="row mt-3">
                                          <div class="col-md-12">
                                             <div class="alert alert-primary">Agregar Comentario</div>
                                             <textarea required="" class="form-control" id="texto" name="texto" rows="12" cols="80"></textarea>
                                          </div>
                                       </div>
                                       <div class="row mt-2">
                                          <div class="col-md-12">
                                             <input class="btn btn-primary" type="submit" value="Guardar">
                                          </div>
                                       </div>
                                    </div>
                                 </form>
                                 <br>
                                 </div>

                                <div class="card col-lg-12 col-xlg-12 col-12">
                                <div class="profiletimeline position-relative">
                                <?php foreach ($comentarios as $key => $value) { ?>
                                            <div class="sl-item mt-2 mb-3">
                                                <div class="sl-left float-left mr-3"> <img src='<?php echo base_url(fotoPerfil($value->user_oid)); ?>' alt="user" class="rounded-circle"> </div>
                                                <div class="sl-right">
                                                    <div>
                                                        <div class="d-md-flex">
                                                            <h5 class="mb-0 font-weight-light">
                                                                <a href="#" class="link"><?php echo $value->nombres." ".$value->apellidos ?></a>
                                                            </h5>
                                                            <span class="sl-date text-muted ml-1">
                                                            <?php 
                                                            $datetime = explode(' ', $value->datetime);
                                                            echo changeDateFormat('d/m/Y',$datetime[0])." ",$datetime[1];
                                                            ?>
                                                            </span>
                                                        </div>

                                                        <p>Nuevo comentario<a href="#"></a></p>
                                                        <div class="row">
                                                            <p class="mt-2"><?php echo strip_tags($value->comentario) ?><p>
                                                        </div>
                                                        <span class="action-icons">
                                                         <? if(MostrarElemento(array('Noticias/ComentarioDelete'))){?>
                                                                  <a title="Borrar" onclick="return confirm('¿Desea eliminar la noticia?')" href="<?php echo base_url('public/Noticias/ComentarioDelete/'.$preview->oid.'/'.$value->oid) ?>" class="pl-3">
                                                                  <i class="icon-trash"></i>
                                                                  </a>
                                                            <?php } ?>
                                                            
                                                         </span>
                                                        <!-- <div class="text-nowrap"> 
                                                            <a href="javascript:void(0)" class="link mr-2">2 comment</a> 
                                                            <a href="javascript:void(0)" class="link mr-2"><i class="fa fa-heart text-danger"></i> 5 Love</a>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <?php } ?>
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
   <script>
      CKEDITOR.replace('texto', {
        language: 'es'
      });
   </script>
</body>
</html>

