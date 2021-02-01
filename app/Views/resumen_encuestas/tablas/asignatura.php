<table name="tabla_carreras" id="tabla_carreras" class="table table-striped table-bordered display" style="width:100%">
    Seleccione una carrera, posteriormente seleccione una asignatura y luego haga click en "Agregar" para que se anexe a la tabla de comparación
    <div class="mt-4 md-4 col-md-6">
        <div class="input-group">
            <select class="form-control" id="inputSelectCarrera" onchange="filtrarElementTabla('getAsignaturas')">
                <option value="null">------ Seleccione una Carrera ------</option>
                <?php foreach($carreras as $c){?>
                    <option value="<?=$c->oid?>"><?= $c->nombre ?></option>
                <?}?>
            </select>
        </div>
    </div>
    <div class="mt-4 md-4 col-md-6">
        <div class="input-group">
            <select class="form-control" id="inputSelectAsignatura">
                <option value="null">------ Seleccione una Asignatura ------</option>
            </select>
            <div class="input-group-append">
                <button class="btn btn-outline-success" type="button" onclick="cargarElementTabla('loadAsignatura', 'inputSelectAsignatura')">Agregar</button>
                <button class="btn btn-outline-danger" type="button" onclick="quitarElementTabla('inputSelectAsignatura')">Quitar</button>
            </div>
        </div>
    </div>
    <hr>
    <thead>
        <tr>
            <th colspan="16">Resumen por Asignaturas</th>
        </tr>
        <tr>
            <th colspan="1"></th>
            <th colspan="1">Años</th>
            <?php for($i = date("Y"); $i >= date("Y") - 6; $i--){ ?>
                <th colspan="2"><?php echo $i ?></th>
            <?php } ?>
        </tr>
        <tr>
            <th></th>
            <th scope="col">Semestres</th>
            <?php for($i = 0; $i < 7; $i++){ ?>
                <th scope="col">1</th>
                <th scope="col">2</th>
            <?php } ?>
        </tr>
    </thead>
</table>