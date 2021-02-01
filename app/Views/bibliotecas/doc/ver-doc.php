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
                    <div class="col-12">
                        <div class="row draggable-cards" id="draggable-area">
                            <div class="col-md-12 col-sm-12">
                                <div class="card  card-hover">
                                    <div class="card-header bg-info">
                                        <h4 class="mb-0 text-white"><?php echo $preview['titulo']; ?></h4></div>
                                    <div class="card-body">
                                        <p class="card-text">
                                            Publicado por <?php echo $preview['nombres'].' '.$preview['apellidos'] ?>
                                            <?php 
                                                $datetime = explode(' ', $preview['datetime'] );
                                                echo changeDateFormat('d/m/Y',$datetime[0])." ",$datetime[1];
                                             ?>
                                             <br>
                                             <?php if( is_file(base_url('/assets/uploads/bibliotecas/doc/'.$preview['archivo'])) ){ ?>
                                             Tamaño: <?php $tamano = getimagesize(base_url('/assets/uploads/bibliotecas/doc/'.$preview['archivo']), $info); echo $tamano['bits'].' KBytes'; ?>

                                             <?php 
                                                $tamano_56 = ( $tamano['bits'] / ( 56 ) / 60 );
                                                $tamano_384 = ( $tamano['bits'] / ( 384 ) / 60 );
                                                $tamano_1mbps = ( $tamano['bits'] / ( 1 ) / 60 );
                                             ?>
                                             <br>
                                             Tiempos de Descarga: <?php echo round($tamano_56, 3).' a 56Kbps, '.round($tamano_384,3).' a 384Kbps, '.round($tamano_1mbps,3).' a 1Mbps'; ?>
                                             <?php } ?>
                                        </p>
                                        <p class="card-text">
                                            <!-- <img style="width: 200px;height: 204px;" src="<?php echo base_url('/assets/uploads/bibliotecas/doc/'.$preview['archivo']) ?>"><br><br> -->
                                            <?if($preview['esurl']){?>
                                            <a href='<?php echo $preview['archivo']; ?>'>
                                                <button class="btn btn-success">
                                                    Acceder
                                                </button>
                                            </a>
                                            <? }elseif($preview['esmicrositio']){?>
                                            <a target="_blank"  class="hits" href='<?php echo base_url('assets/uploads/scorm/'.$preview['archivo'].'/index.html'); ?>'>
                                                Acceder a micrositio
                                            </a>
                                            <?}else{?>
                                            <?
                                                $info = new SplFileInfo(base_url("assets/uploads/bibliotecas/doc/".$preview['archivo']));
                                                // var_dump($info->getExtension());
                                                if(in_array($info->getExtension(),array('mp4','ogg','flv'))){
                                            ?>
                                            <video style="width: 100%;" src="<?php echo base_url("assets/uploads/bibliotecas/doc/".$preview['archivo']); ?>" controls>
                                            Tu navegador no implementa el elemento <code>video</code>.
                                            </video>
                                            <?
                                                }
                                            ?>
                                            <a download href='<?php echo base_url("assets/uploads/bibliotecas/doc/".$preview['archivo']); ?>'>
                                                <button class="btn btn-success">
                                                    Descargar <?=$info->getExtension()?>
                                                </button>
                                            </a>
                                            <?}?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <?php foreach ($comentarios as $key => $value) { ?>
                        <div class="col-md-6 col-sm-12">
                            <div class="card  card-hover">
                                <div class="card-header bg-info">
                                <h4 class="mb-0 text-white">
                                    <a title="Eliminar" href="<?php echo base_url('public/bibliotecas/ComentarioDelete/'.$preview['oid'] .'/'.$value->oid) ?>">
                                        <button class="btn btn-danger">Eliminar</button>
                                    </a>
                                </h4>
                                </div>
                                <div class="card-body">
                                    <b><?php echo $value->nombres." ".$value->apellidos ?></b>
                                    <br>
                                    <span>
                                        <?php 
                                            $datetime = explode(' ', $value->datetime);
                                            echo changeDateFormat('d/m/Y',$datetime[0])." ",$datetime[1];
                                         ?>
                                    </span>
                                    <p class="card-text">
                                        <?php echo $value->comentario ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <form action="<?php echo base_url('public/bibliotecas/docComentario/'.$preview['oid']) ?>" method="POST">
                    <div class="col-md-12 mt-2">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="seccion" value="BIBLIOTECA">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="alert alert-success">Agregar Comentario</div>
                                <textarea required="" class="form-control" id="texto" name="texto" rows="12" cols="80"></textarea>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label>Notificar</label>
                                <select class="form-control" name="notificar">
                                  <option value="0" selected="selected">No Enviar Notificación</option>
                                  <option value="-1">Enviar Correo a toda la Comunidad</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <input class="btn btn-success" type="submit" value="Guardar">
                            </div>
                        </div>
                    </div>
                </form>
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