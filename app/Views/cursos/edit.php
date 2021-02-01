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
                                        <form action="<?php echo base_url('public/cursos/edit_curso/'.$curso_info->oid); ?>" name="curso_add" id="curso_add" method="post" accept-charset="utf-8">
                                            <div class="form-group" hidden>
                                                <label class="col-md-12">oid</label>
                                                <div class="col-md-12">
                                                    <input name="oid_usuario" type="text" class="form-control" value="<?= $profile_data['oid'] ?>">
                                                </div>
                                            </div>
                                            <div class="form-group" hidden>
                                                <label class="col-md-12">oid</label>
                                                <div class="col-md-12">
                                                    <input name="oid" type="text" class="form-control" value="<?= $curso_info->oid ?>">
                                                </div>
                                            </div>
                                            <div class="form-group" hidden>
                                                <label class="col-md-12">oid grupo</label>
                                                <div class="col-md-12">
                                                    <input name="oid_grupo" type="text" class="form-control" value="<?= $oid_grupo ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Título</label>
                                                <div class="col-md-12">
                                                    <input size="50" name="titulo" value="<?php if(isset($curso_info)){echo $curso_info->titulo;}?>" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Descripción</label>
                                                <div class="col-md-12">
                                                <textarea id="descripcion" name="descripcion" rows="12" cols="80" class="form-control">
                                                <?php if(isset($curso_info)){echo $curso_info->descripcion;}?>
                                                </textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Instrucciones</label>
                                                <div class="col-md-12">
                                                    <input id="instrucciones" name="instrucciones" type="text" size="50" value="<?php if(isset($curso_info)){echo $curso_info->instrucciones;}?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Ponderación</label>
                                                <div class="col-md-12">
                                                    <input size="3" name="ponderacion" value="<?php if(isset($curso_info)){echo $curso_info->ponderacion;}else{echo "0";}?>" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Asignatura Evaluada</label>
                                                <div class="col-md-12">
                                                <select name="evaluada" onchange="redireccionar(this);" class="form-control">
                                                    <option value="1" <?php if($curso_info->evaluada){ echo "selected='selected'"; }?>>SI</option>
                                                    <option value="0" <?php if(!$curso_info->evaluada){ echo "selected='selected'"; }?>>NO</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Escala de Notas</label>
                                                <div class="col-md-12">
                                                <select name="escala" id="escala" class="form-control">
                                                    <option value="0" <?= !$curso_info->escala ? "selected":"" ?>>1.0 - 7.0</option>
                                                    <option value="1" <?= $curso_info->escala ? "selected":"" ?>>0% - 100%</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Nota Minima Aprobación:</label>
                                                <div class="col-md-12">
                                                    <select  name="not_min" id="not_min" class="form-control">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Profesores</label>
                                                <? for ($i = 0; $i < 10; $i++) { ?>
                                                    <div class="col-md-12">
                                                        <select name="oid_profesor<?=$i==0?"":$i+1?>" class="form-control">
                                                            <?if(!empty($profesores)) { ?>
                                                                <option value="null" selected='selected'>-- Seleccionar Profesor--</option>
                                                                <? foreach($profesores  as $r){?>
                                                                    <?php
                                                                    $select="";
                                                                    // echo "valor___i=".$i;
                                                                    
                                                                    switch($i){
                                                                        case 0:
                                                                            if($r->oid==$curso_info->oid_profesor){
                                                                                $select = "selected='selected'";
                                                                            }
                                                                        break;
                                                                        case 1:
                                                                            if($r->oid==$curso_info->oid_profesor2){
                                                                                $select = "selected='selected'";
                                                                            }
                                                                        break;
                                                                        case 2:
                                                                            if($r->oid==$curso_info->oid_profesor3){
                                                                                $select = "selected='selected'";
                                                                            }
                                                                        break;
                                                                        case 3:
                                                                            if($r->oid==$curso_info->oid_profesor4){
                                                                                $select = "selected='selected'";
                                                                            }
                                                                        break;
                                                                        case 4:
                                                                            if($r->oid==$curso_info->oid_profesor5){
                                                                                $select = "selected='selected'";
                                                                            }
                                                                        break;
                                                                        case 5:
                                                                            if($r->oid==$curso_info->oid_profesor6){
                                                                                $select = "selected='selected'";
                                                                            }
                                                                        break;
                                                                        case 6:
                                                                            if($r->oid==$curso_info->oid_profesor7){
                                                                                $select = "selected='selected'";
                                                                            }
                                                                        break;
                                                                        case 7:
                                                                            if($r->oid==$curso_info->oid_profesor8){
                                                                                $select = "selected='selected'";
                                                                            }
                                                                        break;
                                                                        case 8:
                                                                            if($r->oid==$curso_info->oid_profesor9){
                                                                                $select = "selected='selected'";
                                                                            }
                                                                        break;
                                                                        case 9:
                                                                            if($r->oid==$curso_info->oid_profesor10){
                                                                                $select = "selected='selected'";
                                                                            }
                                                                        break;
                                                                        default:
                                                                            $select="";
                                                                        break;
                                                                        
                                                                    }
                                                                    ?>
                                                                    <option <?php echo $select; ?> value="<?=$r->oid?>"><?=($r->nombres)?> <?=($r->apellidos)?></option>
                                                                <? }?>
                                                            <? }else { ?>
                                                                <option value="0" selected='selected'>Sin profesores</option>
                                                            <? } ?>
                                                        </select>
                                                    </div>
                                                    <br>
                                                <? } ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Orden</label>
                                                <div class="col-md-12">
                                                <select name="orden" class="form-control">
                                                    <option value="0.5">Al inicio</option>
                                                    <? foreach($cursos  as $valor){?>
                                                        <option <?php if($curso_info->orden==$valor->orden+0.5){ echo "selected='selected'"; }?> value="<?=$valor->orden+0.5?>">Después de <?= $valor->titulo ?></option>
                                                    <? }?>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Estado</label>
                                                <div class="col-md-12">
                                                <select name="inactivo" class="form-control">
                                                    <option value="0" <?php if(!$curso_info->inactivo){ echo "selected='selected'"; }?>>Activo</option>
                                                    <option value="1" <?php if($curso_info->inactivo){ echo "selected='selected'"; }?>>Inactivo</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Mostrar en la Home</label>
                                                <div class="col-md-12">
                                                <!-- <input name="group1"  class="material-inputs" type="radio" id="radio_1" checked /> -->
                                                <!-- <label for="radio_1">Radio - 1</label> -->
                                                <input class="material-inputs" type="radio" name="zona_home" id="zone_home1" value="" <?php if($curso_info->zona_home==""){ echo "checked='checked'"; }?> />
                                                <label for="zone_home1">No mostrar</label>
                                                <input class="material-inputs" type="radio" name="zona_home" id="zone_home2" value="LNK" <?php if($curso_info->zona_home=="LNK"){ echo "checked='checked'"; }?>/>
                                                <label for="zone_home2"> En la Zona de Links</label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-success">Guardar</button>
                                                    <a type="button" style="color:#fff;" class="btn btn-danger">Eliminar</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- Row -->
                <!-- Row -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- <div class="modal fade" id="createmodel" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <h5 class="modal-title" id="createModalLabel"><i class="ti-marker-alt mr-2"></i> Create
                                    New Contact</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info"><i
                                            class="ti-user text-white"></i></button>
                                    <input type="text" class="form-control" placeholder="Enter Name Here"
                                        aria-label="name">
                                </div>
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info"><i
                                            class="ti-more text-white"></i></button>
                                    <input type="text" class="form-control" placeholder="Enter Mobile Number Here"
                                        aria-label="no">
                                </div>
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info"><i
                                            class="ti-import text-white"></i></button>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose Image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success"><i class="ti-save"></i> Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> -->
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
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
<script src="<?php echo base_url() ?>/assets/libs/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('descripcion', {
          language: 'es'
        });
    </script>
    
    <script>
var options = {
		0 : ["1.0","2.0","3.0","4.0","5.0","6.0","7.0"],
		1 : ["10","20","30","40","50","60","70","80","90","100"]
}
var nota_aprobatoria = <? echo $curso_info->not_min; ?>

$(function(){
	var fillSecondary = function(){
		var selected = $('#escala').val();
		$('#not_min').empty();
		options[selected].forEach(function(element,index){
            if(nota_aprobatoria==element){
                $('#not_min').append('<option selected="selected" value='+element+'>'+element+'</option>');
            }else{
                $('#not_min').append('<option value='+element+'>'+element+'</option>');
            }
		});
	}
	$('#escala').change(fillSecondary);
	fillSecondary();
});


function redireccionar(obj) {
var valorSeleccionado = obj.options[obj.selectedIndex].value;
   if ( valorSeleccionado == 1 ) {
     document.getElementById("escala").style.display  = "initial";
     document.getElementById("not_min").style.display  = "initial";
   }
   if ( valorSeleccionado == 0) {
     document.getElementById("escala").style.display  = "none";
     document.getElementById("not_min").style.display  = "none";
   }
}

</script>
</body>

</html>