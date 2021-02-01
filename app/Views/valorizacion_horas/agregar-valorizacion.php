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
                                        <h4 class="card-title">Simulador de Horas</h4>
                                        <a type="button" href="<?php echo site_url('valorizacion/editar'); ?>" class="btn btn-rounded btn-outline-success btn-sm">Actualizar Valor Hora</a>
                                        <a type="button" href="<?php echo site_url('valorizacion/editar_asignacion'); ?>" class="btn btn-rounded btn-outline-success btn-sm">Actualizar Valor Asignacion de movilización</a>
                                    </div>
                                    <hr class="mt-0 mb-5">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Horas Totales de Asignatura</label>
                                                    <div class="col-md-9">
                                                        <input type="number" class="form-control" size="50" id="horastotalesasignatura" value="" min="0" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control" id="spa_horastotalesasignatura" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-sm-12 col-lg-4">
                                                <div class="form-group row">
                                                    <label for="finicio" class="col-sm-3 text-right control-label col-form-label">Inicio</label>
                                                    <div class="col-sm-9">
                                                        <input name="finicio" type="date" min="" max="" class="form-control" id="finicio" placeholder="" onchange="validarFecha('inicio')" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-4">
                                                <div class="form-group row">
                                                    <label for="ftermino" class="col-sm-3 text-right control-label col-form-label">Término</label>
                                                    <div class="col-sm-9">
                                                        <input name="ftermino" type="date" min="" max="" class="form-control" id="ftermino" placeholder="" onchange="validarFecha('termino')" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-4">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="spa_fechas" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Horas a Pago Docente</label>
                                                    <div class="col-md-9">
                                                        <input type="number" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control" id="spa_horapagodocente" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Horas Sueldo Base</label>
                                                    <div class="col-md-9">
                                                        <input type="number" class="form-control" size="50" disabled id="sueldobase" value="<?php echo $sueldobase ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control" id="spa_sueldobase" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Bonificación Docente %</label>
                                                    <div class="col-md-9">
                                                        <input type="number" class="form-control" size="50" disabled id="bonosueldo" value="30">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control" id="spa_bonosueldo" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Trienios</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control" tabindex="1" id="trienios">
                                                            <option value="none">----</option>
                                                            <option value="0">0</option>
                                                            <option value="20">1</option>
                                                            <option value="30">2</option>
                                                            <option value="40">3</option>
                                                            <option value="50">4</option>
                                                            <option value="60">5</option>
                                                            <option value="70">6</option>
                                                            <option value="80">7</option>
                                                            <option value="90">8</option>
                                                            <option value="100">9 o más</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control" id="spa_trienios" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Asignación Académica</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control" tabindex="1" id="asignacionacademica">
                                                            <option value="none">----</option>
                                                            <option value="0">Ninguno</option>
                                                            <option value="30">Doctor</option>
                                                            <option value="25">Magister o Master</option>
                                                            <option value="10">Postítulo 1 año o más</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control" id="spa_asignacionacademica" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Bonificación Salud</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control" tabindex="1" id="bonificacionsalud">
                                                            <option value="none">----</option>
                                                            <option value="4.5">CAPREDENA</option>
                                                            <option value="0">Otro</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control" id="spa_bonificacionsalud" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Empleado Público</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control" tabindex="1" id="empleadopublico" onchange="mostrartr();">
                                                            <option value="none">----</option>
                                                            <option value="1">Si</option>
                                                            <option value="0">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control" id="spa_empleadopublico" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <div class="row" style="display:none;" id="tr_movilizacion">
                                            <div class="col-md-8">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Asignación Movilización</label>
                                                    <div class="col-md-9">
                                                        <input type="number" class="form-control" disabled size="50" id="movilizacion" value="<?php echo $asignacion ?>" min="0">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control" id="spa_movilizacion" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                    </div>
                                    <hr class="mt-0 mb-5">
                                    <div class="card-body">
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control text-right" value="Valor pago mensual" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control" id="valorpagomensual" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control text-right" value="Valor Asignatura" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control" id="valorhoraasignatura" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                    </div>
                                    <hr>
                                    <div class="form-actions">
                                        <div class="card-body">
                                            <div class="text-right">
                                                <button type="button" name="send" onclick="calcularHoras();" class="btn btn-info">Calcular</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body" id="listacuotas">

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
    <script>
    // Date Picker
    jQuery('.mydatepicker, #datepicker, .input-group.date').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#date-range').datepicker({
        toggleActive: true,
        language: 'es'
    });
    jQuery('#datepicker-inline').datepicker({
        todayHighlight: true
    });
    </script>
    <script type="text/javascript">

        function restaFechas(f1,f2){
            var fechaini = new Date(f1);
            var fechafin = new Date(f2);
            var diasdif= fechafin.getTime()-fechaini.getTime();
            var contdias = Math.round(diasdif/(1000*60*60*24));
            return contdias;
        }

        function calcularHoras(){
            diasrestantes = 0;
            dias = 0;
            semanas = 0;
            semanas_enteros = 0;
            diasrestanteequivalencia = 0;
            total_periodo = 0;
            f1 = document.getElementById('finicio').value;
            f2 = document.getElementById('ftermino').value;
            if(f1=="" || f2==""){
                alert("Ingrese los periodos");
                return false;
            }
            dias = restaFechas(f1,f2);
            // console.log(dias);
            semanas = dias / 7;
            // console.log(semanas);
            diasrestantes = dias % 7;
            // console.log(diasrestantes);
            semanas_enteros = parseInt(semanas);
            // console.log(semanas_enteros);
            diasrestantes = diasrestantes + 1;
            switch (diasrestantes) {
                case 1:
                    diasrestanteequivalencia = 0.14;
                break;
                case 2:
                    diasrestanteequivalencia = 0.29;
                break;
                case 3:
                    diasrestanteequivalencia = 0.43;
                break;
                case 4:
                    diasrestanteequivalencia = 0.57;
                break;
                case 5:
                    diasrestanteequivalencia = 0.71;
                break;
                case 6:
                    diasrestanteequivalencia = 0.86;
                break;
                case 7:
                    diasrestanteequivalencia = 1;
                break;
                default:
                    diasrestanteequivalencia = 0;
                break;

            }
            // console.log(diasrestanteequivalencia);
            total_periodo = semanas_enteros + diasrestanteequivalencia;
            // console.log("total periodo", total_periodo);
            document.getElementById("spa_fechas").value = total_periodo;
            horastotalesasignatura = document.getElementById("horastotalesasignatura").value;
            document.getElementById("spa_horastotalesasignatura").value = horastotalesasignatura;
            horapagodocente = horastotalesasignatura / total_periodo;
            horapagodocente = Math.round(horapagodocente);
            // console.log("horas docente:" +horapagodocente);
            if (horapagodocente > 12){
                horapagodocente = 12;
            }
            document.getElementById("spa_horapagodocente").value = horapagodocente;
            sueldobase = document.getElementById("sueldobase").value;
            sueldobasetotal = sueldobase * horapagodocente;

            document.getElementById("spa_sueldobase").value = currencyFormat(sueldobasetotal);

            spa_bonosueldo = 0;
            bonosueldo_porcentaje = document.getElementById("bonosueldo").value;
            bonosueldo = (sueldobasetotal*bonosueldo_porcentaje)/100;
            document.getElementById("spa_bonosueldo").value = currencyFormat(bonosueldo);

            spa_trienios = 0;
            trienios = document.getElementById("trienios").value;
            if(trienios != "none"){
                spa_trienios = ((sueldobasetotal * trienios)/100);
                document.getElementById("spa_trienios").value = currencyFormat(spa_trienios);
            }

            asignacionacademica = document.getElementById("asignacionacademica").value;
            spa_asignacionacademica = 0;
            if(asignacionacademica != "none"){
                spa_asignacionacademica = ((sueldobasetotal * asignacionacademica)/100);
                document.getElementById("spa_asignacionacademica").value = currencyFormat(spa_asignacionacademica);
            }

            bonificacionsalud = document.getElementById("bonificacionsalud").value;
            spa_bonificacionsalud = 0;
            if(bonificacionsalud != "none"){
                sumabonos = spa_asignacionacademica + spa_trienios + sueldobasetotal + bonosueldo;
                spa_bonificacionsalud = ((sumabonos * bonificacionsalud)/100);
                document.getElementById("spa_bonificacionsalud").value = currencyFormat(spa_bonificacionsalud);
            }

            empleadopublico = document.getElementById("empleadopublico").value;
            movilizacion = 0;
            if(empleadopublico == '0'){
                movilizacion = parseInt(document.getElementById("movilizacion").value);
                document.getElementById("spa_movilizacion").value = currencyFormat(movilizacion);
            }
            totales = sueldobasetotal + spa_trienios + spa_asignacionacademica + spa_bonificacionsalud + movilizacion + bonosueldo;
            document.getElementById("valorpagomensual").value = currencyFormat(totales);
            document.getElementById("valorhoraasignatura").value = currencyFormat(totales);

            var fecha1 = moment(f1);
            var fecha2 = moment(f2);
            // console.log("meses:" + fecha2.diff(fecha1, 'months'));

            var date = new Date();
            inicio = new Date(fecha1);
            fin = new Date(fecha2);

            cantidadMeses = 0;
            diasPrimerMes = 0;
            diasUltimoMes = 0;
            totaldiaspagar = 0;
            if(inicio.getMonth() == fin.getMonth()){
                // console.log("mismo mes");
                cantidaddias = fin.getDate() - inicio.getDate()
                // console.log("dias a pagar: " + cantidaddias);
                cantidadMeses = 0;
                diasPrimerMes = 1;
                diasUltimoMes = 0;
                // var ultimoDiaMes1 = new Date(inicio.getFullYear(), inicio.getMonth() + 1, 0);
                cantidaddiasInicio = fin.getDate() - inicio.getDate();
                // alert(cantidaddiasInicio);
                diasPrimerMes = cantidaddiasInicio;
            }else{
                // console.log("diferentes meses");
                mes1 = 0;
                if(inicio.getDate() == 1){
                    // console.log("inicio en primer dia de mes");
                    mes1 = inicio.getMonth();
                }else{
                    //calcular dias a pagar primer meses
                    var ultimoDiaMes1 = new Date(inicio.getFullYear(), inicio.getMonth() + 1, 0);
                    cantidaddiasInicio = ultimoDiaMes1.getDate() - inicio.getDate();
                    // console.log("dias a pagar mes inicio: "+ cantidaddiasInicio);
                    diasPrimerMes = cantidaddiasInicio;
                }
                var ultimoDiaMes2 = new Date(fin.getFullYear(), fin.getMonth() + 1, 0);
                // cantidaddiasInicio = ultimoDiaMes2.getDate() - inicio.getDate();
                mes2 = 0;
                if(fin.getDate() == ultimoDiaMes2.getDate()){
                    // console.log("mes completo");
                    mes2 = fin.getMonth();
                }else{
                    //pagar dias mes final
                    cantidaddiasFin = fin.getDate();
                    // console.log("dias a pagar mes fin: "+  cantidaddiasFin);
                    diasUltimoMes = cantidaddiasFin;
                }
                totalmeses = (fin.getMonth()+1) - inicio.getMonth();
                if((mes1==0) && (mes2 ==0)){
                    totalmeses = totalmeses - 2;
                    cantidadMeses = totalmeses;
                }else{
                    totalmeses = (fin.getMonth()+1) - inicio.getMonth();
                    if((mes1==0) || (mes2 ==0)){
                    totalmeses = totalmeses - 1;
                    }
                    // console.log("total meses :" + totalmeses);
                    cantidadMeses = totalmeses;
                }
            }

            text = "";
            totales_dia = totales / 30;
            totales_suma = 0;
            if(diasPrimerMes != 0){
                // console.log("cuota 1: "+ diasPrimerMes);
                // text = text + '<li>cuota: '+ currencyFormat((diasPrimerMes+1) * totales_dia) +' </li>';
                text = text + '<div class="row">'+
                                '<div class="col-md-8">'+
                                    '<div class="form-group row">'+
                                        '<div class="col-md-12">'+
                                            '<input type="text" class="form-control text-right" value="Cuota" disabled>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-md-4">'+
                                    '<div class="form-group row">'+
                                        '<div class="col-md-12">'+
                                            '<input type="text" class="form-control" disabled value="'+currencyFormat((diasPrimerMes+1) * totales_dia)+'">'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
                totales_suma = totales_suma + ((diasPrimerMes+1) * totales_dia);
                totales_suma_valor_hora_asignatura = totales_suma;
            }
            if(cantidadMeses != 0){
                // console.log("Meses: "+ cantidadMeses);
                var i;
                if(diasPrimerMes != 0){
                    a = 1;
                }
                var a = 0;
                for (i = 0; i < cantidadMeses; i++) {
                    a = a + 1
                    // console.log("cuota "+(a));
                    // text = text + '<li>cuota: '+currencyFormat(totales)+'</li>';
                    text = text + '<div class="row">'+
                                    '<div class="col-md-8">'+
                                        '<div class="form-group row">'+
                                            '<div class="col-md-12">'+
                                                '<input type="text" class="form-control text-right" value="Cuota" disabled>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="col-md-4">'+
                                        '<div class="form-group row">'+
                                            '<div class="col-md-12">'+
                                                '<input type="text" class="form-control" disabled value="'+currencyFormat(totales)+'">'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>';
                    totales_suma = totales_suma + totales;
                    totales_suma_valor_hora_asignatura = totales_suma;
                }
            }
            if(diasUltimoMes != 0){
                // console.log("cuota "+(cantidadMeses)+": "+ diasUltimoMes);
                // text = text + '<li>cuota: '+ currencyFormat(diasUltimoMes * totales_dia) +' </li>';
                text = text + '<div class="row">'+
                                        '<div class="col-md-8">'+
                                            '<div class="form-group row">'+
                                                '<div class="col-md-12">'+
                                                    '<input type="text" class="form-control text-right" value="Cuota" disabled>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-md-4">'+
                                            '<div class="form-group row">'+
                                                '<div class="col-md-12">'+
                                                    '<input type="text" class="form-control" disabled value="'+currencyFormat(diasUltimoMes * totales_dia)+'">'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>';
                totales_suma = totales_suma + diasUltimoMes * totales_dia;
                totales_suma_valor_hora_asignatura = totales_suma;
            }
            document.getElementById("listacuotas").innerHTML = text;
            // console.log("totales suma", totales_suma);
            document.getElementById("valorhoraasignatura").value = currencyFormat(totales_suma_valor_hora_asignatura);
        }

        function mostrartr(){
            publico = document.getElementById('empleadopublico').value;
            if(publico=='0'){
                document.getElementById('tr_movilizacion').style.display = "";
            }else{
                document.getElementById('tr_movilizacion').style.display = "none";
            }
        }
        function currencyFormat(num) {
            const formatter = new Intl.NumberFormat('es-CL', {
                style: 'currency',
                currency: 'CLP',
                minimumFractionDigits: 0
            })
            return formatter.format(num)
        }
        function monthDiff(d1, d2) {
            var months;
            months = (d2.getFullYear() - d1.getFullYear()) * 12;
            months -= d1.getMonth() + 1;
            months += d2.getMonth();
            return months <= 0 ? 0 : months;
        }

        function validarFecha(fecha){
            if (fecha == "termino"){
                document.getElementById("finicio").max = document.getElementById("ftermino").value;
            }else if(fecha == "inicio"){
                document.getElementById("ftermino").min = document.getElementById("finicio").value;
            }else{
                console.log("ERROR");
            }
        }
    </script>
</body>

</html>