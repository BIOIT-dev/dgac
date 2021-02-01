<?php
//echo view('dgac/headers');
?>
<?php
use App\Models\ForoForoModel;
use App\Models\ForoPostModel;
$obj_foro = new ForoForoModel($db);
$obj_post = new ForoPostModel($db);
?>
<?php echo $headers['headersView']; ?>
<!-- <link href="<?php echo base_url(); ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet"> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<!-- <link href="<?php echo base_url(); ?>/assets/libs/bootstrap-table/dist/bootstrap-table.min.css" rel="stylesheet" type="text/css" /> -->
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
                <a style="margin-left: 1%;" title="Agregar Categoría de Foro" href="<?php echo base_url('public/ForoCategoria/method/add'); ?>">
                     <button class="btn btn-info btn-outline"><i class="fa fa-plus text-blue"></i> Agregar Categoría</button>
                    
                </a>
                <br><br>

                <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h5 class="mb-0 text-white">Listado de Categorías de Foros</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table product-overview">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Fecha de creación</th>
                                                <th style="text-align:center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?     foreach ($resultado_busqueda as $key => $value) { ?>
                                      
                                            <tr>
                                                <td width="65%">
                                                    <h5 class="font-500">
                                                     <?php echo str_replace("'", "\'", $value->nombre); ?></h5>
                                                </td>
                                                <td width="15%"><?php echo date($value->fecha) ?></td>
                                               
                                                <td align="center" width="20%">
                                                    <? if(MostrarElemento(array('ForoCategoria/method/edit/'))){?>
                                                    <a href="<?php echo base_url('public/ForoCategoria/method/edit/' . $value->oid); ?>" class="text-inverse" title="Editar Categoria de Foro">
                                                        <button class="btn btn-primary">
                                                            <i class="fa fa-edit ext-dark"></i>
                                                        </button>
                                                    </a>

                                                    <a title="Agregar Foro" href="<?php echo base_url('public/ForoForo/method/add/' . $value->oid); ?>">
                                                        <button class="btn btn-secondary">
                                                            <i class="fa icon-speech"></i>
                                                        </button>
                                                    </a>

                                                    <a title="Ver Foros" href="<?php echo base_url('public/ForoForo/method/index/' . $value->oid); ?>">
                                                        <button class="btn btn-secondary">
                                                            <i class="fa icon-speech"></i>
                                                        </button>
                                                    </a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                         
                                        <?php 
                                            }  
                                        ?>
                                        </tbody>
                                    </table>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>





                <div class="row mt-3">
                    <div class="col-12">

                        <?php 
                        //me traigo las categorias q el usuario ve (foro_categoria)
                        foreach ($resultado_busqueda as $key => $value) { ?>
                        <?php 
                            //busco los foros q tiene
                            $foros = $obj_foro->getFilterElement($value->oid); ?>
                            <div class="card border-info">
                                <div class="card-header bg-info">
                                    <div class="row">
                                      <div class="col-10">
                                        <h4 class="mb-0 text-white">sdfsdffsd
                                            <?php echo str_replace("'", "\'", $value->nombre); ?>
                                        </h4>
                                      </div>
                                      <? if(MostrarElemento(array('ForoCategoria/method/edit/'))){?>
                                      <div class="col-2" style="text-align: right;">
                                          <a title="Editar" href="<?php echo base_url('public/ForoCategoria/method/edit/' . $value->oid); ?>">
                                            <i class="fa fa-edit text-white"></i>
                                        </a>
                                        <a title="Agregar Foro" href="<?php echo base_url('public/ForoForo/method/add/' . $value->oid); ?>">
                                            <i class="fa fa-plus text-white"></i>
                                        </a>
                                      </div>
                                      <?}?>
                                    </div>
                                </div>
                            </div>
                            <!-- Lista de foros asociados -->
                            <div class="jumbotron">
                                <?php foreach ($foros as $key => $value) { ?>
                                    <?php $post = $obj_post->getFilterElement($value->oid); ?>
                                    <?php $oid_categoria = $value->oid_categoria; ?>
                                    <?php $foid = $value->oid; ?>
                                    <div class="row">
                                      <div class="col-10">
                                          <?php echo $value->nombre; ?>
                                      </div>
                                      <? if(MostrarElemento(array('ForoForo/method/edit'))){?>
                                      <div class="col-2" style="text-align: right;">
                                          <a title="Editar" href="<?php echo base_url('public/ForoForo/method/edit/' . $value->oid); ?>">
                                            <i class="fa fa-edit text-blue"></i>
                                        </a>
                                        <a title="Agregar tema" href="<?php echo base_url('public/ForoPost/method/add/' . $value->oid . '/' . $value->oid_categoria); ?>">
                                            <i class="fa fa-plus text-blue"></i>
                                        </a>
                                      </div>
                                      <?}?>
                                    </div>
                                    <?php echo $value->descripcion; ?>
                                    <div class="row">
                                      <div class="col-2"></div>
                                      <div class="col-4">
                                          Temas en Discusión
                                      </div>
                                      <div class="col-2">
                                          Mensajes
                                      </div>
                                      <div class="col-2">
                                          Último Mensaje
                                      </div>
                                      <? if(MostrarElemento(array('ForoPost/method/add'))){?>
                                      <div class="col-2" style="text-align: right;">
                                          <a title="Agregar tema" href="<?php echo base_url('public/ForoPost/method/add/' . $value->oid . '/' . $value->oid_categoria); ?>">
                                            <i class="fa fa-plus text-blue"></i>
                                        </a>
                                      </div>
                                      <?}?>
                                    </div>
                                    <div class="row mt-4">
                                        <?php if (count($post) > 0) { ?>
                                            <?php foreach ($post as $key => $value) { ?>
                                                    <?php $toid = $value->oid; ?>
                                                   <div class="col-md-12">
                                                        <div class="card border-info">
                                                            <div class="card-header bg-info">
                                                                <div class="row">
                                                              <div class="col-6">
                                                                <h4 class="mb-0 text-white">
                                                                    <?php echo $value->asunto; ?>
                                                                </h4>
                                                              </div>
                                                              <div class="col-2 text-white">
                                                                  0
                                                              </div>
                                                              <div class="col-2 text-white">
                                                                  00/00/0000 00:00:00
                                                              </div>
                                                              <? if(MostrarElemento(array('ForoPost/method/edit'))){?>
                                                              <div class="col-2" style="text-align: right;">
                                                                  <a title="Editar" href="<?php echo base_url('public/ForoPost/method/edit/' . $value->oid . '/' . $oid_categoria); ?>">
                                                                    <i class="fa fa-edit text-white"></i>
                                                                </a>
                                                              </div>
                                                              <?}?>
                                                            </div>
                                                            </div>
                                                            
                                                            <div class="card-body">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                    <div class="col-md-2">
                                                                        <img style="width: 100%;" src="<?php echo base_url('assets/images/users/' . $value->foto); ?>">
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <?php echo $value->nombres . ' ' . $value->apellidos; ?>
                                                                        <br>
                                                                        <?php echo $value->fecha; ?>
                                                                        <br>
                                                                        <a href="<?php echo base_url('public/ForoPost/foro_tema_detalle/'.$foid.'/'.$toid); ?>">
                                                                        <?php echo $value->texto; ?>
                                                                        </a>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                               <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
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
    <script src="<?php echo base_url(); ?>/assets/libs/sweetalert2/dist/sweetalert2.all.js"></script>
    <script src="<?php echo base_url(); ?>/assets/extra-libs/sweetalert2/sweet-alert.init.js"></script>

    <!-- This Page JS -->

    <script src="<?php echo base_url(); ?>/assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/dist/js/pages/datatable/custom-datatable.js"></script>
    <!-- <script src="<?php echo base_url(); ?>/assets/dist/js/pages/datatable/datatable-basic.init.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script> -->

    <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script> -->
    <script type="text/javascript" charset="utf8" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/js/dataTables.checkboxes.min.js"></script>

    <!-- This Page JS -->
    <!-- <script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/libs/bootstrap-table/dist/bootstrap-table.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/libs/bootstrap-table/dist/bootstrap-table-locale-all.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/libs/bootstrap-table/dist/extensions/export/bootstrap-table-export.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/dist/js/pages/tables/bootstrap-table.init.js"></script> -->

    <script>
        //Dataset para crear la tabla
        var dataSet = []
        <?php foreach ($resultado_busqueda as $rb) { ?>
            dataSet.push(['<?= $rb->oid ?>', '<?= $rb->oid ?>', '<?= str_replace("'", "\'", $rb->nombre) ?>',
                        '<a href="<?php echo site_url($controller_name . '/method/edit/' . $rb->oid); ?>" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm" aria-label=""">Editar</a>']);
            // console.log(dataSet)
        <?php } ?>
        console.log(dataSet)
        
        $(document).ready(function() {
            var table = $('#tabla_registros').DataTable({
                data: dataSet,
                columnDefs: [
                    {
                        'targets': 0,
                        'checkboxes': {
                            'selectRow': true,
                        }
                    }
                ],
                select: {
                    style: 'multi'
                },
                order: [[1, 'asc']],
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
                }
            });   
        });

        // Se envían todos los id de usuarios a ser eliminados
        function checkboxTest(){
            var checked = [];
            var list_checked = $('#tabla_registros').DataTable().column(0).checkboxes.selected();
            for (var i = 0; i < list_checked.length; i++){
                checked.push(list_checked[i]);
            }
            console.log(checked);


            
        }
    </script>
    <script>
        function modalSwal(){
            cant_usuarios_checked = $('#tabla_registros').DataTable().column(0).checkboxes.selected().length;
            //console.log(cant_usuarios_checked);//

            if (cant_usuarios_checked > 0){
                document.querySelector("#modalDelete #swal2-content").innerHTML = "¿Está seguro que continuar con la operacion? <br>¡Esta acción no se puede deshacer!";
                document.querySelector("#modalDelete").style.display = "block";
            }else{
                document.querySelector("#modalError").style.display = "block";
            }
        }

        function modalClose(){
            document.querySelector("#modalDelete").style.display = "none";
            document.querySelector("#modalError").style.display = "none";
        }

        function botonEliminar(){
            var checked = {};
            var list_checked = $('#tabla_registros').DataTable().column(0).checkboxes.selected();
            for (var i = 0; i < list_checked.length; i++){
                // checked.push(list_checked[i]);
                checked[i] = list_checked[i];
            }
            // console.log(checked); //
            // window.location = '<?php
//echo base_url('public/Usuario/eliminar_usuario/');
?>'+'/'+checked;
            var url = "<?php echo base_url('public/' . $controller_name . '/method/delete'); ?>";
            $.post(url, checked, function(data, status){
                //console.log("CARGANDO!", data, status);//
                if (status){
                    // window.location = "https://stackoverflow.com";
                    document.querySelector("#modalDelete").style.display = "none";
                    document.querySelector("#modalSuccess").style.display = "block";
                    //console.log("BIEN");//
                }else{
                    console.log("ERROR");
                }
            });
        }
    </script>
</body>

</html>