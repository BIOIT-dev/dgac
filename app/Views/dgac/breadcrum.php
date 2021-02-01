<div class="row page-titles">
    <div class="col-md-12 col-12 align-self-center">
        <?php $session = session();?>
        <h3 class="text-themecolor mb-0"><?php echo $session->grupo_nombre; ?></h3>
        <?php
        // echo var_dump($this->uri->segment(2));
        ?>
        <ol class="breadcrumb mb-0">
            <!-- <li class="breadcrumb-item">inicio</li> -->
            <?php
                if (isset($headers['ubicacion_url'])){
                    $url = $headers['ubicacion_url'];
                }else{
                    $url = "/#";
                }
            ?>
            <li class="breadcrumb-item"><a href="<?php echo base_url($url); ?>"><?php echo $headers['ubicacion']; ?></a></li>
            <? echo CrearBreadCrum();?>
        </ul>
    </div>
    
</div>