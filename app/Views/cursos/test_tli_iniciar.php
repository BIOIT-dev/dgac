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
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <!-- Tabs -->
                            <!-- Tabs -->
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
                                    <div class="card-body">
                                    <div class="">
                                        <form class="form-horizontal" action="<?php echo base_url('public/Cursos/testTLIiniciar/'.$profile_data_edit['oid'].'/'.$oid.'/'.$oid_curso); ?>" name="testTLIiniciar" id="testTLIiniciar" method="post" accept-charset="utf-8">
                                            
                                            <div class="col-md-12">
                                                <div class="card border-dark">
                                                    <div class="row card-header bg-info">
                                                        <h3 class="mb-0 text-white col-md-6"><b><?= $profile_data_edit['titulo'] ?> </b> </h3>
                                                    </div>
                                                    <!-- <div class="card-body">
                                                        <h3 class="card-title"><?= $profile_data_edit['titulo'] ?></h3>
                                                    </div> -->
                                                    <div class="card-body">
                                                        <p class="card-text"><?= $profile_data_edit['instrucciones'] ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="form-group" hidden>
                                                <small><label class="col-md-12">oid_test</label></small>
                                                <div class="col-md-12">
                                                    <input name="oid_test" type="text" placeholder="" class="form-control form-control-line" value="<?= $profile_data_edit['oid']? $profile_data_edit['oid'] : ""?>">
                                                </div>
                                            </div>   
                                            <div class="form-group" hidden>
                                                <small><label class="col-md-12">Tipo</label></small>
                                                <div class="col-md-12">
                                                    <input name="tipo" type="text" placeholder="" class="form-control form-control-line" value="<?= $profile_data_edit['tipo'] ?>">
                                                </div>
                                            </div> -->
                                            <!-- <div class="form-group"> -->
                                                <!-- <small><label class="col-md-12">Agregar Pregunta</label></small> -->
                                            <h3 class="col-md-12"></h3>
                                            <div class="col-md-12">
                                                
                                            </div>
                                        
                                            <!-- <div class="row"> -->
                                            <?php 
                                                $numpreg = 1; //aumenta respecto a cada pregunta ej: Pregunta 1, Pregunta 2
                                                $count_pg = 0; //aumenta respecto a la pregunta que se encuentra
                                            ?>
                                            <?php foreach($preguntas_encuesta as $rb) { ?>
                                                <?php ?>
                                                <div class="col-md-12">
                                                    <div class="card border-dark">
                                                        <div class="row card-header bg-dark">
                                                            <h4 class="mb-0 text-white col-md-6"><b>Pregunta <?=$numpreg++?></b> </h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <h4 class="card-title"><?=$rb->texto?></h4>
                                                            <div class="row mt-3">
                                                                <div class="col-md-12">
                                                                    <?php $letter = ord("A"); ?>
                                                                    <?if( $rb->tipo=="ALT" ){?>
                                                                        <?php foreach($resultado_preguntas[$count_pg] as $rp) { ?>
                                                                                <input value="<?= $rp->oid ?>" name="<?= $rp->oid_pregunta ?>" type="radio" id="radio<?= $rp->oid ?>" class="material-inputs radio-col-success" required/>
                                                                                <label for="radio<?= $rp->oid ?>"><?=chr( $letter++ )?>) <?= $rp->texto ?></label>
                                                                                </br>
                                                                        <?php } ?>
                                                                    <?}?>
                                                                    <?if( $rb->tipo=="MUL" ){?>
                                                                        <?php foreach($resultado_preguntas[$count_pg] as $rp) { ?>
                                                                                <?php $mark = ($rp->correcta == "S" ? "checked='checked'" : ""); ?>
                                                                                <input name="group<?= $rp->oid_pregunta ?>" type="checkbox" id="checkbox<?= $rp->oid ?>" class="material-inputs filled-in" <?= $mark ?> disabled/>
                                                                                <label for="checkbox<?= $rp->oid ?>"><?=chr( $letter++ )?>) <?= $rp->texto ?></label>
                                                                                </br>
                                                                        <?php } ?>
                                                                    <?}?>
                                                                    <?if( $rb->tipo=="PED" ){?>
                                                                        <div class="form-group">
                                                                            <textarea name="<?= $rb->oid ?>" class="form-control" rows="3"></textarea>
                                                                        </div>
                                                                    <?}?>
                                                                </div>
                                                            </div>
                                                            <!-- <h3 class="card-title">Special title treatment</h3>
                                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
                                                            <!-- <a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <? $count_pg++ ?>
                                            <?php } ?>
                                            <button type="submit" class="btn btn-info">Grabar</button>
                                        </form>
                                        <!-- Modal delete -->
                                        <div id="modalDelete" class="swal2-container swal2-center swal2-fade swal2-shown" style="overflow-y: auto; display: none;">
                                            <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
                                                <div class="swal2-header">
                                                    <div id="swal2-icon-modal" class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;">
                                                        <span class="swal2-x-mark">
                                                            <span class="swal2-x-mark-line-left"></span>
                                                            <span class="swal2-x-mark-line-right"></span>
                                                        </span>
                                                    </div>
                                                    <h2 class="swal2-title" id="swal2-title" style="display: flex;">¿Estás seguro?</h2>
                                                    <button onclick="modalClose()" type="button" class="swal2-close" aria-label="Close this dialog">×</button>
                                                </div>
                                                <div class="swal2-content">
                                                    <div id="swal2-content" style="display: block;">
                                                    <!-- Mensaje contenido -->
                                                    </div>
                                                    <div class="swal2-actions" style="display: flex;">
                                                        <!-- <a href="<?php //echo base_url('public/Usuario/eliminar_usuario/1234124124'); ?>" type="button" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block; border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);">Eliminar</a> -->
                                                        <button onclick="botonEliminar()" id="boton_eliminar" type="button" class="swal2-confirm swal2-styled" aria-label="">Eliminar</button>
                                                        <button onclick="modalClose()" type="button" class="swal2-cancel swal2-styled" aria-label="">Cancelar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal delete -->
                                        </div>
                                        
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

    <!--Custom JavaScript -->
    <script src="<?php echo base_url() ?>/assets/libs/sweetalert2/dist/sweetalert2.all.js"></script>
    <script src="<?php echo base_url() ?>/assets/extra-libs/sweetalert2/sweet-alert.init.js"></script>

    <script>
        function modalSwal(id_pregunta, id_encuesta){
            document.querySelector("#modalDelete #swal2-content").innerHTML = "¿Está seguro que quiere eliminar la pregunta? <br>¡Esta acción no se puede deshacer!";
            document.querySelector("#modalDelete #boton_eliminar").onclick = function onclick(event) {
                    botonEliminar(id_pregunta, id_encuesta)
                };
            document.querySelector("#modalDelete").style.display = "block";
        }

        function modalClose(){
            document.querySelector("#modalDelete").style.display = "none";
        }

        function imprimir(id_pregunta){
            console.log("IMPRIMIENDO: ", id_pregunta);
        }
        function botonEliminar(id_pregunta, id_encuesta){
            var checked = {id_pregunta, id_encuesta};
            
            var url = "<?php echo base_url('public/encuesta/eliminar_pregunta'); ?>";
            $.post(url, checked, function(data, status){
                if (status){
                    window.location = "<?php echo base_url('public/encuesta/editar/'.$profile_data_edit['oid']); ?>";
                }else{
                    console.log("ERROR");
                }
            });
        }

        function checkRequired(){
            if(!this.form.checkbox.checked){
                alert('You must agree to the terms first.');
                return false;
            }
        }
    </script>
</body>

</html>