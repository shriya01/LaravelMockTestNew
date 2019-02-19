<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//hindi
Route::get('changeLanguage/{local}', '\App\Modules\Dashboard\Controllers\DashboardController@postChangeLanguage')->name('changeLanguage');
//Auth Routes
Route::get('/', '\App\Modules\Auth\Controllers\LoginController@getLogin')->name('login');
Route::post('/', '\App\Modules\Auth\Controllers\LoginController@postLogin');
Route::post('logout', '\App\Modules\Auth\Controllers\HomeController@getLogout')->name('logout');
Route::get('register', '\App\Modules\Auth\Controllers\RegisterController@getRegister');
Route::post('register', '\App\Modules\Auth\Controllers\RegisterController@postRegister')->name('home');
Route::get('home', '\App\Modules\Auth\Controllers\HomeController@index');
Route::get('/user/verify/{user_token}/{user_id}', '\App\Modules\Auth\Controllers\RegisterController@verifyUser');
// Forgot Password Routes
Route::get('forgot', '\App\Modules\Auth\Controllers\ForgotPasswordController@getForgotPassword');
Route::post('forgot', '\App\Modules\Auth\Controllers\ForgotPasswordController@sendResetLinkEmail');
Route::get('/user/reset-password/{user_id}/{user_token}','\App\Modules\Auth\Controllers\ResetPasswordController@resetPassword');
Route::post('reset-password','\App\Modules\Auth\Controllers\ResetPasswordController@postResetPassword');
//Social Login
Route::get('google-login', '\App\Modules\Auth\Controllers\LoginController@loginWithGoogle');
Route::get('github-login', '\App\Modules\Auth\Controllers\LoginController@loginWithGithub');
Route::get('facebook-login', '\App\Modules\Auth\Controllers\LoginController@loginWithFacebook');
Route::group(['middleware' => ['auth']], function () {
	//Profile Module
	Route::get('profile', '\App\Modules\Profile\Controllers\ProfileController@getProfileData');
	Route::post('profile', '\App\Modules\Profile\Controllers\ProfileController@postProfileData');
	Route::get('exams', '\App\Modules\Examination\Controllers\ExaminationController@getExamsListUserSide');
	Route::get('/testInstructions/{section_id?}', '\App\Modules\Examination\Controllers\ExaminationController@testInstructions')->name('testInstructions');
	Route::post('/importantInstructions', '\App\Modules\Examination\Controllers\ExaminationController@importantInstructions')->name('importantInstructions');
	Route::get('/showTest/{section_id?}', '\App\Modules\Examination\Controllers\ExaminationController@showTest')->name('showTest');
	Route::post('/loadquestion', '\App\Modules\Examination\Controllers\ExaminationController@loadQuestions')->name('loadQuestion');
	Route::post('/loadQuestionByID', '\App\Modules\Examination\Controllers\ExaminationController@loadQuestionByID')->name('loadQuestionByID');	
});

