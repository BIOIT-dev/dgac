<?php //echo view('dgac/headers'); ?>
<?php 
    
    function changeDateFormat($format = 'd-m-Y', $originalDate)
    {
        return date($format, strtotime($originalDate));
    }

 ?>
<?php echo $headers['headersView']; ?>

<!-- This Page CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/libs/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

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
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <!-- Tabs -->
                            <!-- Tabs -->
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
                                    <div class="card-body">
                                        <form action="<?php echo base_url('public/Pago'); ?>" name="pago_create" id="pago_create" method="post" accept-charset="utf-8" class="form-horizontal form-material" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <small><label class="col-md-12">Alumno</label></small>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="" class="form-control form-control-line" readonly="" value="<?php echo $profile_data['nombres'].' '.$profile_data['apellido_paterno'].' '.$profile_data['apellido_materno']?>" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Comentario</label></small>
                                                <div class="col-md-12">
                                                    <textarea name="comentario" placeholder="" class="form-control form-control-line" required="" ></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Archivo</label></small>
                                                <div class="col-md-12">
                                                    <input name="ruta" type="file" class="form-control form-control-line" required="" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-success">Enviar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <label>Historial de Pagos</label>
                                    <table name="tabla_pagos" id="tabla_pagos" class="table table-striped table-bordered display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">Fecha</th>
                                                <th scope="col">Comentario</th>
                                                <th scope="col">Archivo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($historia_pagos as $key => $value) { ?>
                                            <tr>
                                                <td scope="col">
                                                    <?php
                                                        $datetime = explode(' ', $value->fecha );
                                                        echo changeDateFormat('d/m/Y',$datetime[0])." ",$datetime[1];
                                                    ?>
                                                </td>
                                                <td scope="col"><?php echo $value->comentario; ?></td>
                                                <td scope="col">
                                                    <a download href='<?php echo base_url("assets/uploads/pago/".$value->ruta); ?>'>
                                                        <?php echo $value->ruta; ?>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th scope="col">Fecha</th>
                                                <th scope="col">Comentario</th>
                                                <th scope="col">Archivo</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <!-- End Modal success -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
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
    <script src="<?php echo base_url() ?>/assets/libs/ckeditor/ckeditor.js"></script>
    <!-- This Page JS -->
    <script src="<?php echo base_url() ?>/assets/libs/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/js/pages/datatable/custom-datatable.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
        
        var table = $('#tabla_pagos').DataTable({
            select: {
                style: 'multi'
            },
            order: [[1, 'asc']],
            language: {
                lengthMenu: "Mostrando _MENU_ datos por página",
                zeroRecords: "Nada encontrado - lo siento",
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
    </script>
    <!-- <script src="<?php echo base_url() ?>/assets/dist/js/pages/datatable/datatable-basic.init.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script> -->

    <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script> -->
    <script type="text/javascript" charset="utf8" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/js/dataTables.checkboxes.min.js"></script>
    <script>
    $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
    var radioswitch = function() {
        var bt = function() {
            $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioState")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
            })
        };
        return {
            init: function() {
                bt()
            }
        }
    }();
    $(document).ready(function() {
        radioswitch.init()
    });
    </script>
</body>

</html>