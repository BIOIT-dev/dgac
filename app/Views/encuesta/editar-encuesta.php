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
                                        <form class="form-horizontal form-material" action="<?php echo base_url('public/encuesta/crear_pregunta/'.$profile_data_edit['oid']); ?>" name="pregunta_edit" id="pregunta_edit" method="post" accept-charset="utf-8">
                                            
                                            <div class="col-md-12">
                                                <div class="card border-dark">
                                                    <div class="row card-header bg-info">
                                                        <h4 class="mb-0 text-white col-md-6"><b>Datos Generales </b> </h4>
                                                        <div class="col-md-6 text-right">
                                                            <a href="<?php echo base_url('public/encuesta/editar_general/'.$profile_data_edit['oid']); ?>" class="btn btn-success btn-sm rounded">Editar</a>
                                                            <!-- <button type="button" class="btn btn-danger btn-sm rounded" onclick="modalSwal()">Eliminar</button> -->
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <h3 class="card-title"><?= $profile_data_edit['titulo'] ?></h3>
                                                        <p class="card-text">Disponible para: <?= ($comunidad_encuesta ? $comunidad_encuesta['nombre'] : "Todas las Comunidades") ?></p>
                                                    </div>
                                                    <div class="card-body">
                                                        <p class="card-text"><?= $profile_data_edit['instrucciones'] ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" hidden>
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
                                            </div>
                                            <!-- <div class="form-group"> -->
                                                <!-- <small><label class="col-md-12">Agregar Pregunta</label></small> -->
                                            <div class="col-md-12">
                                                <div class="card border-dark">
                                                    <div class="row card-header bg-info">
                                                        <h4 class="col-md-12 mb-0 text-white">Agregar Pregunta</h4>
                                                        <div class="col-md-12 text-right">
                                                            <!-- <a href="" class="btn btn-success btn-sm rounded">Editar</a>
                                                            <a href="" class="btn btn-danger btn-sm rounded">Eliminar</a> -->
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <select name="add_pregunta" class="form-control form-control-line">
                                                        <option value="0" selected>--- Tipo de Pregunta ---</option>
                                                            <!-- -->
                                                            <?if( $profile_data_edit['tipo']!="EVD" ){?>
                                                                <?for($i=2; $i<=8; $i++){?>
                                                                    <option value="ALT<?=$i?>">Pregunta de alternativas con <?=$i?> opciones</option>
                                                                <?}?>
                                                            <?}?>
                                                            <!-- -->
                                                            <?if( $profile_data_edit['tipo']=="EVD" ){?>
                                                                <option value="BLK1">Labor Administrativa</option>
                                                                <option value="BLK2">Destreza Pedagógica</option>
                                                                <option value="BLK3">Prácticas Evaluativas</option>
                                                                <option value="BLK4">Relaciones Interpersonales</option>
                                                                <option value="BLK5">Características Personales</option>
                                                            <?}?>
                                                            <!-- -->
                                                            <?if( $profile_data_edit['tipo']=="EDO" ){?>
                                                                <option value="0">---</option>
                                                                <?for($i=2; $i<=8; $i++){?>
                                                                    <option value="MUL<?=$i?>">Pregunta de selección múltiple con <?=$i?> opciones</option>
                                                                <?}?>
                                                            <?}?>
                                                            <!-- -->
                                                            <?if( $profile_data_edit['tipo']=="EDO" || $profile_data_edit['tipo']=="EPO" || $profile_data_edit['tipo']=="EVD" ){?>
                                                                <option value="0">---</option>
                                                                <option value="PED">Pregunta de Desarrollo</option>
                                                            <?}?>
                                                        </select> <!-- <a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a> -->
                                                    </div>
                                                    <div class="col-sm-12 mb-5">
                                                        <!-- <a href="" class="btn btn-success">Agregar</a> -->
                                                        <button type="submit" class="btn btn-success">Agregar</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 class="col-md-12"></h3>
                                            <div class="col-md-12">
                                                
                                            </div>
                                        </form>
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
                                                        <div class="col-md-6 text-right">
                                                            <a href="<?php echo base_url('public/encuesta/editar_pregunta/'.$profile_data_edit['oid'].'/'.$rb->oid); ?>" class="btn btn-success btn-sm rounded">Editar</a>
                                                            <button type="button" class="btn btn-danger btn-sm rounded" onclick="modalSwal(<?=$rb->oid?>,<?=$profile_data_edit['oid']?>)">Eliminar</button>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <h4 class="card-title"><?=$rb->texto?></h4>
                                                        <div class="row mt-3">
                                                            <div class="col-md-12">
                                                                <?php $letter = ord("A"); ?>
                                                                <?if( $rb->tipo=="ALT" ){?>
                                                                    <?php foreach($resultado_preguntas[$count_pg] as $rp) { ?>
                                                                            <?php $mark = ($rp->correcta == "S" ? "checked='checked'" : ""); ?>
                                                                            <input name="group<?= $rp->oid ?>" type="radio" id="radio<?= $rp->oid ?>" class="material-inputs radio-col-success" <?= $mark ?> disabled/>
                                                                            <label for="radio<?= $rp->oid ?>"><?=chr( $letter++ )?>) <?= $rp->texto ?></label>
                                                                            </br>
                                                                    <?php } ?>
                                                                <?}?>
                                                                <?if( $rb->tipo=="MUL" ){?>
                                                                    <?php foreach($resultado_preguntas[$count_pg] as $rp) { ?>
                                                                            <?php $mark = ($rp->correcta == "S" ? "checked='checked'" : ""); ?>
                                                                            <input name="group<?= $rp->oid ?>" type="checkbox" id="checkbox<?= $rp->oid ?>" class="material-inputs filled-in" <?= $mark ?> disabled/>
                                                                            <label for="checkbox<?= $rp->oid ?>"><?=chr( $letter++ )?>) <?= $rp->texto ?></label>
                                                                            </br>
                                                                    <?php } ?>
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
    </script>
</body>

</html>