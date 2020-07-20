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
$routes->get('/api/master', 'Master::index'); // getAll

$routes->get('/api/dashboard', 'Master::dashboard'); // getAll

$routes->get('/api/academicboard', 'Master::academicboard'); // getAll
$routes->get('/api/academicboard/(:any)', 'Master::academicboard/$1'); // get by id
$routes->post('/api/academicboard/add', 'Master::academicboard/add'); // Add data
$routes->post('/api/academicboard/update/(:any)', 'Master::academicboard/update/$1'); // update data
$routes->post('/api/academicboard/delete/(:any)', 'Master::academicboard/delete/$1'); // delete data
$routes->put('/api/academicboard/update/(:any)', 'Master::academicboard/update/$1'); // update data
$routes->delete('/api/academicboard/delete/(:any)', 'Master::academicboard/delete/$1'); // delete data

$routes->get('/api/language', 'Master::language'); // getAll
$routes->get('/api/language/(:any)', 'Master::language/$1'); // get by id
$routes->post('/api/language/add', 'Master::language/add'); // Add data
$routes->post('/api/language/update/(:any)', 'Master::language/update/$1'); // update data
$routes->post('/api/language/delete/(:any)', 'Master::language/delete/$1'); // delete data
$routes->put('/api/language/update/(:any)', 'Master::language/update/$1'); // update data
$routes->delete('/api/language/delete/(:any)', 'Master::language/delete/$1'); // delete data

$routes->get('/api/activity', 'Master::activity'); // getAll
$routes->get('/api/activity/(:any)', 'Master::activity/$1'); // get by id
$routes->post('/api/activity/add', 'Master::activity/add'); // Add data
$routes->post('/api/activity/update/(:any)', 'Master::activity/update/$1'); // update data
$routes->post('/api/activity/delete/(:any)', 'Master::activity/delete/$1'); // delete data
$routes->put('/api/activity/update/(:any)', 'Master::activity/update/$1'); // update data
$routes->delete('/api/activity/delete/(:any)', 'Master::activity/delete/$1'); // delete data

$routes->get('/api/academicyear', 'Master::academicyear'); // getAll
$routes->get('/api/academicyear/(:any)', 'Master::academicyear/$1'); // get by id
$routes->post('/api/academicyear/add', 'Master::academicyear/add'); // Add data
$routes->post('/api/academicyear/update/(:any)', 'Master::academicyear/update/$1'); // update data
$routes->post('/api/academicyear/delete/(:any)', 'Master::academicyear/delete/$1'); // delete data
$routes->put('/api/academicyear/update/(:any)', 'Master::academicyear/update/$1'); // update data
$routes->delete('/api/academicyear/delete/(:any)', 'Master::academicyear/delete/$1'); // delete data

$routes->get('/api/groupname', 'Master::groupname'); // getAll
$routes->get('/api/groupname/(:any)', 'Master::groupname/$1'); // get by id
$routes->post('/api/groupname/add', 'Master::groupname/add'); // Add data
$routes->post('/api/groupname/update/(:any)', 'Master::groupname/update/$1'); // update data
$routes->post('/api/groupname/delete/(:any)', 'Master::groupname/delete/$1'); // delete data
$routes->put('/api/groupname/update/(:any)', 'Master::groupname/update/$1'); // update data
$routes->delete('/api/groupname/delete/(:any)', 'Master::groupname/delete/$1'); // delete data

$routes->get('/api/standard', 'Master::standard'); // getAll
$routes->get('/api/standard/(:any)', 'Master::standard/$1'); // get by id
$routes->post('/api/standard/add', 'Master::standard/add'); // Add data
$routes->post('/api/standard/update/(:any)', 'Master::standard/update/$1'); // update data
$routes->post('/api/standard/delete/(:any)', 'Master::standard/delete/$1'); // delete data
$routes->put('/api/standard/update/(:any)', 'Master::standard/update/$1'); // update data
$routes->delete('/api/standard/delete/(:any)', 'Master::standard/delete/$1'); // delete data

$routes->get('/api/bloodgroup', 'Master::bloodgroup'); // getAll
$routes->get('/api/bloodgroup/(:any)', 'Master::bloodgroup/$1'); // get by id
$routes->post('/api/bloodgroup/add', 'Master::bloodgroup/add'); // Add data
$routes->post('/api/bloodgroup/update/(:any)', 'Master::bloodgroup/update/$1'); // update data
$routes->post('/api/bloodgroup/delete/(:any)', 'Master::bloodgroup/delete/$1'); // delete data
$routes->put('/api/bloodgroup/update/(:any)', 'Master::bloodgroup/update/$1'); // update data
$routes->delete('/api/bloodgroup/delete/(:any)', 'Master::bloodgroup/delete/$1'); // delete data

