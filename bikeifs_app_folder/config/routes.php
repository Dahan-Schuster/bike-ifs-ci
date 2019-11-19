<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';

$route['login/usuario'] = 'home/login/usuario';
$route['login/funcionario'] = 'home/login/funcionario';
$route['login/admin'] = 'home/login/admin';

$route['admin/me'] = 'admin/index';
$route['admin']['POST'] = 'admin/insert';
$route['admin']['GET'] = 'admin/select_all';

$route['funcionario/me'] = 'funcionario/perfil';
$route['funcionario']['GET'] = 'funcionario/select_all';
$route['funcionario']['POST'] = 'funcionario/insert';

$route['usuario/me'] = 'usuario/perfil';
$route['usuario']['GET'] = 'usuario/select_all';
$route['usuario/(:num)']['GET'] = 'usuario/select/$1';
$route['usuario']['POST'] = 'usuario/insert';

$route['bicicleta']['GET'] = 'bicicleta/select_all';
$route['usuario/(:num)/bicicletas']['GET'] = 'bicicleta/select_from_user/$1';
$route['tagrfid/(:any)/bicicleta']['GET'] = 'bicicleta/select_from_uid/$1';
$route['bicicleta']['POST'] = 'bicicleta/insert';

$route['email/(:any)']['GET'] = 'email/select_from_day/$1';
$route['email']['POST'] = 'email/insert';   

$route['registro/(:any)']['GET'] = 'registro/select_from_day/$1';
$route['usuario/historico/(:any)']['GET'] = 'registro/select_from_day/$1/true';
$route['funcionario/historico/(:any)']['GET'] = 'registro/select_from_day/$1/true';
$route['usuario/(:num)/historico/(:any)']['GET'] = 'registro/select_from_day/$2/false/$1';
$route['registro/filtrar']['POST'] = 'registro/select_from_filter';
$route['registro/checkin']['POST'] = 'registro/insert';
$route['registro/checkout']['POST'] = 'registro/checkout';
$route['registro/checkout/desfazer']['POST'] = 'registro/undo_checkout';

$route['tagRFID']['POST'] = 'tagRFID/insert';
$route['tagRFID']['GET'] = 'tagRFID/select_all';

$route['pendencias']['GET'] = 'requisicao/select_all_open';

$route['database/backup/baixar'] = 'database/download';
$route['database/backup/enviar'] = 'mailer/send_current_backup';
$route['database/backup/enviar/ultimo'] = 'mailer/send_last_backup';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
