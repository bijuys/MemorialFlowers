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

$route['404_override'] = 'welcome/notfound';

$route['default_controller'] = "welcome";
$route['in-memory-of/(:num)/(:any)'] = "welcome/in_memory_of/$1/$2";

$route['email-template'] = "welcome/email_template";

$route['administrator/login'] = 'admin/index';

$route['new-template'] = "welcome/new_template";
$route['test-page'] = "welcome/test_page";
$route['about-us'] = "welcome/aboutus";
$route['welcome/lifenews'] = "welcome/lifenews";
$route['scaffolding_trigger'] = "wsjkw";
$route['privacy-and-security'] = "welcome/policies";
$route['terms-of-use'] = "welcome/terms_of_use";
$route['faqs'] = "welcome/faqs";
$route['shop/add-last-visited/(:any)'] = "shop/add_last_visited/$1";

$route['test_new'] = "welcome/clava";
$route['exit_clava'] = "welcome/exit_clava";

$route['pages/(:any)'] = "welcome/page/$1";

$route['reports/daily_report/(:any)'] = "reports/daily_report/$1";

$route['pricing/(:num)/(:num)'] = "products/pricing/$1/$2";

$route['orders/review-invoice/(:any)'] = "welcome/print_invoice/$1";

$route['products/update-prices'] = "products/update_prices"; 
$route['products/update-main-pic'] = "products/update_main_pic"; 

$route['occasion/(:any)'] = "products/occasion/$1";
$route['color/(:any)'] = "products/color/$1";
//$route['category/(:any)'] = "products/show/$1";
$route['products/item/(:any)'] = "products/item/$1";
$route['vaseCollections'] = "products/vase_collections";
$route['vasebuilder'] = "products/vasebuilder";

$route['products/filter/(:num)/(:any)/(:num)/(:num)'] = "products/filter/$1/$2/$3/$4";
//$route['subcategory/(:any)'] = "products/subcategory/$1";
//$route['occasion/(:any)'] = "products/occasion/$1";
//$route['category/(:any)'] = "products/show/$1";
$route['subcategory/(:any)/(:num)'] = "products/subcategory/$1/$2";
$route['subcategory/(:any)/(:num)/(:any)'] = "products/subcategory/$1/$2/$3";
$route['subcategory/(:any)/(:num)/(:any)/(:num)'] = "products/subcategory/$1/$2/$3/$4";
$route['subcategory/(:any)/(:num)/(:any)/(:num)/(:num)'] = "products/subcategory/$1/$2/$3/$4/$5";

$route['products/catalog/(:num)/(:any)/(:num)/(:num)'] = "products/catalog/$1/$2/$3/$4";


$route['category/(:any)/(:num)'] = "products/show/$1/$2";
$route['category/(:any)/(:num)/(:any)'] = "products/show/$1/$2/$3";
$route['category/(:any)/(:num)/(:any)/(:num)'] = "products/show/$1/$2/$3/$4";
$route['category/(:any)/(:num)/(:any)/(:num)/(:num)'] = "products/show/$1/$2/$3/$4/$5";

$route['occasion/(:any)/(:num)'] = "products/occasion/$1/$2";
$route['category/(:any)/(:num)'] = "products/show/$1/$2";
//$route['subjects/(:num)/(:any)'] = 'subjects/view/$1/$2';

//$route['pricing/(:any)'] = "products/pricing/$1";
$route['sameday'] = "products/delivery/Sameday";
$route['location'] = "welcome/location";
$route['location2'] = "welcome/location2";
$route['signin'] = "user/signin";
$route['signup'] = "user/signup";
$route['signout'] = "user/logout";
$route['retrieve-account'] = "affiliates/get_account";
$route['myaccount'] = "user/myaccount";
$route['myaccount/(:any)'] = "user/$1";
$route['mymemorial/(:any)'] = "mymemorial/$1";
$route['mymemorial'] = "mymemorial/welcome";
$route['delivery/(:any)'] = "products/delivery/$1";
$route['grower-direct/'] = "products/delivery/Grower-Direct";
$route['search'] = "products/search/$1";
$route['international'] = "international";
$route['country/(:any)'] = "products/country/$1";
$route['contact'] = "contact";
$route['about-us'] = "contact/about_us";
$route['shipping-and-delivery'] = "contact/shipping_and_delivery";
$route['donate/(:any)'] = "welcome/donate/$1";
$route['contact/test'] = "contact/test";

$route['new-affiliate/(:any)'] = "welcome/test/$1";
$route['sci/(:any)'] = "welcome/sci/$1";

$route['confirm_delivery/(:any)'] = "welcome/confirm_del/$1";
$route['delivered/(:any)'] = "welcome/delivered/$1";

$route['(:any).html'] = "welcome/page/$1";
$route['affiliate/(:any)'] = "welcome";
$route['legacy/(:any)'] = "welcome";

$route['adminaff'] = "mymemorial/admin/welcome";


$route['^(?!siteadmin|products|user|translate|index.php|language|company|blog|affiliates|shop|support).*'] = "products/path_product/$0/$1";

/* $route['(:any)'] = "products/item/$1"; */


/* End of file routes.php */
/* Location: ./system/application/config/routes.php */