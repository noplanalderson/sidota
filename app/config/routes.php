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

$route['default_controller'] 				= 'login';

$route['activation/(:any)']					= 'login/activation/$1';
$route['do-activation']						= 'login/do_activation';

/*----------------------------------
| Route for On Going Report Modules
|-----------------------------------
|
*/
$route['update-progress']					= 'on_going/update';

/*----------------------------------
| Route for Ticket Modules
|-----------------------------------
|
*/
$route['ticket'] 							= 'ticket/index';
$route['ticket/(:any)']						= 'ticket/index/$1';
$route['approve-ticket/(:any)']				= 'ticket/send_to_report/$1';
$route['close-ticket/(:any)']				= 'ticket/send_to_report/$1';
$route['send-report']						= 'ticket/send_report';
$route['ticket-detail/(:any)']				= 'ticket/detail/$1';
$route['get-ticket']						= 'ticket/get_ticket';
$route['add-ticket']						= 'ticket/add';
$route['edit-ticket']						= 'ticket/edit';
$route['delete-ticket']						= 'ticket/delete';

/*----------------------------------
| Route for Activity Report Modules
|-----------------------------------
|
*/
$route['reports'] 							= 'reports/index';
$route['reports/(:any)'] 					= 'reports/index/$1';
$route['monthly-report/(:num)/(:any)'] 		= 'reports/monthly/$1/$2';
$route['periodic-report/(:any)/(:any)'] 	= 'reports/periodic/$1/$2';
$route['edit-report/(:any)'] 				= 'edit_report/index/$1';
$route['copy-report/(:any)'] 				= 'edit_report/copy/$1';
$route['delete-report'] 					= 'reports/delete';
$route['report-detail/(:any)'] 				= 'reports/detail/$1';
$route['daily-report'] 						= 'reports/daily';
$route['daily-report/(:any)/(:num)/(:any)'] = 'reports/daily/$1/$2/$3';
$route['submit-report']						= 'add_report/submit';
$route['edit-submit']						= 'edit_report/submit';
$route['add-tool']							= 'edit_report/add_tool';
$route['remove-tool/(:any)']				= 'edit_report/remove_tool/$1';

/*----------------------------------------
| Route for Activity Documentation Modules
|-----------------------------------------
|
*/
$route['documentations/(:any)'] 				= 'documentations/index/$1';
$route['monthly-documentation/(:num)/(:any)']	= 'documentations/monthly/$1/$2';
$route['preview-documentation/(:any)'] 			= 'documentations/preview/$1';
$route['delete-documentation'] 					= 'documentations/delete';
$route['download-documentation/(:any)/(:any)'] 	= 'documentations/download/$1/$2';
$route['print-documentation/(:any)/(:any)'] 	= 'documentations/print/$1/$2';
$route['periodic-documentation/(:any)/(:any)'] 	= 'documentations/periodic/$1/$2';
$route['ajax-delete-image'] 					= 'edit_report/delete_picture';
$route['upload-documentation'] 					= 'edit_report/single_upload';

/*--------------------------
| Route for PDF Tool Modules
|---------------------------
|
*/
$route['merge-pdf'] = 'PDFTool/index';
$route['mergefile'] = 'PDFTool/mergefile';

/*-----------------------------------
| Route for Employee Schedule Modules
|------------------------------------
|
*/
$route['schedule'] 			= 'schedule/index';
$route['schedule/(:num)'] 	= 'schedule/index/$1';

/*-------------------------
| Route for Library Modules
|--------------------------
|
*/
$route['add-ebook'] 				= 'libraries/add';
$route['edit-ebook/(:any)']			= 'libraries/edit/$1';
$route['delete-ebook']				= 'libraries/delete';
$route['download-ebook/(:any)'] 	= 'libraries/download/$1';

/*---------------------------------
| Route for Employee Profile Module
|----------------------------------
|
*/
$route['profile/(:any)'] 			= 'profile/index/$1';
$route['edit-profile']				= 'profile/edit';
$route['upload-pp']					= 'profile/upload_pp';
$route['delete-pp']					= 'profile/delete_pp';
$route['change-profile']			= 'profile/change';
$route['change-password']			= 'profile/password';
$route['submit-password']			= 'profile/submit_pwd';

/*-----------------------
| Route for Search Module
|------------------------
|
*/
$route['search-result/(:any)']		= 'search/result/$1';

/*-------------------------
| Route for Employee Module
|--------------------------
|
*/
$route['add-employee']				= 'employee/add';
$route['submit-employee']			= 'employee/submit';
$route['edit-employee/(:any)']		= 'employee/edit/$1';
$route['do-edit-employee']			= 'employee/do_edit';
$route['delete-employee']			= 'employee/delete';

/*-----------------------------
| Route for App Settings Module
|------------------------------
|
*/
$route['upload-asset']				= 'app_settings/upload';
$route['submit-setting']			= 'app_settings/submit';

/*----------------------------------
| Route for Access Management Module
|-----------------------------------
|
*/
$route['get-access']				= 'access_management/get_access';
$route['add-access']				= 'access_management/add_access';
$route['edit-access']				= 'access_management/edit_access';
$route['delete-access']				= 'access_management/delete_access';
$route['update-index']				= 'access_management/update_index';


/*--------------------------
| Route for Utilities Module
|---------------------------
|
*/
$route['get-jobdesc']				= 'utilities/get_jobdesc';
$route['get-act-category']			= 'utilities/get_act_category';
$route['get-ebook-category']		= 'utilities/get_ebook_category';
$route['add-utility/(:any)']		= 'utilities/add/$1';
$route['edit-utility/(:any)']		= 'utilities/edit/$1';
$route['delete-utility/(:any)']		= 'utilities/delete/$1';

/*----------------------
| Route for Error Module
|-----------------------
|
*/
$route['page_error/(:num)']			= 'page_error/index/$1';

$route['404_override'] 				= 'page_error/index';
$route['translate_uri_dashes'] 		= true;