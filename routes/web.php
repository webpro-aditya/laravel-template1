<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;

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

// Route::get('/check', function(){
//   echo date('Y-m-d');
// });

// Authenticated routes
Route::group(['middleware' => 'auth'], function () {
    // Admin prefix routes
    Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
        // Access only for admin
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('/loadChangePass', [AdminController::class, 'changePass'])->name('admin.loadChangePass');
        Route::post('/changePassword', [AdminController::class, 'updatePass'])->name('admin.changePassword');

      
    });
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/home', [HomeController::class, 'home'])->name('home.home');
    Route::get('/login', [HomeController::class, 'login'])->name('home.login');
    Route::get('/admin', [HomeController::class, 'login'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login');



    Route::get('/thanks', [HomeController::class, 'thanks'])->name('page.thanks');

    //Page Not Found
    // Route::fallback([PageController::class, 'pageNotFound'])->name('pageNotFound');
});
