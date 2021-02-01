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
                            <div class="card-body">
                                <!-- <div class="col-sm-4">
                                    <select name="select_resumenes" id="select_resumenes" class="form-control" onchange="cargarTabla()">
                                        <option value="null">------ Seleccione Resumen ------</option>
                                        <option value="1">Resumen General Nivel de Formación</option>
                                        <option value="2">Resumen General Capacitación</option>
                                        <option value="3">Resumen por Carrera</option>
                                        <option value="4">Resumen por Asignatura</option>
                                        <option value="5">Resumen por Docente</option>
                                    </select>
                                    <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm m-1 ml-0"
                                                            onclick=''>Limpiar</button>
                                </div> -->
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <select class="form-control" id="select_resumenes" onchange="cargarTabla()">
                                            <option value="null">------ Seleccione Resumen ------</option>
                                            <option value="1">Resumen General Nivel de Formación</option>
                                            <option value="2">Resumen General Capacitación</option>
                                            <option value="3">Resumen por Carrera</option>
                                            <option value="4">Resumen por Asignatura</option>
                                            <option value="5">Resumen por Docente</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-success" type="button">Limpiar</button>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <div id="contenido">
                                        <!-- acá se carga la tabla dinámicamente -->
                                    </div>
                                </div>
                            </div>
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
    <script src="<?php echo base_url() ?>/assets/libs/sweetalert2/dist/sweetalert2.all.js"></script>
    <script src="<?php echo base_url() ?>/assets/extra-libs/sweetalert2/sweet-alert.init.js"></script>

    <!-- This Page JS -->

    <script src="<?php echo base_url() ?>/assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/js/pages/datatable/custom-datatable.js"></script>
    <!-- <script src="<?php echo base_url() ?>/assets/dist/js/pages/datatable/datatable-basic.init.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script> -->

    <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script> -->
    <script type="text/javascript" charset="utf8" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/js/dataTables.checkboxes.min.js"></script>

    <script>
        function cargarTabla(){
            var checked = { 'tipo_tabla': document.getElementById('select_resumenes').value};
            var url = "<?php echo base_url('public/ResumenEncuestas/obtenertabla'); ?>";
            $.get(url, checked, function(data, status){
                if (status){
                    $("#contenido").html(data);
                    if(document.getElementById('select_resumenes').value <= 2)
                        cargarDatos();
                }else{
                    console.log("ERROR");
                }
            });
        }

        function cargarDatos(){
            var select_table = document.getElementById('select_resumenes').value;
            //Dataset para crear la tabla
            switch(select_table){
                case '1':
                    var dataSet = [];
                    <?php foreach($r_nivelFormacion as $nf) { ?>
                        dataSet.push([  '<?= $nf[0] ?>', '<?= $nf[1] ?>', '<?= $nf[2]['blk'] ?>', '<?= $nf[3]['blk'] ?>', '<?= $nf[4]['blk'] ?>', '<?= $nf[5]['blk'] ?>', '<?= $nf[6]['blk'] ?>', '<?= $nf[7]['blk'] ?>', 
                                        '<?= $nf[8]['blk'] ?>', '<?= $nf[9]['blk'] ?>', '<?= $nf[10]['blk'] ?>', '<?= $nf[11]['blk'] ?>', '<?= $nf[12]['blk'] ?>', '<?= $nf[13]['blk'] ?>', '<?= $nf[14]['blk'] ?>', '<?= $nf[15]['blk'] ?>'
                                    ]);
                    <?php } ?>
                    break;
                case '2':
                    var dataSet = [];
                    <?php foreach($r_capacitacion as $nf) { ?>
                        dataSet.push([  '<?= $nf[0] ?>', '<?= $nf[1] ?>', '<?= $nf[2]['blk'] ?>', '<?= $nf[3]['blk'] ?>', '<?= $nf[4]['blk'] ?>', '<?= $nf[5]['blk'] ?>', '<?= $nf[6]['blk'] ?>', '<?= $nf[7]['blk'] ?>', 
                                        '<?= $nf[8]['blk'] ?>', '<?= $nf[9]['blk'] ?>', '<?= $nf[10]['blk'] ?>', '<?= $nf[11]['blk'] ?>', '<?= $nf[12]['blk'] ?>', '<?= $nf[13]['blk'] ?>', '<?= $nf[14]['blk'] ?>', '<?= $nf[15]['blk'] ?>'
                                    ]);
                    <?php } ?>
                    break;
            }

            $(document).ready(function() {
                var table = $('#tabla_carreras').DataTable({
                    data: dataSet,
                    select: {
                        style: 'multi'
                    },
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
                    lengthChange: false,
                    paginate: false,
                    info: false,
                    filter: false,
                    bSort: false,
                });   
            });
        }

        /******************************************************************/
        /******************************************************************/
        function cargarElementTabla(ruta, inputSelect){
            var checked = { 'oid_elemento': document.getElementById(inputSelect).value};
            var url = "<?php echo base_url('public/ResumenEncuestas/'); ?>/"+ruta;
            $.get(url, checked, function(data, status){
                if (status){
                    var respuestaAjax = JSON.parse(data);
                    cargarOtros(respuestaAjax);
                }else{
                    console.log("ERROR");
                }
            });
        }

        function filtrarElementTabla(datos){
            var checked = { 'oid_elemento': document.getElementById('inputSelectCarrera').value};
            var url = "<?php echo base_url('public/ResumenEncuestas/'); ?>/"+datos;
            $.get(url, checked, function(data, status){
                if (status){
                    var respuestaAjax = JSON.parse(data);
                    var inputAsignatura = '<option value="null">------ Seleccione una Asignatura ------</option>';
                    for(var i = 0; i < respuestaAjax.length; i++){
                        inputAsignatura += '<option value="'+respuestaAjax[i]['as_oid']+'">'+respuestaAjax[i]['asignatura']+'</option>';
                    }
                    document.getElementById('inputSelectAsignatura').innerHTML = inputAsignatura;
                }else{
                    console.log("ERROR");
                }
            });
        }

        function filtrarElementDocente(datos){
            var checked = { 'oid_elemento': document.getElementById('inputSelectCarrera').value};
            var url = "<?php echo base_url('public/ResumenEncuestas/'); ?>/"+datos;
            $.get(url, checked, function(data, status){
                if (status){
                    var respuestaAjax = JSON.parse(data);
                    var inputDocente = '<option value="null">------ Seleccione un Docente ------</option>';
                    for(var i = 0; i < respuestaAjax.length; i++){
                        inputDocente += '<option value="'+respuestaAjax[i]['oid']+'">'+respuestaAjax[i]['nombres']+'</option>';
                    }
                    document.getElementById('inputSelectDocente').innerHTML = inputDocente;
                }else{
                    console.log("ERROR");
                }
            });
        }
        
        function cargarOtros(nf){
            var select_table = document.getElementById('select_resumenes').value;
            t = $('#tabla_carreras').DataTable();
            for(var i = 0; i < nf.length; i++){
                t.row.add( [    nf[i][0], nf[i][1], nf[i][2]['blk'], nf[i][3]['blk'], nf[i][4]['blk'], nf[i][5]['blk'], nf[i][6]['blk'], nf[i][7]['blk'], 
                                nf[i][8]['blk'], nf[i][9]['blk'], nf[i][10]['blk'], nf[i][11]['blk'], nf[i][12]['blk'], nf[i][13]['blk'], nf[i][14]['blk'], nf[i][15]['blk']
                            ] ).draw( false );
            } 
            t.columns.adjust().draw()
        }

        function quitarElementTabla(inputSelect){
            var indexRows = [];
            t = $('#tabla_carreras').DataTable();
            var selectedText = $( "#"+inputSelect+" option:selected" ).text();
            var datosTablaFinal = [];
            t.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
                var d = this.data();
                if(d[0] != selectedText){
                    datosTablaFinal.push(d);
                }
            });
            t.clear();
            for(var i = 0; i < datosTablaFinal.length; i++){
                t.row.add(datosTablaFinal[i]).draw(false);
            }
            t.columns.adjust().draw(false);
        }
    </script>
</body>

</html>