<?php //echo view('dgac/headers'); ?>
<?php echo $headers['headersView']; ?>
<link href="<?php echo base_url() ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
<!-- <link href="<?php echo base_url() ?>/assets/libs/bootstrap-table/dist/bootstrap-table.min.css" rel="stylesheet" type="text/css" /> -->
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css">

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
                                <!-- <h4 class="card-title">Default Ordering</h4>
                                <h6 class="card-subtitle">With DataTables you can alter the ordering characteristics of
                                    the table at initialisation time. Using the<code> order | option</code> order
                                    initialisation parameter, you can set the table to display the data in exactly the
                                    order that you want.</h6> -->
                                <div class="table-responsive">
                                    <table name="tabla_usuarios" id="tabla_usuarios" class="table table-striped table-bordered display"
                                        style="width:100%">
                                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm m-1"
                                                            onclick='checkboxTest()'>Eliminar</button>
                                        <thead>
                                            <tr>
                                                <th>
                                                    <!-- <input type="checkbox" name="select_all" id="select_all" class="material-inputs filled-in chk-col-pink"/>
                                                    <label for="select_all"></label> -->
                                                </th>
                                                <th scope="col">Userid</th>
                                                <th scope="col">Apellido Paterno</th>
                                                <th scope="col">Apellido Materno</th>
                                                <th scope="col">Nombres</th>
                                                <th scope="col">Activo</th>
                                                <th scope="col">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($resultado_busqueda as $rb) { ?>
                                                <tr name="#md_checkbox_<?php echo $rb->userid ?>" id="#md_checkbox_<?php echo $rb->userid ?>">
                                                    <td >
                                                        <!-- <input type="checkbox" name="md_checkbox_<?php //echo $rb->userid ?>" id="md_checkbox_<?php //echo $rb->userid ?>" class="material-inputs filled-in chk-col-pink"/>
                                                        <label for="md_checkbox_<?php //echo $rb->userid ?>"></label> -->
                                                    </td>
                                                    <td><?php echo $rb->userid ?></td>
                                                    <td><?php echo $rb->apellido_paterno ?></td>
                                                    <td><?php echo $rb->apellido_materno ?></td>
                                                    <td><?php echo $rb->nombres ?></td>
                                                    <td><?php echo $rb->inactivo ?></td>
                                                    <td style="text-align: center; " class="p-1">
                                                        <!-- <button type="button"
                                                            class="btn waves-effect waves-light btn-rounded btn-success btn-sm fas fa-edit m-0 p-1"></button> -->
                                                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm"
                                                            onclick='checkboxTest()'>Editar</button>
                                                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm"
                                                            onclick='modalSwal(<?php echo $rb->userid ?>)'>Eliminar</button>
                                                        <!-- <a class="editar" title="Editar" onclick='modalSwal(<?php //echo $rb->userid ?>)'>
                                                            <i class="fas fa-edit text-success"></i></a>  
                                                        <a class="eliminar" href="<?php //echo base_url('public/Usuario/eliminar_usuario/'.$rb->oid_usuario); ?>" title="Eliminar">
                                                            <i class="fas fa-trash text-danger"></i></a> -->
                                                    </td>
                                                    <div id="<?php echo 'modalDelete'.$rb->userid ?>" class="swal2-container swal2-center swal2-fade swal2-shown" style="overflow-y: auto; display: none;">
                                                        <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
                                                            <div class="swal2-header">
                                                                <div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;">
                                                                <span class="swal2-x-mark">
                                                                    <span class="swal2-x-mark-line-left"></span>
                                                                    <span class="swal2-x-mark-line-right"></span>
                                                                </span>
                                                            </div>
                                                            <h2 class="swal2-title" id="swal2-title" style="display: flex;">¿Estás seguro?</h2>
                                                            <button onclick="modalClose(<?php echo $rb->userid ?>)" type="button" class="swal2-close" aria-label="Close this dialog">×</button>
                                                        </div>
                                                        <div class="swal2-content">
                                                            <div id="swal2-content" style="display: block;">
                                                                ¿Quieres eliminar a <?php echo $rb->nombres; ?>? <br>¡Esta acción no se puede deshacer!
                                                            </div>
                                                            <div class="swal2-actions" style="display: flex;">
                                                                <a href="<?php echo base_url('public/Usuario/eliminar_usuario/'.$rb->oid_usuario); ?>" type="button" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block; border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);">Eliminar</a>
                                                                <button onclick="modalClose(<?php echo $rb->userid ?>)" type="button" class="swal2-cancel swal2-styled" aria-label="">Cancelar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </tr>
                                                
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th scope="col">Userid</th>
                                                <th scope="col">Apellido Paterno</th>
                                                <th scope="col">Apellido Materno</th>
                                                <th scope="col">Nombres</th>
                                                <th scope="col">Activo</th>
                                                <th scope="col">Acción</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <!-- <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title">Export Table</h4>
                                                    <div class="select">
                                                        <select class="form-control" id="locale">
                                                            <option value="en-US">en-US</option>
                                                            <option value="es-CL" selected>es-CL</option>
                                                        </select>
                                                    </div>

                                                    <div id="toolbar">
                                                        <button id="remove" class="btn btn-danger" disabled>
                                                            <i class="ti-trash"></i> Eliminar
                                                        </button>
                                                    </div>
                                                    <table id="exporttable" data-toolbar="#toolbar" data-search="true"
                                                        data-show-refresh="true" data-show-toggle="true" data-show-fullscreen="false"
                                                        data-show-columns="true" data-detail-view="true" data-show-export="true"
                                                        data-detail-formatter="detailFormatter" data-minimum-count-columns="2"
                                                        data-show-pagination-switch="true" data-pagination="true" data-id-field="id"
                                                        data-page-list="[10, 25, 50, 100, ALL]" data-show-footer="false"
                                                        data-side-pagination="server"
                                                        data-url="https://examples.wenzhixin.net.cn/examples/bootstrap_table/data"
                                                        data-response-handler="responseHandler">
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Warning message <small>(Click on image)</small></h4>
                                                <img src="<?php echo base_url() ?>/assets/images/alert/alert4.png" alt="alert" class="img-fluid model_img"
                                                    id="sa-warning">
                                            </div>
                                        </div>
                                    </div> -->
                                    
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
    <script src="<?php echo base_url() ?>/assets/dist/js/pages/datatable/datatable-basic.init.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>

    <!-- This Page JS -->
    <!-- <script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/bootstrap-table/dist/bootstrap-table.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/bootstrap-table/dist/bootstrap-table-locale-all.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/bootstrap-table/dist/extensions/export/bootstrap-table-export.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/js/pages/tables/bootstrap-table.init.js"></script> -->

    <script>
        $(document).ready(function() {
            var table = $('#tabla_usuarios').DataTable({
                'columnDefs': [
                    {
                        'targets': 0,
                        'checkboxes': {
                        'selectRow': true,
                        'selectCallback': function(){
                            printSelectedRows();
                        }
                        }
                    }
                ],
                'select': {
                    'style': 'multi'
                },
                'order': [[1, 'asc']]
            });   
        });

            // Print selected rows
            function printSelectedRows(){
            var rows_selected = $('#example').DataTable().column(0).checkboxes.selected();

            // Output form data to a console     
            $('#example-console-rows').text(rows_selected.join(","));
            };
        // $(document).ready(function() {
        //     $('#tabla_usuarios').DataTable( {
        //         language: {
        //             lengthMenu: "Mostrando _MENU_ datos por página",
        //             zeroRecords: "Nothing found - sorry",
        //             info: "Mostrando página _PAGE_ de _PAGES_",
        //             infoEmpty: "No hay datos disponibles.",
        //             infoFiltered: "(filtered from _MAX_ total records)",
        //             search: "Buscar",
        //             searchPlaceholder: "",
        //             paginate: {
        //                 first: "Primero",
        //                 last: "Último",
        //                 next: "Siguiente",
        //                 previous: "Anterior"
        //             },
        //         }
        //     } );
        // } );
    </script>
    <script>
        function modalSwal(id){
            console.log(JSON.stringify(id));
            nombreidmodel = '#modalDelete'+JSON.stringify(id);
            console.log(nombreidmodel);
            document.querySelector("#modalDelete"+JSON.stringify(id)).style.display = "block";
        }
        function modalClose(id){
            document.querySelector("#modalDelete"+JSON.stringify(id)).style.display = "none";
        }
        // function checkboxTest(){
        //     console.log("DENTRO")
            
        //     var values = $('td input:checked').map(function() {
        //         return this.id;
        //     }).get();
            
        //     // $('#output').append(values.toString()).append('<br/>');
        //     console.log(values)
            
        // }
        function checkboxTest(){
            var checked = [];
            <?php foreach($resultado_busqueda as $rb) { ?>
                name= document.querySelector("#md_checkbox_<?php echo $rb->userid ?>");
                c = document.querySelector(".selected").id;
                console.log(c);
                if (c){
                    checked.push("<?php echo $rb->userid ?>");
                }else{
                    console.log("NOPE");
                }
            <?php } ?>
            // var rows_selected;
            // table = $('#tabla_usuarios').DataTable( {
            //     columnDefs: [ {
            //         orderable: false,
            //         className: 'select-checkbox',
            //         targets:   0
            //     } ],
            //     select: {
            //         style:    'multi',
            //         selector: 'td:first-child'
            //     }
            // } );
            // rows_selected = table.rows({ selected: true }).data();
            console.log(checked);
        }
        // function selectAll(){
        //     console.log(document.querySelector("#select_all").value);
        // }

        // $('#select_all').click(function(event) {   
        //     if(this.checked) {
        //         // Iterate each checkbox
        //         $(':checkbox').each(function() {
        //             this.checked = true;                        
        //         });
        //     } else {
        //         $(':checkbox').each(function() {
        //             this.checked = false;                       
        //         });
        //     }
        // });

        // $("#select_all").click(function(){
        //     // console.log(document.querySelector("#select_all").checked);
        //     if (document.querySelector("#select_all").checked){
        //         <?php foreach($resultado_busqueda as $rb) { ?>
        //             document.querySelector("#md_checkbox_<?php echo $rb->userid ?>").checked = true;
        //         <?php } ?>
        //     }else{
        //         <?php foreach($resultado_busqueda as $rb) { ?>
        //             document.querySelector("#md_checkbox_<?php echo $rb->userid ?>").checked = false;
        //         <?php } ?>
        //     }
        //     // $('#tabla_usuarios input:checkbox').not(this).prop('checked', this.checked);
        // });

        // $(document).ready(function () { 
        //     var oTable = $('#tabla_usuarios').dataTable({
        //         stateSave: true
        //     });

        //     $("#select_all").on("change", function(){
        //         oTable.$("input[type='checkbox']").attr('checked', $(this.checked));  
        //     });
        // });
    </script>
</body>

</html>