<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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




Route::get('register', ['as' => 'auth.register', 'uses' => 'App\Http\Controllers\UserController@regnew']);
Route::post('/regnew', [UserController::class, 'regnew'])->name('regnew');
            
            

Route::get('programs.index', ['as' => 'programs.index', 'uses' => 'App\Http\Controllers\ProgramController@index']);
Route::view('programs.add','programs.add');
Route::post('programs.add', ['as' => 'programs.add', 'uses' => 'App\Http\Controllers\ProgramController@create']);

Route::get('activity.index', ['as' => 'activity.index', 'uses' => 'App\Http\Controllers\ActivityController@index']);
Route::view('activity.add','activity.add');
Route::post('activity.add', ['as' => 'activity.add', 'uses' => 'App\Http\Controllers\ActivityController@create']);
Route::view('activity.reg','activity.reg');
Route::post('activity.reg', ['as' => 'activity.reg', 'uses' => 'App\Http\Controllers\ActivityAttendanceController@create']);
Route::get('activity.attendance/{id}', ['as' => 'activity.attendance/{id}', 'uses' => 'App\Http\Controllers\ActivityAttendanceController@attendance']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('qr-code', function () {
    return QrCode::size(500)->generate('Welcome to sparkouttech.com!');
});

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});

