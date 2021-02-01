<?php
namespace App\Controllers;

/**
/ Funcion que permite verificar si existe en sesion,
  de lo contrario es redireccionado a login
*/
//~ function verify(){

	//~ $currentURL = current_url();
	//~ // echo $currentURL;
    //~ $config = \CodeIgniter\Config\Services::request()->config;
    //~ $baseUrl = ! empty($config->baseURL) && $config->baseURL !== '/'
			//~ ? rtrim($config->baseURL, '/ ') . '/'
			//~ : $config->baseURL;
	//~ // echo $baseUrl;
    //~ $url = new \CodeIgniter\HTTP\URI($baseUrl);
    //~ if (! empty($uri))
    //~ {
        //~ $url = $url->resolveRelativeURI($uri);
    //~ }
    //~ if (empty($protocol) && \CodeIgniter\Config\Services::request()->isSecure())
    //~ {
        //~ $protocol = 'https';
    //~ }

    //~ if (! empty($protocol))
    //~ {
        //~ $url->setScheme($protocol);
    //~ }
	//~ $uri = explode('/',explode($baseUrl,$currentURL)[1]);
	//~ // echo var_dump($uri);
    //~ $url_enviar = '';
	//~ // echo $uri[0] . "==" . "login";
	//~ $session = \Config\Services::session();
	
	//~ // echo var_dump($session->user_id);
	//~ if(isset($session->user_id)){
		//~ header("Location: ".base_url('public/index'));
	//~ }else{
		//~ if (($uri[0] == "login")){
			//~ // header("Location: ".base_url('public/index'));
			//~ return True;
		//~ }else{
			//~ header("Location: ".base_url('public/login'));
			//~ // echo "no1";
		//~ }
	//~ }
	//~ // exit;

//~ }

/**
/ Llamado de verificacion
*/
//~ $respuesta = verify();



/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['validate_session'];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		// $respuesta = $this->verify();
		// exit;
		parent::initController($request, $response, $logger);
		// exit;
		helper('breadcrum');
		helper('notificaciones');
		// $respuesta = $this->verify();

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
	}

}
