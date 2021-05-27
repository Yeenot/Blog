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

Route::get('/', LoginController::class)->name('login');
Route::get('register', RegisterController::class)->name('register');
Route::post('login', 'AuthenticationController@login')->name('auth.login');
Route::post('register', 'AuthenticationController@register')->name('auth.register');

Route::group(['middleware' => ['auth:web']], function () {
    include('ajax.php');
    Route::get('logout', 'AuthenticationController@logout')->name('auth.logout');
    Route::get('home', HomeController::class)->name('home');
    Route::get('profile/{user}', 'ProfileController@index')->name('profile');
});
// Route::resource('users', "UserController", [
//     'names' => [
//         'index' => 'staff.barbers.index',
//         'create' => 'staff.barbers.create',
//         'store' => 'staff.barbers.store',
//         'show' => 'staff.barbers.show',
//         'edit' => 'staff.barbers.edit',
//         'update' => 'staff.barbers.update',
//         'destroy' => 'staff.barbers.destroy',
//     ]
// ]);