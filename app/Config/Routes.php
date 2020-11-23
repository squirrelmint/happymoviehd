<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

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

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('video/(:num)/(:segment)', 'Home::video/$1/$2');
$routes->get('/series/(:num)/(:segment)', 'Home::series/$1/$2');
$routes->get('/series/(:num)/(:segment)/(:num)/(:any)', 'Home::series/$1/$2/$3/$4');

$routes->get('moviedata', 'Home::moviedata');
$routes->get('moviedata_search', 'Home::moviedata_search');
$routes->get('moviedata_category', 'Home::moviedata_category');

$routes->get('player/(:num)/(:any)', 'Home::player/$1/$2');
$routes->get('search/(:any)', 'Home::search/$1');
$routes->get('popular', 'Home::popular');
$routes->get('category', 'Home::categorylist');
$routes->get('category/(:num)/(:any)', 'Home::category/$1/$2');
$routes->get('contract', 'Home::contract');

$routes->get('countview/(:num)', 'Home::countView/$1');



/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
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
