<?php //echo view('dgac/headers'); ?>
<?php echo $headers['headersView']; ?>

<!-- This Page CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/libs/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
<!-- Custom CSS -->
<link href="<?php echo base_url() ?>/assets/dist/css/style.min.css" rel="stylesheet">

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
                                        <h2><?= $evaluacion[0]->titulo ?></h2>
                                        <? if($evaluacion[0]->inactivo){ ?>
                                            <button type="button" class="btn waves-effect waves-light btn-rounded btn-danger btn-sm m-1 ml-0">Este módulo está inactivo</button>
                                        <? } ?>
                                        <hr>
                                        <h4>Registrar Notas en Evaluación</h4>
                                        <div class="form-group">
                                            <small><label class="col-md-12">Título</label></small>
                                            <div class="col-md-12">
                                                <input name="titulo" type="text" size="50" class="form-control form-control-line" value="<?= $evaluacion[0]->ce_titulo ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <small><label class="col-md-12">Ponderación</label></small>
                                            <div class="col-md-12">
                                                <input name="ponderacion" type="text" size="50" class="form-control form-control-line" value="<?= $evaluacion[0]->ce_ponderacion ?>%" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <small><label class="col-md-12">Descripción</label></small>
                                            <div class="col-md-12">
                                                <input name="descripcion" type="text" size="50" class="form-control form-control-line" value="<?= $evaluacion[0]->texto ?>" disabled>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                        <table name="tabla_examen" id="tabla_examen" class="table table-striped table-bordered display" style="width:100%">
                                            <!-- <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm m-1 ml-0"
                                                                onclick='modalSwal()'>Eliminar Respuesta</button> -->
                                            <!-- <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm m-1 ml-0"
                                                                onclick="location.href='<?php echo site_url('examen/agregar_respuesta/'.$profile_data_edit['oid']); ?>'">Agregar Respuesta</button> -->
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Alumnos</th>
                                                    <?if( $evaluacion[0]->es_tarea ){?>
                                                        <th scope="col">Tarea</th>
                                                    <?}?>
                                                    <th scope="col">Nota<?= ($evaluacion[0]->escala == 0) ? "[1.0-7.0]": "[0%-100%]"?> </th>
                                                    <?if( $evaluacion[0]->tipo == "REG" ){?>
                                                        <th scope="col">Retroalimentación</th>
                                                    <?}?>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Alumnos</th>
                                                    <?if( $evaluacion[0]->es_tarea ){?>
                                                        <th scope="col">Tarea</th>
                                                    <?}?>
                                                    <th scope="col">Nota<?= ($evaluacion[0]->escala == 0) ? "[1.0-7.0]": "[0%-100%]"?> </th>
                                                    <?if( $evaluacion[0]->tipo == "REG" ){?>
                                                        <th scope="col">Retroalimentación</th>
                                                    <?}?>
                                                </tr>
                                            </tfoot>
                                        </table>
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
                                                        <button onclick="botonEliminar()" type="button" class="swal2-confirm swal2-styled" aria-label="">Eliminar</button>
                                                        <button onclick="modalClose()" type="button" class="swal2-cancel swal2-styled" aria-label="">Cancelar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal delete -->
                                        <!-- Modal error -->
                                        <div id="modalError" class="swal2-container swal2-center swal2-fade swal2-shown" style="overflow-y: auto; display: none;">
                                            <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
                                                <div class="swal2-header">
                                                    <div id="swal2-icon-modal" class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;">
                                                        <span class="swal2-x-mark">
                                                            <span class="swal2-x-mark-line-left"></span>
                                                            <span class="swal2-x-mark-line-right"></span>
                                                        </span>
                                                    </div>
                                                    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Error</h2>
                                                    <button onclick="modalClose()" type="button" class="swal2-close" aria-label="Close this dialog">×</button>
                                                </div>
                                                <div class="swal2-content">
                                                    <div id="swal2-content" style="display: block;">
                                                        No hay preguntas seleccionadas para eliminar
                                                    </div>
                                                    <div class="swal2-actions" style="display: flex;">
                                                        <button onclick="modalClose()" type="button" class="swal2-confirm swal2-styled" aria-label="">OK</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal error -->
                                        <!-- Modal success -->
                                        <div id="modalSuccess" class="swal2-container swal2-center swal2-fade swal2-shown" style="overflow-y: auto; display: none;">
                                            <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
                                                <div class="swal2-header">
                                                    <div id="swal2-icon-modal" class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex;">
                                                        <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>    
                                                        <span class="swal2-success-line-tip"></span>
                                                        <span class="swal2-success-line-long"></span>
                                                        <div class="swal2-success-ring"></div> 
                                                        <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                                        <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                                                    </div>
                                                    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Éxito</h2>
                                                    <!-- <button onclick="modalClose()" type="button" class="swal2-close" aria-label="Close this dialog">×</button> -->
                                                </div>
                                                <div class="swal2-content">
                                                    <div id="swal2-content" style="display: block;">
                                                        ¡Notas Ingresadas Correctamente!
                                                    </div>
                                                    <div class="swal2-actions" style="display: flex;">
                                                        <!-- <a href="<?php echo site_url('examen/index'); ?>" type="button" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block; border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);">OK</a> -->
                                                        <button onclick="javascript:location.reload();" type="button" class="swal2-confirm swal2-styled" aria-label="">OK</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal success -->
                                        <!-- Modal form retroalimentación -->
                                        <div id="modalFeedback" class="swal2-container swal2-center swal2-fade swal2-shown" style="overflow-y: auto; display: none;">
                                            <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
                                                <div class="swal2-header">
                                                    <!-- <div id="swal2-icon-modal" class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex;">
                                                        <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>    
                                                        <span class="swal2-success-line-tip"></span>
                                                        <span class="swal2-success-line-long"></span>
                                                        <div class="swal2-success-ring"></div> 
                                                        <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                                        <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                                                    </div> -->
                                                    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Ingresar Archivo de Retroalimentación</h2>
                                                    <!-- <button onclick="modalClose()" type="button" class="swal2-close" aria-label="Close this dialog">×</button> -->
                                                </div>
                                                <div class="swal2-content">
                                                    <!-- <div id="swal2-content" style="display: block;">
                                                        ¡Notas Ingresadas Correctamente!
                                                    </div> -->
                                                    <form class="pl-3 pr-3" action="<?php echo base_url('public/Cursos/agregarFeedback'); ?>" name="agregar_feedback" id="agregar_feedback" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                                        <div class="form-group" hidden>
                                                            <label for="grupo_id">curso_evaluacion_alumno</label>
                                                            <input value="" class="form-control" type="text" name="curso_evaluacion_alumno" id="curso_evaluacion_alumno" required="">
                                                        </div>
                                                        <div class="form-group" hidden>
                                                            <label for="grupo_id">oid_grupo</label>
                                                            <input value="<?= $oid_curso ?>" class="form-control" type="text" name="oid_grupo_hidden" id="oid_grupo_hidden" required="">
                                                        </div>
                                                        <div class="form-group" hidden>
                                                            <label for="grupo_id">oid_evaluacion</label>
                                                            <input value="<?= $oid_evaluacion ?>" class="form-control" type="text" name="oid_evaluacion_hidden" id="oid_evaluacion_hidden" required="">
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Archivo</span>
                                                                    </div>
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input" name="archivo" id="inputGroupFile01" required>
                                                                        <label class="custom-file-label" for="inputGroupFile01">Seleccionar archivo</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="swal2-actions" style="display: flex;">
                                                            <button id="botonEliminar" type="submit" class="swal2-confirm swal2-styled" aria-label="">Enviar</button>
                                                            <button onclick="modalClose()" type="button" class="swal2-cancel swal2-styled" aria-label="">Cancelar</button>
                                                        </div>
                                                    </form>
                                                    <!-- <div class="swal2-actions" style="display: flex;">
                                                        <!-- <a href="<?php echo site_url('examen/index'); ?>" type="button" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block; border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);">OK</a> -->
                                                        <!-- <button onclick="modalClose()" type="button" class="swal2-confirm swal2-styled" aria-label="">OK</button>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal form retroalimentación -->
                                    </div>
                                </div>
                            </div>
                            <?if( $evaluacion[0]->tipo == "REG" ){?>
                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-success m-1 ml-0"
                                                                onclick='getDataTable()'>Grabar</button>
                            <?}?>
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
    <!--Custom JavaScript -->
    <script src="<?php echo base_url() ?>/assets/libs/sweetalert2/dist/sweetalert2.all.js"></script>
    <script src="<?php echo base_url() ?>/assets/extra-libs/sweetalert2/sweet-alert.init.js"></script>
    <!-- This Page JS -->
    <script src="<?php echo base_url() ?>/assets/libs/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/js/pages/datatable/custom-datatable.js"></script>
    <script type="text/javascript" charset="utf8" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/js/dataTables.checkboxes.min.js"></script>
    <script>
    $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
    var radioswitch = function() {
        var bt = function() {
            $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioState")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
            })
        };
        return {
            init: function() {
                bt()
            }
        }
    }();
    $(document).ready(function() {
        radioswitch.init()
    });
    </script>
    <script>
        //Dataset para crear la tabla
        var dataSet = []
        <?php foreach($alumnos as $rb) { ?>
            dataTemp = [];
            dataTemp = ['<?= $rb->uoid ?>','<?= $rb->apellidos.", ".$rb->nombres ?>'];
            <?if( $evaluacion[0]->es_tarea ){?>
                dataTemp.push('<td class="form_texto" style="text-align: center;">'+
                                <?if( $rb->cta_oid ){?>
                                '<div class="attach-buttons">'+
                                    '<a href="<?php echo site_url('Cursos/descargarRespuesta/'.$rb->cta_archivo); ?>" title="Descargar" download>Descargar</a>'+
                                '</div>'+
                                <?}else{?>
                                '---'+
                                <?}?>
                            '</td>');
            <?}?>
            dataTemp.push('<input id="nota<?= $rb->uoid ?>" name="titulo" type="number" min="0" max="100" class="form-control form-control-line" value="<?= $rb->nota ?>" <?= ($evaluacion[0]->tipo != "REG")?"disabled":""?>>');
            <?if( $evaluacion[0]->tipo == "REG" ){?>
                <?if($rb->nota!="" && $rb->archivo==""){?>
                    dataTemp.push('<a href="#" onclick="return addRetroalimentacion(<?=$rb->cea_oid?>)" title="Agregar">'+
                        '<i class="fas fa-plus"></i> Agregar '+
                    '</a>');
                <?}elseif($rb->nota!="" && $rb->archivo!=""){?>
                    dataTemp.push('<a href="<?php echo site_url('Cursos/descargar/'.$rb->archivo); ?>" title="Descargar">'+
                        '<i class="fas fa-download"></i> Descargar '+
                    '</a> '+
                    '<a href="#" onclick="return eliminarRetroalimentacion(<?=$rb->cea_oid?>)" title="Eliminar">'+
                        '<i class="fas fa-trash-alt"></i> Eliminar'+
                    '</a>');
                <?}else{?>
                    dataTemp.push('---');
                <?}?>
            <?}?>
            // console.log(dataTemp);

            dataSet.push(dataTemp);
        <?php } ?>
        console.log(dataSet);
        
        $(document).ready(function() {
            var table = $('#tabla_examen').DataTable({
                data: dataSet,
                // columnDefs: [
                //     {
                //         'targets': 0,
                //         'checkboxes': {
                //             'selectRow': true,
                //         }
                //     }
                // ],
                select: {
                    style: 'multi'
                },
                order: [[1, 'asc']],
                language: {
                    lengthMenu: "Mostrando _MENU_ datos por página",
                    zeroRecords: "Nothing found - sorry",
                    info: "Mostrando página _PAGE_ de _PAGES_",
                    infoEmpty: "No hay datos disponibles.",
                    infoFiltered: "(filtered from _MAX_ total records)",
                    search: "Buscar",
                    searchPlaceholder: "",
                    paginate: {
                        first: "Primero",
                        last: "Último",
                        next: "Siguiente",
                        previous: "Anterior"
                    },
                },
                paging: false
            });
        });

        function getDataTable(table){
            var form_data  = $('#tabla_examen').DataTable().rows().data(); 
            var dataJson = {};
            var nota = '';
            var flag = false;
            var rangos = [];
            for(var i = 0; i < form_data.length; i++){
                try {
                    nota = document.getElementById("nota"+form_data[i][0]).value;
                    <? if ($evaluacion[0]->escala == 0){ ?>
                        rangos = [1.0, 7.0];
                    <? }else { ?> 
                        rangos = [0, 100];
                    <? } ?>
                    if(nota != ""){
                        if(nota < rangos[0] || nota > rangos[1]){
                            document.getElementById("nota"+form_data[i][0]).focus();
                            window.alert("Valor no válido, debe ser entre "+rangos[0]+" y "+rangos[1]); 
                            flag = true;
                            break;
                        }
                    }
                    
                } catch (error) {
                    nota = '';
                }
                console.log(form_data[i]);
                dataJson[i] = {
                    oid_usuario: form_data[i][0],
                    nota: nota
                };
            }
            if(flag == true) return;
            console.log(dataJson);
            var url = "<?php echo base_url('public/cursos/add_notas_evaluacion/'.$oid_grupo."/".$oid_evaluacion); ?>";
            $.post(url, dataJson, function(data, status){
                if (status){
                    // console.log(data);
                    document.querySelector("#modalSuccess").style.display = "block";
                }else{
                    console.log("ERROR");
                }
            });
        }

        function addRetroalimentacion(oid){
            console.log(oid);
            document.querySelector("#curso_evaluacion_alumno").value = oid;
            document.querySelector("#modalFeedback").style.display = "block";
        }

        function eliminarRetroalimentacion(oid){
            var url = "<?php echo base_url('public/Cursos/eliminarFeedback'); ?>";
            $.post(url, {oid:oid}, function(data, status){
                if (status){
                    console.log(data);
                    location.reload();
                    // document.querySelector("#modalDelete").style.display = "none";
                    // document.querySelector("#modalSuccess").style.display = "block";
                }else{
                    console.log("ERROR");
                }
            });

            // document.querySelector("#curso_evaluacion_alumno").value = oid;
            // document.querySelector("#modalFeedback").style.display = "block";
        }
        
    </script>
    <script>
        function modalSwal(){
            cant_usuarios_checked = $('#tabla_examen').DataTable().column(0).checkboxes.selected().length;

            if (cant_usuarios_checked > 0){
                document.querySelector("#modalDelete #swal2-content").innerHTML = "¿Está seguro que quiere eliminar "+cant_usuarios_checked+" preguntas? <br>¡Esta acción no se puede deshacer!";
                document.querySelector("#modalDelete").style.display = "block";
            }else{
                document.querySelector("#modalError").style.display = "block";
            }
        }

        function modalClose(){
            document.querySelector("#modalSuccess").style.display = "none";
            document.querySelector("#modalDelete").style.display = "none";
            document.querySelector("#modalError").style.display = "none";
            document.querySelector("#modalFeedback").style.display = "none";
        }

        function botonEliminar(){
            var checked = {};
            var list_checked = $('#tabla_examen').DataTable().column(0).checkboxes.selected();
            for (var i = 0; i < list_checked.length; i++){
                checked[i] = list_checked[i];
            }
            
            var url = "<?php echo base_url('public/examen/eliminar'); ?>";
            $.post(url, checked, function(data, status){
                if (status){
                    document.querySelector("#modalDelete").style.display = "none";
                    document.querySelector("#modalSuccess").style.display = "block";
                }else{
                    console.log("ERROR");
                }
            });
        }
    </script>
</body>

</html>