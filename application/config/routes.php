<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.2.4 or newer
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Academic Free License version 3.0
 *
 * This source file is subject to the Academic Free License (AFL 3.0) that is
 * bundled with this package in the files license_afl.txt / license_afl.rst.
 * It is also available through the world wide web at this URL:
 * http://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world wide web, please send an email to
 * licensing@ellislab.com so we can send you a copy immediately.
 *
 * @package		CodeIgniter
 * @author		EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2013, EllisLab, Inc. (http://ellislab.com/)
 * @license		http://opensource.org/licenses/AFL-3.0 Academic Free License (AFL 3.0)
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

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
| There are two reserved routes:
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
*/

$route['default_controller'] = 'welcome';
$route['404_override'] = '';

/*
 * backend 路由表
 */
$route['backend/login'] = 'backend/admin/login';
$route['backend/logout'] = 'backend/admin/logout';
$route['backend/admin/create'] = 'backend/admin/create';

$route['backend/tutor'] = 'backend/tutor/index';
$route['backend/tutor/(:num)'] = 'backend/tutor/get_tutor_by_id/$1';
$route['backend/tutor/(:num)/remove'] = 'backend/tutor/remove_tutor_by_id/$1';
$route['backend/tutor/create'] = 'backend/tutor/create_tutor';

$route['backend/problem'] = 'backend/problem/index';
$route['backend/problem/(:num)'] = 'backend/problem/get_problem_by_id/$1';
$route['backend/problem/(:num)/remove'] = 'backend/problem/remove_problem_by_id/$1';
$route['backend/problem/create'] = 'backend/problem/create_problem';

$route['backend/solution'] = 'backend/solution/index';

$route['backend/user'] = 'backend/user/index';
$route['backend/user/(:num)'] = 'backend/user/get_by_id/$1';

/*
 * api 路由表
 */
$route['api/problems.*'] = 'api/problem_api/problems';
$route['api/problem/(:num).*'] = 'api/problem_api/problem';

$route['api/tutors.*'] = 'api/tutor_api/tutors';
$route['api/tutor/(:num).*'] = 'api/tutor_api/tutor';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
