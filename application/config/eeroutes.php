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
| 	example.com/class/method/id/
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
| There are two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['scaffolding_trigger'] = 'scaffolding';
|
| This route lets you set a "secret" word that will trigger the
| scaffolding feature for added security. Note: Scaffolding must be
| enabled in the controller in which you intend to use it.   The reserved 
| routes must come before any wildcard or regular expression routes.
|
*/
$route['index.php/test'] = "products/subcategory/mysubcat";
$route['404_override'] = 'welcome/notfound';

$route['default_controller'] = "welcome";
$route['scaffolding_trigger'] = "wsjkw";

$route['pages/(:any)'] = "welcome/page/$1";
$route['(:any).html'] = "welcome/page/$1";
$route['occasion/(:any)'] = "products/occasion/$1";
$route['color/(:any)'] = "products/color/$1";
$route['category/(:any)'] = "products/show/$1";
$route['products/item/(:any)'] = "products/item/$1";
$route['subcategory/(:any)'] = "products/subcategory/$1";
$route['sameday'] = "products/delivery/Sameday";
$route['signin'] = "user/signin";
$route['signup'] = "user/signup";
$route['signout'] = "user/logout";
$route['retrieve-account'] = "user/get_account";
$route['myaccount'] = "user/myaccount";
$route['myaccount/(:any)'] = "user/$1";
$route['delivery/(:any)'] = "products/delivery/$1";
$route['grower-direct/'] = "products/delivery/Grower-Direct";
$route['search'] = "products/search/$1";
$route['international'] = "international";
$route['country/(:any)'] = "products/country/$1";
$route['contact'] = "contact";
$route['contact/test'] = "contact/test";
$route['^(?!siteadmin|products|user|translate|index.php|language|company|blog|affiliates|shop|support).*'] = "products/path_product/$0/$1";

/* $route['(:any)'] = "products/item/$1"; */


/* End of file routes.php */
/* Location: ./system/application/config/routes.php */