<?php 

use App\Models\NoticiasModel;
use App\Models\MensajesModel;

// namespace App\Controllers;
if(!function_exists("generarNotificaciones"))
{
 
	function generarNotificaciones($grupo_id,$user_id)
	{
    
    $notificaciones = new NoticiasModel($db);
    $resultado = $notificaciones->ultimasHistorias($grupo_id,$user_id);
    $html = '<li class="nav-item dropdown">'.
            '<a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>';
    if($resultado){
        $html = $html . '<div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>';
    }

    $html = $html . '</a>
                    <div class="dropdown-menu dropdown-menu-right mailbox scale-up">
                        <ul class="list-style-none">
                        <li>
                            <div class="border-bottom rounded-top py-3 px-4">
                                <h5 class="mb-0 font-weight-medium">Historial de Eventos</h5>
                            </div>
                        </li>
                        <li>
                            <div class="message-center notifications position-relative" style="height:250px;">';

foreach($resultado as $r){
    if( $r->accion=="AVISOS:ADD" ){
        $url="a/avisos/s";
        $titulo='Ha Ingresado un Aviso en el Diario Mural';
      }
      elseif( $r->accion=="BIBLIOTECA:ADD" ){
        $url="/biblio/biblioComment.php?oid=$r->oid_objeto";
        $titulo='Ha Ingresado un Documento en la Biblioteca';
      }
      elseif( $r->accion=="BIBLIOTECA:COMMENT" ){
        $url="/biblio/biblioComment.php?oid=$r->oid_objeto";
        $titulo='Ha Escrito un Comentario en la Biblioteca';
      }
      elseif( $r->accion=="FOROS:TEMAADD" ){
        $url="/foros/foro_tema_detalle.php?foid=&amp;toid=$r->oid_objeto";
        $titulo='Ha iniciado una Conversación en los Foros';
      }
      elseif( $r->accion=="FOROS:POSTADD" ){
        $url="/foros/foro_tema_detalle.php?foid=&amp;toid=$r->oid_objeto";
        $titulo='Ha Participado en los Foros';
      }
      elseif( $r->accion=="QSOY:COMMENT" ){
        $url="/comunidad/quienSoy.php?oid=$r->oid_objeto";
        $titulo='Te ha Escrito un Comentario';
      }
      elseif( $r->accion=="QSOY:VIEW" ){
        $url="/comunidad/quienSoy.php?oid=$r->oid_usuario";
        $titulo='Ha Visitado tu Quien Soy';
      }
      elseif( $r->accion=="QSOY:ADDFOTO" ){
        $url="/comunidad/misFotos.php?oid=$r->oid_usuario&amp;idx=$r->oid_extra";
        $titulo='Ha Agregado una Foto';
      }
      elseif( $r->accion=="MICOMUNIDAD:MISFOTOS:COMMENT" ){
        $url="/comunidad/misFotos.php?oid=$r->oid_usuario&amp;idx=$r->oid_objeto";
        $titulo='Ha Escrito un Comentario en una Foto';
      }
      elseif( $r->accion=="MICURSO:PIZARRA:ADD" ){
        $url="/miscursos/miCurso.php?coid=$r->oid_extra";
        $titulo='Ha Ingresado un Aviso en un Módulo';
      }
      elseif( $r->accion=="MICURSO:SCO:ADD" ){
        $url="/miscursos/miCurso.php?coid=$r->oid_extra";
        $titulo='Ha Ingresado un Objeto de Aprendizaje en un Módulo';
      }
      elseif( $r->accion=="MICURSO:EVALUACIONES:ADD" ){
        $url="/miscursos/miCurso.php?coid=$r->oid_extra";
        $titulo='Ha Ingresado una Evaluación en un Módulo';
      }
      elseif( $r->accion=="MICURSO:APUNTES:ADD" ){
        $url="/miscursos/miCurso.php?coid=$r->oid_extra";
        $titulo='Ha Ingresado un Documento en un Módulo';
        
      }
    $html = $html . '<a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2">
                        <span class="btn btn-danger rounded-circle btn-circle"><i class="fa fa-link"></i></span>
                        <div class="w-75 d-inline-block v-middle pl-2">
                            <h5 class="message-title mb-0 mt-1">'.$r->nombres.', '.$r->apellidos.'</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">'.$titulo.'</span> <span class="font-12 text-nowrap d-block text-muted">'.$r->laFecha.'</span> </div>
                    </a>';

    }

    $html = $html . '</div>
                                 </li>
                                 <!--<li>
                                     <a class="nav-link border-top text-center text-dark pt-3" href="javascript:void(0);"> <strong>Ver todas las notificaciones</strong> <i class="fa fa-angle-right"></i> </a>
                                 </li>-->
                             </ul>
                         </div>
                    </li>';                            
        return $html;

    }

    function generarNotificacionesCorreo($grupo_id,$user_id)
	{
    
    $notificaciones = new MensajesModel($db);
    $resultado = $notificaciones->get_my_mensajes($user_id);
    $html = '<li class="nav-item dropdown">'.
            '<a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                class="mdi mdi-email"></i>';
    if($resultado){
        $html = $html . '<div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>';
    }

    $html = $html . '</a>
                    <div class="dropdown-menu dropdown-menu-right mailbox scale-up">
                        <ul class="list-style-none">
                        <li>
                            <div class="border-bottom rounded-top py-3 px-4">
                                <h5 class="mb-0 font-weight-medium">Tienes mensajes nuevos</h5>
                            </div>
                        </li>
                        <li>
                            <div class="message-center notifications position-relative" style="height:250px;">';
    // var_dump($resultado);
    // return;
    foreach($resultado as $r){
        $sec = strtotime($r->fecha);  
        //converts seconds into a specific format  
        $newdate = date ("Y/d/m", $sec);    

        $html = $html . '<a href="' . base_url('public/mensajeria/ver/'.$r->oid) . '" class="message-item d-flex align-items-center border-bottom px-3 py-2">
        <span class="user-img position-relative d-inline-block"> <img src="'.base_url('assets/images/no_avatar.jpg').'" alt="user" class="rounded-circle w-100"> <span class="profile-status rounded-circle online"></span> </span>
        <div class="w-75 d-inline-block v-middle pl-2">
        <h5 class="message-title mb-0 mt-1">'.$r->nombres.$r->oid.'</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">'.substr(strip_tags($r->texto),0,50).'</span> <span class="font-12 text-nowrap d-block text-muted">'.$newdate.'</span> </div>
        </a>';

    }

    $html = $html . '</div>
                              </li>
                              <li>
                              <a class="nav-link border-top text-center text-dark pt-3" href="'.site_url('Mensajeria/inbox').'"> <b>Ver todos los mensajes</b> <i class="fa fa-angle-right"></i> </a>
                              </li>
                          </ul>
                      </div>
                </li>';                            
    return $html;

  }

}