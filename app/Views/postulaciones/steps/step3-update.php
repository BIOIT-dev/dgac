<!-- <section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Documentos</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table name="tabla_comprobantes" id="tabla_comprobantes" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Archivo</th>
                                    <th scope="col">Subido</th>
                                    <th scope="col">Acción</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Archivo</th>
                                    <th scope="col">Subido</th>
                                    <th scope="col">Acción</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

<section>
    <div class="row">
        <?php foreach($tiposArchivo as $rp){ ?>
            <div class="col-sm-12 col-lg-4">
                <div class="form-group row">
                    <!-- <label for="rut" class="col-sm-3 text-right control-label col-form-label"></label> -->
                    <div class="col-sm-12">
                        <input type="text" maxlength="10" class="form-control form-control-line" value="<?= $rp->tiar_nombre ?>" disabled>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-3">
                <div class="form-group row">
                    <!-- <label for="rut" class="col-sm-3 text-right control-label col-form-label"></label> -->
                    <?php 
                        if(isset($rp->archivo_data)){
                            $nombre_archivo =  $rp->archivo_data;
                        }else{
                            $nombre_archivo = 'NULL';
                        } ?>
                    <div class="col-sm-12">
                        <input type="text" maxlength="10" class="form-control form-control-line" value="<?= $nombre_archivo!='NULL'?$nombre_archivo:'' ?>" disabled>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-5">
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="custom-file">
                            <?php
                                if(isset($rp->archivo_data)){
                                    if($rp->archivo_data != ''){
                                        $obligatorio = '0';
                                    }else{
                                        $obligatorio = '1';
                                    }
                                }else{
                                    $obligatorio = '1';
                                } 
                            ?>
                            <input onchange="verInner('<?= $rp->oid ?>')" type="file" class="custom-file-input" name="archivo<?= $rp->oid ?>" id="archivo<?= $rp->oid ?>" <?= $obligatorio=='1' ? 'required' : '' ?>>
                            <label id="label-archivo<?= $rp->oid ?>" class="custom-file-label" for="archivo<?= $rp->oid ?>">Elegir Archivo <?= $obligatorio=='1' ? '(Requerido)' : '' ?></label>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!-- <button onClick="verInner()">VER</button> -->
    </div>
</section>

