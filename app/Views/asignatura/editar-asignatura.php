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
                                        <form action="<?php echo base_url('public/asignatura/editar/'.$profile_data_edit['oid']); ?>" name="carrera_crear" id="carrera_crear" method="post" accept-charset="utf-8" class="form-horizontal">
                                            <div class="form-group" hidden>
                                                <small><label class="col-md-12">oid</label></small>
                                                <div class="col-md-12">
                                                    <input name="oid" type="text" class="form-control form-control-line" value="<?= $profile_data_edit['oid'] ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Carrera</label></small>
                                                <div class="col-md-12">
                                                    <select id="carrera_oid" name="carrera_oid" class="form-control form-control-line">
                                                        <?php foreach($r_carreras as $r){ ?>
                                                            <option value="<?= $r->oid ?>" <?= ($profile_data_edit['carrera_oid']==$r->oid)?'selected':'' ?>><?= $r->nombre ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Semestre</label></small>
                                                <div class="col-md-12">
                                                    <select id="semestre" name="semestre" class="form-control form-control-line">
                                                        <option value="Primero" <? if($profile_data_edit['semestre']=='Primero'){ echo 'selected="selected"'; }?>>Primero</option>
                                                        <option value="Segundo" <? if($profile_data_edit['semestre']=='Segundo'){ echo 'selected="selected"'; }?>>Segundo</option>
                                                        <option value="Tercero" <? if($profile_data_edit['semestre']=='Tercero'){ echo 'selected="selected"'; }?>>Tercero</option>
                                                        <option value="Cuarto" <? if($profile_data_edit['semestre']=='Cuarto'){ echo 'selected="selected"'; }?>>Cuarto</option>
                                                        <option value="Quinto" <? if($profile_data_edit['semestre']=='Quinto'){ echo 'selected="selected"'; }?>>Quinto</option>
                                                        <option value="Sexto" <? if($profile_data_edit['semestre']=='Sexto'){ echo 'selected="selected"'; }?>>Sexto</option>
                                                        <option value="Séptimo" <? if($profile_data_edit['semestre']=='Séptimo'){ echo 'selected="selected"'; }?>>Séptimo</option>
                                                        <option value="Octavo" <? if($profile_data_edit['semestre']=='Octavo'){ echo 'selected="selected"'; }?>>Octavo</option>
                                                    </select>
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <small><label class="col-md-12">Nombre de la Asignatura</label></small>
                                                <div class="col-md-12">
                                                    <input name="asignatura" type="text" size="50" class="form-control form-control-line" value="<?= $profile_data_edit['asignatura'] ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <small><label class="col-md-12">Siglas</label></small>
                                                <div class="col-md-12">
                                                    <input name="sigla" type="text" size="50" class="form-control form-control-line" value="<?= $profile_data_edit['sigla'] ?>">
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
</body>

</html>