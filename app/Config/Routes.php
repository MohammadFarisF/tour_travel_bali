<?php

namespace Config;

use App\Filters\AdminFilter;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('User');
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

$routes->post('/confirm-booking', 'Dashboard\Booking::confirmBooking', ['filter' => 'userFilter']);
$routes->get('/contact', 'User::contact');
$routes->get('/package-detail/(:any)', 'Dashboard\Paket::packageDetails/$1');

$routes->get('booking/getPaymentHistory/(:any)', 'Dashboard\Payment::getPaymentHistory/$1');
$routes->get('booking/getPreviousPayments/(:any)/(:any)', 'Dashboard\Payment::getPreviousPayments/$1/$2');
$routes->post('/payment/submit', 'Dashboard\Payment::submit');

$routes->get('profile/my_booking', 'Dashboard\Booking::cust_index', ['filter' => 'userFilter']);
$routes->get('profile/my_account', 'Dashboard\Customer::showAccount', ['filter' => 'userFilter']);
$routes->post('profile/update_account', 'Dashboard\Customer::updateAccount', ['filter' => 'userFilter']);
$routes->get('profile/review', 'Dashboard\Review::cust_index', ['filter' => 'userFilter']);
$routes->post('review/store', 'Dashboard\Review::store', ['filter' => 'userFilter']);
$routes->get('profile/invoice', 'Dashboard\Booking::invoice', ['filter' => 'userFilter']);
$routes->get('profile/invoice-details/(:any)', 'Dashboard\Booking::viewInvoice/$1', ['filter' => 'userFilter']);
$routes->post('profile/printPdf/(:any)', 'Dashboard\Booking::printInvoice/$1', ['filter' => 'userFilter']);


$routes->get('/booking/(:segment)', 'Dashboard\Booking::bookingDetails/$1', ['filter' => 'userFilter']);
$routes->post('/booking/cancelBooking/(:any)', 'Dashboard\Booking::cancelBooking/$1', ['filter' => 'userFilter']);


$routes->get('login', 'Auth::login');
$routes->post('login/proses', 'Auth::loginPost');
$routes->get('register', 'Auth::register');
$routes->post('register/proses', 'Auth::registerPost');
$routes->post('logout', 'Auth::logout');

$routes->group('bali', ['filter' => 'adminFilter'], function ($routes) {
    $routes->get('/', 'Dashboard::index');

    $routes->get('profile', 'Dashboard\Admin::profile');
    $routes->post('updateProfile', 'Dashboard\Admin::updateProfile');
    $routes->post('updatePassword', 'Dashboard\Admin::updatePassword');

    $routes->get('paket', 'Dashboard\Paket::index');
    $routes->get('paket/create', 'Dashboard\Paket::create');
    $routes->post('paket/store', 'Dashboard\Paket::store');
    $routes->get('paket/edit/(:any)', 'Dashboard\Paket::edit/$1');
    $routes->post('paket/update', 'Dashboard\Paket::update');
    $routes->post('paket/delete/(:any)', 'Dashboard\Paket::delete/$1');

    $routes->get('destinasi', 'Dashboard\Destinasi::index');
    $routes->get('destinasi/create', 'Dashboard\Destinasi::create');
    $routes->post('destinasi/store', 'Dashboard\Destinasi::store');
    $routes->get('destinasi/delete/(:any)', 'Dashboard\Destinasi::delete/$1');
    $routes->get('destinasi/edit/(:any)', 'Dashboard\Destinasi::edit/$1');
    $routes->post('destinasi/update', 'Dashboard\Destinasi::update');

    $routes->get('admin', 'Dashboard\Admin::index');
    $routes->get('admin/create', 'Dashboard\Admin::create'); // Tambah prefix Dashboard
    $routes->post('admin/store', 'Dashboard\Admin::store');;
    $routes->post('admin/delete/(:any)', 'Dashboard\Admin::delete/$1'); // Tambah prefix Dashboard

    $routes->get('kendaraan', 'Dashboard\Kendaraan::index');
    $routes->get('kendaraan/create', 'Dashboard\Kendaraan::create');
    $routes->post('kendaraan/store', 'Dashboard\Kendaraan::store');
    $routes->get('kendaraan/edit/(:any)', 'Dashboard\Kendaraan::edit/$1');
    $routes->post('kendaraan/update/(:any)', 'Dashboard\Kendaraan::update/$1');
    $routes->post('kendaraan/delete/(:any)', 'Dashboard\Kendaraan::delete/$1');
    $routes->post('kendaraan/updatestatus/(:any)', 'Dashboard\Kendaraan::updateStatus/$1');

    $routes->get('customer', 'Dashboard\Customer::index');
    $routes->post('customer/delete/(:any)', 'Dashboard\Customer::delete/$1');

    $routes->get('review', 'Dashboard\Review::index');
    $routes->post('review/delete/(:any)', 'Dashboard\Review::delete/$1');

    $routes->get('banktravel', 'Dashboard\Bank_Travel::index');
    $routes->get('banktravel/create/', 'Dashboard\Bank_Travel::create');
    $routes->post('banktravel/store', 'Dashboard\Bank_Travel::store');
    $routes->get('banktravel/delete/(:any)', 'Dashboard\Bank_Travel::delete/$1');
    $routes->get('banktravel/edit/(:any)', 'Dashboard\Bank_Travel::edit/$1');
    $routes->post('banktravel/update/(:any)', 'Dashboard\Bank_Travel::update/$1');

    $routes->get('booking', 'Dashboard\Booking::index');
    $routes->post('booking/completeBooking/(:any)', 'Dashboard\Booking::completeBooking/$1');

    $routes->get('payment', 'Dashboard\Payment::index');
    $routes->post('payment/updateStatus', 'Dashboard\Payment::updateStatus');

    $routes->get('refund', 'Dashboard\Refund::index');
    $routes->post('refund/updateStatus', 'Dashboard\Refund::updateStatus');

    $routes->get('report', 'Dashboard\Report::index');
    $routes->post('report/printReport', 'Dashboard\Report::printReport');
});







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
