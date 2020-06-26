<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix'=>'administrator'], function() {
    /*
     * Login, logout routes,
     * */
    Route::get('login','Auth\AdminLoginController@showLoginForm')->name('admin.login.get');
    Route::post('login','Auth\AdminLoginController@login')->name('admin.login.post');
    Route::post('logout','Auth\AdminLoginController@logout')->name('admin.logout.post');

    Route::get('/','Admin\HomeController@index')->name('admin.home');
    Route::get('users','Admin\HomeController@show')->name('admin.list');
    Route::get('user/add','Admin\HomeController@add')->name('admin.users.add');
    Route::post('user/add','Admin\HomeController@store')->name('admin.users.store');
    Route::post('user/deactivate/{id}','Admin\HomeController@deactivate')->name('admin.users.deactivate');
    Route::post('user/activate/{id}','Admin\HomeController@activate')->name('admin.users.activate');

    Route::get('students','Admin\StudentController@show')->name('admin.students.list');
    Route::get('student/add','Admin\StudentController@add')->name('admin.students.add');
    Route::post('student/add','Admin\StudentController@store')->name('admin.students.store');
    Route::get('student/bulk-add','Admin\StudentController@addBulk')->name('admin.students.add.bulk');
    Route::post('student/bulk-add','Admin\StudentController@storeBulk')->name('admin.students.store.bulk');
    Route::get('student/edit/{id}','Admin\StudentController@edit')->name('admin.students.edit.get');
    Route::post('student/update/{id}','Admin\StudentController@update')->name('admin.students.edit.post');
    Route::post('student/reset/{id}','Admin\StudentController@passwordReset')->name('admin.students.password-reset.post');
    Route::post('student/deactivate/{id}','Admin\StudentController@deactivate')->name('admin.students.deactivate');
    Route::post('student/activate/{id}','Admin\StudentController@activate')->name('admin.students.activate');
    
    Route::get('subjects','Admin\SubjectController@show')->name('subjects.list.get');
    Route::get('subject/add','Admin\SubjectController@add')->name('subjects.add.get');
    Route::post('subject/add','Admin\SubjectController@store')->name('subjects.add.post');
    Route::get('subject/edit/{id}','Admin\SubjectController@edit')->name('subjects.edit.get');
    Route::post('subject/edit/{id}','Admin\SubjectController@update')->name('subjects.edit.post');
    Route::post('subject/deactivate/{id}','Admin\SubjectController@deactivate')->name('subjects.deactivate');
    Route::post('subject/activate/{id}','Admin\SubjectController@activate')->name('subjects.activate');

    Route::get('teachers','Admin\TeacherController@show')->name('teachers.list.get');
    Route::get('teacher/add','Admin\TeacherController@add')->name('teachers.add.get');
    Route::post('teacher/add','Admin\TeacherController@store')->name('teachers.add.post');
    Route::get('teacher/edit/{id}','Admin\TeacherController@edit')->name('teachers.edit.get');
    Route::post('teacher/edit/{id}','Admin\TeacherController@update')->name('teachers.edit.post');
    Route::post('teacher/deactivate/{id}','Admin\TeacherController@deactivate')->name('teachers.deactivate');
    Route::post('teacher/activate/{id}','Admin\TeacherController@activate')->name('teachers.activate');

    Route::get('virtual-classes','Admin\VirtualClassController@show')->name('virtual.classes.list.get');
    Route::get('virtual-class/add','Admin\VirtualClassController@add')->name('virtual.classes.add.get');
    Route::post('virtual-class/add','Admin\VirtualClassController@store')->name('virtual.classes.add.post');
    Route::get('virtual-class/edit/{id}','Admin\VirtualClassController@edit')->name('virtual.classes.edit.get');
    Route::post('virtual-class/edit/{id}','Admin\VirtualClassController@update')->name('virtual.classes.edit.post');
    Route::post('virtual-class/upload/{id}','Admin\VirtualClassController@upload')->name('virtual.classes.upload.post');
    Route::post('virtual-class/deactivate/{id}','Admin\VirtualClassController@deactivate')->name('virtual.classes.deactivate');
    Route::post('virtual-class/activate/{id}','Admin\VirtualClassController@activate')->name('virtual.classes.activate');
    Route::get('virtual-class/{id}/sessions','Admin\VirtualClassController@sessionList')->name('virtual.classes.session.get');
    Route::post('virtual-class/{id}/sessions','Admin\VirtualClassController@storeSession')->name('virtual.classes.session.post');
    Route::get('virtual-class/{id}/payments','Admin\VirtualClassController@paymentList')->name('virtual.classes.payment.get');
    Route::post('virtual-class/{id}/payments','Admin\VirtualClassController@storePayments')->name('virtual.classes.payment.post');
    Route::post('virtual-class/{id}/payments/remove/{payment_id}','Admin\VirtualClassController@removePayments')->name('virtual.classes.payment.remove.post');

    Route::get('banners/{grade?}','Admin\BannerController@show')->name('banner.get');
    Route::post('banners','Admin\BannerController@upload')->name('banner.post');
});

Route::get('/', function () {
    return redirect()->to(route('home'));
});


Auth::routes();
Route::get('register', function(){
    abort(404);
});

Route::get('home', 'HomeController@index')->name('home');
Route::post('student/update', 'HomeController@update')->name('student.update');
