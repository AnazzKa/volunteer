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
$route['default_controller'] = "Login";
$route['do_login'] = "Login/process";
$route['do_logout'] = "Login/do_logout";
$route['dashboard'] = 'Dashboard';
$route['users'] = 'Users/index';
$route['users_view'] = 'Users/view';
$route['profile'] = 'Profile';
$route['volunteer_view'] = 'Users/volunteer_view';
$route['previlage'] = 'Users/previlage';
$route['selected_volunteers'] = 'Users/selected_volunteers';
$route['volunteer_print'] = 'Users/volunteer_print';
$route['profile_print'] = 'Profile/profile_print';
$route['contact'] = 'Contact';
$route['contact_single_view'] = 'Contact/contact_single_view';
$route['contact_mail'] = 'Contact/contact_mail';
$route['appointment'] = 'Appointment';
$route['clearance_volunteers'] = 'Users/clearance_volunteers';
$route['inactive_volunteers'] = 'Users/inactive_volunteers';
$route['menus'] = 'Users/menus';
$route['notifications'] = 'Users/notifications';
$route['import'] = 'Import';
$route['import_table'] = 'Import/import_table';
$route['seminar_registration'] = 'seminar_registration';
$route['epilepsy_masterclass'] = 'epilepsy_masterclass';

$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */