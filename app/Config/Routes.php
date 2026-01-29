<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('services', 'ServicesController::index');



// $routes->get('/user', 'User::index');
// $routes->post('/user/save', 'User::save');
// $routes->get('/user/list', 'User::list');

$routes->get('admin/dashboard', 'Admin\Dashboard::index');



$routes->group('admin', function($routes) {
    $routes->get('services', 'Admin\Services::index');
    $routes->post('services/store', 'Admin\Services::store');
    $routes->post('services/update/(:num)', 'Admin\Services::update/$1');
    $routes->get('services/delete/(:num)', 'Admin\Services::delete/$1');
    $routes->post('services/toggle/(:num)', 'Admin\Services::toggle/$1');


    $routes->get('barbers', 'Admin\Barbers::index');
    $routes->post('barbers/store', 'Admin\Barbers::store');
    $routes->get('barbers/edit/(:num)', 'Admin\Barbers::edit/$1');  // show edit form
    $routes->post('barbers/edit/(:num)', 'Admin\Barbers::update/$1');  // submit form
    $routes->get('barbers/delete/(:num)', 'Admin\Barbers::delete/$1');
    $routes->post('barbers/update/(:num)', 'Admin\Barbers::update/$1');
    $routes->post('barbers/add-leave', 'Admin\Barbers::addLeave');



    $routes->get('appointments', 'Admin\Appointments::index');
    $routes->post('appointments/update/(:num)', 'Admin\Appointments::updateStatus/$1');


});



$routes->get('/booking', 'Booking::index');
$routes->get('/booking/services', 'Booking::services');
$routes->get('/booking/barbers/(:num)', 'Booking::barbers/$1');
$routes->get('/booking/slots', 'Booking::slots');
$routes->post('/booking/confirm', 'Booking::confirm');



$routes->group('admin', function($routes) {

    // Auth
    $routes->get('login', 'Admin\Auth::login');
    $routes->post('login', 'Admin\Auth::attemptLogin');
    $routes->get('logout', 'Admin\Auth::logout'); // points to logout method


    // Admins
    $routes->get('admins', 'Admin\Admins::index');
    $routes->get('admins/create', 'Admin\Admins::create');
    $routes->post('admins/store', 'Admin\Admins::store');
    $routes->get('admins/status/(:num)', 'Admin\Admins::toggleStatus/$1');


});
$routes->get('admin/settings', 'Admin\Settings::index');
$routes->post('admin/settings/save', 'Admin\Settings::save');


$routes->get('superadmin', 'SuperAdminController::login');
$routes->post('superadmin/login', 'SuperAdminController::loginPost');

$routes->get('superadmin/settings', 'SuperAdminController::settings');
$routes->post('superadmin/settings', 'SuperAdminController::saveSettings');

$routes->get('superadmin/logout', 'SuperAdminController::logout');

