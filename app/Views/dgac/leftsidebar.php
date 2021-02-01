

<?php 
    
    $session = session();
    // echo var_dump($session->aulavirtual);
    $menu = $session->menu;
    $aula = $session->aulavirtual;

?>

<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <?php if( isset($menu['role_permisos']) ){ ?>
                <?php foreach ($menu['role_permisos'] as $key => $value) { ?>

                    <?php if( ($value->tipo == 1 ) && ($value->id_gm)){ ?>
                        <li class="sidebar-item">
                            <a data-acceso="<?php echo $value->acceso; ?>" class="sidebar-link two-column waves-effect waves-dark show-acceso" href='<?php echo base_url("public/$value->url"); ?>' aria-expanded="false">
                                <i class="mdi <?php echo $value->icono; ?>"></i>
                                <span class="hide-menu"><?php echo $value->nombre; ?></span>
                            </a>
                        </li>
                    <?php } ?>



                <?php } ?>
                <?php } ?>

                <?php if( isset($aula) && !empty($aula) ){ ?>
                    <li class="sidebar-item">
                            <a class="sidebar-link two-column waves-effect waves-dark show-acceso active" style="background-color: #7460ee;" href='<?=$aula;?>' aria-expanded="false">
                                <i class="mdi "></i>
                                <span class="hide-menu">Aula Virtual</span>
                            </a>
                        </li>
                <?php } ?>

                
                
            </ul>
        </nav>
        <input type="hidden"  id="countdown"class="timer">
        <!-- <label class="timer" style="margin: 0% 0% 0% 92%;margin-top: 1%;color:red;" id="countdown"> -->
        </label>
        <span hidden="" id="remainingSeconds"></span>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<script src="<?php echo base_url() ?>/assets/libs/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
    $( "a.show-acceso" ).click(function() {

        var acceso = $(this).data('acceso');
        
        $.ajax({
            url:'<?php echo base_url('public/Usuario/acceso_modulo'); ?>',
            method: 'post',
            data: { acceso: acceso },
            success: function(response){
                
            }
        });

    });
</script>