//Admin Routes
Route::get('admin', '\App\Modules\Auth\Controllers\AdminController@getLogin');
Route::post('admin', '\App\Modules\Auth\Controllers\AdminController@postLogin');
//Admin Routes
Route::group(['middleware' => ['auth','admin']], function () {
	Route::get('dashboard', '\App\Modules\Dashboard\Controllers\DashboardController@index');
	//Section Module
	Route::get('/addSection/{section_id?}', '\App\Modules\Section\Controllers\SectionController@getSection')->name('addSection');
	Route::post('addSection/{section_id?}', '\App\Modules\Section\Controllers\SectionController@postSection');
	Route::get('section', '\App\Modules\Section\Controllers\SectionController@getSectionList');
	Route::get('/deleteSection/{section_id?}', '\App\Modules\Section\Controllers\SectionController@destroy')->name('deleteSection');
	Route::get('/showSection/{section_id?}', '\App\Modules\Section\Controllers\SectionController@show')->name('showSection');
	//Examination
	Route::get('examination', '\App\Modules\Examination\Controllers\ExaminationController@getExaminationList');
	Route::get('/addExamination/{examination_id?}', '\App\Modules\Examination\Controllers\ExaminationController@getExamination')->name('addExamination');
	Route::post('/addExamination/{examination_id?}', '\App\Modules\Examination\Controllers\ExaminationController@postExamination');
	Route::get('/deleteExamination/{section_id?}', '\App\Modules\Examination\Controllers\ExaminationController@destroy')->name('deleteExamination');
	Route::get('/showExamination/{section_id?}', '\App\Modules\Examination\Controllers\ExaminationController@show')->name('showExamination');
	//Mock test
	Route::get('mock-test', '\App\Modules\MockTest\Controllers\MockTestController@getMockTestList');
	Route::get('/addMockTest/{mocktest_id?}', '\App\Modules\MockTest\Controllers\MockTestController@getMockTest')->name('addMockTest');
	Route::post('/addMockTest/{mocktest_id?}', '\App\Modules\MockTest\Controllers\MockTestController@postMockTest');
	Route::get('/showMockTest/{mocktest?}', '\App\Modules\MockTest\Controllers\MockTestController@show')->name('showMockTest');
	//Question Set
	Route::get('/questions', '\App\Modules\QuestionSets\Controllers\QuestionSetsController@questions')->name('questions');
	Route::get('/showQuestion/{section_id?}/{id?}', '\App\Modules\QuestionSets\Controllers\QuestionSetsController@index')->name('showQuestion');
	Route::get('/addQuestion/{mocktest_id?}/{section_id?}/{question_id?}', '\App\Modules\QuestionSets\Controllers\QuestionSetsController@getQuestion')->name('addQuestion');
	Route::post('/addQuestion/{mocktest_id?}/{section_id?}/{question_id?}', '\App\Modules\QuestionSets\Controllers\QuestionSetsController@postQuestion');
	//Category
	Route::get('/categories/{id?}', '\App\Modules\Category\Controllers\CategoryController@index');
	Route::get('/addCategory/{category_id?}', '\App\Modules\Category\Controllers\CategoryController@getCategory')->name('addCategory');
	Route::post('/addCategory/{mocktest_id?}', '\App\Modules\Category\Controllers\CategoryController@postCategory');
	//Posts
	Route::get('/showPosts/{id?}', '\App\Modules\Post\Controllers\PostController@index')->name('showPosts');
	Route::get('/addPost/{post_id?}', '\App\Modules\Post\Controllers\PostController@getPosts')->name('addPost');
	Route::post('/addPost/{post_id?}', '\App\Modules\Post\Controllers\PostController@postPosts');
	//Answers
	Route::get('/addHint/{question_id?}', '\App\Modules\Answers\Controllers\AnswersController@getAnswer')->name('addHint');
	Route::post('/addHint/{question_id?}', '\App\Modules\Answers\Controllers\AnswersController@postAnswer');
	//Directions
	Route::get('/directions/{id?}', '\App\Modules\Directions\Controllers\DirectionsController@index')->name('directions');
	Route::get('/addDirectionGuidelines/{id?}', '\App\Modules\Directions\Controllers\DirectionsController@getDirection')->name('addDirectionGuidelines');
	Route::post('/addDirectionGuidelines/{id?}', '\App\Modules\Directions\Controllers\DirectionsController@postDirection');
	Route::post('/downloadPdf', '\App\Modules\QuestionSets\Controllers\QuestionSetsController@generateAndEmailPDF')->name('downloadPdf');
	//Package
	Route::get('/packages', '\App\Modules\Package\Controllers\PackageController@index');
	Route::get('/addPackage/{package_id?}', '\App\Modules\Package\Controllers\PackageController@getPackage')->name('addPackage');
	Route::post('/addPackage/{package_id?}', '\App\Modules\Package\Controllers\PackageController@postPackage');

	Route::post('/getCategoriesBySection', '\App\Modules\MockTest\Controllers\MockTestController@getCategoriesBySection')->name('getCategoriesBySection');
	Route::post('/showQuestions', '\App\Modules\MockTest\Controllers\MockTestController@showQuestions')->name('showQuestions');
	Route::post('/showQuestions', '\App\Modules\MockTest\Controllers\MockTestController@showQuestionsByCategory')->name('showQuestions');
	Route::post('/addQuestions', '\App\Modules\MockTest\Controllers\MockTestController@addQuestions')->name('addQuestions');
});
