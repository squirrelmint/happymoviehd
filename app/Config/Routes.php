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
$routes->setDefaultController('Movie');
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

#Movie
$routes->get('video/(:num)/(:any)', 'Movie::video/$1/$2');
$routes->get('/series/(:num)/(:any)', 'Movie::series/$1/$2');
$routes->get('/series/(:num)/(:segment)/(:num)/(:any)', 'Movie::series/$1/$2/$3/$4');

$routes->get('moviedata', 'Movie::moviedata');
$routes->get('moviedata_search', 'Movie::moviedata_search');
$routes->get('moviedata_category', 'Movie::moviedata_category');

$routes->get('player/(:num)/(:any)', 'Movie::player/$1/$2');
$routes->get('search/(:any)', 'Movie::search/$1');
$routes->get('popular', 'Movie::popular');
$routes->get('moviedata_popular', 'Movie::moviedata_popular');
$routes->get('category', 'Movie::categorylist');
$routes->get('category/(:num)/(:any)', 'Movie::category/$1/$2');
$routes->get('contract', 'Movie::contract');

$routes->get('countview/(:num)', 'Movie::countView/$1');
$routes->post('save_requests', 'Movie::save_requests');
$routes->post('con_ads', 'Movie::con_ads');
$routes->post('saveReport', 'Movie::saveReport');

#Av
$routes->get('av', 'Av::index');
$routes->get('av/(:num)/(:any)', 'Av::video/$1/$2');
$routes->get('av/clips/(:num)/(:any)', 'Av::clips/$1/$2');


$routes->get('av/moviedata', 'Av::moviedata');
$routes->get('av/moviedata_search', 'Av::moviedata_search');
$routes->get('av/moviedata_category', 'Av::moviedata_category');

$routes->get('av/player/(:num)/(:any)', 'Av::player/$1/$2');
$routes->get('av/search/(:any)', 'Av::search/$1');
$routes->get('av/popular', 'MovAvie::popular');
$routes->get('av/clips', 'Av::clipslist');
$routes->get('av/category/(:num)/(:any)', 'Av::category/$1/$2');
$routes->get('av/contract', 'Av::contract');

$routes->get('countview/(:num)', 'Av::countView/$1');
$routes->post('save_requests', 'Av::save_requests');
$routes->post('con_ads', 'Av::con_ads');
$routes->post('saveReport', 'Av::saveReport');



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
