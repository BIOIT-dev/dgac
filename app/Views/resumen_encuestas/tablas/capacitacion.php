<table name="tabla_carreras" id="tabla_carreras" class="table table-striped table-bordered display" style="width:100%">
    <!-- <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm m-1 ml-0"
                        onclick='modalSwal()'>Eliminar</button> -->
    <thead>
        <tr>
            <th colspan="16">Resumen General Capacitación</th>
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