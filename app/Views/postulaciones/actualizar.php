<?php //echo view('dgac/headers'); ?>
<?php echo $headers['headersView']; ?>
<!-- This Page CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
<!-- Custom CSS -->
<!-- <link href="<?php echo base_url() ?>/assets/dist/css/style.min.css" rel="stylesheet"> -->
<!-- This page CSS -->
<link href="<?php echo base_url() ?>/assets/libs/jquery-steps/jquery.steps.css" rel="stylesheet">
<link href="<?php echo base_url() ?>/assets/libs/jquery-steps/steps.css" rel="stylesheet">

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
        <?php //echo view('dgac/leftsidebar'); ?>
        <div id="remainingSeconds" hidden>1000</div>
        <div id="countdown" hidden>1000</div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style="padding-top: 70px;">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <?php //echo view('dgac/breadcrum'); ?>
            <!-- <h3>Postulación Carreras</h3> -->
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
                        <div class="card" style="display: block;">
                            <div class="card bg-dark">
                                <div class="card-body text-center">
                                    <div class="text-white p-3">
                                        <h2 class="mb-0 text-white">FORMULARIO DE INSCRIPCIÓN</h2></div>
                                        <h3 class="card-title text-white">PROCESO DE ADMISIÓN</h3>
                                        <h3 class="font-weight-light text-white"><?= $grupoPostulacion['nombre'] ?></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card bg-warning">
                                <div class="card-body text-center">
                                    <div class="text-white p-3">
                                        <h5 class="font-weight-light text-white">
                                        Ya tienes un usuario creado, recuerda que el usuario es el rut sin dígito verificador y la clave es su nombre 
                                        en minúsculas o el que utilizó en el proceso anterior.
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card bg-danger">
                                <div class="card-body text-center">
                                    <div class="text-white p-3">
                                        <h5 class="font-weight-light text-white">
                                            Antes de completar este formulario, el postulante debe depositar o transferir electrónicamente $10.000.- por concepto de inscripción en la 
                                            Cuenta Corriente DGAC - ETA Nº 9491422 de Banco Estado. RUT 61.104.000-8, cuyo comprobante debe ser adjuntado en la sección Documentos y 
                                            enviar al correo finanzas@meteochile.cl indicando nombre completo del postulante, RUT y carrera.
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body wizard-content">
                                        <h6 class="card-subtitle"></h6>
                                        <form action="<?php echo base_url('public/Postulaciones/finalizar/'); ?>" name="finalizar_postulacion" id="finalizar_postulacion" method="post" accept-charset="utf-8" class="validation-wizard wizard-circle" enctype="multipart/form-data">
                                            <!-- Step 1 -->
                                            <h6>Datos Personales</h6>
                                            <?php echo view('postulaciones/steps/step1'); ?>
                                            <!-- Step 2 -->
                                            <h6>Puntajes PSU y NEM</h6>
                                            <?php echo view('postulaciones/steps/step2'); ?>
                                            <!-- Step 3 -->
                                            <h6>Documentos</h6>
                                            <?php echo view('postulaciones/steps/step3-update'); ?>
                                            <!-- Step 4 -->
                                            <h6>Encuesta</h6>
                                            <?php echo view('postulaciones/steps/step4'); ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div id="centermodal" class="swal2-container swal2-center swal2-fade swal2-shown" style="overflow-y: auto; display: none;">
                                <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
                                    <div class="swal2-header">
                                        <h2 class="swal2-title" id="swal2-title" style="display: flex;">Enviando postulación</h2>
                                        <h2 class="swal2-title" id="swal2-title" style="display: flex;">Espera un momento...</h2>
                                        <div class="spinner-border text-success" style="width: 3rem; height: 3rem;" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="modalDelete" class="swal2-container swal2-center swal2-fade swal2-shown" style="overflow-y: auto; display: none;">
                                <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
                                    <div class="swal2-header">
                                        <ul class="swal2-progress-steps" style="display: none;"></ul>
                                        <div class="swal2-icon swal2-error" style="display: none;">
                                        <span class="swal2-x-mark">
                                            <span class="swal2-x-mark-line-left"></span>
                                            <span class="swal2-x-mark-line-right"></span>
                                        </span>
                                    </div>
                                    <div class="swal2-icon swal2-question" style="display: none;"></div>
                                    <div class="swal2-icon swal2-warning" style="display: none;"></div>
                                    <div class="swal2-icon swal2-info" style="display: none;"></div>
                                    <div class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex;">
                                        <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                                        <span class="swal2-success-line-tip"></span> 
                                        <span class="swal2-success-line-long"></span>
                                        <div class="swal2-success-ring"></div> 
                                        <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                        <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                                    </div><img class="swal2-image" style="display: none;">
                                    <h2 class="swal2-title" id="swal2-title" style="display: flex;">¡Éxito!</h2>
                                    <button type="button" class="swal2-close" aria-label="Close this dialog" style="display: none;">×</button>
                                </div>
                                <div class="swal2-content">
                                    <div id="swal2-content" style="display: block;">
                                        Su postulación se ha realizado con éxito<br>
                                        Se le entregará la información a su correo electrónico
                                    </div>
                                    <input class="swal2-input" style="display: none;">
                                    <input type="file" class="swal2-file" style="display: none;">
                                    <div class="swal2-range" style="display: none;">
                                        <input type="range"><output></output></div>
                                        <select class="swal2-select" style="display: none;"></select>
                                        <div class="swal2-radio" style="display: none;"></div>
                                        <label for="swal2-checkbox" class="swal2-checkbox" style="display: none;">
                                            <input type="checkbox"><span class="swal2-label"></span>
                                        </label>
                                        <textarea class="swal2-textarea" style="display: none;"></textarea>
                                        <div class="swal2-validation-message" id="swal2-validation-message" style="display: none;"></div>
                                    </div>
                                    <div class="swal2-actions" style="display: flex;">
                                        <a href="<?php echo site_url('postulaciones'); ?>" type="button" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block; border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);">OK</a>
                                    </div>
                                    <div class="swal2-footer" style="display: none;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
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
    <!--Custom JavaScript Formulario paso a paso -->
    <script src="<?php echo base_url() ?>/assets/dist/js/custom.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/jquery-validation/dist/jquery.validate.min.js"></script>
    <!-- This Page JS -->
    <!-- <script src="<?php echo base_url() ?>/assets/libs/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script> -->
    <script src="<?php echo base_url() ?>/assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/js/pages/datatable/custom-datatable.js"></script>
    <!-- Validaciones Usuario -->
    <script src="<?php echo base_url() ?>/assets/dist/js/validaciones-usuario.js"></script>
    <!-- Regiones/Comunas -->
    <script src="<?php echo base_url() ?>/assets/dist/regiones-comunas.js"></script>
    <script>
        /* select múltiple sin presionar CTRL */
        window.onmousedown = function (e) {
            var el = e.target;
            if (el.tagName.toLowerCase() == 'option' && el.parentNode.hasAttribute('multiple')) {
                e.preventDefault();
                // toggle selection
                if (el.hasAttribute('selected')) el.removeAttribute('selected');
                else el.setAttribute('selected', '');
                // hack to correct buggy behavior
                var select = el.parentNode.cloneNode(true);
                el.parentNode.parentNode.replaceChild(select, el.parentNode);
            }
        }

        /* carga datos de regiones desde json regiones-comunas.js*/
        window.onload = function(){
            var regionesJSON = regiones['regiones'];
            var datos = "<option value='null'>--- Seleccionar ---</option>";
            let ciudadPostulante = '<?= $usuarioPostulante['ciudad']?>';
            for(var i = 0; i < regionesJSON.length; i++){
                let valSelected = (ciudadPostulante == regionesJSON[i]['region']?'selected':'');
                datos += "<option value='"+regionesJSON[i]['region']+"' "+valSelected+">"+regionesJSON[i]['region']+"</option>";
            }
            $("#ciudad").html(datos);
            cargarComunas();
        }

        function cargarComunas(){
            let regionesJSON = regiones['regiones'];
            let reg = document.getElementById('ciudad').value;
            let comunaJSON;
            let comunaPostulante = '<?= $usuarioPostulante['comuna']?>';
            for(var i = 0; i < regionesJSON.length; i++){
                if(regionesJSON[i]['region'] == reg){
                    comunaJSON = regionesJSON[i]['comunas'];
                }
            }
            var datos = "<option value='null'>--- Seleccionar ---</option>";
            for(var i = 0; i < comunaJSON.length; i++){
                let valSelected = (comunaPostulante == comunaJSON[i]?'selected':'');
                datos += "<option value='"+comunaJSON[i]+"' "+valSelected+">"+comunaJSON[i]+"</option>";
            }
            $("#comuna").html(datos);
        }
    </script>
    <script>
        //Basic Example
        $("#example-basic").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            autoFocus: true
        });

        // Basic Example with form
        var form = $("#example-form");
        form.validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); },
            rules: {
                confirm: {
                    equalTo: "#password"
                }
            }
        });
        form.children("div").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            onStepChanging: function(event, currentIndex, newIndex) {
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onFinishing: function(event, currentIndex) {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function(event, currentIndex) {
                alert("Submitted!");
            }
        });

        // Advance Example

        var form = $("#example-advanced-form").show();

        form.steps({
            headerTag: "h3",
            bodyTag: "fieldset",
            transitionEffect: "slideLeft",
            onStepChanging: function(event, currentIndex, newIndex) {
                // Allways allow previous action even if the current form is not valid!
                if (currentIndex > newIndex) {
                    return true;
                }
                // Forbid next action on "Warning" step if the user is to young
                if (newIndex === 3 && Number($("#age-2").val()) < 18) {
                    return false;
                }
                // Needed in some cases if the user went back (clean up)
                if (currentIndex < newIndex) {
                    // To remove error styles
                    form.find(".body:eq(" + newIndex + ") label.error").remove();
                    form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                }
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onStepChanged: function(event, currentIndex, priorIndex) {
                // Used to skip the "Warning" step if the user is old enough.
                if (currentIndex === 2 && Number($("#age-2").val()) >= 18) {
                    form.steps("next");
                }
                // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
                if (currentIndex === 2 && priorIndex === 3) {
                    form.steps("previous");
                }
            },
            onFinishing: function(event, currentIndex) {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function(event, currentIndex) {
                alert("Submitted!");
            }
        }).validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); },
            rules: {
                confirm: {
                    equalTo: "#password-2"
                }
            }
        });

        // Dynamic Manipulation
        $("#example-manipulation").steps({
            headerTag: "h3",
            bodyTag: "section",
            enableAllSteps: true,
            enablePagination: false
        });

        //Vertical Steps

        $("#example-vertical").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            stepsOrientation: "vertical"
        });

        //Custom design form example
        $(".tab-wizard").steps({
            headerTag: "h6",
            bodyTag: "section",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            labels: {
                finish: "Enviar"
            },
            onFinished: function(event, currentIndex) {
                var checked = $('form').serialize();
                var url = "<?php echo base_url('public/Postulaciones/finalizar'); ?>";
                console.log("en el otro post");
                $.post(url, checked, function(data, status){
                    if (status){
                        console.log(data);
                        // var respuestaAjax = JSON.parse(data);
                        // cargarOtros(respuestaAjax);
                    }else{
                        console.log("ERROR");
                    }
                });
            }
        });


        var form = $(".validation-wizard").show();

        $(".validation-wizard").steps({
            headerTag: "h6",
            bodyTag: "section",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            labels: {
                finish: "Enviar"
            },
            onStepChanging: function(event, currentIndex, newIndex) {
                // console.log("onStepChanging");
                return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid())
            },
            onFinishing: function(event, currentIndex) {
                console.log(event);
                console.log("Terminando");
                // Serialize the entire form:
                var data = new FormData(document.getElementById('finalizar_postulacion'));
                console.log(data);
                var url = "<?php echo base_url('public/Postulaciones/actualizar/'.$data_postulacion->oid); ?>";
                document.querySelector("#centermodal").style.display = "flex";
                $.ajax({
                    url: url, // NB: Use the correct action name
                    type: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if(response){
                            document.querySelector("#centermodal").style.display = "none";
                            document.querySelector("#modalDelete").style.display = "flex";
                        }
                        // console.log(response);
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            },
            onFinished: function(event, currentIndex) {
                // console.log("onFinished");
                // swal("Form Submitted!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");
            }
        }), $(".validation-wizard").validate({
            ignore: "input[type=hidden]",
            errorClass: "text-danger",
            successClass: "text-success",
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass)
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass)
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element)
            },
            rules: {
                email: {
                    email: !0
                }
            }
        })
    </script>
    <script>
        var dataComprobantes = []
        <?php foreach($tiposArchivo as $rp) { ?>
            dataComprobantes.push(['<?= $rp->oid ?>','<?= $rp->tiar_nombre ?>', '',
                        '<button onclick="modalSwal('+'<?= $rp->oid ?>'+')" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm" aria-label=""">Agregar</button>']);
        <?php } ?>
        crearTablaSimple('#tabla_comprobantes', dataComprobantes);

        function crearTablaSimple(nombreTabla, datosTabla){
                $(document).ready(function() {
                    var table = $(nombreTabla).DataTable({
                        data: datosTabla,
                        select: {
                            style: 'multi'
                        },
                        // order: [[1, 'desc']],
                        language: {
                            lengthMenu: "Mostrando _MENU_ datos por página",
                            zeroRecords: "No se encontraron elementos",
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
                        lengthChange: false,
                        paginate: false,
                        info: false,
                        filter: false,
                        bSort: false,
                    });   
                });
            }
    </script>
    <script>
        function mostrarTienesHijos(){
            let valueHijos = document.getElementById('post_thijos').value;
            if(valueHijos == "1"){
                document.getElementById('div_post_canthijos').hidden = false;
            } 
            if(valueHijos == "0"){
                document.getElementById('div_post_canthijos').hidden = true;
            }
        }
        function mostrarPuebloOriginario(){
            let valueHijos = document.getElementById('post_ppueblo').value;
            if(valueHijos == "1"){
                document.getElementById('div_post_ppueblo').hidden = false;
            } 
            if(valueHijos == "0"){
                document.getElementById('div_post_ppueblo').hidden = true;
            }
        }
    </script>
    <script>
        function modalSwal(tabla){
            tabla = 'tabla_comprobantes';
            console.log(tabla);
            // document.querySelector("#modalError #botonEliminar").onclick = function onclick(event) {botonEliminar(tabla)}
            document.querySelector("#modalError #grupo_id").value = tabla;
            document.querySelector("#modalError").style.display = "block";
        }

        function modalClose(){
            // document.querySelector("#modalDelete").style.display = "none";
            document.querySelector("#modalError").style.display = "none";
        }

        function verInner(id_archivo){
            let inner_archivo = document.getElementById('archivo'+id_archivo);
            let label_archivo = document.getElementById('label-archivo'+id_archivo);
            label_archivo.innerHTML = inner_archivo.value;
        }

        function check(e) { //no se ingresan caracteres especiales
            tecla = (document.all) ? e.keyCode : e.which;
            //Tecla de retroceso para borrar, siempre la permite
            if (tecla == 8) {
                return true;
            }
            // Patron de entrada, en este caso solo acepta numeros y letras
            patron = /[A-Za-z0-9]/;
            tecla_final = String.fromCharCode(tecla);
            return patron.test(tecla_final);
        }
    </script>
</body>

</html>