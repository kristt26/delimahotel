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
$routes->get('/', 'Home::index');
$routes->group('auth', function ($routes) {
    $routes->get('', 'Auth::index');
    $routes->post('login', 'Auth::login');
    $routes->get('logout', 'Auth::logout');
});
$routes->group('dashboard', function ($routes) {
    $routes->get('', 'Admin\Dashboard::index');
});

$routes->group('jenis', function ($routes) {
    $routes->get('', 'Admin\Jenis::index');
    $routes->get('store', 'Admin\Jenis::store');
    $routes->post('post', 'Admin\Jenis::post');
    $routes->put('put', 'Admin\Jenis::put');
});

$routes->group('fasilitas', function ($routes) {
    $routes->get('store', 'Admin\Fasilitas::store');
    $routes->post('post', 'Admin\Fasilitas::post');
    $routes->put('put', 'Admin\Fasilitas::put');
});

$routes->group('kamar', function ($routes) {
    $routes->get('', 'Admin\Kamar::index');
    $routes->get('store', 'Admin\Kamar::store');
    $routes->post('post', 'Admin\Kamar::post');
    $routes->put('put', 'Admin\Kamar::put');
    $routes->delete('delete/(:any)', 'Admin\Kamar::deleted/$1');
});

$routes->group('tambahan', function ($routes) {
    $routes->get('', 'Admin\Tambahan::index');
    $routes->get('store', 'Admin\Tambahan::store');
    $routes->post('post', 'Admin\Tambahan::post');
    $routes->put('put', 'Admin\Tambahan::put');
    $routes->delete('delete/(:any)', 'Admin\Tambahan::deleted/$1');
});

$routes->group('menu', function ($routes) {
    $routes->get('', 'Admin\Menu::index');
    $routes->get('store', 'Admin\Menu::store');
    $routes->post('post', 'Admin\Menu::post');
    $routes->put('put', 'Admin\Menu::put');
    $routes->delete('delete/(:any)', 'Admin\Menu::deleted/$1');
});

$routes->group('laundry', function ($routes) {
    $routes->get('', 'Admin\Laundry::index');
    $routes->get('store', 'Admin\Laundry::store');
    $routes->post('post', 'Admin\Laundry::post');
    $routes->put('put', 'Admin\Laundry::put');
    $routes->delete('delete/(:any)', 'Admin\Laundry::deleted/$1');
});






$routes->group('reservasi', function ($routes) {
    $routes->get('', 'Admin\Reservasi::index');
    $routes->get('pesanan_add', 'Admin\Reservasi::tambah');
    $routes->get('store', 'Admin\Reservasi::store');
    $routes->post('post', 'Admin\Reservasi::post');
    $routes->post('akses', 'Admin\Reservasi::akses');
    $routes->get('store_add', 'Admin\Reservasi::storeadd');
    $routes->put('put', 'Admin\Reservasi::update');
    $routes->delete('delete/(:any)', 'Admin\Reservasi::deleted/$1');
});

$routes->group('rooms', function ($routes) {
    $routes->get('', 'Rooms::index');
});

$routes->group('booking', function ($routes) {
    $routes->get('', 'Booking::index');
    $routes->get('store', 'Booking::store');
    $routes->post('post', 'Booking::post');
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
