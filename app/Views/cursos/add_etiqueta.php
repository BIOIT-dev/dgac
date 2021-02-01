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
                                        <form action="<?php echo base_url('public/cursos/add_etiqueta/'.$oid_curso); ?>" name="add_etiqueta" id="add_etiqueta" method="post" accept-charset="utf-8">
                                            <div class="form-group" hidden>
                                                <label class="col-md-12">oid</label>
                                                <div class="col-md-12">
                                                    <input name="oid_usuario" type="text" class="form-control" value="<?= $profile_data['oid'] ?>">
                                                </div>
                                            </div>
                                            <div class="form-group" hidden>
                                                <label class="col-md-12">oid grupo</label>
                                                <div class="col-md-12">
                                                    <input name="oid_curso" type="text" class="form-control" value="<?= $oid_curso ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12" >Título</label>
                                                <div class="col-md-12">
                                                    <input size="50" name="titulo" value="" type="text" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Orden</label>
                                                <div class="col-md-12">
                                                <select name="orden" class="form-control">
                                                    <option value="0.5">Al inicio</option>
                                                    <? foreach($cursos_orden  as $valor){?>
                                                        <option value="<?=$valor->orden+0.5?>">Después de <?= $valor->titulo ?></option>
                                                    <? }?>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-success">Guardar</button>
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
    
    <script>
var options = {
		0 : ["1.0","2.0","3.0","4.0","5.0","6.0","7.0"],
		1 : [10,20,30,40,50,60,70,80,90,100]
}

$(function(){
	var fillSecondary = function(){
		var selected = $('#escala').val();
		$('#not_min').empty();
		options[selected].forEach(function(element,index){
			$('#not_min').append('<option value='+element+'>'+element+'</option>');
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