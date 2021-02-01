<?php //echo view('dgac/headers'); ?>
<?php echo $headers['headersView']; ?>
<!-- <link href="<?php echo base_url() ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet"> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<!-- <link href="<?php echo base_url() ?>/assets/libs/bootstrap-table/dist/bootstrap-table.min.css" rel="stylesheet" type="text/css" /> -->
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css"> -->

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
                <!-- Row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <form action="<?php echo base_url('public/periodo/editar_periodo/'.$edit_periodo['oid']); ?>" name="editar_periodo" id="editar_periodo" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="card-body">
                                    <h4 class="card-title">Editar Periodo</h4>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="peri_anio" class="col-sm-3 text-right control-label col-form-label">Año</label>
                                                <div class="col-sm-9">
                                                    <select name="peri_anio" id="peri_anio" class="form-control" onchange="copiarValue()">
                                                        <?php for($i = date("Y") - 1; $i <= date("Y") + 2; $i++){ ?>
                                                            <option value="<?php echo $i ?>" <?= ($edit_periodo['peri_anio']==$i)?'selected':'' ?> id="peri_anio<?php echo $i ?>"><?php echo $i ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="peri_semestre" class="col-sm-3 text-right control-label col-form-label">Semestre</label>
                                                <div class="col-sm-9">
                                                    <select name="peri_semestre" id="peri_semestre" class="form-control" onchange="copiarValue()">
                                                        <option value="1" id="peri_semestre1" <?= ($edit_periodo['peri_semestre']=='1')?'selected':'' ?>>1</option>
                                                        <option value="2" id="peri_semestre2" <?= ($edit_periodo['peri_semestre']=='2')?'selected':'' ?>>2</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="periodo_vista" class="col-sm-3 text-right control-label col-form-label">Periodo</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="periodo_vista" required disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6" hidden>
                                            <div class="form-group row">
                                                <label for="peri_nombre" class="col-sm-3 text-right control-label col-form-label">Periodo</label>
                                                <div class="col-sm-9">
                                                    <input name="peri_nombre" type="text" class="form-control" id="peri_nombre" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="peri_carreras_postular" class="col-sm-3 text-right control-label col-form-label">Carreras</label>
                                                <div class="col-sm-9">
                                                    <input name="peri_carreras_postular" type="number" min="0" class="form-control" id="peri_carreras_postular" value="<?php echo $edit_periodo['peri_carreras_postular'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="peri_inicio" class="col-sm-3 text-right control-label col-form-label">Fecha Inicio</label>
                                                <div class="col-sm-9">
                                                    <input value="<?= $edit_periodo['peri_inicio'] ?>" name="peri_inicio" type="date" min="" max="<?= $edit_periodo['peri_termino'] ?>" class="form-control" id="peri_inicio" placeholder="" onchange="validarFecha('inicio')">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="peri_termino" class="col-sm-3 text-right control-label col-form-label">Fecha Término</label>
                                                <div class="col-sm-9">
                                                    <input value="<?= $edit_periodo['peri_termino'] ?>" name="peri_termino" type="date" min="<?= $edit_periodo['peri_inicio'] ?>" max="" class="form-control" id="peri_termino" placeholder="" onchange="validarFecha('termino')">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <div class="form-group mb-0 text-right">
                                        <button type="submit" class="btn btn-info waves-effect waves-light">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
    <!--Custom JavaScript -->
    <script src="<?php echo base_url() ?>/assets/libs/ckeditor/ckeditor.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/sweetalert2/dist/sweetalert2.all.js"></script>
    <script src="<?php echo base_url() ?>/assets/extra-libs/sweetalert2/sweet-alert.init.js"></script>

    <!-- This Page JS -->

    <script src="<?php echo base_url() ?>/assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/js/pages/datatable/custom-datatable.js"></script>
    <script type="text/javascript" charset="utf8" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/js/dataTables.checkboxes.min.js"></script>  
    <script>
        function copiarValue(){
            var peri_anio = document.getElementById("peri_anio").value;
            var peri_semestre = document.getElementById("peri_semestre").value;
            document.getElementById("peri_nombre").value = document.getElementById("peri_anio"+peri_anio).innerHTML+'/'+document.getElementById("peri_semestre"+peri_semestre).innerHTML;
            document.getElementById("periodo_vista").value = document.getElementById("peri_anio"+peri_anio).innerHTML+'/'+document.getElementById("peri_semestre"+peri_semestre).innerHTML;
        }

        function validarFecha(fecha){
            if (fecha == "termino"){
                document.getElementById("peri_inicio").max = document.getElementById("peri_termino").value;
            }else if(fecha == "inicio"){
                document.getElementById("peri_termino").min = document.getElementById("peri_inicio").value;
            }else{
                console.log("ERROR");
            }
        }

        $(function() {
            copiarValue();
        });
    </script>
</body>

</html>