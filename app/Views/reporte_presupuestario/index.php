<?php //echo view('dgac/headers'); ?>
<?php echo $headers['headersView']; ?>

<!-- DatetimePicker CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

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
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card ">
                            <form action="#" class="form-horizontal">
                                <div class="form-body">
                                    <div class="card-body">
                                        <h4 class="card-title" hidden>-</h4>
                                        <a type="button" href="<?php echo site_url('reportePresupuestario/agregar_presupuesto'); ?>" class="btn btn-rounded btn-outline-success btn-sm">ACTUALIZAR PRESUPUESTO TOTAL</a>
                                    </div>
                                    <hr class="mt-0 mb-5">
                                    <div class="card-body">
                                        <div class="card-body">
                                            <h5 class="card-title">Reporte Presupuestario</h5>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">AÑO</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control" tabindex="1" id="cohorte" onChange="calcularPresupuesto();">
                                                            <option value="none">Seleccionar Cohorte</option>
                                                            <?php foreach($presupuestos as $presup){ ?>
                                                                <option value="<?php echo $presup->oid ?>"><?php echo $presup->cohorte ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">TOTAL CURSOS</label>
                                                    <div class="col-md-9">
                                                        <input name="total1" id="total1" type="text" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">PRESUPUESTO TOTAL</label>
                                                    <div class="col-md-9">
                                                        <input name="total2" id="total2" type="text" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">SALDO DEL PRESUPUESTO TOTAL</label>
                                                    <div class="col-md-9">
                                                        <input name="total3" id="total3" type="text" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Cursos PAC</h5>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Cursos PAC de Formación</label>
                                                    <div class="col-md-9">
                                                        <input name="total5" id="total5" type="text" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Cursos PAC de Capacitación</label>
                                                    <div class="col-md-9">
                                                        <input name="total6" id="total6" type="text" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3"><strong>TOTAL CURSOS PAC</strong></label>
                                                    <div class="col-md-9">
                                                        <input name="total4" id="total4" type="text" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Costo total de cursos PAC Formación</label>
                                                    <div class="col-md-9">
                                                        <input name="total8" id="total8" type="text" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Costo total de cursos PAC Capacitación</label>
                                                    <div class="col-md-9">
                                                        <input name="total9" id="total9" type="text" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3"><strong>TOTAL COSTO CURSOS PAC</strong></label>
                                                    <div class="col-md-9">
                                                        <input name="total7" id="total7" type="text" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Cursos NO PAC</h5>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Cursos No PAC de Formación</label>
                                                    <div class="col-md-9">
                                                        <input name="total11" id="total11" type="text" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Cursos No PAC de Capacitación</label>
                                                    <div class="col-md-9">
                                                        <input name="total12" id="total12" type="text" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3"><strong>TOTAL CURSOS NO PAC</strong></label>
                                                    <div class="col-md-9">
                                                        <input name="total10" id="total10" type="text" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Costo total de cursos No PAC Formación</label>
                                                    <div class="col-md-9">
                                                        <input name="total14" id="total14" type="text" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Costo total de cursos No PAC Capacitación</label>
                                                    <div class="col-md-9">
                                                    <input name="total15" id="total15" type="text" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3"><strong>TOTAL COSTO CURSOS NO PAC</strong></label>
                                                    <div class="col-md-9">
                                                        <input name="total13" id="total13" type="text" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
    <!-- DatetimePicker JS -->
    <script src="<?php echo base_url() ?>/assets/libs/moment/moment.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/js/number.js/jquery.number.js"></script>
    <script type="text/javascript">

        function calcularPresupuesto(){
            cohorte = $('#cohorte').val();
            var checked = {"cohorte" : cohorte};
            var url = "<?php echo base_url('public/ReportePresupuestario/reportePresupuestarioApi'); ?>";
            $.get(url, checked, function(respuesta, status){
                if (status){
                    respuesta = JSON.parse(respuesta);
                    total1 = respuesta.total1;
                    if(total1==null){ total1=0 }
                    $('#total1').val(total1);

                    total2 = respuesta.total2;
                    if(total2==null){ total2=0 }
                    $('#total2').val('$' + currencyFormat(total2));

                    total3 = respuesta.correccion_totales;
                    if(total3==null){ total3=0 }
                    $('#total3').val('$' + currencyFormat(total3));

                    total4 = respuesta.total4;
                    if(total4==null){ total4=0 }
                    $('#total4').val(total4);

                    total5 = respuesta.total5;
                    if(total5==null){ total5=0 }
                    $('#total5').val(total5);

                    total6 = respuesta.total6;
                    if(total6==null){ total6=0 }
                    $('#total6').val(total6);

                    total7 = respuesta.total7;
                    if(total7==null){ total7=0 }
                    $('#total7').val('$' + currencyFormat(total7));

                    total8 = respuesta.total8;
                    if(total8==null){ total8=0 }
                    $('#total8').val('$' + currencyFormat(total8));

                    total9 = respuesta.total9;
                    if(total9==null){ total9=0 }
                    $('#total9').val('$' + currencyFormat(total9));

                    total10 = respuesta.total10;
                    if(total10==null){ total10=0 }
                    $('#total10').val(total10);

                    total11 = respuesta.total11;
                    if(total11==null){ total11=0 }
                    $('#total11').val(total11);

                    total12 = respuesta.total12;
                    if(total12==null){ total12=0 }
                    $('#total12').val(total12);

                    total13 = respuesta.total13;
                    if(total13==null){ total13=0 }
                    $('#total13').val('$' + currencyFormat(total13));

                    total14 = respuesta.total14;
                    if(total14==null){ total14=0 }
                    $('#total14').val('$' + currencyFormat(total14));

                    total15 = respuesta.total15;
                    if(total15==null){ total15=0 }
                    $('#total15').val('$' + currencyFormat(total15));
                }else{
                    console.log("ERROR");
                }
            });
        }

        function currencyFormat(num) {
            n = $.number( num, 0, ',', '.' );
            return n;
        }
        function monthDiff(d1, d2) {
            var months;
            months = (d2.getFullYear() - d1.getFullYear()) * 12;
            months -= d1.getMonth() + 1;
            months += d2.getMonth();
            return months <= 0 ? 0 : months;
        }
    </script>
</body>

</html>