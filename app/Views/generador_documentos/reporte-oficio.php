<?php //echo view('dgac/headers'); ?>
<?php echo $headers['headersView']; ?>

<style>
.list_titulo {
    font-size: 13px;
    font-weight: bold;
    text-align: center;
    text-decoration: none;
    color: #ffffff;
    background-color: #ff8c00;
}
.form_botones {
    text-align: center;
    color: #000000;
}
</style>

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
                                        <form action="<?php echo base_url('public/GeneradorDocs/reporte_oficio'); ?>" name="generar_reporte" id="generar_reporte" method="post" accept-charset="utf-8" class="form-horizontal form-material">
                                            <div class="form-group">
                                                <div class="col-md-12">
													<div class="row">
                                                        <div class="col-md-6">
                                                            <label for="activo">Nombre del director firmante</label>
                                                            <input id="firmante" name="firmante" class="with-gap material-inputs form-control" required="">
                                                        </div>
                                                        <div class="col-md-6">
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-md-6">
                                                            <label for="url">Curso</label>
                                                            <select id="curso" name="curso" class="with-gap material-inputs form-control" required="">
                                                                <option value="">Seleccionar curso</option>
                                                                <?php foreach ($cursos as $curso) { ?>
                                                                    <option value="<?php echo $curso->nombre_grupo; ?>">
                                                                        <?php echo $curso->nombre_grupo; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-md-6">
                                                            <label for="activo">Unidad</label>
                                                            <select id="unidad" name="unidad" class="with-gap material-inputs form-control" required="">
                                                                
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-md-12">
															<table id="portadores" border="0" width="90%" cellpadding="4" cellspacing="1" summary="">
															  <br><br>
															  <tbody >
																<tr>
																	<td colspan="9" class="list_titulo">Documento Oficio Portador</td>
																</tr>
																
																<tr>
																  <td colspan="9" name="cbx_reponse" id="cbx_reponse">

															      </td>
																</tr>

															    <tr>
																  <td colspan="9" class="form_botones">
																	<button type="submit" class="btn btn-success">Grabar</button>
																  </td>
															    </tr>
															  <tbody >
															</table>                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--<div class="form-group">
                                                <div class="col-sm-12 text-center">
                                                    <button type="submit" class="btn btn-success">Imprimir oficio portador</button>
                                                </div>
                                            </div>-->
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
        $("#curso").change(function() {
		  var curso = $(this).val();

		  $.ajax( {
			  dataType: "json",
			  type: "POST",
			  url: "<?php echo base_url('public/GeneradorDocs/find_unidades'); ?>",
			  data: {'curso':curso},
			  success: function( response ) {
				$('#unidad').find('option:gt(0)').remove();
				var option = '<option value="null">Selecciona</option>';
				$.each(response, function (i,o) {
					option += '<option value="'+o.unidad+'">'+o.unidad+'</option>';
				});
				$('#unidad').html(option);
			  }
			} );

		});
		
		/**
        / Carga de listado de profesores con ajax según el curso y la unidad seleccionada
        */
		var getoficioportador = function(){
			var curso = $('#curso').val();
			var unidad = $('#unidad').val();

			// alert(grupo);
			$.post("<?php echo base_url('public/GeneradorDocs/find_oficioPortador'); ?>", { curso:curso, unidad:unidad }, function(data){
				$("#cbx_reponse").html(data);
				
				/**
				/ Para quitar portador del listado
				*/
				$('.quitar_portador').click(function(e){
					
					var id = $(this).data('id');

					$.post("<?php echo base_url('public/GeneradorDocs/quitar_portador'); ?>", { id:id }, function(data){
						console.log(data);
					});
					
					// Recarga del listado de profesores
					getoficioportador();
					
				});
				
			}); 		
        }

		$('#unidad').change(getoficioportador);
		
		/**
		/ Evitar envío del formulario si no se ha marcado ningún profesor
		*/
		$('#generar_reporte').submit(function(e){
			
			// Verificación de checkbox marcados
			var num_checked = 0;  // Contador de checkbox marcados
		
			// Recorremos la tabla para verificar
			var table_tr = $("#portadores tbody").children('tr');
			
			if(table_tr.eq(1).find('td#cbx_reponse').children('tr.results').length > 0){
				table_tr.eq(1).find('td#cbx_reponse').children('tr.results').each(function () {
					var checkbox;
					checkbox = $(this).find('td').eq(0).find('input');
					
					if (checkbox.is(':checked')) {
						num_checked += 1;
					}
				});
			}
			
			if (num_checked == 0) {
				e.preventDefault();
                alert('Debe seleccionar al menos uno');
			}			
			
		});

    </script>
</body>

</html>
