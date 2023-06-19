<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ModulesController;
use App\Http\Controllers\ProjectsController;

use Illuminate\Support\Facades\Route;

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
    return view('home');
  })->middleware(['auth', 'verified'])->name('homr');
  
  

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    
    
  Route::get('/profile', [ProfileController::class,'edit'])->name('profile');
  Route::get('/profile.avatar', [ProfileController::class,'avatar'])->name('profile.avatar');
  Route::get('/profile.password', [ProfileController::class,'password'])->name('profile.password');

  Route::post('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
  Route::post('/profile-avatar-update', [ProfileController::class, 'avatar_update'])->name('profile.avatar.update');
  Route::post('/profile-password-update', [ProfileController::class, 'password_update'])->name('profile.password.update');

  Route::resource('/modules', ModulesController::class);
  Route::get('/modules.moreordering/{id}/{foo}', [ModulesController::class, 'moreordering'])->name('modules.moreordering');
  Route::get('/modules.lessordering/{id}/{foo}', [ModulesController::class, 'lessordering'])->name('modules.lessordering');

});