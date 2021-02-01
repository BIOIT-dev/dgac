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
                    <div class="col-lg-12 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Tabs -->
                            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-timeline-tab" data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-timeline" aria-selected="true">Datos</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-profile" aria-selected="false">Información</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">Setting</a>
                                </li> -->
                            </ul>
                            <!-- Tabs -->
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
                                    <div class="card-body">
                                            <?php 
                                                $session = session();

                                                if( isset($mensaje_servidor) ){
                                                    echo '<div class="alert alert-success">';
                                                        echo $mensaje_servidor;
                                                    echo '</div>';
                                                }
                                            ?>
                                        <form action="<?php echo base_url('public/Comunidad/carga'); ?>" name="generar_reporte" id="generar_reporte" method="post" accept-charset="utf-8" class="form-horizontal form-material" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="categoria">Categoría</label>
                                                            <select id="categoria" name="categoria" class="with-gap material-inputs form-control" required="">
                                                                <option value="">Selecciona una categoría</option>
                                                                <?php foreach ($categorias as $categoria) { ?>
                                                                    <option value="<?php echo $categoria->oid; ?>">
                                                                        <?php echo $categoria->nombre; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-md-6">
                                                            <label for="clasificacion">Clasificación</label>
                                                            <select id="clasificacion" name="clasificacion" class="with-gap material-inputs form-control" required="">
                                                                <option value="">Selecciona una clasificación</option>
                                                                <?php foreach ($clasificaciones as $clasificacion) { ?>
                                                                    <option value="<?php echo $clasificacion->grcl_cod; ?>">
                                                                        <?php echo $clasificacion->grcl_nombre; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-md-6">
															<label for="cbx_Profesores">Archivo</label>
                                                            <input type="file" id="archivo" name="archivo" class="with-gap material-inputs form-control" required="">
                                                        </div>
                                                        <div class="col-md-6">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12 text-center">
                                                    <button type="submit" class="btn btn-success">Subir</button>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12 text-center">
                                                    <img src="<?php echo base_url() ?>/assets/images/cargamasiva2.jpg" style="width:700px;height:50px;">
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

        /**
        / Carga de cursos con ajax según la comunidad seleccionada
        */
        $("#comunidad").change(function() {
		  var grupo_id = $(this).val();

		  $.ajax( {
			  dataType: "json",
			  type: "POST",
			  url: "<?php echo base_url('public/GeneradorDocs/find_cursos'); ?>",
			  data: {'oid_grupo':grupo_id},
			  success: function( response ) {
				$('#curso').find('option:gt(0)').remove();
				var option = "";
				$.each(response, function (i,o) {
					option += '<option value="'+o.oid+'">'+o.titulo+'</option>';
				});
				$('#curso').html(option);
			  }
			} );

		});
		
		/**
        / Carga de profesores con ajax según la comunidad y el curso seleccionado
        */
        $("#comunidad, #curso").change(function() {
		  var grupo_id = $("#comunidad").val();
		  var curso_id = $("#curso").val();
		  var firmante = $("#firmante").val();
		  
		  if(grupo_id != "" && curso_id != ""){
			  $.ajax( {
				  dataType: "json",
				  type: "POST",
				  url: "<?php echo base_url('public/GeneradorDocs/find_profesores'); ?>",
				  data: {'oid_grupo':grupo_id, 'oid_curso':curso_id, 'firmante':firmante},
				  success: function( response ) {
					var html = "";
					$.each(response, function (i,o) {
						if(o.nombres != null && o.nombres != ''){
							html += '<br><div>'+o.nombres+' '+o.apellidos+'</div>';
						}
						if(o.nombres2 != null && o.nombres2 != ''){
							html += '<br><div>'+o.nombres2+' '+o.apellidos2+'</div>';
						}
					});
					$('#cbx_Profesores').html(html);
				  }
				} );
		  }
		  
		});

    </script>
</body>

</html>
