<?php


use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});



Auth::routes(['register'=> false]);

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    //Route group attendance
    Route::get('/attendances', 'AttendanceController@index')->name('index.attendance');
    Route::get('/attendance/check-in', 'AttendanceController@create')->name('create.attendance');
    Route::post('/attendance', 'AttendanceController@store')->name('store.attendance');
    Route::get('/attendance/{attendance}/check-out/', 'AttendanceController@edit')->name('edit.attendance');
    Route::put('/attendance/{attendance}', 'AttendanceController@update')->name('update.attendance');

    Route::get('/attendance/export-excel', 'AttendanceController@export_excel')->name('export.excel.attendance');
    Route::post('/attendance/export-excel-bymonth', 'AttendanceController@export_byMonthExcel')->name('export.excelByMonth.attendance');


    Route::get('cuti-forms', 'CutiFormController@index')->name('cuti-form.index');
    Route::post('cuti-forms', 'CutiFormController@store')->name('cuti-form.store');

    Route::get('my-profiles', 'ProfileController@index')->name('index.myprofile');
    Route::get('my-profile/{id}/edit', 'ProfileController@getProfile')->name('edit.myprofile');
    Route::put('my-profile/{id}', 'ProfileController@update')->name('update.myprofile');

    Route::delete('my-profile/{id}', 'ProfileController@destroy')->name('delete.myprofile');


    Route::get('otp/verify', 'OTPController@verify')->name('otp.verify');
    Route::post('otp/verify', 'OTPController@check')->name('otp.check');

    Route::post('otp/resend', 'OTPController@resetOtp')->name('otp.resend');


    Route::middleware('admin')->group(function () {

        Route::get('administrator/attendances', 'Administrator\AttendanceController@index')->name('administrator.index.attendance');
        Route::get('administrator/attendance/create', 'Administrator\AttendanceController@create')->name('administrator.create.attendance');
        Route::post('administrator/attendances', 'Administrator\AttendanceController@store')->name('administrator.store.attendance');

        Route::post('administrator/attendances/export-excel-bymonth', 'Administrator\AttendanceController@export_byMonthExcel_administrator')->name('administrator.export-by-month.attendance');
       


        Route::delete('administrator/attendance/{id}', 'Administrator\AttendanceController@destroy')->name('administrator.destroy.attendance');

        //Route group shift-attendance
        Route::get('administrator/shift-attendance/create', 'Administrator\ShiftAttendanceController@create')->name('create.shift-attendance');
        Route::get('administrator/shift-attendances', 'Administrator\ShiftAttendanceController@index')->name('index.shift-attendance');
        Route::get('administrator/shift-attendance/{id}', 'Administrator\ShiftAttendanceController@show')->name('show.shift-attendance');
        Route::post('administrator/shift-attendance', 'Administrator\ShiftAttendanceController@store')->name('store.shift-attendance');
        Route::get('administrator/shift-attendance/{id}/edit', 'Administrator\ShiftAttendanceController@edit')->name('edit.shift-attendance');
        Route::put('administrator/shift-attendance/{id}', 'Administrator\ShiftAttendanceController@update')->name('update.shift-attendance');
        Route::delete('administrator/shift-attendance/{id}', 'Administrator\ShiftAttendanceController@destroy')->name('destroy.shift-attendance');


        //Route group employee-schedule
        Route::get('administrator/employee-schedules', 'Administrator\EmployeeScheduleController@index')->name('index.employee-schedule');
        Route::get('administrator/employee-schedule/create', 'Administrator\EmployeeScheduleController@create')->name('create.employee-schedule');
        Route::post('administrator/employee-schedules', 'Administrator\EmployeeScheduleController@store')->name('store.employee-schedule');
        Route::delete('administrator/employee-schedule/{id}', 'Administrator\EmployeeScheduleController@destroy')->name('destroy.employee-schedule');
        Route::delete('administrator/employee-schedules', 'Administrator\EmployeeScheduleController@destroyAll')->name('destroyAll.employee-schedule');



        
        //Route group role

        Route::get('administrator/roles', 'Administrator\RoleController@index')->name('index.role');
        Route::get('administrator/role/create', 'Administrator\RoleController@create')->name('create.role');
        Route::post('administrator/roles', 'Administrator\RoleController@store')->name('store.role');
        Route::get('administrator/role/{id}', 'Administrator\RoleController@show')->name('show.role');
        Route::get('administrator/role/{id}/edit', 'Administrator\RoleController@edit')->name('edit.role');

        Route::put('administrator/role/{id}', 'Administrator\RoleController@update')->name('update.role');

        Route::delete('administrator/role/{id}', 'Administrator\RoleController@destroy')->name('destroy.role');


        Route::get('administrator/user-managers', 'Administrator\UserController@index')->name('index.user-manager');
        Route::get('administrator/user-managers/create', 'Administrator\UserController@create')->name('create.user-manager');
        Route::post('administrator/user-managers', 'Administrator\UserController@store')->name('store.user-manager');
        Route::get('administrator/user-manager/{id}/edit', 'Administrator\UserController@edit')->name('edit.user-manager');
        Route::put('administrator/user-manager/{id}', 'Administrator\UserController@update')->name('update.user-manager');

        Route::get('administrator/my-profile', 'Administrator\ProfileController@index')->name('administrator.index.my-profile');
        Route::get('administrator/my-profile/{id}/edit', 'Administrator\ProfileController@getProfile')->name('administrator.edit.my-profile');
        Route::put('administrator/my-profile/{id}', 'Administrator\ProfileController@update')->name('administrator.update.my-profile');




        Route::get('administrator/locations', 'Administrator\LocationController@index')->name('administrator.index.location');
        Route::post('administrator/locations', 'Administrator\LocationController@store')->name('administrator.store.location');
        Route::delete('administrator/location/{id}', 'Administrator\LocationController@destroy')->name('administrator.destroy.location');


        Route::get('administrator/logos', 'Administrator\LogoController@index')->name('administrator.index.logo');
        Route::post('administrator/logos', 'Administrator\LogoController@store')->name('administrator.store.logo');
        Route::get('administrator/logo/{logo}', 'Administrator\LogoController@show')->name('administrator.show.logo');
        Route::get('administrator/logo/{logo}/edit', 'Administrator\LogoController@edit')->name('administrator.edit.logo');
        Route::put('administrator/logo/{logo}', 'Administrator\LogoController@update')->name('administrator.update.logo');

        Route::delete('administrator/logo/{logo}', 'Administrator\LogoController@destroy')->name('administrator.destroy.logo');

        Route::get('administrator/cuti-accepts', 'Administrator\CutiAcceptController@index')->name('administrator.index.cuti-accept');
        Route::get('administrator/cuti-accept/{id}/edit', 'Administrator\CutiAcceptController@edit')->name('administrator.edit.cuti-accept');

        Route::put('administrator/cuti-accept/{id}', 'Administrator\CutiAcceptController@update')->name('administrator.update.cuti-accept');
        Route::delete('administrator/cuti-accept/{id}', 'Administrator\CutiAcceptController@destroy')->name('administrator.destroy.cuti-accept');




    });
    
});

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
// Route::get('admin/dashboard/attendance', 'Dashboard\AttendanceController@create')->name('index.dashboard.attendance');