$routes->get('/api/religion', 'Master::religion'); // getAll
$routes->get('/api/religion/(:any)', 'Master::religion/$1'); // get by id
$routes->post('/api/religion/add', 'Master::religion/add'); // Add data
$routes->post('/api/religion/update/(:any)', 'Master::religion/update/$1'); // update data
$routes->post('/api/religion/delete/(:any)', 'Master::religion/delete/$1'); // delete data
$routes->put('/api/religion/update/(:any)', 'Master::religion/update/$1'); // update data
$routes->delete('/api/religion/delete/(:any)', 'Master::religion/delete/$1'); // delete data

$routes->get('/api/community', 'Master::community'); // getAll
$routes->get('/api/community/(:any)', 'Master::community/$1'); // get by id
$routes->post('/api/community/add', 'Master::community/add'); // Add data
$routes->post('/api/community/update/(:any)', 'Master::community/update/$1'); // update data
$routes->post('/api/community/delete/(:any)', 'Master::community/delete/$1'); // delete data
$routes->put('/api/community/update/(:any)', 'Master::community/update/$1'); // update data
$routes->delete('/api/community/delete/(:any)', 'Master::community/delete/$1'); // delete data

$routes->get('/api/citizen', 'Master::citizen'); // getAll
$routes->get('/api/citizen/(:any)', 'Master::citizen/$1'); // get by id
$routes->post('/api/citizen/add', 'Master::citizen/add'); // Add data
$routes->post('/api/citizen/update/(:any)', 'Master::citizen/update/$1'); // update data
$routes->post('/api/citizen/delete/(:any)', 'Master::citizen/delete/$1'); // delete data
$routes->put('/api/citizen/update/(:any)', 'Master::citizen/update/$1'); // update data
$routes->delete('/api/citizen/delete/(:any)', 'Master::citizen/delete/$1'); // delete data

$routes->get('/api/certificatename', 'Master::certificatename'); // getAll
$routes->get('/api/certificatename/(:any)', 'Master::certificatename/$1'); // get by id
$routes->post('/api/certificatename/add', 'Master::certificatename/add'); // Add data
$routes->post('/api/certificatename/update/(:any)', 'Master::certificatename/update/$1'); // update data
$routes->post('/api/certificatename/delete/(:any)', 'Master::certificatename/delete/$1'); // delete data
$routes->put('/api/certificatename/update/(:any)', 'Master::certificatename/update/$1'); // update data
$routes->delete('/api/certificatename/delete/(:any)', 'Master::certificatename/delete/$1'); // delete data


$routes->get('/api/section', 'Master::section'); // getAll
$routes->get('/api/section/(:any)', 'Master::section/$1'); // get by id
$routes->post('/api/section/add', 'Master::section/add'); // Add data
$routes->post('/api/section/update/(:any)', 'Master::section/update/$1'); // update data
$routes->post('/api/section/delete/(:any)', 'Master::section/delete/$1'); // delete data
$routes->put('/api/section/update/(:any)', 'Master::section/update/$1'); // update data
$routes->delete('/api/section/delete/(:any)', 'Master::section/delete/$1'); // delete data


//STUDENT API CALLs
$routes->get('/api/students', 'Student::index');
$routes->get('/api/student/(:any)', 'Student::view/$1');
$routes->post('/api/student', 'Student::create');
$routes->post('/api/student/update/(:any)', 'Student::update/$1');
$routes->post('/api/student/delete/(:any)', 'Student::delete/$1');
$routes->put('/api/student/(:any)', 'Student::update/$1');
$routes->delete('/api/student/(:any)', 'Student::delete/$1');

$routes->post('/api/student/document', 'Student::document');
$routes->post('/api/student/upload', 'Student::upload');

$routes->post('/api/student/statusupdate/(:any)/(:any)', 'Student::statusupdate/$1/$2');
$routes->get('/api/students/selected', 'Student::selected');
$routes->get('/api/students/management', 'Student::management');


//UserGroup API CALLs
$routes->get('/api/usergroups', 'Group::index');
$routes->get('/api/usergroup/(:any)', 'Group::view/$1');
$routes->post('/api/usergroup', 'Group::create');
$routes->post('/api/usergroup/update/(:any)', 'Group::update/$1');
$routes->post('/api/usergroup/delete/(:any)', 'Group::delete/$1');
$routes->put('/api/usergroup/(:any)', 'Group::update/$1');
$routes->delete('/api/usergroup/(:any)', 'Group::delete/$1');

//User API CALLs
$routes->get('/api/loginusers', 'User::index');
$routes->get('/api/loginuser/(:any)', 'User::view/$1');
$routes->post('/api/loginuser', 'User::create');
$routes->post('/api/loginuser/update/(:any)', 'User::update/$1');
$routes->post('/api/loginuser/delete/(:any)', 'User::delete/$1');
$routes->put('/api/loginuser/(:any)', 'User::update/$1');
$routes->delete('/api/loginuser/(:any)', 'User::delete/$1');


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
