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
                <!-- <h4 class="mb-3">ACCORDION</h4> -->
                <!-- Accordian -->
                <div id="accordion" class="nav-accordion" role="tablist"
                    aria-multiselectable="true">
                    <div class="card mb-1">
                        <div class="card-header bg-info" role="tab" id="headingOne">
                            <h5 class="mb-0">
                                <a class="collapsed text-white" data-toggle="collapse" data-parent="#accordion"
                                    href="#collapseOne" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    Número de matriculados en la institución
                                </a>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse show" role="tabpanel"
                            aria-labelledby="headingOne">
                            <?php echo view('indicadores_academicos/tablas/matriculados_institucion'); ?>
                        </div>
                    </div>
                    <div class="card mb-1">
                        <div class="card-header bg-info" role="tab" id="headingTwo">
                            <h5 class="mb-0">
                                <a class="collapsed text-white" data-toggle="collapse"
                                    data-parent="#accordion" href="#collapseTwo"
                                    aria-expanded="false" aria-controls="collapseTwo">
                                    Matrícula Nueva por Nivel de Formación
                                </a>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" role="tabpanel"
                            aria-labelledby="headingTwo">
                            <?php echo view('indicadores_academicos/tablas/matriculados_nivel_formacion'); ?>
                        </div>
                    </div>
                    <div class="card mb-1">
                        <div class="card-header bg-info" role="tab" id="headingThree">
                            <h5 class="mb-0">
                                <a class="collapsed text-white" data-toggle="collapse"
                                    data-parent="#accordion" href="#collapseThree"
                                    aria-expanded="false" aria-controls="collapseThree">
                                    Matrícula Nueva por Carrera
                                </a>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" role="tabpanel"
                            aria-labelledby="headingThree">
                            <?php echo view('indicadores_academicos/tablas/matricula_nueva_carrera'); ?>
                        </div>
                    </div>
                    <div class="card mb-1">
                        <div class="card-header bg-info" role="tab" id="headingFour">
                            <h5 class="mb-0">
                                <a class="collapsed text-white" data-toggle="collapse"
                                    data-parent="#accordion" href="#collapseFour"
                                    aria-expanded="false" aria-controls="collapseFour">
                                    Indicadores de Proceso de Admisión
                                </a>
                            </h5>
                        </div>
                        <div id="collapseFour" class="collapse" role="tabpanel"
                            aria-labelledby="headingFour">
                            <?php echo view('indicadores_academicos/tablas/retencion_profesionales'); ?>
                        </div>
                    </div>
                    <div class="card mb-1">
                        <div class="card-header bg-info" role="tab" id="headingFive">
                            <h5 class="mb-0">
                                <a class="collapsed text-white" data-toggle="collapse"
                                    data-parent="#accordion" href="#collapseFive"
                                    aria-expanded="false" aria-controls="collapseFive">
                                    Retención por cohorte según progresión académica
                                </a>
                            </h5>
                        </div>
                        <div id="collapseFive" class="collapse" role="tabpanel"
                            aria-labelledby="headingFive">
                            <?php echo view('indicadores_academicos/tablas/retencion_progresion_academica'); ?>
                        </div>
                    </div>
                    <div class="card mb-1">
                        <div class="card-header bg-info" role="tab" id="headingSix">
                            <h5 class="mb-0">
                                <a class="collapsed text-white" data-toggle="collapse"
                                    data-parent="#accordion" href="#collapseSix"
                                    aria-expanded="false" aria-controls="collapseSix">
                                    Indicadores de Titulación por Nivel de Formación
                                </a>
                            </h5>
                        </div>
                        <div id="collapseSix" class="collapse" role="tabpanel"
                            aria-labelledby="headingSix">
                            <?php echo view('indicadores_academicos/tablas/titulacion_nivel_formacion'); ?>
                        </div>
                    </div>
                    
                </div>
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
    <!-- This Page JS -->
    <script src="<?php echo base_url() ?>/assets/libs/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/js/pages/datatable/custom-datatable.js"></script>
    <!-- <script src="<?php echo base_url() ?>/assets/dist/js/pages/chartjs/chartjs.init.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/chart.js/dist/Chart.min.js"></script> -->
    <script type="text/javascript" charset="utf8" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/js/dataTables.checkboxes.min.js"></script>
    <script>
        /******************************************************************/
        /* Número de matriculados en la institución  */
        var dataMatriculadosInstitucionNueva = [['Matricula Nueva'], ['Matricula Total']];
        <?php foreach($matriculados_institucion_nueva as $mi) { ?>
            dataMatriculadosInstitucionNueva[0].push('<?= $mi['num'] ?>');
        <?php } ?>
        <?php foreach($matriculados_institucion_total as $mi) { ?>
            dataMatriculadosInstitucionNueva[1].push('<?= $mi['num'] ?>');
        <?php } ?>
        crearTablaSimple('#tabla_matriculados_institucion', dataMatriculadosInstitucionNueva);
        /******************************************************************/
        /******************************************************************/
        /* Matrícula Nueva por Nivel de Formación  */
        var dataMatriculadosNivelFormacion = [['Carreras Técnicas'], ['Carreras Profesionales']];
        <?php foreach($matricula_formacion_tecnica as $mi) { ?>
            dataMatriculadosNivelFormacion[0].push('<?= $mi['num'] ?>');
        <?php } ?>
        <?php foreach($matricula_formacion_profesional as $mi) { ?>
            dataMatriculadosNivelFormacion[1].push('<?= $mi['num'] ?>');
        <?php } ?>
        crearTablaSimple('#tabla_matriculados_nivel_formacion', dataMatriculadosNivelFormacion);
        /******************************************************************/
        /******************************************************************/
        /* Matrícula Nueva por Carrera  */
        var dataMatriculaNuevaCarrera = [];
        <?php foreach($matricula_nueva_carrera as $mi) { ?>
            var dataAux = [];
            <?php for($i =0;$i<=8;$i++){?>
                    dataAux.push('<?= $mi[0][$i] ?>');
            <?php } ?>
            dataMatriculaNuevaCarrera.push(dataAux);
        <?php } ?>
        crearTablaSimple('#tabla_matricula_nueva_carrera', dataMatriculaNuevaCarrera);
        /******************************************************************/
        /******************************************************************/
        /* Indicadores de Proceso de Admisión - Ratios de Ocupación Total Institucion */
        var dataRatiosOcupacionInstitucion = [[]];
        <?php foreach($ratios_ocupacion_institucion as $mi) { ?>
            dataRatiosOcupacionInstitucion[0].push('<?= $mi['num'] ?>'!="" ? parseInt('<?= $mi['num'] ?>') : "0");
        <?php } ?>
        crearTablaSimple('#tabla_ratio_ocup_institucion', dataRatiosOcupacionInstitucion);
        /******************************************************************/
        /******************************************************************/
        /* Indicadores de Proceso de Admisión - Ratios de Ocupación Total Institucion por Nivel de Formación */
        var dataRatiosOcupacionFormacion = [['Carreras Técnicas'], ['Carreras Profesionales']];
        <?php foreach($ratios_ocupacion_tecnica as $mi) { ?>
            dataRatiosOcupacionFormacion[0].push('<?= $mi['num'] ?>'!="" ? parseInt('<?= $mi['num'] ?>') : "0");
        <?php } ?>
        <?php foreach($ratios_ocupacion_profesional as $mi) { ?>
            dataRatiosOcupacionFormacion[1].push('<?= $mi['num'] ?>'!="" ? parseInt('<?= $mi['num'] ?>') : "0");
        <?php } ?>
        crearTablaSimple('#tabla_ratio_ocup_formacion', dataRatiosOcupacionFormacion);
        /******************************************************************/
        /******************************************************************/
        /* Retención por cohorte según progresión académica - Carreras de 8 semestres */
        var dataCohorteCarrera8sem = [];
        <?php foreach($cohorte_carrera_8sem as $mi) { ?>
            var dataAux = [];
            <?php for($i =0;$i<=5;$i++){?>
                
                dataAux.push('<?= $mi[$i] ?>'!="" ? parseInt('<?= $mi[$i] ?>') : "0");
            <?php } ?>
            dataCohorteCarrera8sem.push(dataAux);
        <?php } ?>
        console.log(dataCohorteCarrera8sem);
        crearTablaSimple('#tabla_titulacion_tecnicas1', dataCohorteCarrera8sem);
        /******************************************************************/
        /******************************************************************/
        /* Retención por cohorte según progresión académica - Carreras de 6 semestres */
        var dataCohorteCarrera6sem = [];
        <?php foreach($cohorte_carrera_6sem as $mi) { ?>
            var dataAux = [];
            <?php for($i =0;$i<=4;$i++){?>
                dataAux.push('<?= $mi[$i] ?>'!="" ? parseInt('<?= $mi[$i] ?>') : "0");
            <?php } ?>
            dataCohorteCarrera6sem.push(dataAux);
        <?php } ?>
        crearTablaSimple('#tabla_titulacion_tecnicas2', dataCohorteCarrera6sem);
        /******************************************************************/
        /******************************************************************/
        /* Retención por cohorte según progresión académica - Carreras de 3 semestres */
        var dataCohorteCarrera3sem = [];
        <?php foreach($cohorte_carrera_3sem as $mi) { ?>
            var dataAux = [];
            <?php for($i =0;$i<=3;$i++){?>
                dataAux.push('<?= $mi[$i] ?>'!="" ? parseInt('<?= $mi[$i] ?>') : "0");
            <?php } ?>
            dataCohorteCarrera3sem.push(dataAux);
        <?php } ?>
        crearTablaSimple('#tabla_titulacion_tecnicas3', dataCohorteCarrera3sem);
        /******************************************************************/
        /******************************************************************/
        /* Retención por cohorte según progresión académica - Carreras de 2 semestres */
        var dataCohorteCarrera2sem = [];
        <?php foreach($cohorte_carrera_2sem as $mi) { ?>
            var dataAux = [];
            <?php for($i =0;$i<=2;$i++){?>
                dataAux.push('<?= $mi[$i] ?>'!="" ? parseInt('<?= $mi[$i] ?>') : "0");
            <?php } ?>
            dataCohorteCarrera2sem.push(dataAux);
        <?php } ?>
        crearTablaSimple('#tabla_titulacion_tecnicas4', dataCohorteCarrera2sem);
        /******************************************************************/
        /******************************************************************/
        /* Indicadores de Titulación por Nivel de Formación - Carreras de 8 semestres */
        var dataTitulacionNivelFormacion8 = [['Carreras Técnicas', ''], ['Carreras Profesionales', '']];
        <?php foreach($titulacion_formacion_tec_8sem as $mi) { ?>
            dataTitulacionNivelFormacion8[0].push('<?= $mi['num'] ?>'!="" ? parseInt('<?= $mi['num'] ?>') : "0");
        <?php } ?>
        <?php foreach($titulacion_formacion_prof_8sem as $mi) { ?>
            dataTitulacionNivelFormacion8[1].push('<?= $mi['num'] ?>'!="" ? parseInt('<?= $mi['num'] ?>') : "0");
        <?php } ?>
        crearTablaSimple('#tabla_titulacion_nivel_formacion1', dataTitulacionNivelFormacion8);
        /******************************************************************/
        /******************************************************************/
        /* Indicadores de Titulación por Nivel de Formación - Carreras de 6 semestres */
        var dataTitulacionNivelFormacion6 = [['Carreras Técnicas', ''], ['Carreras Profesionales', '']];
        <?php foreach($titulacion_formacion_tec_6sem as $mi) { ?>
            dataTitulacionNivelFormacion6[0].push('<?= $mi['num'] ?>'!="" ? parseInt('<?= $mi['num'] ?>') : "0");
        <?php } ?>
        <?php foreach($titulacion_formacion_prof_6sem as $mi) { ?>
            dataTitulacionNivelFormacion6[1].push('<?= $mi['num'] ?>'!="" ? parseInt('<?= $mi['num'] ?>') : "0");
        <?php } ?>
        crearTablaSimple('#tabla_titulacion_nivel_formacion2', dataTitulacionNivelFormacion6);
        /******************************************************************/
        /******************************************************************/
        /* Indicadores de Titulación por Nivel de Formación - Carreras de 3 semestres */
        var dataTitulacionNivelFormacion3 = [['Carreras Técnicas', ''], ['Carreras Profesionales', '']];
        <?php foreach($titulacion_formacion_tec_3sem as $mi) { ?>
            dataTitulacionNivelFormacion3[0].push('<?= $mi['num'] ?>'!="" ? parseInt('<?= $mi['num'] ?>') : "0");
        <?php } ?>
        <?php foreach($titulacion_formacion_prof_3sem as $mi) { ?>
            dataTitulacionNivelFormacion3[1].push('<?= $mi['num'] ?>'!="" ? parseInt('<?= $mi['num'] ?>') : "0");
        <?php } ?>
        crearTablaSimple('#tabla_titulacion_nivel_formacion3', dataTitulacionNivelFormacion3);
        /******************************************************************/
        /******************************************************************/
        /* Indicadores de Titulación por Nivel de Formación - Carreras de 2 semestres */
        var dataTitulacionNivelFormacion2 = [['Carreras Técnicas', ''], ['Carreras Profesionales', '']];
        <?php foreach($titulacion_formacion_tec_2sem as $mi) { ?>
            dataTitulacionNivelFormacion2[0].push('<?= $mi['num'] ?>'!="" ? parseInt('<?= $mi['num'] ?>') : "0");
        <?php } ?>
        <?php foreach($titulacion_formacion_prof_2sem as $mi) { ?>
            dataTitulacionNivelFormacion2[1].push('<?= $mi['num'] ?>'!="" ? parseInt('<?= $mi['num'] ?>') : "0");
        <?php } ?>
        crearTablaSimple('#tabla_titulacion_nivel_formacion4', dataTitulacionNivelFormacion2);
        /******************************************************************/
        /******************************************************************/
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
                    }
                });   
            });
        }
    </script>
    <script>
        function mostrarGrafico(tipoGrafico){
            window.location = "<?php echo base_url('public/indicadoresAcademicos/grafico') ?>"+"/"+tipoGrafico;
        }
    </script>
</body>

</html>