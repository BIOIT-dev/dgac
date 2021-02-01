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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            <div class="container-fluid" style="width: 80%;">
                                <canvas id="canvas"></canvas>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    <script src="<?php echo base_url() ?>/assets/dist/js/js-grafico/Chart.bundle.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/js/js-grafico/utils.js"></script>
    <script>
        var color = Chart.helpers.color;
        const colores_datos = [
            window.chartColors.blue, 
            window.chartColors.red,
            window.chartColors.yellow,
            window.chartColors.green,
        ];
        
        const anio_year = new Date().getFullYear(); //fecha actual
        const anio_inicio = anio_year-'<?= $fecha_atras ?>'; //fecha inicio de datos
        /*******************************************************/
        var labelValues = []; // Label para los datos, se llena con los años (eje X)
        for(var i = anio_inicio; i <= anio_year; i++)
            labelValues.push(i);
        /*******************************************************/
        valores = []; //se inicializa el array para los valores
        for (var i = 0; i < ('<?= count($datosGrafico) ?>'); i++) 
            valores[i] = [];
        /*******************************************************/
        var labelNames = []; //Nombre de los label o datos
        var index = 0;
        <?php foreach($datosGrafico as $dg) { ?>
            labelNames.push('<?= $dg[0] ?>'); 
            <?php for($i = 1; $i < count($dg); $i++) { ?>
                valores[index].push('<?= $dg[$i]['num'] ?>'); // se llena el array de valores
            <?php } ?>
            index++;
        <?php } ?>
        /*******************************************************/
        var datasetsValues = []; // datasets con toda la información para cada label
        for (var i = 0; i < ('<?= count($datosGrafico) ?>'); i++) {
            datasetsValues[i] = {
                label: labelNames[i],
                backgroundColor: color(colores_datos[i]).alpha(0.7).rgbString(),
                borderColor: colores_datos[i],
                borderWidth: 2,
                data: valores[i]
            };
        }

        var barChartData = {
            labels: labelValues,
            datasets: datasetsValues
        };
        /******************************************************/
        //carga el gráfico de barras al inicio
        window.onload = function() {
            // Chart.defaults.global.defaultFontColor = 'white'; // COLOR TODO EL TEXTO DEL GRÁFICO
            var ctx = document.getElementById('canvas').getContext('2d');
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        display: true,
                        labels: {
                            // This more specific font property overrides the global property
                            // defaultFontColor: 'white'
                        },
                        position: 'bottom',
                    },
                    title: {
                        display: true,
                        text: '<?= $tituloGrafico ?>'
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                drawBorder: true,
                                color: ['', '']
                            },
                            ticks: {
                                min: 0,
                                //max: 6,
                                // max: 20,
                                // stepSize: 2
                            },

                        }],
                    }
                } //acá volver a ejecutar la funcion barchartdata
            });
        };
    </script>
</body>

</html>