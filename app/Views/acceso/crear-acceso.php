<?php //echo view('dgac/headers'); ?>
<?php echo $headers['headersView']; ?>
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
                    <div class="col-lg-12 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Tabs -->
                            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-timeline-tab" data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-timeline" aria-selected="true">Acceso</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-profile" aria-selected="false">Información</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">Setting</a>
                                </li> -->
                            </ul>
                            <!-- Tabs -->
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
                                    <div class="card-body">
                                            <?php 
                                                $session = session();

                                                if( isset($mensaje_servidor) ){
                                                    echo '<div class="alert alert-success">';
                                                        echo $mensaje_servidor;
                                                    echo '</div>';
                                                }
                                            ?>
                                        <form action="<?php echo base_url('public/Acceso/crear_acceso'); ?>" name="crear_acceso" id="crear_acceso" method="post" accept-charset="utf-8" class="form-horizontal form-material">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="role_id">Rol</label>
                                                            <!--<select id="role_id" name="role_id" class="with-gap material-inputs form-control" required="">-->
                                                            <select id="role_clave" name="role_clave" class="with-gap material-inputs form-control" required="">
                                                                <option value="">----------</option>
                                                                <?php foreach ($roles as $key => $value) { ?>
                                                                <option value="<?php echo $value->clave; ?>">
                                                                    <?php echo $value->name; ?>
                                                                </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12 mt-5">
                                                            <label for="grupo_id">Grupo (Comunidad)</label>
                                                            <select id="grupo_id" name="grupo_id" class="with-gap material-inputs form-control" required="">
                                                                <option value="">----------</option>
                                                                <?php foreach ($grupo as $key => $value) { ?>
                                                                <option value="<?php echo $value->oid; ?>">
                                                                    <?php echo $value->nombre; ?>
                                                                </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12 mt-5">
                                                            <label for="usuario_ids">Listado Usuario(s)</label>
                                                            <select multiple="" id="usuario_ids" name="usuario_ids[]" class="form-control" required=""></select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-success">Guardar</button>
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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/libs/select2/dist/css/select2.min.css">
    <style type="text/css">
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #1e88e5 !important;
            border: 1px solid #422323 !important;
            border-radius: 4px;
            cursor: default;
            float: left;
            margin-right: 5px;
            margin-top: 5px;
            padding: 0 5px;
        }
    </style>
    <!-- This Page JS -->

    <script src="<?php echo base_url() ?>/assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/dist/js/pages/datatable/custom-datatable.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>/assets/libs/select2/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            function load_DataTable(){

                var table = $('#tabla_usuarios_old').DataTable({
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


            }

            function load_users(){

                $.ajax({
                   url:'<?php echo base_url("public/Acceso/ajax_usuario"); ?>',
                   dataType: "json",
                   type:'post',
                   success:  function (response) {
                        var html = '';
                        $.each(response, function (i,o) {
                            //console.log(o.nombres)
                            html += '<option value='+o.oid+'>'+o.nombres + " " + o.apellidos+'</option>';
                        });
                        $("select#usuario_ids").append(html);
                   },
                   statusCode: {
                      404: function() {
                         alert('Not found');
                      }
                   },
                   error:function(x,xs,xt){
                      //window.open(JSON.stringify(x));
                      //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
                   }
                });

            }

            load_DataTable();

            load_users();

            $("select#usuario_ids").select2({
              tags: true
            });


        });
    </script>
</body>

</html>
