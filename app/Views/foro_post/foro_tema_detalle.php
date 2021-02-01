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
        <div class="col-xs-12 text-right">
            <a style="margin-left: 1%;" title="Regresar a Categoría de Foro" href="<?php echo base_url('public/CategoriasForos/index'); ?>">
                 <button class="btn btn-success btn-outline col-xs-12 col-sm-1 "><i class=" fas fa-arrow-left text-blue fa-1x"> Volver</i></button>
                
            </a>
        </div>
        <br>

        <div class="col-md-12 col-lg-12">

            <div class="table-responsive bg-light-info border borde-tema">
                <table id="zero_config" class="table  ">
                    <tbody>
                           <tr>
                                <td colspan="1" width="12%">
                                  
                                    <img src="<?=base_url(fotoPerfil($tema->oid_usuario));?>" alt="user" class="img-fluid" width="90">
                                     
                                </td>
                               
                                <td colspan="3">
                                    <span class="font text-dark"><?=date("d/m/Y h:i:s", strtotime($tema->fecha))?>
                                         
                                    </span>
                                    <p>
                                        <strong class="text-dark">Publicado por: <?=NombrePerfil($tema->oid_usuario)?>
                                        </strong>

                                        <span class="pl-3 text-white"><?=$tema->texto?></span>
                                    </p>
                                   <?php
                                    if($tema->archivo!=""){
                                    ?>
                                    <p>
                                        <b  class="text-dark">Documento Adjunto: </b>
                                        <a download href='<?php echo base_url("assets/uploads/foro/".$tema->archivo); ?>'>
                                            <i class="fas fa-download fa-1x"></i>
                                            Descargar
                                        </a>
                                    </p>

                                   <?php } ?>
                                </td>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-info btn-reponse" id="btn_resp">Responder</button>
                                    <button type="button" class="btn btn-danger btn-reponse" id="cancel_resp" style="display: none">Cancelar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
            </div>
            <hr>
            
            <div class="row">
                    <div class="col-xs-1 col-lg-1"></div>
                    <div class="col-xs-10 col-lg-10">
                        <div class="card div_resp" style="display: none">
                            <div class="card-body bg-dark rounded-top">
                                <h4 class="text-white card-title pl-3">Publicar Respuesta</h4>
                            </div>
                            <div class="card-body p-2 border border-dark bg-light-info">
                               
                                <div class="col-sm-12 col-xs-12 ">
                                            <form id="form_resp" action="<?=base_url('public/Post/add_response')?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                                <input type="hidden" name="oid_tema" value="<?=$tema->oid?>">
                                                
                                                <input type="hidden" name="jerarquia" value="<?=$tema->jerarquia?>">
                                                 <input type="hidden" name="foro_id" value="<?=$tema->oid_foro?>">
                                                <div class="form-group">
                                                    <label for=""><b>Asunto</b></label>
                                                    <input type="text" class="form-control" id="asunto" name="asunto" placeholder="RE:Tema" required>
                                                </div>
                                                <div class="form-group">
                                                    <label><b>Respuesta</b></label>
                                                    <textarea cols="80" id="texto" name="texto" rows="1" style="overflow:scroll; resize: none;" required>           
                                                    </textarea>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label for=""><b>Archivo</b></label>
                                                    <input type="file" class="form-control" id="archivo" name="archivo" >
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for=""><b>Notificar</b></label>
                                                    <div class="checkbox checkbox-success">
                                                        <input id="zona_home" name="zona_home" type="checkbox" class="material-inputs">
                                                        <label for="checkbox1"> Enviar correo a toda la comunidad </label>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-info waves-effect waves-light mr-2">Guardar</button>
                                                <button id="cancel_resp2" type="button" class="btn btn-danger waves-effect waves-light cancel_resp_hijo">Cancelar</button>
                                            </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-xs-1 col-lg-1"></div>
            </div> 

        </div>

        <?=$pager->links('post', 'default_full') ?>
     
        <div class="col-sm-12 col-lg-12">
            <div class="card bg-info">
                <div class="card-body text-white">
                    <div class="d-flex flex-row">
                        <div class="ml-auto align-self-center pr-2">
                            <h4 class="font-weight-medium mb-1 text-white"><?=$cantidad_post?> Respuestas</h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>
            
        <div class="col-xs-12 col-lg-12">
           
                <?php 

                foreach ($post as $p){

                    $p= (object) $p;
                     $indent=strlen( $p->jerarquia )/11;
                     $ml=$indent*20;

                ?>
                 
                    <div class="col-xs-12 col-lg-12 " style="padding-left: <?=$ml?>px; padding-right: 0px">

                        <table  class="table table-responsive  border borde bg-light">
                            <tbody>
                                    <tr>
                                            <td colspan="1" width="12%">
                                                <img src="<?=base_url(fotoPerfil($p->oid_usuario))?>" alt="user" class="img-fluid" width="90">
                                                 
                                            </td>
                                           
                                            <td colspan="5">
                                                <p>
                                                    <button type="button" class="btn btn-danger btn-delete btn-xs btn-delete-post" data-id="<?=$p->oid?>">
                                                        <i class="fa fa-trash text-white fa-1x" data-toggle="tooltip" data-placement="top" title="Eliminar comentario"  ></i>
                                                    </button>
                                                </p>
                                              
                                                <span class="font text-dark"><?=date("d/m/Y h:i:s", strtotime($tema->fecha))?>
                                                     
                                                </span>
                                                <p><strong class="text-dark">Autor: <?=NombrePerfil($p->oid_usuario)?>
                                                </strong>
                                    

                                                <a  href="<?php echo base_url('public/Post/mostrar_email')."/".$p->oid_foro."/".$p->oid; ?>">
                                                        <i class="fas fa-envelope-square  fa-lg"></i>
                                                        
                                                    </a>
                                                </p>

                                                <p>
                                                    <strong class="text-dark">
                                                    </strong>
                                                </p>
                                                <span class="p-2 rounded  bg-light-success d-inline-block mb-2 text-dark  shadow ">
                                                    <?=$p->texto?></span>
                                               <?php
                                                if($p->archivo != ""){

                                                    $info = new SplFileInfo(base_url("assets/uploads/foro/d".$p->archivo));
                                               ?>
                                                <p>
                                                    <b  class="text-dark">Documento Adjunto: </b>
                                                    <a download href="<?php echo base_url("assets/uploads/foro/".$p->archivo); ?>">
                                                        <i class="fas fa-download fa-1x"></i>
                                                        Descargar
                                                    </a>
                                                </p>

                                               <?php } ?>
                                            </td>
                                            
                                    </tr>
                                   
                                    <tr>
                                            <td colspan="6">
                                                <button type="button" class="btn btn-info btn-reponse btn_resp_padre" data-id="<?=$p->oid?>" id="btn_resp_padre<?=$p->oid?>">Responder
                                                </button>
                                                <button type="button" class="btn btn-danger btn-reponse cancel_resp_padre"  style="display: none" data-id="<?=$p->oid?>" id="cancel_resp_padre<?=$p->oid?>">Cancelar
                                                </button>
                                                
                                            </td>
                                    </tr>
                              
                            </tbody>
                        </table> 
                        <hr>
                    </div>
                
                    <!--Formulario-->
                    <div class="row">
                        <div class="col-xs-1 col-lg-1"></div>
                            <div class="col-xs-10 col-lg-10">
                                <div class="card div_resp<?=$p->oid?>" style="display: none" id="div_resp<?=$p->oid?>">
                                    <div class="card-body bg-dark rounded-top">
                                        <h4 class="text-white card-title pl-3">Publicar Respuesta</h4>
                                    </div>
                                    <div class="card-body p-2 border border-dark bg-light-info">
                                       
                                        <div class="col-sm-12 col-xs-12 ">
                                                    <form id="form_resp<?=$p->oid?>" name="form_resp<?=$p->oid?>" action="<?=base_url('public/Post/add_response')?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                                        <input type="hidden" name="oid_tema" value="<?=$p->oid?>">
                                                        <input type="hidden" name="oid_padre" value="<?=$p->oid_padre?>">
                                                        <input type="hidden" name="jerarquia" value="<?=$p->jerarquia?>">
                                                        <input type="hidden" name="foro_id" value="<?=$tema->oid?>">
                                                        <div class="form-group">
                                                            <label for=""><b>Asunto</b></label>
                                                            <input type="text" class="form-control asunto" id="asunto<?=$p->oid?>" name="asunto" placeholder="RE:<?=$p->asunto?>" required value="RE: <?=$p->asunto?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label><b>Respuesta</b></label>
                                                            <textarea class="editor" cols="80"  name="texto" id="texo<?=$p->oid?>" rows="1" style="overflow:scroll; resize: none;" required >           
                                                            </textarea>
                                                           
                                                        </div>
                                                        <div class="form-group">
                                                            <label for=""><b>Archivo</b></label>
                                                            <input type="file" class="form-control" id="archivo<?=$p->oid?>" name="archivo" >
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label for=""><b>Notificar</b></label>
                                                            <div class="checkbox checkbox-success">
                                                                <input id="zona_home" name="zona_home" type="checkbox" class="material-inputs">
                                                                <label for="checkbox1"> Enviar correo a toda la comunidad </label>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-info waves-effect waves-light mr-2">Guardar</button>
                                                        <button  id="cancel_resp_hijo" data-id="<?=$p->oid?>" type="button" class=" btn btn-danger waves-effect waves-light cancel_resp_hijo">Cancelar </button>
                                                    </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-1 col-lg-1"></div>
                    </div> 


                <?php } 
                ?>

               
                          
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
<script src="<?php echo base_url() ?>/assets/libs/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url() ?>/assets/libs/ckeditor/samples/js/sample.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>/assets/extra-libs/confirm/jquery-confirm.min.css">
    <script src="<?php echo base_url() ?>/assets/extra-libs/confirm/jquery-confirm.min.js"></script>


    <script type="text/javascript">
        CKEDITOR.replace('texto', {
          language: 'es',
          height : 60,
          resize_enabled : false
        });


                                                                
     CKEDITOR.replaceAll("editor" , {
      language: 'es',
      height : 55,
      resize_enabled : false
    }); 

    </script>
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

            $("#btn_resp").on("click", function(){
     
                $(".div_resp").css("display", "block")
     
                $("#btn_resp").css("display", "none")
                $("#cancel_resp").css("display", "block")
                $("#form_resp")[0].reset()
            })

            $("#cancel_resp").on("click", function(){
                $(".div_resp").css("display", "none")

                $("#cancel_resp").css("display", "none")
                $("#btn_resp").css("display", "block")
                $("#form_resp")[0].reset()
          
            })


            $(".btn_resp_padre").on("click", function(){
                    
                _id = $(this).attr('data-id')
       
                $(".div_resp"+_id).css("display", "block")
     
                $(this).css("display", "none")
                $("#cancel_resp_padre"+_id).css("display", "block")

            })

            $(".cancel_resp_padre").on("click", function(){
            
                _id = $(this).attr('data-id')

                $(".div_resp"+_id).css("display", "none")

                $(this).css("display", "none")
                $("#btn_resp_padre"+_id).css("display", "block")
                
                $("#asunto"+_id).val('')
                $("#texto"+_id).val('')
                $("#archivo"+_id).val(null);
                $('input:checkbox').removeAttr('checked');
                $("#btn_resp_padre"+_id).focus()
                CKupdate()

            })

            $(".cancel_resp_hijo").on("click", function(){

                _id = $(this).attr('data-id')

                $(".div_resp"+_id).css("display", "none")

                $("#cancel_resp_padre"+_id).css("display", "none")
                $("#btn_resp_padre"+_id).css("display", "block")
                
                //CKEDITOR.instances['content'].setData('');
                
                $("#asunto"+_id).val('')
                $("#texto"+_id).val('')
                $("#archivo"+_id).val(null);
                $('input:checkbox').removeAttr('checked');
                $("#btn_resp_padre"+_id).focus()
                CKupdate()
          
            })

            function CKupdate(){
                for ( instance in CKEDITOR.instances ){
                    CKEDITOR.instances[instance].updateElement();
                    CKEDITOR.instances[instance].setData('');
                }
            }


            $(".btn-delete-post").on("click", function(){
            
                _id_tema= $(this).attr('data-id')

                  $.confirm({
                        title: 'Eliminar Post!',
                        content: 'Seguro desea eliminar el post',
                        type: 'red',
                        typeAnimated: true,
                        buttons: {
                            tryAgain: {
                                text: 'Eliminar',
                                btnClass: 'btn-red',
                                action: function(){
                                    //LLamada a eliminar el post 
                                        $.ajax({
                                        type : "post",
                                        url: "<?=base_url('public/Post/delete_post/')?>",
                                        data: {'id_tema': _id_tema},
                                        dataType : 'json',
                                        success: function(respuesta) {
                                            if(respuesta.exito == 1){
                                                 Swal.fire({
                                                    title: "Registro Eliminado",
                                                    text: "El post se ha eliminado con exito!",
                                                    type: "success",
                                                    showCancelButton: true,
                                                    showConfirmButton : false,
                                                    cancelButtonColor: "#3085d6",
                                                    cancelButtonText: "OK",
                                                    closeOnConfirm: true
                                                })

                                                setTimeout(function(){ location.reload(); }, 2000);

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

                                                setTimeout(function(){ location.reload(); }, 2000);
                                                

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
            })

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

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: .20rem;
    padding-top: 5px;
}
.borde{
    border-color:#D8E3E3 !important;
}

.borde-tema{
    border-color: #8FB8B5 !important;
}
mouse-pointer
</style>