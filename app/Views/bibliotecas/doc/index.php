<?php //echo view('dgac/headers'); ?>
<?php 

    use App\Models\BibliotecasModel;
    $obj = new BibliotecasModel($db);

    function changeDateFormat($format = 'd-m-Y', $originalDate)
    {
        return date($format, strtotime($originalDate));
    }
    try{
        $session   = session();
        $accesos   = $session->accesos;
        $lectura   = $accesos['lectura'];
        $escritura = $accesos['escritura'];
        $eliminar  = $accesos['eliminar'];
    }catch (\Exception $e)
    {
        $accesos   = NULL;
        $lectura   = NULL;
        $escritura = NULL;
        $eliminar  = NULL;
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
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                            <? if(MostrarElemento(array('bibliotecas/biblioCateAdd'))){?>
                                <a title="Agregar Categoria de Documentos" href="<?php echo base_url('public/bibliotecas/biblioCateAdd/'.$oid_categoria) ?>">
                                    <button type="button" style="text-align: center;" class="btn btn-success">
                                        <i class="mdi mdi-folder-plus"></i>
                                    </button>
                                </a>
                                <?}?>
                                <? if(MostrarElemento(array('bibliotecas/biblioFileAdd'))){?>
                                <a title="Agregar Documento" href="<?php echo base_url('public/bibliotecas/biblioFileAdd/'.$oid_categoria) ?>">
                                    <button type="button" style="text-align: center;" class="btn btn-success">
                                        <i class="mdi mdi-upload"></i>
                                    </button>
                                </a>
                                <?}?>
                                <? if(MostrarElemento(array('bibliotecas/biblioMicroSitioAdd'))){?>
                                <a title="Agregar MicroSitio" href="<?php echo base_url('public/bibliotecas/biblioMicroSitioAdd/'.$oid_categoria) ?>">
                                    <button type="button" style="text-align: center;" class="btn btn-success">
                                        <i class="mdi mdi-server-plus"></i>
                                    </button>
                                </a>
                                <?}?>
                                <? if(MostrarElemento(array('bibliotecas/biblioUrlAdd'))){?>
                                <a title="Agregar Url en Internet" href="<?php echo base_url('public/bibliotecas/biblioUrlAdd/'.$oid_categoria) ?>">
                                    <button type="button" style="text-align: center;" class="btn btn-success">
                                        <i class="mdi mdi-web"></i>
                                    </button>
                                </a>
                                <?php } ?>
                                <a title="Volver" onclick="return window.history.back();">
                                    <button type="button" style="text-align: center;" class="btn btn-success">
                                        <i class="mdi mdi-keyboard-return"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="row draggable-cards mt-2" id="draggable-area">
                            <?php if( count($bibliotecas) > 0 ){ ?>
                                <?php foreach ($bibliotecas as $key => $value) { ?>
                            <div class="col-md-6 col-sm-12">
                                <div style="height: 238.764px;" class="card card-hover">
                                    <div class="card-header bg-info">
                                        <h4 style="font-size: 14px !important;" class="mb-0 text-white"><?php echo $value->nombre; ?></h4>
                                    </div>
                                    <div class="card-body">
                                        <h3 hidden="" class="card-title"></h3>
                                        <p class="card-text"><?php echo $value->descripcion; ?></p>
                                        <? if(MostrarElemento(array('bibliotecas/doc'))){?>
                                        <a title="Acceder" href="<?php echo base_url('public/bibliotecas/doc/'.$value->oid) ?>">
                                            <button class="btn btn-success">
                                                Acceder
                                            </button>
                                        </a>
                                        <?php } ?>
                                        <? if(MostrarElemento(array('bibliotecas/biblioCateDelete'))){?>
                                        <a title="Eliminar" onclick="return confirm('¿Desea eliminar la categoria?')" href="<?php echo base_url('public/bibliotecas/biblioCateDelete/'.$value->oid) ?>">
                                            <button class="btn btn-danger">
                                                Eliminar
                                            </button>
                                        </a>
                                        <?php } ?>
                                        <? if(MostrarElemento(array('bibliotecas/biblioCateUpd'))){?>
                                        <a title="Editar" href="<?php echo base_url('public/bibliotecas/biblioCateUpd/'.$value->oid) ?>">
                                            <button class="btn btn-success">
                                                Editar
                                            </button>
                                        </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php }else{ ?>
                                <b>No se encuentran categorias Asociadas...</b>
                            <?php } ?>
                        </div>
                        <div class="row draggable-cards mt-2" id="draggable-area">
                            <?php if( count($archivo) > 0 ){ ?>
                                <?php foreach ($archivo as $key => $value) { ?>
                                <div class="col-md-6 col-sm-12">
                                    <div class="card  card-hover">
                                        <div class="card-header bg-info">
                                            <h4 class="mb-0 text-white"><?php echo $value->titulo; ?></h4></div>
                                        <div class="card-body" style="height: 320.17px;">
                                            <p class="card-text">
                                            <? if(MostrarElemento(array('bibliotecas/biblioFileDelete'))){?>
                                                <a title="Eliminar" onclick="return confirm('¿Desea eliminar el documento?')" href="<?php echo base_url('public/bibliotecas/biblioFileDelete/'.$value->oid.'/'.$value->oid_categoria) ?>">
                                                    <button class="btn btn-danger">
                                                        Eliminar
                                                    </button>
                                                </a>&nbsp;
                                                <?php } ?>
                                                <? if(MostrarElemento(array('bibliotecas/biblioFileEdit'))){?>
                                                <a title="Editar" href="<?php echo base_url('public/bibliotecas/biblioFileEdit/'.$value->oid) ?>">
                                                    <button class="btn btn-success">
                                                        Editar
                                                    </button>
                                                </a>
                                                <?php } ?>
                                            </p>
                                            <p>
                                                <?php 

                                                    $datetime = explode(' ', $value->fecha);
                                                    $datetime_oficial = changeDateFormat('d/m/Y',$datetime[0])." ".$datetime[1];

                                                 ?>
                                                Última modificación: <?php echo $value->nombres." ".$value->apellidos.' - '.$datetime_oficial; ?>
                                            <br>
                                            <?if($value->esurl){?>
                                            URL:  <?php echo $value->archivo; ?>
                                            <?}elseif($value->esmicrositio){?>
                                            <!-- Ruta de Descarga: assets/uploads/bibliotecas/doc/<?php echo $value->archivo; ?> -->
                                            <?}else{?>
                                            Ruta de Descarga: assets/uploads/bibliotecas/doc/<?php echo $value->archivo; ?>
                                            <?}?>
                                            <br>
                                             <?php if( is_file(base_url('/assets/uploads/bibliotecas/doc/'.$value->archivo)) ){ ?>
                                             Tamaño: <?php $tamano = getimagesize(base_url('/assets/uploads/bibliotecas/doc/'.$value->archivo), $info); echo $tamano['bits'].' KBytes'; ?>

                                             <?php 
                                                $tamano_56 = ( $tamano['bits'] / ( 56 ) / 60 );
                                                $tamano_384 = ( $tamano['bits'] / ( 384 ) / 60 );
                                                $tamano_1mbps = ( $tamano['bits'] / ( 1 ) / 60 );
                                             ?>
                                             <br>
                                             Tiempos de Descarga: <?php echo round($tamano_56, 3).' a 56Kbps, '.round($tamano_384,3).' a 384Kbps, '.round($tamano_1mbps,3).' a 1Mbps'; ?>
                                             <?php } ?>
                                             
                                             Descargado 
                                             <?php
                                                if( $value->hits == 1 || $value->hits == 0 ){
                                                    echo $value->hits.' Vez'; 
                                                }else{
                                                    echo $value->hits.' Veces'; 
                                                }
                                            ?>
                                            <b><?php echo $value->descripcion; ?></b>
                                            <br>
                                            <?if($value->esurl){?>
                                            <a target="_blank" data-id='<?php echo $value->oid; ?>' class="hits" href='<?php echo $value->archivo; ?>'>
                                                Acceder
                                            </a>
                                            <? }elseif($value->esmicrositio){?>
                                            <a target="_blank" data-id='<?php echo $value->oid; ?>' class="hits" href='<?php echo base_url('assets/uploads/scorm/'.$value->archivo.'/index.html'); ?>'>
                                                Acceder a micrositio
                                            </a>
                                            <?}else{?>
                                            <a data-id='<?php echo $value->oid; ?>' class="hits" download href='<?php echo base_url("assets/uploads/bibliotecas/doc/".$value->archivo); ?>'>
                                                Descargar
                                            </a>
                                            <?}?>
                                            </p>
                                            <hr/>
                                            <a href="<?php echo base_url('public/bibliotecas/biblioComment/'.$value->oid) ?>">
                                                <button class="btn btn-success">
                                                    Agregar
                                                </button>&nbsp;
                                                <?php 

                                                    $count = $obj->count_comentarios($value->oid);

                                                 ?>
                                                <b> <?php echo $count->cantidad; ?> Comentarios Registrados</b>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
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
        $( "a.hits" ).click(function() {
            
            var id = $(this).data('id');
            
            $.ajax({
                url:'<?php echo base_url('public/bibliotecas/docVisitas'); ?>',
                method: 'post',
                data: { id: id },
                success: function(response){
                    //window.location.href = href;
                }
            });

        });
    </script>
</body>

</html>