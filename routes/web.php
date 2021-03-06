<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix("admin")->middleware(["auth", 'isAdmin'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');



    Route::controller(CategoryController::class)->group(function () {
        //Category Routes
        Route::get("category", "index")->name("admin.category.index");
        Route::get("category/create", "create");
        Route::post("category", "store");

        Route::get("category/{category}/edit", "edit");
        Route::put("category/{category}", "update");

        Route::get("category/{category}/delete", "delete");
        Route::post("category/{category/edit", "destroy");
    });
});