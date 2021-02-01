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
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <!-- Tabs -->
                            <!-- Tabs -->
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
                                    <div class="card-body">
                                        <form onsubmit="return valForm(this);" action="<?php echo base_url('public/encuesta/crear_encuesta'); ?>" name="encuesta_create" id="f" method="post" accept-charset="utf-8" class="form-horizontal form-material">
                                            <div class="form-group" hidden>
                                                <small><label class="col-md-12">oid</label></small>
                                                <div class="col-md-12">
                                                    <input name="oid_usuario" type="text" class="form-control form-control-line" value="<?= $profile_data['oid'] ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Título</label></small>
                                                <div class="col-md-12">
                                                    <input name="titulo" type="text" size="50" value="" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Tipo</label></small>
                                                <div class="col-md-12">
                                                    <select name="tipo" id="tipo" class="form-control" onchange="dimensiones(this);">
                                                        <option value="EDO">Encuesta de Observación</option>
                                                        <option value="EPO">Encuesta de Observación (a y b con Porcentaje)</option>
                                                        <option value="EVD">Encuesta de Observación (Evaluación Docente)</option>
                                                        <option value="TLI" selected='selected'>Banco de Preguntas para Evaluaciones</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="divBLK" style="display:none">
                                                <div class="form-group">
                                                    <small><label class="col-md-12" id="txtBLK1" style="display:none">Labor Administrativa</label></small>
                                                    <div class="col-md-12">
                                                        <input id="BLK1" name="BLK1" type="number" placeholder="10%" class="form-control form-control-line" min="0" style="display:none">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <small><label class="col-md-12" id="txtBLK2" style="display:none">Destreza pedagógica</label></small>
                                                    <div class="col-md-12">
                                                        <input id="BLK2" name="BLK2" type="number" placeholder="30%" class="form-control form-control-line" min="0" style="display:none">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <small><label class="col-md-12" id="txtBLK3" style="display:none">Prácticas evaluativas</label></small>
                                                    <div class="col-md-12">
                                                        <input id="BLK3" name="BLK3" type="number" placeholder="30%" class="form-control form-control-line" min="0" style="display:none">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <small><label class="col-md-12" id="txtBLK4" style="display:none">Relaciones interpersonales</label></small>
                                                    <div class="col-md-12">
                                                        <input id="BLK4" name="BLK4" type="number" placeholder="15%" class="form-control form-control-line" min="0" style="display:none">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <small><label class="col-md-12" id="txtBLK5" style="display:none">Características personales</label></small>
                                                    <div class="col-md-12">
                                                        <input id="BLK5" name="BLK5" type="number" placeholder="15%" class="form-control form-control-line" min="0" style="display:none">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Buscar en</label></small>
                                                <div class="col-md-12">
                                                    <select name="oid_grupo" class="form-control">
                                                        <option value="0" selected='selected'>Todas las Comunidades</option>
                                                        <?php foreach($query as $que) { ?>
                                                            <option value="<?php echo $que->oid ?>"><?php echo $que->nombre ?></option>
                                                        <?php } ?>
                                                    </select>
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
    <script src="<?php echo base_url() ?>/assets/libs/ckeditor/ckeditor.js"></script>
    <script>
        function dimensiones(obj) {
            var valorSeleccionado = obj.options[obj.selectedIndex].value;

            if ( valorSeleccionado == "EVD" ) { 
                document.getElementById("BLK1").style.display  = "initial";
                document.getElementById("BLK2").style.display  = "initial";
                document.getElementById("BLK3").style.display  = "initial";
                document.getElementById("BLK4").style.display  = "initial";
                document.getElementById("BLK5").style.display  = "initial";
                
                document.getElementById("txtBLK1").style.display  = "initial";
                document.getElementById("txtBLK2").style.display  = "initial";
                document.getElementById("txtBLK3").style.display  = "initial";
                document.getElementById("txtBLK4").style.display  = "initial";
                document.getElementById("txtBLK5").style.display  = "initial";
                document.getElementById("divBLK").style.display  = "initial";
            }
            if ( valorSeleccionado == "EDO"|| valorSeleccionado == "EPO"||valorSeleccionado =="TLI") {    
                document.getElementById("BLK1").style.display  = "none";
                document.getElementById("BLK2").style.display  = "none";
                document.getElementById("BLK3").style.display  = "none";
                document.getElementById("BLK4").style.display  = "none";
                document.getElementById("BLK5").style.display  = "none"; 
            
                document.getElementById("txtBLK1").style.display  = "none";
                document.getElementById("txtBLK2").style.display  = "none";
                document.getElementById("txtBLK3").style.display  = "none";
                document.getElementById("txtBLK4").style.display  = "none";
                document.getElementById("txtBLK5").style.display  = "none"; 
                document.getElementById("divBLK").style.display  = "none";
            }
        }
    </script>
    <script type="text/javascript">
        function valForm( f ){
            var msg="";
            var o;
            var BLK1 = document.getElementById("BLK1").value;  
            var BLK2 =  document.getElementById("BLK2").value; 
            var BLK3 =  document.getElementById("BLK3").value; 
            var BLK4 = document.getElementById("BLK4").value; 
            var BLK5 =  document.getElementById("BLK5").value; 
            var tipo =document.getElementById("tipo").value; 


            var sum=parseInt(BLK1)+parseInt(BLK2)+parseInt(BLK3)+parseInt(BLK4)+parseInt(BLK5);
            var res=Number.isNaN(sum);


            if(tipo=="EVD" ){
                if(BLK1==""){
                    alert("Labor Administrativa NO puede quedar vacio");
                    document.getElementById("BLK1").focus();
                    return false;
                }else if(BLK2==""){
                    alert("Destreza pedagógica NO puede quedar vacio");
                    document.getElementById("BLK2").focus();
                    return false;
                }else if(BLK3==""){
                    alert("Prácticas evaluativas NO puede quedar vacio");
                    document.getElementById("BLK3").focus();
                    return false;
                }else if(BLK4==""){
                    alert("Relaciones interpersonales NO puede quedar vacio");
                    document.getElementById("BLK4").focus();
                    return false;
                }else if(BLK5==""){
                    alert("Características personales NO puede quedar vacio");
                    document.getElementById("BLK5").focus();
                    return false;
                }
            }
            if(res!=true){
                if(sum!=100){
                    alert("La suma de los pesos de las dimensiones debe ser iguales a 100%");
                    document.getElementById("BLK1").focus();
                    return false;
                }  
            }
        }
    </script>
</body>

</html>