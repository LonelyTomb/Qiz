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
Route::get('/', function () {
	return view('welcome');
});
Route::get('/', 'PagesController@index')->name('home');
Route::get('/register', 'PagesController@register')->name('register');
Route::get('/logIn', 'PagesController@logIn')->name('logIn');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('user.home');

Route::get('user/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('/quiz')->group(function () {
	Route::get('/', 'QuizController@index')->name('quiz.index');
	Route::get('/show/{id}', 'QuizController@show');
	Route::post('/store', 'QuizController@store')->name('quiz.store');
});

Route::prefix('/script')->group(function () {
//	View User Script as User
	Route::get('/', 'ScriptController@index')->name('script.index');
	Route::get('/show/{id}', 'ScriptController@show')->name('script.show');
	Route::post('/store', 'ScriptController@store')->name('script.store');
});

Route::resource('scripts', 'QuizController');

Route::prefix('/examiner')->group(function () {
	Route::get('/login', 'Auth\ExaminerLoginController@showLoginForm')->name('examiner.login');
	Route::get('/register', 'Auth\ExaminerRegisterController@index')->name('examiner.register');
	Route::post('/register', 'Auth\ExaminerRegisterController@create')->name('examiner.saveExaminer');
	Route::post('/login', 'Auth\ExaminerLoginController@login')->name('examiner.login.submit');
	Route::get('/logout', 'Auth\ExaminerLoginController@logout')->name('examiner.logout');


	Route::get('/download','ExportModelToExcel@getExcelSheet')->name('examiner.download');

//	Examiner Landing Page
	Route::get('/home', 'ExaminerController@index')->name('examiner.home');
	Route::post('/home', 'CourseController@saveCourse')->name('examiner.saveCourse');

	//Password Reset routes
	Route::post('/password/email', 'Auth\ExaminerForgotPasswordController@sendResetLinkEmail')->name('examiner.password.email');    // step 2
	Route::get('/password/reset', 'Auth\ExaminerForgotPasswordController@showLinkRequestForm')->name('examiner.password.request');   // step 1
	Route::post('/password/reset', 'Auth\ExaminerResetPasswordController@reset');                                                   // step 4
	Route::get('/password/reset/{token}', 'Auth\ExaminerResetPasswordController@showResetForm')->name('examiner.password.reset');   // step 3

	//View Courses
	Route::get('/courses', 'CourseController@courses')->name('examiner.view_quizzes');
	//Update Courses
	Route::get('/courses/update/{id}', 'CourseController@viewCourse')->name('examiner.viewCourse');
	Route::post('/courses/update', 'CourseController@updateCourse')->name('examiner.updateCourse');
	Route::get('/courses/delete/{id}', 'CourseController@deleteCourse')->name('examiner.deleteCourse');

//	View Questions
	Route::get('/courses/view/{id}', 'QuestionController@viewQuestions')->name('examiner.viewQuestions');
//	Route::post('/courses/update', 'ExaminerController@updateCourse')->name('examiner.updateCourse');
	Route::get('/courses/view/delete/{id}', 'QuestionController@deleteQuestion')->name('examiner.deleteQuestion');

//	Add Questions
	Route::get('/courses/add/{id}', 'QuestionController@addQuestions')->name('examiner.addQuestions');
	Route::post('/courses/add', 'QuestionController@saveQuestions')->name('examiner.saveQuestions');

//  Batch Upload Question&Answers
	Route::get('/courses/select/{id}','BatchUploadQuestions@selectCourse')->name('examiner.selectCourse');
	Route::post('/course/select/{id}/mark','BatchUploadQuestions@markCourse')->name('examiner.processUploadUserQuestions');

	Route::get('/courses/upload','BatchUploadQuestions@index')->name('examiner.uploadQuestions');
	Route::post('/courses/upload','BatchUploadQuestions@processUploadQuestions')->name('examiner.processUploadQuestions');

	Route::get('/courses/upload/scripts','BatchUploadQuestions@UploadMarkPage')->name('examiner.UploadMarkPage');
	Route::post('/courses/upload/scripts','BatchUploadQuestions@markUpoadScripts')->name('examiner.markUploadScripts');

	Route::get('/courses/export/scores/{id}','CourseController@exportScores')->name('examiner.exportScores');

//	View User Results as Examiner
	Route::get('/courses/results', 'ExaminerController@viewResult')->name('examiner.results');
	Route::get('/courses/results/{id}', 'ExaminerController@checkResult')->name('examiner.checkResult');
	Route::get('/courses/viewScript/{quiz}', 'ExaminerController@viewScript')->name('examiner.viewScript');
});

Route::prefix('/admin')->group(function () {
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('/', 'AdminController@index')->name('admin.home');
	Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

	Route::get('/examiners', 'AdminController@examiners')->name('admin.view_examiners');
	Route::get('/students', 'AdminController@students')->name('admin.view_students');
	Route::get('/courses', 'AdminController@courses')->name('admin.view_courses');

	//Password Reset routes
	Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');    // step 2
	Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');   // step 1
	Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');                                                   // step 4
	Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');   // step 3

});
