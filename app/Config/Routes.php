<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'User::index');
$routes->get('/about', 'User::about');
$routes->get('/booking', 'User::booking');
$routes->get('/contact', 'User::contact');
$routes->get('/payment', 'User::payment');
$routes->get('profile/change', 'User::change');
$routes->get('profile/order_data', 'User::order_data');
$routes->get('profile/review', 'User::review');


$routes->get('/bali', 'Dashboard::index');
$routes->get('/bali/paket', 'Dashboard\Paket::index');
$routes->get('/bali/destinasi', 'Dashboard\Destinasi::index');
$routes->get('/bali/kendaraan', 'Dashboard\Kendaraan::index');

$routes->get('/bali/kendaraan/create', 'Dashboard\Kendaraan::create');
$routes->post('/bali/kendaraan/store', 'Dashboard\Kendaraan::store');
$routes->get('/bali/kendaraan/edit/(:num)', 'Dashboard\Kendaraan::edit/$1');
$routes->post('/bali/kendaraan/update/(:num)', 'Dashboard\Kendaraan::update/$1');
$routes->get('/bali/paket/create', 'Dashboard\Paket::create');
$routes->post('/bali/paket/store', 'Dashboard\Paket::store');
$routes->get('/bali/paket/edit/(:any)', 'Dashboard\Paket::edit/$1');
$routes->post('/bali/paket/update', 'Dashboard\Paket::update');
$routes->get('/bali/paket/delete/(:any)', 'Dashboard\Paket::delete/$1');

$routes->post('/bali/kendaraan/delete/(:any)', 'Dashboard\Kendaraan::delete/$1');






/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
