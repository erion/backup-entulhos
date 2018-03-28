<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
/*
$route['^(\w{2})/(.*)$'] = '$2';
$route['^(\w{2})$'] = $route['default_controller'];
*/
$route['default_controller'] = "inicial";
$route['404_override'] = 'paginas/paginaErro';
$route['../inicial'] = "inicial/index";

/*
rotas colecao*/
$route['../colecao/detalhe/(:any)'] = 'colecao/detalhe/$1';
$route['../colecao/(:any)/(:any)'] = 'colecao/detalhes/$2';
$route['../colecao/(:any)'] = 'colecao/categoria/$1';
$route['../colecao'] = 'colecao/index';

$route['../onde-encontrar'] = 'ondeencontrar/index';
$route['../empresa'] = 'empresa/index';
$route['../campanha/old'] = 'campanha/old';
$route['../campanha'] = 'campanha/index';
$route['../naonda'] = 'naonda/index';
$route['../contato'] = 'contato/index';
$route['../cadastro'] = 'cadastro/index';
$route['../fale-conosco'] = 'contato/index';

/*
$route['BR'] = 'inicial/index';
$route['EN'] = 'inicial/index/EN';
$route['SP'] = 'inicial/index/SP';
$route['empresa/(:any)'] = 'empresa/index/$1';

//colecao sem filtros
$route['../colecao/BR'] = 'colecao/index';
$route['colecao/EN'] = 'colecao/index/todos/EN';
$route['colecao/SP'] = 'colecao/index/todos/SP';
//colecao com filtros

$route['colecao/detalhe/(:any)'] = 'colecao/detalhe/$1';
$route['colecao/detalhes/(:any)/(:any)/(:any)'] = 'colecao/detalhes/$1/$2/$3';
$route['colecao/detalhes/(:any)/(:any)'] = 'colecao/detalhes/$1/$2';
$route['colecao/(:any)/(:any)'] = 'colecao/index/$1/$2';
$route['colecao/(:any)'] = 'colecao/index/$1';
*/

/* End of file routes.php */
/* Location: ./application/config/routes.php */