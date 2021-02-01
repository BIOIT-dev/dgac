<?php
//echo view('dgac/headers');
?>
<?php
use App\Models\ForoForoModel;
use App\Models\ForoPostModel;
use App\Models\UsuarioModel;

$obj_post = new ForoPostModel($db);
?>
<?php echo $headers['headersView']; 

?>
<!-- <link href="<?php echo base_url(); ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet"> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<!-- <link href="<?php echo base_url(); ?>/assets/libs/bootstrap-table/dist/bootstrap-table.min.css" rel="stylesheet" type="text/css" /> -->
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css"> -->

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
<br>
            <div class="container-fluid card bg-white">
                <!-- Row -->
                <!-- Row -->
                <div class="col-xs-12 ">
                  <?php
                        if($rol =='ADM' or $rol =='PRO'  )
                        {
                    ?>
                    <a style="margin-left: 1%;" title="Agregar Categoría de Foro" href="<?php echo base_url('public/CategoriasForos/add'); ?>">
                         <button class="btn btn-primary btn-outline col-xs-12 col-sm-2 "><i class="fa fa-plus text-blue"></i> Agregar Categoría</button>
                        
                    </a>
                    <?
                    }
                    ?>
                </div>
                <br>

<div class="col-md-12 col-lg-12">
    <?php
      foreach ($categorias as $cate) {
    ?>
     <div class="d-flex no-block align-items-center bg-success pr-2 pt-1 pb-1 mb-1">
                <b class="text-white pl-3" style="padding-top: 3px" !important><?=$cate->nombre?></b>
                <div class="ml-auto text-right">
                  <div class="col-xs-1  float-right ml-4">
              <?php
                    if($rol =='ADM' or $rol =='PRO')
                    {
                ?>
                    <a href="<?php echo base_url('public/CategoriasForos/edit/'.$cate->oid); ?>">
                        <button type="button" class="btn btn-dark btn-xs col-xs-12 " title="Editar Categoría">
                            <i class="fa fa-edit"></i> 
                        </button>
                    </a>   

                    <a href="<?php echo base_url('public/Foro/add/'.$cate->oid); ?>"> 
                        <button type="button" class="btn btn-primary btn-xs" title="Agregar Foro">
                            <i class="fa fa-plus text-blue"></i> 
                        </button>
                    </a>
            <?
                }
            ?>
                 </div>
          </div>
      </div>
      
      
      <?php
        $foro = new ForoForoModel($db);
        $foros = $foro->getFilterElement($cate->oid);

        foreach ($foros as $f) {
          ?> 
            <div class="table-responsive ">
                    <table id="zero_config" class="table  bg-light border border-success">
                        <tbody>
                            <tr>
                                <td colspan="5" width="90%">
                                    <i class=" fas fa-download text-info pl-2 fa-lg"></i>
                                  <span class="col-xs-9 pl-3 text-capitalize text-dark"><strong><?=$f->nombre?></strong></span>
                                </td>
                            
                                <td class="text-right">
                        <?php
                            if($rol =='ADM' or $rol =='PRO')
                            {
                        ?>
                                    <a href="<?php echo base_url('public/Foro/edit/'.$f->oid); ?>"> 
                                      <button type="button" class="btn btn-dark btn-xs" title="Editar Foro">
                                          <i class="fa fa-edit"></i> 
                                      </button>
                                    </a>
                          
                              
                                    <a href="<?php echo base_url('public/Foro/exportarForo/'.$f->oid); ?>"  target="_blank">
                                          <button type="button" class="btn btn-info btn-xs" title="Exportar Foro">
                                              <i class="fas fa-save fa-1x text-white"></i> 
                                          </button>
                                    </a>
                                    <a href="<?php echo base_url('public/Foro/estadisticasForo/'.$f->oid); ?>">
                                          <button type="button" class="btn btn-success btn-xs" title="Estadisticas Foro">
                                              <i class="far fa-file-excel text-white"></i> 
                                          </button>
                                    </a>
                            <?
                            }
                            ?>
                                </td>
                              
                            </tr>
                           <tr>
                                <td colspan="6" class="pl-5">
                                     <span class="text-dark"><?=$f->descripcion?></span>
                                </td>
                            </tr>
                            <tr class="text-right">
                               
                                <td colspan="2" width="40%">
                                  <span><b class="text-dark">Temas en discusión</b> </span>
                                </td>
                                <td colspan="1" width="22%">
                                  <span><b class="text-dark">Mensajes</b> </span>
                                </td>
                            
                                <td colspan="2" width="20%">
                                  <span><b class="text-dark">Último Mensaje</b> </span>
                                </td>
                                <td colspan="1" width="15%" class="pr-2">
                    <?php
                            if($rol =='ADM' or $rol =='PRO'){
                                          
                                    ?>
                                                <a href="<?php echo base_url('public/Post/add/'.$f->oid); ?>">
                                      <button type="button" class="btn btn-primary btn-xs" title="Agregar Tema">
                                          <i class="fa fa-plus text-blue"></i> 
                                      </button>
                                </a>
                    <?
                        }
                    ?>
                                </td>
                            </tr>
                           
                        </tbody>
                      
                    </table>
                   
            </div>

                <!--temas por cada foro-->
                <?php
                    $temas = $obj_post->getFilterElement($f->oid);

                    foreach ($temas as $tem) { 
                ?>
                 <div class="table-responsive pl-5">
                    <table id="zero_config" class="table  bg-white border border-secondary">
                        <tbody>
                            <tr class="bg-light">
                                <td colspan="3" width="51%">

                                    <a href="<?php echo base_url('public/Post/tema_detalle/'.$f->oid.'/'.$tem->oid); ?>">
                                        <i class=" mdi  mdi-forum pl-2  text-primary fa-lg"></i>
                                    </a>

                                    <span class="hover">
                                        <a href="<?php echo base_url('public/Post/tema_detalle/'.$f->oid.'/'.$tem->oid); ?>" >
                                          <span class="col-xs-9 pl-3 text-capitalize text-dark "><strong><?=$tem->asunto?></strong></span>
                                        </a>
                                    </span>
                                </td>
                                <td colspan="1" width="15%" class="text-center">
                                    <span><strong>
                                        <?php echo $obj_post->getCountPost($tem->oid);
                                        ?>
                                        
                                    </strong></span>
                                   
                                </td>
                            
                                <td colspan="1" class="pl-3 text-right" width="20%">
                                    <span>
                                        <strong>
                                        <?php  
                                            echo date("d/m/Y h:i:s", strtotime($obj_post->getLastPost($tem->oid)));
                                        ?>
                                        </strong>
                                    </span>
                                </td>
                                <td colspan="1" width="17" class="text-right">
                            <?php
                            if($rol =='ADM' or $rol =='PRO'  ){
                                          
                            ?>
                                    <a href="" class="delete_tema" id-tema="<?=$tem->oid?>">
                                          <button type="button" class="btn btn-danger btn-xs" title="Eliminar Tema">
                                              <i class="fa fa-trash"></i> 
                                          </button>

                                    </a>
                                   
                                    <a href="<?php echo base_url('public/Post/edit/'.$tem->oid); ?>">
                                          <button type="button" class="btn btn-dark btn-xs" title="Editar Tema">
                                              <i class="fa fa-edit  text-white"></i> 
                                          </button>
                                    </a>

                            <?
                            }
                            ?>

                                </td>
                            </tr>
                           <tr>
                                <td colspan="1" width="12%">
                                    <?php
                                        $usuario = new UsuarioModel($db);
                                        $findUsuario = $usuario->find($tem->oid_usuario);

                                    ?>
                                    <img src="<? echo  base_url(fotoPerfil($tem->oid_usuario)); ?>" alt="user" class="img-fluid" width="90">
                                     
                                </td>
                               
                                <td colspan="3">
                                    <strong><?=$findUsuario['nombres'].' '.$findUsuario['apellidos']?>
                                    </strong>
                                    <p class="font"><strong><?=date("d/m/Y h:i:s", strtotime($tem->fecha))?></strong></p>
                                        <div class=" entrar" title="Entrar al tema" data-id="<?=$tem->oid?>" data-foro="<?=$tem->oid_foro?>">
                                            <i class="mdi mdi-open-in-new fa-lg text-info"></i>
                                            <span class="pl-3 "><?=$tem->texto?></span>
                                        </div>
                                </td>
                                <td colspan="2"></td>
                            </tr>
                          
                           
                        </tbody>
                      
                    </table>
                   
            </div>
                <?
                  }
                ?>

                <!--Fin de Temas-->
        <?php 
            }
        ?>
        <br><br>
    <?php 
      }
    ?>

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

    <script src="<?php echo base_url(); ?>/assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/dist/js/pages/datatable/custom-datatable.js"></script>
    <!-- <script src="<?php echo base_url(); ?>/assets/dist/js/pages/datatable/datatable-basic.init.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script> -->

    <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script> -->
    <script type="text/javascript" charset="utf8" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/js/dataTables.checkboxes.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/extra-libs/confirm/jquery-confirm.min.css">
    <script src="<?php echo base_url() ?>/assets/extra-libs/confirm/jquery-confirm.min.js"></script>

    <!-- This Page JS -->
    <!-- <script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/libs/bootstrap-table/dist/bootstrap-table.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/libs/bootstrap-table/dist/bootstrap-table-locale-all.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/libs/bootstrap-table/dist/extensions/export/bootstrap-table-export.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/dist/js/pages/tables/bootstrap-table.init.js"></script> -->


