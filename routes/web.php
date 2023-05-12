<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');

    Route::middleware(['guest:admin'])->group(function(){

        Route::post('login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->name('login.submit');

          });

    Route::middleware(['auth:admin'])->group(function(){
    
        Route::post('logout', [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('logout');

        Route::get('home', [HomeController::class, 'index'])->name('home');
        
        Route::get('profile', [HomeController::class, 'index'])->name('profile');
        
        Route::get('about', [HomeController::class, 'index'])->name('about');
        
        Route::resource('products', ProductController::class); 
        
        Route::resource('categories', ProductController::class); 
        
    });

});
