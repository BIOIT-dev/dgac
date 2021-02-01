<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/js/dataTables.checkboxes.min.js"></script>


</head>
<table name='#tabla_usuarios' id="tabla_usuarios" class="table table-striped table-bordered display" style="width:100%">
    <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm m-1"
                        onclick='checkboxTest()'>Eliminar</button>
    
</table>
<hr>
<p><b>Selected rows data:</b></p>
<pre id="example-console-rows"></pre>
<script>

    var dataSet = []
    <?php foreach($resultado_busqueda as $rb) { ?>
        dataSet.push(['<?php echo $rb->userid ?>', '<?php echo $rb->userid ?>', '<?php echo $rb->apellido_paterno ?>', 
                    '<?php echo $rb->apellido_materno ?>', '<?php echo $rb->nombres ?>',
                    '<button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm" onclick="checkboxTest()">Editar</button>']);
                //     checked.push("<?php //echo $rb->userid ?>");
        console.log(dataSet)
    <?php } ?>

    $(document).ready(function() {
        var table = $('#tabla_usuarios').DataTable({
            data: dataSet,
            columns: [
                { title: "" },
                { title: "Userid" },
                { title: "paterno" },
                { title: "materno" },
                { title: "nombre" },
                { title: "accion" }
            ],
            columnDefs: [
                {
                    'targets': 0,
                    'checkboxes': {
                        'selectRow': true,
                        // 'selectCallback': function(){
                        //     printSelectedRows();
                        // }
                    }
                }
            ],
            select: {
                style: 'multi'
            },
            order: [[1, 'asc']]
        });   
    });

    // Print selected rows
    function printSelectedRows(){
        var rows_selected = $('#tabla_usuarios').DataTable().column(0).checkboxes.selected();
        // console.log($('#tabla_usuarios').DataTable().toArray());
        console.log(rows_selected);
        // Output form data to a console     
        $('#example-console-rows').text(rows_selected.toString());
    };

    function checkboxTest(){
            var checked = [];
            checked = $('#tabla_usuarios').DataTable().column(0).checkboxes.selected();
            // <?php foreach($resultado_busqueda as $rb) { ?>
            //     name= document.getElementById("#md_checkbox_<?php echo $rb->userid ?>").innerHTML;
            //     console.log(name);
            //     // c = document.querySelector(".selected");
            //     // // console.log(c);
            //     // if (c){
            //     //     checked.push("<?php echo $rb->userid ?>");
            //     // }
            // <?php } ?>
            // var rows_selected;
            // table = $('#tabla_usuarios').DataTable( {
            //     columnDefs: [ {
            //         orderable: false,
            //         className: 'select-checkbox',
            //         targets:   0
            //     } ],
            //     select: {
            //         style:    'multi',
            //         selector: 'td:first-child'
            //     }
            // } );
            // rows_selected = table.rows({ selected: true }).data();
            console.log(checked);
        }


</script>
<!-- <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Export Table</h4>
                <div class="select">
                    <select class="form-control" id="locale">
                        <option value="en-US">en-US</option>
                        <option value="es-CL" selected>es-CL</option>
                    </select>
                </div>

                <div id="toolbar">
                    <button id="remove" class="btn btn-danger" disabled>
                        <i class="ti-trash"></i> Eliminar
                    </button>
                </div>
                <table id="exporttable" data-toolbar="#toolbar" data-search="true"
                    data-show-refresh="true" data-show-toggle="true" data-show-fullscreen="false"
                    data-show-columns="true" data-detail-view="true" data-show-export="true"
                    data-detail-formatter="detailFormatter" data-minimum-count-columns="2"
                    data-show-pagination-switch="true" data-pagination="true" data-id-field="id"
                    data-page-list="[10, 25, 50, 100, ALL]" data-show-footer="false"
                    data-side-pagination="server"
                    data-url="https://examples.wenzhixin.net.cn/examples/bootstrap_table/data"
                    data-response-handler="responseHandler">
                </table>
            </div>
        </div>
    </div>
</div> -->
<!-- <div class="col-md-3">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Warning message <small>(Click on image)</small></h4>
            <img src="<?php echo base_url() ?>/assets/images/alert/alert4.png" alt="alert" class="img-fluid model_img"
                id="sa-warning">
        </div>
    </div>
</div> -->

