<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('auth', function ($routes) {
    $routes->get('login', 'AuthController::index');
    $routes->post('login', 'AuthController::login');
    $routes->get('register', 'AuthController::register');
    $routes->post('storeregister', 'AuthController::storeRegistration');
    $routes->get('forgot-password', 'AuthController::forgotpassword');
    $routes->post('forgot-password', 'AuthController::forgotpasswordact');
    $routes->get('logout', 'AuthController::logout'); // Tambahkan rute untuk logout
    // Tambahkan rute lainnya jika diperlukan
});
$routes->group('admin', function ($routes) {
    $routes->get('dashboard', 'Admin\DashboardController::index');
    $routes->group('data-merek', function ($routes) {
        $routes->get('/', 'Admin\MerekController::index');
        $routes->get('create', 'Admin\MerekController::create');
        $routes->get('edit/(:num)', 'Admin\MerekController::edit/$1');
        $routes->get('delete/(:num)', 'Admin\MerekController::delete/$1');
        $routes->post('store', 'Admin\MerekController::store');
        $routes->post('update', 'Admin\MerekController::update');
    });
    $routes->group('data-perangkat', function ($routes) {
        $routes->get('/', 'Admin\PerangkatController::index');
        $routes->get('create', 'Admin\PerangkatController::create');
        $routes->get('edit/(:num)', 'Admin\PerangkatController::edit/$1');
        $routes->get('detail/(:num)', 'Admin\PerangkatController::detail/$1');
        $routes->get('delete/(:num)', 'Admin\PerangkatController::delete/$1');
        $routes->post('store', 'Admin\PerangkatController::store');
        $routes->post('update', 'Admin\PerangkatController::update');
    });
    //LINK Data Spesifikasi
    $routes->group('data-spesifikasi', function ($routes) {
        $routes->get('(:num)', 'Admin\SpesifikasiController::index/$1');
        $routes->get('edit/(:num)', 'Admin\SpesifikasiController::edit_spesifikasi/$1');
        $routes->get('create-spesifikasi/(:num)', 'Admin\SpesifikasiController::create_spesifikasi/$1');
        $routes->get('delete/(:num)', 'Admin\SpesifikasiController::delete_spesifikasi/$1');
        $routes->post('store-spesifikasi', 'Admin\SpesifikasiController::store_spesifikasi');
        $routes->post('update-spesifikasi', 'Admin\SpesifikasiController::update_spesifikasi');
    });
    //LINK Order Data
    $routes->group('order-data', function ($routes) {
        $routes->get('/', 'Admin\OrderController::index');
        $routes->get('detail/(:any)', 'Admin\OrderController::detail/$1');
        $routes->get('verif/(:any)', 'Admin\OrderController::verif/$1');
    });
    // LINK Report
    $routes->group('report', function ($routes) {
        $routes->get('data-smartphone', 'Admin\ReportController::index');
        $routes->get('data-pembelian', 'Admin\ReportController::checkout_report');
        $routes->post('cetak-laporan-smartphone', 'Admin\ReportController::print_smartphone');
        $routes->post('cetak-laporan-pembelian', 'Admin\ReportController::print_checkout');
    });
    // LINK PRofile
    $routes->group('profile', function ($routes) {
        $routes->get('/', 'ProfileController::index');
        $routes->post('update', 'ProfileController::update');
    });
});
$routes->group('client', function ($routes) {
    $routes->get('data-perangkat/(:num)', 'Client\PerangkatController::detail/$1');
    $routes->group('cart', function ($routes) {
        $routes->get('/', 'CartController::index');
        $routes->get('add/(:num)', 'Client\CartController::addToCart/$1');
    });
    $routes->group('checkout', function ($routes) {
        $routes->get('/', 'Client\CheckoutController::index');
        $routes->post('process', 'Client\CheckoutController::action');
    });
    $routes->group('pesananku', function ($routes) {
        $routes->get('/', 'Client\OrderController::index');
        $routes->post('process', 'Client\OrderController::action');
        $routes->post('do-upload', 'Client\OrderController::do_upload');
        $routes->get('delete/(:any)', 'Client\OrderController::delete/$1');
        $routes->get('upload-bukti/(:any)', 'Client\OrderController::uploadbukti/$1');
        $routes->get('konfirmasi/(:any)', 'Client\OrderController::konfirmasi/$1');
    });
    $routes->group('profile', function ($routes) {
        $routes->get('/', 'ProfileController::index');
        $routes->post('update', 'ProfileController::update');
    });
});
$routes->get('/', 'Home::index');
$routes->get('/galery-smartphone', 'GaleryController::index');
$routes->get('/notifications', 'NotificationController::index');
