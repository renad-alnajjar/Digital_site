<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\digitalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RegesterUserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Router;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

  Route::get('/',[digitalController::class , 'index'])->name('home');
 Route::prefix('new/user')->group(function () {
    Route::controller(RegesterUserController::class)->group(function () {
        Route::get('/', 'showPageCreateUser')->name('new.user');
        Route::post('/create', 'store');
    });
});
Route::prefix('cms')->middleware('guest:admin,user')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        //**Route  Auth Login */
        Route::get('/{guard}/login', 'showLoginView')->name('login');
        Route::post('/login', 'login');
        //**Route  Auth Forgot Password */
        Route::get('/{guard}/forgot-password', 'showForgotpassword')->name('auth.forgot');
        Route::post('/forgot-password', 'sendRestLink');
        //**Route  Auth Reset Password */
        Route::get('{guard}/reset-password/{token}', 'shoewResetPassword')->name('password.reset');
        Route::post('reset-password', 'resetPassword');
    });
});

Route::prefix('cms/admin')->middleware(['auth:admin,user,pharmacist'])->group(function () {
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::post('roles/permissions', [Rolecontroller::class, 'updateRolePermission']);
});

Route::prefix('cms/admin')->middleware(['auth:admin,user'])->group(function () {
    Route::get('/', [HomeController::class, 'home'])->name('dash.Home');
    Route::resource('/currencies', CurrencyController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/admins', AdminController::class);
    Route::resource('/courses', CoursesController::class);
    Route::resource('/deposits', DepositController::class);




    // Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
});


Route::prefix('cms/admin/')->controller(AuthController::class)->middleware(['auth:admin,user'])->group(function () {
    Route::get('logout', 'logout')->name('logout');
});