</body>

</html>

    <script type="text/javascript">

        $( document ).ready(function() {

            $(".entrar").mouseover(function(){
              $(this).addClass(["punteado"]);
            });

            $(".entrar").mouseout(function(){
              $(this).removeClass(["punteado"]);
            });

            $(".entrar").on("click", function(){
                _id_tema = $(this).attr("data-id");
                _id_foro = $(this).attr("data-foro");
                _base_url = "<?=base_url('public/Post/tema_detalle/')?>"


                location.href = _base_url+'/'+_id_foro+'/' +_id_tema
            })

            $(".delete_tema").on("click", function(){
                _id_tema = $(this).attr("id-tema")

                $.confirm({
                        title: 'Eliminar Tema!',
                        content: 'Seguro desea eliminar el tema',
                        type: 'red',
                        typeAnimated: true,
                        buttons: {
                            tryAgain: {
                                text: 'Eliminar',
                                btnClass: 'btn-red',
                                action: function(){

                                     $.ajax({
                                        type : "post",
                                        url: "<?=base_url('public/Post/delete/')?>",
                                        data: {'id_tema': _id_tema},
                                        dataType : 'json',
                                        success: function(respuesta) {
                                            if(respuesta.exito == 1){
                                                 Swal.fire({
                                                    title: "Registro Eliminado",
                                                    text: "El tema se ha eliminado con exito!",
                                                    type: "success",
                                                    showCancelButton: true,
                                                    showConfirmButton : false,
                                                    cancelButtonColor: "#3085d6",
                                                    cancelButtonText: "OK",
                                                    closeOnConfirm: true
                                                })

                                                setTimeout(function(){ location.reload(); }, 7000);

                                            }else{
                                                Swal.fire({
                                                    title: "error al Eliminar",
                                                    text: "Ocurrio un error al eliminar Registro!",
                                                    type: "danger",
                                                    showCancelButton: true,
                                                    cancelButtonColor: "#DD6B55",
                                                    showConfirmButton : false,
                                                    cancelButtonText: "OK",
                                                    closeOnConfirm: false
                                                })

                                                setTimeout(function(){ location.reload(); }, 7000);
                                                

                                            }
                                        },
                                        error: function() {
                                            console.log("No se ha podido obtener la información");
                                        }
                                    });
                                }
                            },
                            close: {
                                  text: 'Cerrar',
                                action: function () {
                                }
                            }
                        }
                });

               

                return false;
             });

        })

    </script>
<style>
.card {
   margin-bottom: 6px !important; 
   border-radius: 0px !important;
}
.card-header {
    padding: .25rem 1rem;
    margin-bottom: 0;
    background-color: rgba(0,0,0,.03);
    border-bottom: 0 solid rgba(0,0,0,.125);
}
.alert1 {
    position: relative;
    padding: .55rem 1.25rem;
    border: 1px solid #c2c7cc; 
    border-radius: 0px; 
    margin-bottom: 0px !important;
}

.hover>a:hover{ 
    color: #17202A !important; 
    text-decoration: underline !important;
}


table td, .table th {
    padding: .45rem !important;
    vertical-align: top;
    border-top: 0px solid #e8eef3 !important;
}

.punteado{
  border-style: dotted;
   border-width: 1px;
   border-color: 660033;
   background-color: cc3366;
   font-family: verdana, arial;
   font-size: 10pt;
   cursor: pointer;
}

.entrar {
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2; /* number of lines to show */
    -webkit-box-orient: vertical;
}

mouse-pointer
</style>