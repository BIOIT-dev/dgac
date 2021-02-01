<!-- Modal Asistencias -->
<div class="modal fade" id="modal-asistencias" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Agregar Día de Asistencia</h4>
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="pl-3 pr-3" action="<?php echo base_url('public/Cursos/asistencia/'.$id_curso); ?>" name="agregar_asistencia" id="agregar_asistencia" method="post" accept-charset="utf-8">
                    <div class="form-group" hidden>
                        <label for="tipo">Tipo</label>
                        <input name="tipo" id="tipo1" type="text" value="asistencia" class="form-control form-control-line">
                    </div>
                    <div class="form-group">
                        <label for="asis_fecha">Fecha</label>
                        <input name="asis_fecha" id="asis_fecha" type="date" value="<?= date ('Y-m-d'); ?>" class="form-control form-control-line">
                    </div>
                    <div class="form-group">
                        <label for="asis_horas">Horas<code>*</code></label>
                        <input name="asis_horas" id="asis_horas" type="number" min="0" class="form-control form-control-line" required>
                    </div>
                    <div class="form-group">
                        <label for="asis_inicio">Inicio<code>*</code></label>
                        <input name="asis_inicio" id="asis_inicio" type="time" value="<?= date ('H:i'); ?>" class="form-control form-control-line" required>
                    </div>
                    <div class="form-group">
                        <label for="asis_termino">Término</label>
                        <input name="asis_termino" id="asis_termino" type="time" value="<?= date ('H:i'); ?>" class="form-control form-control-line">
                    </div>
                    <div class="form-group">
                        <label for="asis_content">Contenido de la clase</label>
                        <textarea name="asis_content" id="asis_content" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="swal2-actions" style="display: flex;">
                        <button id="botonGrabarAsistencia" type="submit" class="btn btn-info waves-effect waves-light m-1 mb-3" aria-label="">Grabar</button>
                        <!-- <button onclick="modalClose()" type="button" class="btn btn-info waves-effect waves-light m-1 mb-3" aria-label="">Cancelar</button> -->
                        <button type="button" class="btn btn-secondary waves-effect waves-light m-1 mb-3" data-dismiss="modal"aria-hidden="true">Cancelar</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- FIN Modal Asistencias -->

