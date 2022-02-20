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
$route['default_controller'] = 'virtualstore';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//$route['category/:num'] = 'categoria/index';
//$route['category/create/:num'] = 'category/create';

//Rotas da loja virtual
$route['store/productPage/:num'] 													= "virtualstore/productPage/$1";

//Rotas Cliente

//Rotas Admin
$route['admin/category'] 																	= 'category/index';
$route['admin/category/index'] 														= 'category/index';
$route['admin/category/create'] 													= 'category/create';
$route['admin/category/edit/(:num)'] 											= 'category/create/$1';
$route['admin/category/save'] 														= 'category/save';
$route['admin/category/save/(:num)'] 											= 'category/save/$1';
$route['admin/category/changeStatus/(:num)']              = 'category/changeStatus/$1';

$route['admin/subcategory'] 															= 'subcategory/index';
$route['admin/subcategory/index'] 												= 'subcategory/index';
$route['admin/subcategory/create'] 												= 'subcategory/create';
$route['admin/subcategory/edit/(:num)'] 									= 'subcategory/create/$1';
$route['admin/subcategory/save'] 													= 'subcategory/save';
$route['admin/subcategory/save/(:num)'] 									= 'subcategory/save/$1';
$route['admin/subcategory/changeStatus/(:num)'] 					= 'subcategory/changeStatus/$1';

$route['admin/product'] 																	= 'product/index';
$route['admin/product/index'] 														= 'product/index';
$route['admin/product/create']														= 'product/create';
$route['admin/product/edit/(:num)'] 											= 'product/create/$1';
$route['admin/product/save'] 															= 'product/save';
$route['admin/product/save/(:num)'] 											= 'product/save/$1';
$route['admin/product/changeStatus/(:num)'] 							= 'product/changeStatus/$1';

//$route['admin/productimage'] 															= 'productimage/index';
//$route['admin/productimage/index'] 												= 'productimage/index';
$route['admin/productimage/view/(:num)'] 									= 'productimage/view_image/$1';
$route['admin/productimage/create/(:num)']								= 'productimage/create/$1';
$route['admin/productimage/edit/(:num)/(:num)'] 					= 'productimage/create/$1/$2';
$route['admin/productimage/save/(:num)'] 									= 'productimage/save/$1';
$route['admin/productimage/save/(:num)/(:num)'] 					= 'productimage/save/$1/$2';
$route['admin/productimage/changeStatus/(:num)'] 					= 'productimage/changeStatus/$1';

//$route['admin/productitem'] 															= 'productimage/index';
//$route['admin/productitem/index'] 												= 'productimage/index';
$route['admin/productitem/view/(:num)'] 									= 'productitem/view_item/$1';
$route['admin/productitem/create/(:num)']									= 'productitem/create/$1';
$route['admin/productitem/edit/(:num)/(:num)'] 						= 'productitem/create/$1/$2';
$route['admin/productitem/save/(:num)'] 									= 'productitem/save/$1';
$route['admin/productitem/save/(:num)/(:num)'] 						= 'productitem/save/$1/$2';
$route['admin/productitem/changeStatus/(:num)'] 					= 'productitem/changeStatus/$1';

$route['admin/item'] 																			= 'item/index';
$route['admin/item/index'] 																= 'item/index';
$route['admin/item/create'] 															= 'item/create';
$route['admin/item/edit/(:num)'] 													= 'item/create/$1';
$route['admin/item/save'] 																= 'item/save';
$route['admin/item/save/(:num)'] 													= 'item/save/$1';
$route['admin/item/changeStatus/(:num)'] 									= 'item/changeStatus/$1';

$route['admin/categoryitem']															= 'categoryitem/index';
$route['admin/categoryitem/index'] 												= 'categoryitem/index';
$route['admin/categoryitem/create'] 											= 'categoryitem/create';
$route['admin/categoryitem/edit/(:num)'] 									= 'categoryitem/create/$1';
$route['admin/categoryitem/save'] 												= 'categoryitem/save';
$route['admin/categoryitem/save/(:num)'] 									= 'categoryitem/save/$1';
$route['admin/categoryitem/changeStatus/(:num)'] 					= 'categoryitem/changeStatus/$1';

$route['admin/permissioncategory']												= 'permissioncategory/index';
$route['admin/permissioncategory/index'] 									= 'permissioncategory/index';
$route['admin/permissioncategory/create'] 								= 'permissioncategory/create';
$route['admin/permissioncategory/edit/(:num)'] 						= 'permissioncategory/create/$1';
$route['admin/permissioncategory/save'] 									= 'permissioncategory/save';
$route['admin/permissioncategory/save/(:num)'] 						= 'permissioncategory/save/$1';
$route['admin/permissioncategory/changeStatus/(:num)'] 		= 'permissioncategory/changeStatus/$1';

$route['admin/permission']																= 'permission/index';
$route['admin/permission/index'] 													= 'permission/index';
$route['admin/permission/create'] 												= 'permission/create';
$route['admin/permission/edit/(:num)'] 										= 'permission/create/$1';
$route['admin/permission/save'] 													= 'permission/save';
$route['admin/permission/save/(:num)'] 										= 'permission/save/$1';
$route['admin/permission/changeStatus/(:num)'] 						= 'permission/changeStatus/$1';

$route['admin/permissiongroup']																	= 'permissiongroup/index';
$route['admin/permissiongroup/index'] 													= 'permissiongroup/index';
$route['admin/permissiongroup/create'] 													= 'permissiongroup/create';
$route['admin/permissiongroup/edit/(:num)'] 										= 'permissiongroup/create/$1';
$route['admin/permissiongroup/save'] 														= 'permissiongroup/save';
$route['admin/permissiongroup/save/(:num)'] 										= 'permissiongroup/save/$1';
$route['admin/permissiongroup/changeStatus/(:num)'] 						= 'permissiongroup/changeStatus/$1';

$route['admin/grouphaspermission']															= 'grouphaspermission/index';
$route['admin/grouphaspermission/index'] 												= 'grouphaspermission/index';
$route['admin/grouphaspermission/create'] 											= 'grouphaspermission/create';
$route['admin/grouphaspermission/edit/(:num)'] 									= 'grouphaspermission/create/$1';
$route['admin/grouphaspermission/save'] 												= 'grouphaspermission/save';
$route['admin/grouphaspermission/save/(:num)'] 									= 'grouphaspermission/save/$1';
$route['admin/grouphaspermission/changeStatus/(:num)'] 					= 'grouphaspermission/changeStatus/$1';

$route['admin/userhaspermission']																= 'userhaspermission/index';
$route['admin/userhaspermission/index'] 												= 'userhaspermission/index';
$route['admin/userhaspermission/create'] 												= 'userhaspermission/create';
$route['admin/userhaspermission/edit/(:num)'] 									= 'userhaspermission/create/$1';
$route['admin/userhaspermission/save'] 													= 'userhaspermission/save';
$route['admin/userhaspermission/save/(:num)'] 									= 'userhaspermission/save/$1';
$route['admin/userhaspermission/changeStatus/(:num)'] 					= 'userhaspermission/changeStatus/$1';
