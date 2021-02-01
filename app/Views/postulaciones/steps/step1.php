<section>
    <div class="row">
        <div class="col-sm-12 col-lg-6" hidden>
            <div class="form-group row">
                <label for="rut" class="col-sm-3 text-right control-label col-form-label">RUT<code>*</code></label>
                <div class="col-sm-9">
                    <input id="rut" name="rut" type="text" oninput="checkRut(this)" maxlength="10" class="form-control form-control-line" value="<?= $usuarioPostulante['rut'] ?>" required>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-6" hidden>
            <div class="form-group row">
                <label for="oid_grupo" class="col-sm-3 text-right control-label col-form-label">Grupo ID</label>
                <div class="col-sm-9">
                    <input id="oid_grupo" name="oid_grupo" type="text" class="form-control form-control-line" value="<?= $grupoPostulacion['oid'] ?>" required>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-6">
            <div class="form-group row">
                <label for="rut2" class="col-sm-3 text-right control-label col-form-label">RUT<code>*</code></label>
                <div class="col-sm-9">
                    <input id="rut2" name="rut2" type="text" oninput="checkRut(this)" maxlength="10" placeholder="Ej: 12345678-9" class="form-control form-control-line" value="<?= $usuarioPostulante['rut'] ?>" disabled>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-6">
            <div class="form-group row">
                <label for="periodo_vista" class="col-sm-3 text-right control-label col-form-label">Nombres<code>*</code></label>
                <div class="col-sm-9">
                <input name="nombres" type="text" placeholder="" class="form-control form-control-line" value="<?= $usuarioPostulante['nombres'] ?>" onkeypress="return check(event)" required>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <div class="form-group row">
                <label for="periodo_vista" class="col-sm-3 text-right control-label col-form-label">A. Paterno<code>*</code></label>
                <div class="col-sm-9">
                    <input name="apellido_paterno" type="text" placeholder="Apellido Paterno" class="form-control form-control-line" value="<?= $usuarioPostulante['apellido_paterno'] ?>" onkeypress="return check(event)" required>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-6">
            <div class="form-group row">
                <label for="periodo_vista" class="col-sm-3 text-right control-label col-form-label">A. Materno<code>*</code></label>
                <div class="col-sm-9">
                    <input name="apellido_materno" type="text" placeholder="Apellido Materno" class="form-control form-control-line" value="<?= $usuarioPostulante['apellido_materno'] ?>" onkeypress="return check(event)" required>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <div class="form-group row">
                <label for="peri_semestre" class="col-sm-3 text-right control-label col-form-label">Sexo</label>
                <div class="col-sm-9">
                    <select name="sexo" id="sexo" class="form-control">
                        <option value="">--- Seleccionar ---</option>
                        <option value="m" <?= ($usuarioPostulante['sexo']=='m')?'selected':''?>>Masculino</option>
                        <option value="f" <?= ($usuarioPostulante['sexo']=='f')?'selected':''?>>Femenino</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-6">
            <div class="form-group row">
                <label for="fecnac" class="col-sm-3 text-right control-label col-form-label">Fecha de Nacimiento<code>*</code></label>
                <div class="col-sm-9">
                    <input value="<?= $usuarioPostulante['fecnac'] ?>" name="fecnac" type="date" placeholder="" class="form-control form-control-line" required>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <div class="form-group row">
                <label for="ciudad" class="col-sm-3 text-right control-label col-form-label">Región</label>
                <div class="col-sm-9">
                    <select name="ciudad" id="ciudad" class="form-control" onchange="cargarComunas()">
                        <option value="">--- Seleccionar ---</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-6">
            <div class="form-group row">
                <label for="comuna" class="col-sm-3 text-right control-label col-form-label">Comuna</label>
                <div class="col-sm-9">
                    <select name="comuna" id="comuna" class="form-control">
                        <option value="">--- Seleccionar ---</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <div class="form-group row">
                <label for="peri_semestre" class="col-sm-3 text-right control-label col-form-label">Dirección<code>*</code></label>
                <div class="col-sm-9">
                    <input value="<?= $usuarioPostulante['direccion'] ?>" name="direccion" type="text" placeholder="" class="form-control form-control-line" onkeypress="return check(event)" required>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-6">
            <div class="form-group row">
                <label for="periodo_vista" class="col-sm-3 text-right control-label col-form-label">Teléfono<code>*</code></label>
                <div class="col-sm-9">
                    <input value="<?= $usuarioPostulante['fono'] ?>" name="fono" type="text" placeholder="" class="form-control form-control-line" onkeypress="return check(event)" required>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <div class="form-group row">
                <label for="peri_semestre" class="col-sm-3 text-right control-label col-form-label">Email<code>*</code></label>
                <div class="col-sm-9">
                    <input value="<?= $usuarioPostulante['email'] ?>" name="email" type="email" placeholder="" class="form-control form-control-line" required>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-6">
            <div class="form-group row">
                <label for="oid_sedes" class="col-sm-3 text-right control-label col-form-label">Sede de rendición<code>*</code></label>
                <div class="col-sm-9">
                    <select name="oid_sedes" id="oid_sedes" class="form-control" required>
                        <option value="">--- Seleccionar ---</option>
                        <?php foreach($sedes_rendicion as $sr){?>
                            <option value="<?=$sr->oid?>" <?= ($sedeRendicion==$sr->oid)?'selected':''?>><?= $sr->sede_nombre ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</section>