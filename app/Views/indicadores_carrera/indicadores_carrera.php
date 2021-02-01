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
                                    Matricula por carrera
                                </a>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse show" role="tabpanel"
                            aria-labelledby="headingOne">
                            <?php echo view('indicadores_carrera/tablas/matricula'); ?>
                        </div>
                    </div>
                    <div class="card mb-1">
                        <div class="card-header bg-info" role="tab" id="headingTwo">
                            <h5 class="mb-0">
                                <a class="collapsed text-white" data-toggle="collapse"
                                    data-parent="#accordion" href="#collapseTwo"
                                    aria-expanded="false" aria-controls="collapseTwo">
                                    Ratios de ocupación
                                </a>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" role="tabpanel"
                            aria-labelledby="headingTwo">
                            <?php echo view('indicadores_carrera/tablas/ratios_ocupacion'); ?>
                        </div>
                    </div>
                    <div class="card mb-1">
                        <div class="card-header bg-info" role="tab" id="headingThree">
                            <h5 class="mb-0">
                                <a class="collapsed text-white" data-toggle="collapse"
                                    data-parent="#accordion" href="#collapseThree"
                                    aria-expanded="false" aria-controls="collapseThree">
                                    Tasa de retención carreras técnicas
                                </a>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" role="tabpanel"
                            aria-labelledby="headingThree">
                            <?php echo view('indicadores_carrera/tablas/retencion_tecnicas'); ?>
                        </div>
                    </div>
                    <div class="card mb-1">
                        <div class="card-header bg-info" role="tab" id="headingFour">
                            <h5 class="mb-0">
                                <a class="collapsed text-white" data-toggle="collapse"
                                    data-parent="#accordion" href="#collapseFour"
                                    aria-expanded="false" aria-controls="collapseFour">
                                    Tasa de retención carreras profesionales
                                </a>
                            </h5>
                        </div>
                        <div id="collapseFour" class="collapse" role="tabpanel"
                            aria-labelledby="headingFour">
                            <?php echo view('indicadores_carrera/tablas/retencion_profesionales'); ?>
                        </div>
                    </div>
                    <div class="card mb-1">
                        <div class="card-header bg-info" role="tab" id="headingFive">
                            <h5 class="mb-0">
                                <a class="collapsed text-white" data-toggle="collapse"
                                    data-parent="#accordion" href="#collapseFive"
                                    aria-expanded="false" aria-controls="collapseFive">
                                    Tasa de titulación de carreras Técnicas
                                </a>
                            </h5>
                        </div>
                        <div id="collapseFive" class="collapse" role="tabpanel"
                            aria-labelledby="headingFive">
                            <?php echo view('indicadores_carrera/tablas/titulacion_tecnicas'); ?>
                        </div>
                    </div>
                    <div class="card mb-1">
                        <div class="card-header bg-info" role="tab" id="headingSix">
                            <h5 class="mb-0">
                                <a class="collapsed text-white" data-toggle="collapse"
                                    data-parent="#accordion" href="#collapseSix"
                                    aria-expanded="false" aria-controls="collapseSix">
                                    Tasa de titulación de carreras Profesionales
                                </a>
                            </h5>
                        </div>
                        <div id="collapseSix" class="collapse" role="tabpanel"
                            aria-labelledby="headingSix">
                            <?php echo view('indicadores_carrera/tablas/titulacion_profesionales'); ?>
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
    <script type="text/javascript" charset="utf8" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/js/dataTables.checkboxes.min.js"></script>
    <script>
        /******************************************************************/
        /******************************************************************/
        const anio_year = new Date().getFullYear();
        const anio_inicio = 2014;

        var dataMatricula = [];
        for (var i = 0; i <= (anio_year-anio_inicio); i++) {
            dataMatricula[i] = [];
        }
        <?php foreach($matricula_carrera as $rp) { ?>
            for (var i = 0; i <= (anio_year-anio_inicio); i++) {
                if('<?= $rp->anio ?>' == (anio_inicio+i).toString()){
                    dataMatricula[i].push(['<?= $rp->oid_ig ?>', '<?= $rp->grupo ?>','<?= $rp->nuevos ?>','<?= $rp->antiguos ?>','<?= $rp->reincorpora ?>','<?= $rp->total ?>']);
                }
            }
        <?php } ?>
        // Se crean las tablas para mostrar 
        for(var i = 0; i <= anio_year-anio_inicio; i++){
            crearTablaSimple('#tabla_matricula_'+(anio_inicio+i).toString(), dataMatricula[i]);
        }
        /******************************************************************/
        /******************************************************************/
        var dataRatiosOcupacion = [];
        <?php foreach($ratios_ocupacion as $rp) { ?>
            dataRatiosOcupacion.push(['<?= $rp['oid'] ?>', '<?php echo $rp['grupo'] ?>', '<?php echo $rp['2013'] ?>', '<?php echo $rp['2014'] ?>', '<?php echo $rp['2015'] ?>',
            '<?php echo $rp['2016'] ?>', '<?php echo $rp['2017'] ?>', '<?php echo $rp['2018'] ?>', '<?php echo $rp['2019'] ?>']);
        <?php } ?>
        crearTablaSimple('#tabla_ratios_ocupacion', dataRatiosOcupacion);
        /******************************************************************/
        /******************************************************************/
        /* Tasa de retención carreras técnicas */
        var tasaRet1SemCohorteTec = []; //Tasa retención 1er semestre por cohorte carreras técnicas
        var tasaRet2SemCohorteTec = []; //Tasa retención 2do semestre por cohorte carreras técnicas
        <?php foreach($tasa_tec_1_sem_cohorte as $rp) { ?>
            tasaRet1SemCohorteTec.push(['<?= $rp['oid'] ?>', '<?php echo $rp['grupo'] ?>', '<?php echo $rp['2013'] ?>', '<?php echo $rp['2014'] ?>', '<?php echo $rp['2015'] ?>',
            '<?php echo $rp['2016'] ?>', '<?php echo $rp['2017'] ?>', '<?php echo $rp['2018'] ?>', '<?php echo $rp['2019'] ?>']);
        <?php } ?>
        crearTablaSimple('#tabla_retencion_tecnicas1', tasaRet1SemCohorteTec);
        <?php foreach($tasa_tec_2_sem_cohorte as $rp) { ?>
            tasaRet2SemCohorteTec.push(['<?= $rp['oid'] ?>', '<?php echo $rp['grupo'] ?>', '<?php echo $rp['2013'] ?>', '<?php echo $rp['2014'] ?>', '<?php echo $rp['2015'] ?>',
            '<?php echo $rp['2016'] ?>', '<?php echo $rp['2017'] ?>', '<?php echo $rp['2018'] ?>', '<?php echo $rp['2019'] ?>']);
        <?php } ?>
        crearTablaSimple('#tabla_retencion_tecnicas2', tasaRet2SemCohorteTec);
        /******************************************************************/
        /******************************************************************/
        /* Tasa de retención carreras profesionales */
        var tasaRet1SemCohorteProf = []; //Tasa retención 1er semestre por cohorte carreras profesionales
        var tasaRet2SemCohorteProf = []; //Tasa retención 2do semestre por cohorte carreras profesionales
        <?php foreach($tasa_prof_1_sem_cohorte as $rp) { ?>
            tasaRet1SemCohorteProf.push(['<?= $rp['oid'] ?>', '<?php echo $rp['grupo'] ?>', '<?php echo $rp['2013'] ?>', '<?php echo $rp['2014'] ?>', '<?php echo $rp['2015'] ?>',
            '<?php echo $rp['2016'] ?>', '<?php echo $rp['2017'] ?>', '<?php echo $rp['2018'] ?>', '<?php echo $rp['2019'] ?>']);
        <?php } ?>
        crearTablaSimple('#tabla_retencion_profesionales1', tasaRet1SemCohorteProf);
        <?php foreach($tasa_prof_2_sem_cohorte as $rp) { ?>
            tasaRet2SemCohorteProf.push(['<?= $rp['oid'] ?>', '<?php echo $rp['grupo'] ?>', '<?php echo $rp['2013'] ?>', '<?php echo $rp['2014'] ?>', '<?php echo $rp['2015'] ?>',
            '<?php echo $rp['2016'] ?>', '<?php echo $rp['2017'] ?>', '<?php echo $rp['2018'] ?>', '<?php echo $rp['2019'] ?>']);
        <?php } ?>
        crearTablaSimple('#tabla_retencion_profesionales2', tasaRet2SemCohorteProf);
        /******************************************************************/
        /******************************************************************/
        /* Tasa de Titulación Carreras Técnicas  */
        var tercerSemCohorteTec = []; //Al 3er semestre por cohorte
        var oportunaCohorteTec = []; //Oportuna por cohorte
        var tiempoRealCohorteTec = []; //Tiempo real titulacion por cohorte
        <?php foreach($tit_tecnica_3_sem_cohorte as $rp) { ?>
            tercerSemCohorteTec.push(['<?= $rp['oid'] ?>', '<?php echo $rp['grupo'] ?>', '<?php echo $rp['2013'] ?>', '<?php echo $rp['2014'] ?>', '<?php echo $rp['2015'] ?>',
            '<?php echo $rp['2016'] ?>', '<?php echo $rp['2017'] ?>', '<?php echo $rp['2018'] ?>', '<?php echo $rp['2019'] ?>']);
        <?php } ?>
        crearTablaSimple('#tabla_titulacion_tecnicas1', tercerSemCohorteTec);
        <?php foreach($oportuna_tecnica_cohorte as $rp) { ?>
            oportunaCohorteTec.push(['<?= $rp['oid'] ?>', '<?php echo $rp['grupo'] ?>', '<?php echo $rp['2013'] ?>', '<?php echo $rp['2014'] ?>', '<?php echo $rp['2015'] ?>',
            '<?php echo $rp['2016'] ?>', '<?php echo $rp['2017'] ?>', '<?php echo $rp['2018'] ?>', '<?php echo $rp['2019'] ?>']);
        <?php } ?>
        crearTablaSimple('#tabla_titulacion_tecnicas2', oportunaCohorteTec);
        <?php foreach($tiempo_tecnica_cohorte as $rp) { ?>
            tiempoRealCohorteTec.push(['<?= $rp['oid'] ?>', '<?php echo $rp['grupo'] ?>', '<?php echo $rp['2013'] ?>', '<?php echo $rp['2014'] ?>', '<?php echo $rp['2015'] ?>',
            '<?php echo $rp['2016'] ?>', '<?php echo $rp['2017'] ?>', '<?php echo $rp['2018'] ?>', '<?php echo $rp['2019'] ?>']);
        <?php } ?>
        crearTablaSimple('#tabla_titulacion_tecnicas3', tiempoRealCohorteTec);
        /******************************************************************/
        /******************************************************************/
        /* Tasa de Titulación Carreras Profesionales  */
        var tercerSemCohorteProf = []; //Al 3er semestre por cohorte
        var oportunaCohorteProf = []; //Oportuna por cohorte
        var tiempoRealCohorteProf = []; //Tiempo real titulacion por cohorte
        <?php foreach($tit_prof_3_sem_cohorte as $rp) { ?>
            tercerSemCohorteProf.push(['<?= $rp['oid'] ?>', '<?php echo $rp['grupo'] ?>', '<?php echo $rp['2013'] ?>', '<?php echo $rp['2014'] ?>', '<?php echo $rp['2015'] ?>',
            '<?php echo $rp['2016'] ?>', '<?php echo $rp['2017'] ?>', '<?php echo $rp['2018'] ?>', '<?php echo $rp['2019'] ?>']);
        <?php } ?>
        crearTablaSimple('#tabla_titulacion_profesionales1', tercerSemCohorteProf);
        <?php foreach($oportuna_prof_cohorte as $rp) { ?>
            oportunaCohorteProf.push(['<?= $rp['oid'] ?>', '<?php echo $rp['grupo'] ?>', '<?php echo $rp['2013'] ?>', '<?php echo $rp['2014'] ?>', '<?php echo $rp['2015'] ?>',
            '<?php echo $rp['2016'] ?>', '<?php echo $rp['2017'] ?>', '<?php echo $rp['2018'] ?>', '<?php echo $rp['2019'] ?>']);
        <?php } ?>
        crearTablaSimple('#tabla_titulacion_profesionales2', oportunaCohorteProf);
        <?php foreach($tiempo_prof_cohorte as $rp) { ?>
            tiempoRealCohorteProf.push(['<?= $rp['oid'] ?>', '<?php echo $rp['grupo'] ?>', '<?php echo $rp['2013'] ?>', '<?php echo $rp['2014'] ?>', '<?php echo $rp['2015'] ?>',
            '<?php echo $rp['2016'] ?>', '<?php echo $rp['2017'] ?>', '<?php echo $rp['2018'] ?>', '<?php echo $rp['2019'] ?>']);
        <?php } ?>
        crearTablaSimple('#tabla_titulacion_profesionales3', tiempoRealCohorteProf);
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
</body>

</html>