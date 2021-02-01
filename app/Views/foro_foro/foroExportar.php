<?php
    use App\Models\ForoPostModel;

?>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>

    p {
        margin: 0 0  !important;
    }

    .table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
        border: 1px solid #1d1919;
        padding-right: 10px!important;
        padding-top: 2px !important;
        padding-bottom: 2px !important;
    }

    body {
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        font-size: 10px !important;
        line-height: 1.428571429;
        color: #333;
        background-color: #fff;
    }

    table {
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        font-size: 12px !important;
        line-height: 1.428571429;
        color: #333;
    }
</style> 

<br><br>
<div class="container">

    <div class="row">
        <div>
            <table class="col-md-12 table-bordered table-condensed border border-dark">
                
                <tbody>
                    <tr>
                        <td colspan="4">
                            <p class=" text-dark"><b>Categoria: <?=$categoria->nombre?></b></p>
                            <p class=" text-dark"><b>Foro: <?=$foro->nombre?></b></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <p class="col-xs-12" style="padding-left: 5px !important"> <?=$foro->descripcion?></p>
                        </td>
                    </tr>

                    <tr>
                            <td >
                                <p class="col-xs-12"><strong>Tema en Dicusión</strong></p>
                             
                            </td>
                            <td >
                                <p class="col-xs-12"><strong>Publicado por</strong></p>
                            </td>
                            <td >
                                <p class="col-xs-12"><strong>Respuestas</strong></p>
                            </td>
                            <td >
                                <p class="col-xs-12"><strong>Ultimo mensaje</strong></p>
                            </td>
                        </tr>
                 <?php
                    $oPost = new ForoPostModel($db);

                    foreach ($temas as $t) {
                        
                        $cant_resp = $oPost->getCountPost($t->oid);
                        $ultimo = $oPost->getLastPost($t->oid);

                        if($cant_resp > 0){
                      ?>
                        <tr>
                            <td >
                                <p class="col-xs-12"><?=$t->asunto?></p>
                             
                            </td>
                            <td >
                                <p class="col-xs-12 text-center">
                                    
                                        <?=$t->apellidos.", ".$t->nombres?>
                                    
                                </p>
                                <p class="col-xs-12 text-center">
                                     <?=date('d/m/Y h:i:s', strtotime($t->fecha))?>
                                </p>
                            </td>
                            <td >
                                <p class="col-xs-12 text-center">
                                    <?=$cant_resp?>
                                </p>
                            </td>
                            <td >
                                <p class="col-xs-12 text-center"><?=date('d/m/Y h:i:s', strtotime($ultimo))?></p>
                            </td>
                        </tr>
                        <?
                                }//Fin del if
                            }
                        ?>
                </tbody>
            </table>

        </div>
    </div>

       <br>

        <?php
            $oPost = new ForoPostModel($db);

            foreach ($temas as $t) {
                
                $cant_resp = $oPost->getCountPost($t->oid);
                $ultimo = $oPost->getLastPost($t->oid);

                if($cant_resp > 0){
        ?>
            <div class="row">
                <table class="col-md-12 table-bordered table-condensed border border-dark">
                    <tbody>
                         <tr>
                            <td colspan="4">
                                <p style="font-size: 13 !important">
                                    <strong> <?=date('d/m/Y h:i:s', strtotime($t->fecha))?> </strong>
                                </p>
                                <p style="font-size: 13 !important">
                                    <strong>Autor: <?=$t->apellidos.", ".$t->nombres?>
                                    </strong>
                                </p>
                                <p style="font-size: 13 !important">
                                    <strong><?=$t->asunto?></strong>
                                </p>
                            </td>
                         
                        </tr>
                        <tr>
                            <td>
                                <p class="col-xs-12"><?=$t->texto?></p>
                             
                            </td>
                        </tr>
                    <?
                        $respuestas = $oPost->getPostResponseData($t->oid);


                        foreach ($respuestas as $resp) {

                        ?>
                            <tr>
                                <td colspan="4">
                                    <p><?=date('d/m/Y h:i:s', strtotime($resp->fecha))?>
                                    </p>
                                    <p>
                                        Publicado por: <? echo $resp->apellidos.", ".$resp->nombres?>
                                    </p>
                                    <p>
                                         <?=$resp->asunto?>
                                    </p>
                                 
                                    <p style="padding-top: 10px !important">
                                         <?=$resp->texto?>
                                    </p>
                                </td>
                            </tr>
                        <?

                        }
                        ?>
                    </tbody>
                </table>
        </div>
        <br>
        <?
                }//Fin del if
            }
        ?>
</div>