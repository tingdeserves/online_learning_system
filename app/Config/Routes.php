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
$routes->setAutoRoute(true);
/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */



// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//My Routes
$routes->get('/', 'Home::index');
$routes->get('/hello', 'Hello::index');
//resize homepage image
$routes->post('/', 'Home::resize');
//login
$routes->get('/login', 'Login::index');
$routes->get('/learner_login', 'LearnerLogin::index');
$routes->get('/educator_login', 'EducatorLogin::index');
//password reset
$routes->get('/learner_login/password_reset', 'PasswordReset::index');
$routes->post('/learner_login/password_reset/verify_username', 'PasswordReset::verify_username');
$routes->post('/learner_login/password_reset/verify_answers', 'PasswordReset::verify_answers');
$routes->post('/learner_login/password_reset/submit_new_pw', 'PasswordReset::submit_new_pw');

//check login
$routes->post('/login/check_login', 'Login::check_login');
$routes->post('/learner_login/check_login', 'LearnerLogin::check_login');
$routes->post('/educator_login/check_login', 'EducatorLogin::check_login');
//logout
$routes->get('/login/logout', 'Login::logout');   //$routes->get('baseURL+the directory in View', 'Controller::which function in controller'); 
$routes->get('/learner_login/logout', 'LearnerLogin::logout');
$routes->get('/educator_login/logout', 'EducatorLogin::logout');
//upload
$routes->get('/upload', 'Upload::index');
$routes->post('/upload/upload_file', 'Upload::upload_file');
$routes->get('/register', 'Register::index');
//learner workplace
$routes->get('/learner_workplace', 'LearnerWorkplace::index');
//educator workplace
$routes->get('/educator_workplace', 'EducatorWorkplace::index');
$routes->post('/educator_workplace/succ', 'EducatorWorkplace::releaseCourses');
$routes->get('/educator_workplace/succ', 'EducatorWorkplace::release_success');

//profile
$routes->get('/profile', 'Profile::index');
$routes->post('/profile', 'Profile::updateprofile');
$routes->get('/profile/update', 'Profile::index');
$routes->post('/profile/image', 'Profile::updatePortrait');
$routes->get('/profile/image', 'Profile::index');
//verify number
$routes->get('/profile/verify_number', 'Profile::verifyIndex');
$routes->match(["post"], '/profile/verify_number', 'Profile::verifyPhone');
//verify code AJAX
$routes->match(["post"], '/profile/verify_code', 'Profile::verifyCode');
//secret questions
$routes->get('/profile/secret_questions', 'Profile::sq_form');
$routes->match(["post"], '/profile/secret_questions', 'Profile::insert_sq');

//courses list
$routes->get('/courses_list', 'CoursesList::index');
$routes->post('/courses_list/a_z', 'CoursesList::sort_name_a_z');
$routes->post('/courses_list/z_a', 'CoursesList::sort_name_z_a');
$routes->post('/courses_list/id_asc', 'CoursesList::sort_name_id_asc');
$routes->post('/courses_list/id_des', 'CoursesList::sort_name_id_des');

//course add collection by post
$routes->post('/courses_list', 'CourseCollection::addCollection');
//course detail
$routes->get('/course_detail', 'CourseDetail::index');
$routes->get('/course_detail/(:num)', 'CourseDetail::index');
$routes->post('/course_detail/(:num)', 'CourseDetail::addComments');
$routes->post('/course_detail/add_files', 'CourseDetail::upload_course_materials');

//$routes->post('/course_detail/(:num)', 'CourseDetail::index');   //test
//register
$routes->get('/register', 'Register::index');
$routes->post('/register', 'Register::register');
$routes->get('/register/succ', 'Register::register_success');
//textbook
$routes->get('/textbook', 'Textbook::index');
//Imagick-resize  (was rotate)
$routes->get('/try_imagick', 'TryImagick::index');
$routes->post('/try_imagick', 'TryImagick::rotate');
//stripe payment
$routes->get('/checkout_success(.*)', 'StripeCheckout::success');
$routes->get('/checkout_cancel', 'StripeCheckout::cancel');
$routes->get('/checkout_page', 'StripeCheckout::index');
$routes->post('/checkout_stripe', 'StripeCheckout::checkout_process');
//Serach box auto complete
$routes->post('/auto_complete', 'CoursesList::auto_complete');
//search course - results
//$routes->get('/search_results', 'CoursesList::test_search_results');  //comment it when complete
$routes->post('/search_results', 'CoursesList::search_results');
//user location
$routes->get('/user_location', 'UserLocation::index');







//try AJAX
$routes->get('/(.*)/try_ajax', 'Try_AJAX::getAJAXResult');
$routes->match(["get","post"], '/(.*)/try_ajax', 'Try_AJAX::getAJAXResult');
$routes->get('/try_ajax', 'Try_AJAX::index');

//try sms
$routes->get('/send_sms', 'send_sms::index');

//test
$routes->get('test', 'TestController::testImageMagick');
//try autocomplete
$routes->get('/auto', 'TryAuto::index');
$routes->post('/auto_complete', 'CoursesList::auto_complete');
//try continuious loading
$routes->get('/loading', 'TryAuto::continuious_loading');
$routes->post('/loading', 'TryAuto::continuious_loading_go');
//try google maps
$routes->get('/maps', 'TryAuto::google_maps');











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