<!-- Modal Justificaciones -->
<div class="modal fade" id="modal-justificaciones" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Justificaciones de horas</h4>
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="pl-3 pr-3" action="<?php echo base_url('public/Cursos/asistencia/'.$id_curso); ?>" name="justificaciones_horas" id="justificaciones_horas" method="post" accept-charset="utf-8">
                    <div class="form-group" hidden>
                        <label for="tipo">Tipo</label>
                        <input name="tipo" id="tipo2" type="text" value="justificaciones" class="form-control form-control-line">
                    </div>
                    <div class="form-group">
                        <label for="alumno_justificacion">Alumno<code>*</code></label>
                        <select id="alumno_justificacion" name="alumno_justificacion" class="form-control form-control-line" onchange="getFecha()">
                            <option value="null">--- Seleccionar ---</option>
                            <?php foreach($alumnos as $r){ ?>
                                <option value="<?= $r->oid ?>"><?= $r->rut." ".$r->nombres." ".$r->apellidos ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="asis_horas">Fecha Ausente</label>
                        <select id="fecha_justificacion" name="fecha_justificacion" class="form-control form-control-line" onchange="getHorasJ(this.options[this.selectedIndex].text)">
                            <option value="null">--- Seleccionar ---</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="horas_justificadas">H. Justificadas<code>*</code></label>
                        <input name="horas_justificadas" id="horas_justificadas" type="number" min="1" class="form-control form-control-line" required>
                    </div>
                    <div class="swal2-actions" style="display: flex;">
                        <button id="botonGrabarHoras" type="submit" class="btn btn-info waves-effect waves-light m-1 mb-3" aria-label="">Grabar</button>
                        <!-- <button onclick="modalClose()" type="button" class="btn btn-info waves-effect waves-light m-1 mb-3" aria-label="">Cancelar</button> -->
                        <button type="button" class="btn btn-secondary waves-effect waves-light m-1 mb-3" data-dismiss="modal"aria-hidden="true">Cancelar</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Modal Justificaciones -->

<!-- Modal Atrasos -->
<div class="modal fade" id="modal-atrasos" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Registro de atrasos</h4>
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="pl-3 pr-3" action="<?php echo base_url('public/Cursos/asistencia/'.$id_curso); ?>" name="registro_atrasos" id="registro_atrasos" method="post" accept-charset="utf-8">
                    <div class="form-group" hidden>
                        <label for="tipo">Tipo</label>
                        <input name="tipo" id="tipo3" type="text" value="atrasos" class="form-control form-control-line">
                    </div>
                    <div class="form-group">
                        <label for="alumno_atraso">Alumno<code>*</code></label>
                        <select id="alumno_atraso" name="alumno_atraso" class="form-control form-control-line" onchange="getFechaAtraso()">
                            <option value="null">--- Seleccionar ---</option>
                            <?php foreach($alumnos as $r){ ?>
                                <option value="<?= $r->oid ?>"><?= $r->rut." ".$r->nombres." ".$r->apellidos ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fecha_atraso">Fecha Atraso</label>
                        <select id="fecha_atraso" name="fecha_atraso" class="form-control form-control-line">
                            <option value="null">--- Seleccionar ---</option>
                        </select>
                    </div>
                    <!-- <div class="form-group">
                        <label for="horas_justificadas">H. Justificadas<code>*</code></label>
                        <input name="horas_justificadas" id="horas_justificadas" type="number" min="1" class="form-control form-control-line" required>
                    </div> -->
                    <div class="swal2-actions" style="display: flex;">
                        <button id="botonGrabarAtraso" type="submit" class="btn btn-info waves-effect waves-light m-1 mb-3" aria-label="">Grabar</button>
                        <!-- <button onclick="modalClose()" type="button" class="btn btn-info waves-effect waves-light m-1 mb-3" aria-label="">Cancelar</button> -->
                        <button type="button" class="btn btn-secondary waves-effect waves-light m-1 mb-3" data-dismiss="modal"aria-hidden="true">Cancelar</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Modal Atrasos -->

<!-- Modal Atrasos -->
<div class="modal fade" id="modal-atrasos-diaria" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Registro de atrasos</h4>
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="pl-3 pr-3" action="<?php echo base_url('public/Cursos/asistencia_diaria/'.$id_curso); ?>" name="registro_atrasos" id="registro_atrasos" method="post" accept-charset="utf-8">
                    <div class="form-group" hidden>
                        <label for="tipo">Tipo</label>
                        <input name="tipo" id="tipo3" type="text" value="atrasos" class="form-control form-control-line">
                    </div>
                    <div class="form-group" hidden>
                        <label for="id_asistencia">ID Asistencia</label>
                        <input name="id_asistencia" id="id_asistencia" type="text" value="<?= (isset($id_asistencia))?$id_asistencia:'' ?>" class="form-control form-control-line">
                    </div>
                    <div class="form-group">
                        <label for="oid_usuario">Alumno<code>*</code></label>
                        <select id="alumno_atraso2" name="oid_usuario" class="form-control form-control-line">
                            <option value="null">--- Seleccionar ---</option>
                            <?php foreach($alumnos as $r){ ?>
                                <? if(isset($r->asistencia) && $r->asistencia == 2){ ?>
                                    <option value="<?= $r->oid ?>"><?= $r->rut." ".$r->nombres." ".$r->apellidos ?></option>
                                <? } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="asus_horajust">H. Ausente<code>*</code></label>
                        <input name="asus_horajust" id="asus_horajust" type="number" min="1" max="<?= isset($asistencia[0]['asis_horas'])?$asistencia[0]['asis_horas']:'' ?>" class="form-control form-control-line" required>
                    </div>
                    <div class="form-group">
                        <label for="asus_llegada">H. Llegada</label>
                        <input name="asus_llegada" id="asus_llegada" type="time" value="<?= date ('H:i'); ?>" class="form-control form-control-line">
                    </div>
                    <div class="swal2-actions" style="display: flex;">
                        <button id="botonGrabarAtraso" type="submit" class="btn btn-info waves-effect waves-light m-1 mb-3" aria-label="">Grabar</button>
                        <!-- <button onclick="modalClose()" type="button" class="btn btn-info waves-effect waves-light m-1 mb-3" aria-label="">Cancelar</button> -->
                        <button type="button" class="btn btn-secondary waves-effect waves-light m-1 mb-3" data-dismiss="modal"aria-hidden="true">Cancelar</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Modal Atrasos -->

<!-- Modal Editar Asistencias -->
<div class="modal fade" id="modal-editar-asistencias" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Editar Día de Asistencia</h4>
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="pl-3 pr-3" action="<?php echo base_url('public/Cursos/editar_asistencia/'.$id_curso); ?>" name="editar_asistencia" id="editar_asistencia" method="post" accept-charset="utf-8">
                    <div class="form-group" hidden>
                        <label for="oid">ID Asistencia</label>
                        <input name="oid" id="edit_id_asistencia" type="text" class="form-control form-control-line">
                    </div>
                    <div class="form-group">
                        <label for="asis_fecha">Fecha</label>
                        <input name="asis_fecha" id="edit_asis_fecha" type="date" class="form-control form-control-line">
                    </div>
                    <div class="form-group">
                        <label for="asis_horas">Horas<code>*</code></label>
                        <input name="asis_horas" id="edit_asis_horas" type="number" min="0" class="form-control form-control-line" required>
                    </div>
                    <div class="form-group">
                        <label for="asis_inicio">Inicio<code>*</code></label>
                        <input name="asis_inicio" id="edit_asis_inicio" type="time" class="form-control form-control-line" required>
                    </div>
                    <div class="form-group">
                        <label for="asis_termino">Término</label>
                        <input name="asis_termino" id="edit_asis_termino" type="time" class="form-control form-control-line">
                    </div>
                    <div class="form-group">
                        <label for="asis_content">Contenido de la clase</label>
                        <textarea name="asis_content" id="edit_asis_content" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="swal2-actions" style="display: flex;">
                        <button id="botonEditAsistencia" type="submit" class="btn btn-info waves-effect waves-light m-1 mb-3" aria-label="">Grabar</button>
                        <button type="button" class="btn btn-secondary waves-effect waves-light m-1 mb-3" data-dismiss="modal"aria-hidden="true">Cancelar</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- FIN Modal Editar Asistencias -->