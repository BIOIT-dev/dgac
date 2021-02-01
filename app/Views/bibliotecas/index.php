<?php //echo view('dgac/headers'); ?>
<?php 
    
    use App\Models\BibliotecasModel;
    $obj = new BibliotecasModel($db);

    $session   = session();
    $accesos   = $session->accesos;
   
   

    if( isset($accesos['lectura']) || isset($accesos['escritura']) || isset($accesos['eliminar']) ){
        $lectura   = $accesos['lectura'];
        $escritura = $accesos['escritura'];
        $eliminar  = $accesos['eliminar'];
    }else{
        $lectura   = 0;
        $escritura = 0;
        $eliminar  = 0;
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
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div>
                    <input type="hidden" name="id_categoria" id="id_categoria" value="<?=session()->id?>"
                </div>


                <div class="card-body card">
                    <div class="row">
                        <div class="col-md-5 col-12">
                            <h4 class="card-title">Categoria de Documentos</h4>
                            
                             <? if(MostrarElemento(array('bibliotecas/biblioCateAdd'))){
                                ?>
                                <button title="Agregar Categoria de Documentos" type="button" style="text-align: center;" class="btn btn-success mt-3 col-xs-12 col-sm-3 btn-add-categoria">
                                    <span class="btn-label">
                                        <i class="mr-2 mdi mdi-folder-plus"></i>
                                    </span>
                                    Nuevo
                                </button>
                          
                        <?php } ?>
                        <? if(MostrarElemento(array('bibliotecas/biblioCateUpd'))){?>
                                    <button title="Editar Categoria" class="btn btn-info mt-3 col-xs-12 col-sm-3 col-sm-3 waves-effect waves-light" type="button">
                                        <span class="btn-label">
                                            <i class="far fa-edit"></i></span>
                                                Editar
                                    </button>
                        <?php } ?>
                         

                        <? if(MostrarElemento(array('bibliotecas/biblioCateDelete'))){?>
                        
                            <button title="Eliminar Categoria" class="btn btn-danger waves-effect waves-light mt-3 col-xs-12 col-sm-3" type="button">

                                <span class="btn-label">
                                    <i class="fa fa-trash"></i></span>
                                        Eliminar
                                </button>
                        <?php } ?>
                        
                        <br>
                            <div id="tree_categorias" class="treeview" style="padding-top: 5px;">
                                

                            </div>
                        </div>
                   
                        <div class="col-md-7 col-12">
                            <h4 class="card-title"></h4>

                             <div class=" justify-content-right" id="botonera_derecha" style="display: none; padding-top: 33px;">
                              
                                    <? if(MostrarElemento(array('bibliotecas/biblioFileAdd'))){?>
                                       
                                        <button title="Agregar Documento"  type="button" style="text-align: center;" class="btn btn-primary btn-documento col-xs-12 col-sm-4  mt-2">
                                            <i class="mdi mdi-upload"></i>
                                            Documento
                                        </button>
                                              
                                    <?}?>
                                    <? if(MostrarElemento(array('bibliotecas/biblioMicroSitioAdd'))){?>
                                        
                                        <button title="Agregar MicroSitio" type="button" style="text-align: center;" class="btn btn-dark btn-micro col-xs-12 col-xs-12 col-sm-3 mt-2">
                                                        <i class="mdi mdi-server-plus"></i>
                                        MicroSitio
                                        </button>
                                    <?}?>
                                    <? if(MostrarElemento(array('bibliotecas/biblioUrlAdd'))){?>
                                
                                        <button title="Agregar Url en Internet"type="button" style="text-align: center;" class="btn btn-info btn-web col-xs-12 col-sm-4 mt-2">
                                                        <i class="mdi mdi-web"></i>
                                            Url en Internet
                                        </button>
                                        
                                    <?php } ?>          
                            </div>
                           <div id="msg_contenido" class="col-xs-12" style="display: none">

                            </div>
                        <div class="row draggable-cards mt-2" id="contenido_docs">
                            
                       
                        </div> 
                    </div>
                </div>

                    
                    <div class="col-6">
                        <div id="msg_contenido" class="col-xs-12" style="display: none">

                        </div>
                        <div class="row draggable-cards mt-2" id="contenido_docs">
                            
                       
                        </div> 
                        
                    </div>
                    
                 
                   
                </div>
                

            
                <!-- Row -->
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

        $( document ).ready(function() {

            $("#msg_contenido").html('')
            //$("#botonera_derecha").css('display', 'none')

            var treeData = <?=$categorias?>;
            _nodo_id="";
         
            $('#tree_categorias').treeview({
                  selectedBackColor: "#03a9f3",
                  onhoverColor: "rgba(0, 0, 0, 0.05)",
                  expandIcon: 'ti-plus',
                  collapseIcon: 'ti-minus',
                  nodeIcon: 'fa fa-folder',
                  data: treeData
                  
            });


            if($("#id_categoria").val() == ""){
                $('#tree_categorias').treeview('collapseAll', { silent: true });
            }

            //seleccionar
            $('#tree_categorias').on('nodeSelected', function(event, data) {

                _nodo_id = data.id
                getDocumentos()
                $("#botonera_derecha").css('display', 'block')
            })

             $('#tree_categorias').on('nodeUnselected ', function(event, data) {

                _nodo_id = ""
                $("#msg_contenido").html('')
                $("#contenido_docs").html('')
                $("#botonera_derecha").css('display', 'none')

                <?session()->id = ""?>
            })


            //Agregar categoria
            $(".btn-add-categoria").on("click", function(event) {

                event.stopPropagation();
                event.preventDefault();
                _url = "<?=base_url('public/bibliotecas/biblioCateAdd')?>";

                if(_nodo_id ==''){
                   _url = "<?=base_url('public/bibliotecas/biblioCateAdd')?>";
                }else{
                    _url = "<?=base_url('public/bibliotecas/biblioCateAdd')?>";
                    _url += '/'+_nodo_id
                }


                location.href = _url;
                
            });


            //Eliminar categoria
            $(".btn-danger").on("click", function(event) {

                event.stopPropagation();
                event.preventDefault();

                if(_nodo_id ==''){
                    alert("Debe seleccionar una categoria")
                    return
                }

                var r = confirm("¿Desea eliminar la categoria?");
                if (r == true) {
                    var base_url = "<?=base_url('public/bibliotecas/biblioCateDelete')?>";
                   location.href = base_url+'/'+_nodo_id;
                }
            });

            //Actualizar categoria
            $(".btn-info").on("click", function(event) {
                event.stopPropagation();
                event.preventDefault();

                if(_nodo_id ==''){
                    alert("Debe seleccionar una categoria")
                    return
                }

                var base_url = "<?=base_url('public/bibliotecas/biblioCateUpd')?>";
                   location.href = base_url+'/'+_nodo_id;
                
            });
          
            //Agragar documento a categoria
            $(".btn-documento").on("click", function(event) {
                event.stopPropagation();
                event.preventDefault();

                if(_nodo_id ==''){
                    alert("Debe seleccionar una categoria")
                    return
                }

                base_url="<?php echo base_url('public/bibliotecas/biblioFileAdd') ?>"

                location.href = base_url+'/'+_nodo_id;
                
            });


            //Agregar micro a categoria
            $(".btn-micro").on("click", function(event) {
                event.stopPropagation();
                event.preventDefault();

                if(_nodo_id ==''){
                    alert("Debe seleccionar una categoria")
                    return
                }

                base_url="<?php echo base_url('public/bibliotecas/biblioMicroSitioAdd') ?>"

                location.href = base_url+'/'+_nodo_id;
                
            });


            //Agregar url documento a categoria
            $(".btn-web").on("click", function(event) {
                event.stopPropagation();
                event.preventDefault();

                if(_nodo_id ==''){
                    alert("Debe seleccionar una categoria")
                    return
                }

                base_url="<?php echo base_url('public/bibliotecas/biblioUrlAdd') ?>"

                location.href = base_url+'/'+_nodo_id;
                
            });


            //$('#tree_categorias').treeview('collapseAll', { silent: true });
            nodo = $("#id_categoria").val();

            selectNodeById(nodo)
  

        });

        function selectNodeById(id){
            var treeViewObject = $('#tree_categorias').data('treeview'),
            allCollapsedNodes = treeViewObject.getCollapsed(),
            allExpandedNodes = treeViewObject.getExpanded(),
            allNodes = allCollapsedNodes.concat(allExpandedNodes);
            for (var i = 0; i < allNodes.length; i++) {

                if (allNodes[i].id != id){ 
                    $('#tree_categorias').treeview('collapseNode', [ allNodes[i].nodeId, { silent: true, ignoreChildren: false } ]);
                    continue;
                }else
                    treeViewObject.selectNode(allNodes[i].nodeId);
                    _pa = ('#tree_categorias').treeview('getParent', allNodes[i].nodeId);
                    $('#tree_categorias').treeview('revealNode', [ _pa, { silent: true, ignoreChildren: false } ]);

                    treeViewObject.revealNode(_pa);
                   
            }
        }



        function getDocumentos() {
          $.ajax({
            dataType: "json",
            url: "<?=base_url('public/bibliotecas/doc')?>/"+_nodo_id,
            success: function(respuesta) {

              _cad = ""
              _msg = '';
              $("#contenido_docs").html('')
              

            if(respuesta.length == 0){
                _msg = ""
                $("#msg_contenido").html('')

                _msg = `<br><div class="alert alert-warning alert-dismissible fade show" role="alert" style="padding-top:10px">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong>Atención- </strong> No existe contenido para mostrar!
                </div>`
                $("#msg_contenido").html(_msg)
                $("#msg_contenido").css('display', 'block')
                //$("#botonera_derecha").css('display', 'none')
            }

            $.each(respuesta, function(index, doc) {

                $("#botonera_derecha").css('display', 'block')

                f = new Date(doc.fecha);

                _date = f.getFullYear()+'/'+(f.getMonth()+1)+'/'+f.getDay()+' '+ f.getHours()+':'+ f.getMinutes()+':'+f.getSeconds()

                _ruta = ""
                _upload = ""
                _acceder = ""
                _cant_comentarios = 0

                    _ruta = ""
                _upload = ""
                _acceder = ""
                _cant_comentarios = 0

                if(doc.esurl == 1){
                    _ruta = `<b>URL: </b> ${doc.archivo}`
                }else{
                    _ruta =`<b>Ruta de Descarga: </b> ${doc.archivo}`
                }

                if(doc.hits == 1 || doc.hits== 0 ){
                    _upload = `${doc.hits} Vez`; 
                }else{
                    _upload = `${doc.hits} Veces`;  
                }


                if(doc.esurl ==  1){ 
                    _acceder = `<a target="_blank" data-id='${doc.oid}' class="hits" href='${doc.archivo}' style="padding-bottom:10px !important;">
                            Acceder
                        </a>`
                }else if(doc.esmicrositio == 1){

                    base_url = "<?=base_url('assets/uploads/scorm')?>";
                    base_url += '/'+doc.archivo +'/index.html'

                    _acceder = `<a target="_blank" data-id='${doc.oid}' class="hits" href='${base_url}' style="padding-bottom:10px !important;">
                            Acceder a micrositio
                        </a>`

                }else{

                    base_url = "<?=base_url('assets/uploads/bibliotecas/doc/')?>";
                    base_url += '/'+doc.archivo

                    _acceder = `<a data-id='${doc.oid}' class="hits" download href='${base_url}' style="padding-bottom:10px !important;">
                            Descargar
                        </a>`
                }

                _url_comentario = "<?=base_url('public/bibliotecas/biblioComment/')?>";
                _url_comentario += '/'+doc.oid

                _url_editar = "<?=base_url('public/bibliotecas/biblioFileEdit/')?>";
                _url_editar += '/'+doc.oid

                _url_eliminar = "<?=base_url('public/bibliotecas/biblioFileDelete')?>";
                _url_eliminar += '/'+doc.oid+'/'+doc.oid_categoria


                _cad += `<div class="col-md-6 col-sm-6 col-xs-12 col-sm-12">
                            <div class="card border">
                                <div class="card-header bg-info">
                                    <h4 class="mb-0 text-white">${doc.titulo}</h4>
                                </div>
                                <div class="card-body">
                                    <div style="min-height: 250px;">
                                        <p><b>Última modificación:</b> ${doc.nombres} ${doc.apellidos} - ${_date}
                                        <br>
                                        ${_ruta}
                                        
                                        <br><b>Descargado: </b> <span class="badge badge-primary px-2 py-1"> ${_upload}</span>
                                        <br><hr>
                                        <div style="max-height: 100px;" class="ellipsis">
                                            <h3 class="my-1" >${doc.descripcion}</h3>
                                        </div>
                                        <br><br>
                                        ${_acceder}
                                        
                                    </p>
                                    </div>    
                                </div>

                                <div class="card-footer bg-transparent  border-top"> 
                                    <a href="${_url_comentario}"><b>${doc.count_comen}  Comentarios </b></a>
                                    <div class="float-right">

                                        <a title="Agregar Comentario" href="${_url_comentario}">
                                            <button class="btn btn-success">
                                                <i class="mr-2 mdi mdi-library-plus"></i>
                                            </button>
                                        </a>
                                        
                                        <a title="Editar Documento" href=" ${_url_editar}">
                                            <button  class="btn btn-dark btn-outline"><i class="fa fa-edit"></i> 
                                            </button>
                                        </a>
                                        <a title="Eliminar Documento" href="${_url_eliminar}">
                                            <button  class="btn btn-danger"><i class="fa fa-trash"></i> 
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>`
 
              });
             
              $("#contenido_docs").html(_cad)

            },
            error: function() {
              console.log("No se ha podido obtener la información");
            }
          });
        }
    </script>
</body>

<style>
.card-header {
    padding: .45rem 1.10rem;
    margin-bottom: 0;
    background-color: rgba(0,0,0,.03);
    border-bottom: 0 solid rgba(0,0,0,.125);
}

.ellipsis {
  
    font-family: sans-serif;
    font-size: 1.3rem;
    line-height: 1.4;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
</html>