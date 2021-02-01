<?php //echo view('dgac/headers'); ?>
<?php echo $headers['headersView']; ?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/libs/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css">
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
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-12 col-md-12">
                    <div id="accordion" class="custom-accordion mb-4">

                        <div class="card mb-0">
                            <div class="card-header" style="background-color: #1e88e5;" id="headingTwo">
                                <h5 class="m-0">
                                    <a style="color: #ffffff;" id="eva2" class="custom-accordion-title d-block pt-2 pb-2 collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Evaluación en Línea para Alumnos<span class="float-right"><i class="mdi mdi-chevron-down accordion-arrow"></i></span>
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                <form action="<?php echo base_url('public/cursos/edit_evaluaciones/'.$oid_curso.'/'.$oid_evaluacion); ?>" name="edit_evaluaciones_2" id="edit_evaluaciones_2" method="post" accept-charset="utf-8">
                                    <!-- <div class="form-group" hidden>
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
                                    </div> -->
                                    <div class="form-group">
                                        <label class="col-md-12">Título</label>
                                        <div class="col-md-12">
                                            <input size="50" name="titulo" value="<?= $datos_evaluaciones->titulo ?>" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Texto</label>
                                        <div class="col-md-12">
                                            <textarea size="50" name="texto" class="form-control"><?= $datos_evaluaciones->texto ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Ponderación</label>
                                        <div class="col-md-12">
                                            <input size="4" name="ponderacion" value="<?=$datos_evaluaciones->ponderacion ?>" type="text" class="form-control">
                                            <small id="name13" class="badge badge-default badge-danger form-text text-white float-right">Máximo Porcentaje Posible: <?=$cursos_maxima_ponderacion?>%</small>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Inicio/Término</label>
                                        <div class="col-md-12">
                                            <div class="input-daterange input-group" id="date-range">
                                                <input type="datetime-local" class="form-control" name="finicio" value="<?= date('Y-m-d\TH:i:s', strtotime($datos_evaluaciones->finicio)); ?>" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-info b-0 text-white">AL</span>
                                                </div>
                                                <input type="datetime-local" class="form-control" name="ftermino" value="<?= date('Y-m-d\TH:i:s', strtotime($datos_evaluaciones->ftermino)); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Banco de Preguntas:</label>
                                        <div class="col-md-12">
                                            <input size="50" value="<?= $pregunta_seleccionada[0]->titulo ?> [Total de <?= $pregunta_seleccionada[0]->numpregs ?> preguntas]" type="text" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Número de Preguntas:	</label>
                                        <div class="col-md-12">
                                            <input size="4" name="numpregs_test" value="<?= $datos_evaluaciones->numpregs_test ?>" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Obligatorio:</label>
                                        <div class="col-md-12">
                                            <select name="responder_todo" class="form-control">
                                                <option value="0" selected="selected">No es Obligatorio Responder Todas las Preguntas</option>
                                                <option value="1">Debe Responder Todas las Preguntas</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Retroalimentacion:</label>
                                        <div class="col-md-12">
                                        <select name="muestra_feedback" class="form-control">
                                            <option value="0" <?= $datos_evaluaciones->muestra_feedback ? "":"selected" ?>>No, no se muestra reatroalimentacion al finalizar la evaluacion</option>
                                            <option value="1" <?= $datos_evaluaciones->muestra_feedback? "selected":"" ?>>Si, si se muestra reatroalimentacion al finalizar la evaluacion</option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Disponibilidad:</label>
                                        <div class="col-md-12">
                                        <select name="disponible_test" class="form-control">
                                            <option value="0" <?= $datos_evaluaciones->disponible_test ? "":"selected" ?>>No Disponible para Alumnos</option>
                                            <option value="1" <?= $datos_evaluaciones->disponible_test? "selected":"" ?>>Disponible para Alumnos</option>
                                        </select>
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
                                            <!-- <input type="hidden" name="tipo" value="TLI" />
                                            <input type="hidden" name="es_formativa" value="0" /> -->
                                            <button type="submit" onclick="return validar('add_evaluaciones_2');" class="btn btn-success">Guardar</button>
                                        </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div> <!-- end card-->

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
<script src="<?php echo base_url() ?>/assets/libs/sweetalert2/dist/sweetalert2.all.js"></script>
    <script src="<?php echo base_url() ?>/assets/extra-libs/sweetalert2/sweet-alert.init.js"></script>
    <!-- This Page JS -->
    <script src="<?php echo base_url() ?>/assets/libs/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/js/pages/datatable/custom-datatable.js"></script>
    <script type="text/javascript" charset="utf8" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/js/dataTables.checkboxes.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/moment/moment.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/extra-libs/sweetalert2/sweet-alert.init.js"></script>
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
    

    

    $("#eva1").click(function(){
        elemento2 = $('#collapseTwo').attr('class');
        elemento3 = $('#collapseThree').attr('class');
        // console.log(elemento2);
        // console.log(elemento3);
        if(elemento2=='collapse show'){
            $('#eva2').click();
        }
        if(elemento3=='collapse show'){
            $('#eva3').click();
        }
    });

    $("#eva2").click(function(){
        elemento1 = $('#collapseOne').attr('class');
        elemento3 = $('#collapseThree').attr('class');
        // console.log(elemento1);
        // console.log(elemento3);
        if(elemento1=='collapse'){
            $('#eva1').click();
        }
        if(elemento3=='collapse show'){
            $('#eva3').click();
        }
    });

    $("#eva3").click(function(){
        elemento1 = $('#collapseOne').attr('class');
        elemento2 = $('#collapseTwo').attr('class');
        
        if(elemento1=='collapse'){
            $('#eva1').click();
        }
        if(elemento2=='collapse show'){
            $('#eva2').click();
        }
    });

    function validar(formulario){
        
        try{
            var f1 = $('#'+formulario).find('input[name="finicio"]').val();
            var f2 = $('#'+formulario).find('input[name="ftermino"]').val();
        if(f1=="" || f2==""){
            Swal.fire("Error!","Debe ingresar valores en las fechas de inicio / termino!");
          return false;
        }
        var fecha1 = moment(f1);
        var fecha2 = moment(f2);
        var date = new Date();
        inicio = new Date(f1);
        fin = new Date(f2);
        if(inicio < date){
            Swal.fire("Error!","La fecha de inicio es menor a la fecha actual!");

          return false;
        }
        if(fin < inicio){
            Swal.fire("Error!","La fecha de termino es menor a la fecha de inicio!");
          return false;
        }
        // return false;
        } catch(e){
        return false;
        }
    }

    function getNumPregsTLI( s ){
    var v=s.options[ s.selectedIndex ].value;
    var a=v.split( ":" );
    var n=a[1] * 1;
    return n;
  }

  function cambiaTLI( s ){
    var n=getNumPregsTLI( s );
    document.forms.fTLI.numpregs_test.value=n;
  }

  function cambiaFOR( s ){
    var n=getNumPregsTLI( s );
    document.forms.fFOR.numpregs_test.value=n;
  }


    </script>
</body>

</html>