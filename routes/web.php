<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GalleryController;

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
Route::get('login', [AuthController::class, 'index'])->name('login');

Route::group([
    'prefix' => 'admin'
], function () {
    Route::get('/', [AuthController::class, 'index'])->name('admin');
    Route::post('login', [AuthController::class, 'login'])->name('admin.login');

    Route::group([
        'middleware' => ['auth:admin']
    ], function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');

        //role Management Routes
        Route::group([
            'middleware' => ['CheckPermission'], 'prefix' => 'role'
        ], function () {
            Route::get('', [RoleController::class, 'index'])->name('admin.role');
            Route::get('/add', [RoleController::class, 'roleAdd'])->name('admin.role.add');
            Route::post('/insert', [RoleController::class, 'roleInsert'])->name('admin.role.insert');
            Route::get('/edit/{id}', [RoleController::class, 'roleEdit'])->name('admin.role.edit');
            Route::post('/update/{id}', [RoleController::class, 'roleUpdate'])->name('admin.role.update');
            Route::get('/remove/{id}', [RoleController::class, 'roleRemove'])->name('admin.role.remove');
        });
        //user Management Routes
        Route::group([
            'middleware' => ['CheckPermission'], 'prefix' => 'user'
        ], function () {
            Route::get('', [UserController::class, 'index'])->name('admin.user');
            Route::get('/add', [UserController::class, 'userAdd'])->name('admin.user.add');
            Route::post('/insert', [UserController::class, 'userInsert'])->name('admin.user.insert');
            Route::get('/edit/{id}', [UserController::class, 'userEdit'])->name('admin.user.edit');
            Route::post('/update/{id}', [UserController::class, 'userUpdate'])->name('admin.user.update');
            Route::get('/remove/{id}', [UserController::class, 'userRemove'])->name('admin.user.remove');
        });

        //gallery Management Routes
        Route::group(['prefix' => 'gallery'], function () {
            Route::get('', [GalleryController::class, 'index'])->name('admin.gallery');
            Route::get('/add', [GalleryController::class, 'galleryAdd'])->name('admin.gallery.add');
            Route::post('/insert', [GalleryController::class, 'galleryInsert'])->name('admin.gallery.insert');
            Route::get('/edit/{id}', [GalleryController::class, 'galleryEdit'])->name('admin.gallery.edit');
            Route::get('/view/{id}', [GalleryController::class, 'galleryView'])->name('admin.gallery.view');
            Route::post('/update/{id}', [GalleryController::class, 'galleryUpdate'])->name('admin.gallery.update');
            Route::get('/remove/{id}', [GalleryController::class, 'galleryRemove'])->name('admin.gallery.remove');
            Route::post('/remove/img', [GalleryController::class, 'galleryImgRemove'])->name('admin.gallery.img.remove');
        });
    });
});
