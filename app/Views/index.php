<?php 
    $session = session();
    $menu = $session->menu;
?>
<?php echo $headers['headersView']; ?>
<link href="<?php echo base_url() ?>/assets/libs/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet" />

<style>
img.swal2-image {
    height: 100px !important;
    border-radius: 15px !important;
}
</style>
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
                <div class="row">
                    <!-- Column -->
					
                    <!-- Inicio Panel de noticias  -->
                    <!-- ============================================================== -->
                    <div class="col-lg-8 col-md-12">
                        <div class="row">
                            <?php foreach ($noticias as $key => $value) { ?>
                            <div class="card blog-widget col-lg-12 col-md-12">
                                <div class="card-body">
                                    <div class="blog-image">
                                        <?php if ($value->foto_grande){
                                            $imagen = base_url("assets/uploads/noticias/$value->foto_grande");
                                        }else{
                                            $imagen = base_url("assets/images/not_image.png");
                                        } ?>
                                        <img src="<?php echo $imagen; ?>" alt="img" class="img-fluid blog-img-height w-100" />
                                    </div>
                                    <h3>
                                        <a style="cursor: pointer;" data-id='<?php echo $value->oid; ?>' class="visita" data-href="<?php echo base_url('public/Noticias/noticiaPreviewPublic/'.$value->oid); ?>">
                                            <?php echo $value->titulo; ?>
                                        </a>
                                    </h3>
                                    <label class="badge badge-pill badge-success py-1 px-2">Mantención</label> <?php echo $value->datetime ?>
                                    <p class="my-3">
                                        <?php echo strip_tags($value->resumen,'<a>'); ?>
                                    </p>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        
                    <!-- Inicio del calendario -->
                    <div class="row">
                        <div class="card blog-widget col-lg-12 col-md-12">
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center mb-4">
                                    <h4 class="card-title">Agenda</h4>
                                    <div class="ml-auto">
                                        <div class="btn-group">
                                            <a class="btn btn-dark" href="<?php echo site_url('home/index/pasadas'); ?>">
                                                Pasadas
                                            </a>
                                            <a class="btn btn-dark" href="<?php echo site_url('home/index/hoy'); ?>">
                                                Hoy
                                            </a>
                                            <a class="btn btn-dark" href="<?php echo site_url('home/index/proximas'); ?>">
                                                Proximas
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin calendario -->

                    </div>
                    <!-- Fin Panel de noticias  -->
                    <!-- ============================================================== -->
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Últimos Documentos en la Biblioteca</h4>
                                <ul class="feeds m-0 p-0 pt-2 scrollable" >
                                    <?php foreach ($UltimosDocumentos as $key => $value) { ?>
                                        <div class="feed-item d-flex py-2 align-items-center">
                                            <a href="javascript:void(0)"
                                            class="btn btn-danger btn-circle font-18 p-3 text-white d-flex align-items-center justify-content-center"><i
                                                class="far fa-file-pdf"></i></a>
                                            <div class="ml-3 text-truncate">
                                                <a href='<?php echo base_url("public/bibliotecas/biblioComment/".$value->oid); ?>'>
                                                    <?= $value->titulo; ?>
                                                </a>

                                            </div>
                                            <!-- <div class="justify-content-end text-truncate ml-auto">
                                                <span class="font-12 text-muted">Just Now</span>
                                            </div> -->
                                        </div>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Links Directos</h4>
                                <ul class="feeds m-0 p-0 pt-2 scrollable" >
                                <?php foreach ($linksDirectos as $key => $value) { ?>
                                    <div class="feed-item d-flex py-2 align-items-center">
                                        <a href="javascript:void(0)"
                                            class="btn btn-danger btn-circle font-18 p-3 text-white d-flex align-items-center justify-content-center"><i
                                                class="far fa-file-pdf"></i></a>
                                        <div class="ml-3 text-truncate">
                                            <?php 
                                            if( $value->origen=='FOROS' ){
                                                $url="foros/";
                                              }
                                              elseif( $value->origen=='ENCUESTA' ){
                                                $url="encuestas/";
                                              }
                                              elseif( $value->origen=='CURSO' ){
                                                $url="cursos/curso_detalle/".$value->p1;
                                              }
                                              elseif( $value->origen=='BIBLIO' ){
                                                $url="bibliotecas/biblioComment/".$value->p1;
                                              }
                                            
                                            ?>
                                            <a href="<?= $url ?>"><span class=""><?= $value->titulo ?></span></a>
                                        </div>
                                    </div>
                                <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <!-- Modal Encuestas -->
                        <div id="modalEncuestas" class="swal2-container swal2-center swal2-fade swal2-shown" style="overflow-y: auto; display: none;">
                            <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
                                <div class="swal2-header">
                                    <div id="swal2-icon-modal" class="swal2-icon swal2-info swal2-animate-info-icon" style="display: flex;">
                                    </div>
                                    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Tienes encuestas sin responder</h2>
                                    <button onclick="modalClose()" type="button" class="swal2-close" aria-label="Close this dialog">×</button>
                                </div>
                                <div class="swal2-content">
                                    <div id="swal2-content" style="display: block;">
                                        <!-- Mensaje contenido -->
                                        Hay <b>encuestas</b> que no respondiste aún, dirígete al siguiente <b><a href="<?php echo base_url('public/encuestas/index'); ?>">link</a></b> para contestarlas
                                    </div>
                                    <div class="swal2-actions" style="display: flex;">
                                        <button onClick="noMostrar()" type="button" class="swal2-confirm swal2-styled" style="background-color:#DD6B55">No Mostrar más</button>
                                        <button onclick="modalClose()" type="button" class="swal2-cancel swal2-styled">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Encuestas -->
                    </div>
                </div>
                <!-- Row -->
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
    <script src="<?php echo base_url() ?>/assets/libs/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/fullcalendar/dist/locale/es.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url() ?>/assets/libs/sweetalert2/dist/sweetalert2.all.js"></script>
    <script src="<?php echo base_url() ?>/assets/extra-libs/sweetalert2/sweet-alert.init.js"></script>
    <script type="text/javascript">
        $( "a.visita" ).click(function() {
            
            var id = $(this).data('id');
            var href   = $(this).data('href');
            
            $.ajax({
                url:'<?php echo base_url('public/Noticias/noticiaVisitas'); ?>',
                method: 'post',
                data: { id: id },
                success: function(response){
                    window.location.href = href;
                }
            });

        });
    </script>
    <script>
        $(function() {
            // page is now ready, initialize the calendar...
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            var form = '';
            var today = new Date($.now());
            var defaultEvents = [
            <?php foreach($Agenda as $rb){ ?>
                {
                    title: '<?= $rb->titulo ?>',
                    user: '<?= $rb->oid_usuario ?>',
                    photo : '<?php echo base_url(fotoPerfil($rb->oid_usuario)); ?>',
                    start: '<?= $rb->laFecha ?> <?=$rb->laHora ?>',
                    // end: new Date($.now() - 399000000),
                    contenido:'<?=$rb->descripcion ?>',
                    className: 'bg-info'
                },
            <?php } ?>
            ];
            $('#calendar').fullCalendar({
            // put your options and callbacks here
            slotDuration: '00:60:00',
            locale: 'es',
                    /* If we want to split day time each 15minutes */
                    // minTime: '08:00:00',
                    // maxTime: '19:00:00',
                    defaultView: 'month',
                    handleWindowResize: true,

                    header: {
                        // left: 'prev,next today',
                        center: 'title',
                        // right: 'month,agendaWeek,agendaDay'
                        // right: 'month,agendaWeek,agendaDay'

                    },
                    events: defaultEvents,
                    eventClick: function(calEvent, jsEvent, view) {
                    
                        Swal.fire({
                            title: calEvent.title,
                            text: calEvent.contenido,
                            imageUrl: calEvent.photo,
                        });
                        $('.swal2-actions a').hide();
                    // alert('Event: ' + calEvent.contenido);
                    // alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
                    // alert('View: ' + view.name);

                    // change the border color just for fun
                    // $(this).css('border-color', 'red');

                    },
                    editable: false,
                    droppable: false, // this allows things to be dropped onto the calendar !!!
                    eventLimit: false, // allow "more" link when too many events
                    selectable: false,
            })

        });
    </script>
    <script>
        function modalClose(){
            document.querySelector("#modalEncuestas").style.display = "none";
        }

        function noMostrar(){
            var url = "<?php echo base_url('public/home/noMostrar'); ?>";
            $.post(url, {noMostrar: "0"}, function(data, status){
                if (status){
                    document.querySelector("#modalEncuestas").style.display = "none";
                }else{
                    console.log("ERROR");
                }
            });
        }

        window.onload = () => {
            encuestasFlag = '<?= $encuestas_flag ?>';
            mostrarEncuestas = '<?= $session->mostrar_encuestas ?>';
            let permisos = '<?= $menu['permisos']->rol ?>';
            if(permisos == 'ALU'){
                if(encuestasFlag == "0"){
                    document.querySelector("#modalEncuestas").style.display = "none";
                }else if(mostrarEncuestas == "0"){
                    document.querySelector("#modalEncuestas").style.display = "none";
                }else{
                    document.querySelector("#modalEncuestas").style.display = "block";
                }
            }
        }
    </script>
</body>

</html>
