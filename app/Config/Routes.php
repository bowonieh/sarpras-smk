<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Dashboard::index',['filter' => 'auth']);
$routes->group('auth',function($routes){
	
	$routes->add('login','AuthController::index');
	$routes->add('checklogin','AuthController::checkLogin');
	$routes->add('logout','AuthController::logout');
});
$routes->add('alat','Alat::index', ['filter' => 'auth']);
$routes->add('dashboard','Dashboard::index', ['filter' => 'auth']);
$routes->group('master',['filter'=>'auth','filter'=>'adminonly'],function($routes){
	$routes->add('/','Dashboard::index');
	$routes->add('ruangan','RuangController::index');
	$routes->add('ruangan/(:any)','RuangController::$1');
	$routes->add('ruangan/list','RuangController::list');
	$routes->add('kompetensi-keahlian','KompetensikeahlianController::index');
	$routes->add('kompetensi-keahlian/(:any)','KompetensikeahlianController::$1');
	$routes->add('alat','Jenisalat::index');
	$routes->add('alat/(:any)','Jenisalat::$1');
	$routes->add('prasarana-ruang','PrasaranaController::index');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
