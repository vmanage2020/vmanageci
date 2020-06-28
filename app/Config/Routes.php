<?php namespace Config;

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

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->get('/users', 'Login::index');

$routes->post('/signin', 'Login::signin');


//API CALL
//$routes->get('/api/signin', 'Login::api_signin');
$routes->post('/api/signin', 'Login::api_signin');

//Master
$routes->get('/api/academicboard', 'Master::academicboard'); // getAll
$routes->get('/api/academicboard/(:any)', 'Master::academicboard/$1'); // get by id
$routes->post('/api/academicboard/add', 'Master::academicboard/add'); // Add data
$routes->put('/api/academicboard/update/(:any)', 'Master::academicboard/update/$1'); // update data
$routes->delete('/api/academicboard/delete/(:any)', 'Master::academicboard/delete/$1'); // delete data

//STUDENT API CALLs
$routes->get('/api/students', 'Student::index');
$routes->get('/api/student/(:any)', 'Student::getbyid/$1');
$routes->post('/api/student', 'Student::create');
$routes->get('/api/student/(:any)', 'Student::view/$1');
$routes->put('/api/student/(:any)', 'Student::update/$1');
$routes->delete('/api/student/(:any)', 'Student::delete/$1');


$routes->post('/api/student/update/(:any)', 'Student::update/$1');
$routes->post('/api/student/delete/(:any)', 'Student::delete/$1');

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
