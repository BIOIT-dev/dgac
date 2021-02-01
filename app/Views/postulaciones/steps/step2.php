<section>
    <div class="form-group row">
        <label for="post_mat" class="col-sm-3 control-label">Matemática <code>*</code></label>
        <div class="col-sm-9">
            <div class="input-group">
                <input type="number" class="form-control" name="post_mat" id="post_mat" min="0" max="850" value="<?= isset($data_postulacion)?$data_postulacion->post_mat:'' ?>">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="post_len" class="col-sm-3 control-label">Lenguaje <code>*</code></label>
        <div class="col-sm-9">
            <div class="input-group">
                <input type="number" class="form-control" name="post_len" id="post_len" min="0" max="850" value="<?= isset($data_postulacion)?$data_postulacion->post_len:'' ?>">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="post_nem" class="col-sm-3 control-label">NEM <code>*</code></label>
        <div class="col-sm-9">
            <div class="input-group">
                <input type="number" class="form-control" name="post_nem" id="post_nem" min="0" max="850" value="<?= isset($data_postulacion)?$data_postulacion->post_nem:'' ?>">
            </div>
        </div>
    </div>
</section>