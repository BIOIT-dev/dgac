<?php echo view('dgac/headers'); ?>

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
                        
                            <a id="compose_mail" class="btn btn-secondary waves-effect waves-light" href="<?php echo base_url('public/Mensajeria/correo_masivo/'.$rol); ?>">Enviar correo masivo</a>
                        
                            <a id="compose_mail" class="btn btn-primary waves-effect waves-light" href="<?php echo base_url('public/Mensajeria/mensaje_masivo/'.$rol); ?>">Enviar mensaje masivo</a>
                        
                    </div>
                    <div class="col-lg-12 col-xl-12 col-md-12">
                        <div class="card" style="background-color: transparent;margin-bottom: 0px;">
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center">
                                    <!-- <h4 class="card-title"><?php echo $headers['ubicacion']; ?></h4> -->
                                        <div class="ml-auto">
                                            <div class="btn-group">
                                                <select class="form-control" name="" id=""  onchange="doChange(this);">
                                                    <option value="ALU" <?=$rol=='ALU'?"selected='selected'":""?>>Alumnos</option>
                                                    <option value="TUT" <?=$rol=='TUT'?"selected='selected'":""?>>Gestor Administrativo</option>
                                                    <option value="PRO" <?=$rol=='PRO'?"selected='selected'":""?>>Profesores</option>
                                                    <option value="PUB" <?=$rol=='PUB'?"selected='selected'":""?>>Coordinadores</option>
                                                    <option value="VIS" <?=$rol=='VIS'?"selected='selected'":""?>>Curricular</option>
                                                    <option value="ADM" <?=$rol=='ADM'?"selected='selected'":""?>>Administradores</option>
                                                    <option value="POS" <?=$rol=='POS'?"selected='selected'":""?>>Administrador de Admision</option>
                                                    <!-- <option value="CONN">Usuarios Conectados</option> -->
                                                </select>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="row el-element-overlay">
                            <?php foreach ($resultado_busqueda as $key => $value) { ?>
                                <div class="col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="el-card-item pb-3">
                                            <div class="el-card-avatar mb-3 el-overlay-1 w-100 overflow-hidden position-relative text-center"> 
                                                <img src="<?php echo base_url(fotoPerfil($value->oid)); ?>" alt="user" class="d-block position-relative w-100">
                                                <div class="el-overlay w-100 overflow-hidden">
                                                    <ul class="list-style-none el-info text-white text-uppercase d-inline-block p-0">
                                                        <li class="el-item d-inline-block my-0  mx-1"><a class="btn default btn-outline image-popup-vertical-fit el-link text-white border-white" href="<?php echo base_url('assets/images/users/'.$value->foto); ?>"><i class="icon-user"></i></a></li>
                                                        <li class="el-item d-inline-block my-0  mx-1">
                                                          <a onclick="get_email('<?php echo $value->email; ?>');" class="btn default btn-outline el-link text-white border-white" data-toggle="modal"data-target="#myModalEmail"><i class="mdi mdi-email"></i></a>
                                                        </li>
                                                        <li class="el-item d-inline-block my-0  mx-1">
                                                          <a onclick="get_user_id('<?php echo $value->oid; ?>','<?php echo $value->nombres.' '.$value->apellidos;?>');" data-toggle="modal"data-target="#myModalMessage" class="btn default btn-outline el-link text-white border-white" href="javascript:void(0);"><i class="mdi mdi-message"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="el-card-content text-center">
                                                <h4 class="mb-0"><?php echo $value->nombres.' '.$value->apellidos;?></h4> 
                                                
                                            </div>
                                            <div class="el-card-content text-center">
                                            <span class="text-muted"><i class="far fa-envelope" style="color:#2288e5;"></i> <?php echo $value->email; ?></span>
                                            <br>
                                            <span class="text-muted"><i class="fas fa-phone" style="color:#2288e5;"></i> <?php echo $value->fono; ?></span>
                                                <hr>
                                                <div class="row text-center justify-content-md-center">
                                                    <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium"><?php echo $value->conexiones; ?></font></a></div>
                                                    <!-- <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i> <font class="font-medium">54</font></a></div> -->
                                                </div>
                                                <span class="text-muted"><?php echo substr(strip_tags($value->quien_soy),0,150); ?>...</span>
                                            </div>
                                        </div>
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

      var get_email = function(email){
        $("#email-user").val(email);
      }

      var get_user_id = function(oid,full_name){
        $("#oid_destino").val(oid);
        $("#full_name").val( 'Enviar a ' + full_name );
      }

      $( "a.show-forms-user" ).click(function() {
          
          //var id       = $(this).data('id');
          //var revisado = $(this).val();
          
          //$.ajax({
          //    url: '<?php echo site_url('Usuario/change_pay');?>',
          //    type : 'POST',
          //    data : {
          //        'oid' : id,
          //        'revisado' : revisado
          //    },
          //    success: function( response )
          //    {
          //        toastr.success('Se ha realizado el cambio de estatus correctamente!', 'Información');
          //    }
          //});

      });


        function doChange( s ){
            var _rol=s.options[ s.selectedIndex ].value;
            // alert(_rol)
            document.location="<?php echo base_url('public/usuario/mi_comunidad/'); ?>/" + _rol;
        }
   </script>
</body>
</html>

<!-- Envio de email -->
<div id="myModalEmail" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="myModalEmailLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myModalEmailLabel">Mensaje</h4>
                <button type="button" class="close ml-auto" data-dismiss="modal"
                    aria-hidden="true">×</button>
            </div>
            <form action="<?php echo base_url('public/Usuario/send_email_user/'.$rol); ?>" name="send_email_user" id="send_email_user" method="post" accept-charset="utf-8">
              <div class="modal-body">
                  <input class="form-control" type="text" id="email-user" name="email" readonly="">
                  <textarea placeholder="Escribe un mensaje" required="" class="form-control mt-3" name="message" rows="12" cols="80"></textarea>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-light"
                      data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-success mt-3"><i class="far fa-envelope"></i> Enviar</button>
              </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Envio de mensajeria -->
<div id="myModalMessage" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="myModalMessageLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myModalMessageLabel">Redactar</h4>
                <button type="button" class="close ml-auto" data-dismiss="modal"
                    aria-hidden="true">×</button>
            </div>
            <form action="<?php echo base_url('public/Usuario/send_message_user/'.$rol); ?>" name="send_message_user" id="send_message_user" method="post" accept-charset="utf-8">
              <div class="modal-body">
                  <input class="form-control" type="text" id="full_name" readonly="">
                  <input class="form-control" type="hidden" id="oid_destino" name="oid_destino">
                  <textarea placeholder="Escribe un mensaje" required="" class="form-control mt-3" name="message" rows="12" cols="80"></textarea>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-light"
                      data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-success mt-3"><i class="far fa-envelope"></i> Enviar</button>
              </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


