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
                                    <a class="nav-link active" id="pills-timeline-tab" data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-timeline" aria-selected="true">Carga Masiva de Usuarios</a>
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
                                        <form id="f" method="post" action="<?php echo base_url('public/Usuario/carga'); ?>" accept-charset="utf-8" class="form-horizontal form-material" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <small><label class="col-md-12">Autentificación</label></small>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <input name="authInterna" class="with-gap material-inputs" type="radio" id="radio_1" value="1" checked="checked" onclick="document.forms['f']['campo[2]'].checked=true;"/>
                                                            <label for="radio_1">En la Plataforma</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="authInterna" class="with-gap material-inputs" type="radio" id="radio_2" value="0" onclick="document.forms['f']['campo[2]'].checked=false;" />
                                                            <label for="radio_2">Externa a la Plataforma</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Comunidad</label></small>
                                                <div class="col-md-12">
                                                    <select class="form-control form-control-line" id="goid" name="goid">
                                                        <?php foreach ($comunidades as $comunidad) { ?>
															<?php if( $profile_data['oid_grupo']!=1 && $comunidad->oid!=$profile_data['oid_grupo'] ) continue; ?>
															<option value="<?php echo $comunidad->oid; ?>" <?php $comunidad->oid==$profile_data['oid_grupo']?"selected='selected'":""; ?>>
																<?php echo $comunidad->nombre; ?>
															</option>
														<?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Rol</label></small>
                                                <div class="col-md-12">
                                                    <select class="form-control form-control-line" id="grol" name="grol">
                                                        <?php foreach ($roles as $rol) { ?>
															<?php $sel=($rol->clave=="ALU" ? "selected='selected'" : "" ); ?>
															<option value="<?php echo $rol->clave; ?>" <?php echo $sel; ?>>
																<?php echo $rol->name; ?>
															</option>
														<?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Archivo</label></small>
                                                <div class="col-md-12">
													<input type="file" class="form-control form-control-line" id="gfile" name="gfile">
													<ul>
														<li>Debe corresponder a un archivo de texto</li>
														<li>Userid,Clave,Nombres,Apellido Paterno,[Apellido Materno],[Sexo],[Email]</li>
														<li>Debe reemplazar el caracter (,) por el delimitador señalado</li>
														<li>Los campos entre corchetes [&nbsp;] son opcionales</li>
														<li>Debe especificar sexo como M o F</li>
													</ul>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Campos</label></small>
                                                <div class="col-md-12">
                                                    <?php foreach( $campos as $idx => $a ){?>
													<input type="checkbox" name="campo[<?php echo $idx;?>]" value="1" <?php echo $a[ 0 ] ? 'checked="checked" disabled="disabled"' : '' ?> />
													<?php echo htmlentities($a[ 1 ], ENT_QUOTES, "UTF-8"); ?>
													<?php if( isset( $a[ 2 ] ) ){?>
													<?php echo htmlentities($a[ 2 ], ENT_QUOTES, "UTF-8"); ?>
													<?php }?>
													<br />
													<?php }?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Duplicados</label></small>
                                                <div class="col-md-12">
                                                    <input type="checkbox" name="incorporar" value="1" checked='checked' /> Si el Usuario (Userid) Existe en el Sistema, asignarlo a la Comunidad
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Codificación</label></small>
                                                <div class="col-md-12">
                                                    <input type="radio" name="gcod" value="utf-8" checked='checked' /> UTF-8
													<br />
													<input type="radio" name="gcod" value="latin1" /> Latin1
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Delimitador de campo</label></small>
                                                <div class="col-md-12">
                                                    <input type="radio" name="gsep" value="," checked='checked' /> coma [,]
													<br />
													<input type="radio" name="gsep" value=";" /> punto y coma [;]
													<br />
													<input type="radio" name="gsep" value=":" /> dos puntos [:]
													<br />
													<input type="radio" name="gsep" value="TAB" /> Tab
													<br />
													<input type="radio" name="gsep" value="OTRO" /> Otro
													<input type="text" name="gsepotro" value="" size="3" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Delimitador de línea</label></small>
                                                <div class="col-md-12">
                                                    <input type="radio" name="geol" value="LF" checked='checked' /> Unix (LF)
													<br />
													<input type="radio" name="geol" value="CRLF" /> DOS (CR+LF)
													<br />
													<input type="radio" name="geol" value="CR" /> Mac (CR)
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Ignorar al inicio</label></small>
                                                <div class="col-md-12">
                                                    <input type="radio" name="glin" value="0" checked='checked' /> 0 Líneas
													<br />
													<input type="radio" name="glin" value="1" /> 1 Líneas
													<br />
													<input type="radio" name="glin" value="2" /> 2 Líneas
													<br />
													<input type="radio" name="glin" value="3" /> 3 Líneas
													<br />
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="col-sm-12 text-center">
                                                    <button class="btn btn-success">Realizar carga masiva</button>
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
