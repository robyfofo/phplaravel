<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ModulesController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LevelsController;
use App\Http\Controllers\ThirdpartiesController;
use App\Http\Controllers\ThirdpartiesCategoriesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TimecardsController;
use App\Http\Controllers\EstimatesController;

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
  })->middleware(['auth', 'verified'])->name('home');
  
  

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    
    
  Route::get('/profile', [ProfileController::class,'edit'])->name('profile');
  Route::get('/profile.avatar', [ProfileController::class,'avatar'])->name('profile.avatar');
  Route::get('/profile.password', [ProfileController::class,'password'])->name('profile.password');

  Route::post('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
  Route::post('/profile-avatar-update', [ProfileController::class, 'avatar_update'])->name('profile.avatar.update');
  Route::post('/profile-password-update', [ProfileController::class, 'password_update'])->name('profile.password.update');

  Route::resource('/users', UsersController::class);
  
  Route::resource('/levels', LevelsController::class);
  
  Route::resource('/modules', ModulesController::class);
  Route::get('/modules.moreordering/{id}/{foo}', [ModulesController::class, 'moreordering'])->name('modules.moreordering');
  Route::get('/modules.lessordering/{id}/{foo}', [ModulesController::class, 'lessordering'])->name('modules.lessordering');
  
  Route::resource('/projects', ProjectsController::class);
  Route::get('/projects.moreordering/{id}/{foo}', [ProjectsController::class, 'moreordering'])->name('projects.moreordering');
  Route::get('/projects.lessordering/{id}/{foo}', [ProjectsController::class, 'lessordering'])->name('projects.lessordering');
  
  Route::resource('/thirdparties', ThirdpartiesController::class);

  Route::resource('/thirdpartiescategories', ThirdpartiesCategoriesController::class);
  Route::get('/thirdpartiescategories.moreordering/{id}/{foo}', [ThirdpartiesCategoriesController::class, 'moreordering'])->name('thirdpartiescategories.moreordering');
  Route::get('/thirdpartiescategories.lessordering/{id}/{foo}', [ThirdpartiesCategoriesController::class, 'lessordering'])->name('thirdpartiescategories.lessordering');
  
  // timecards
  Route::get('/timecards', [TimecardsController::class, 'index'])->name('timecards.index');
  Route::post('/timecards/store', [TimecardsController::class, 'store'])->name('timecards.store');
  Route::put('/timecards/{timecard}', [TimecardsController::class, 'update'])->name('timecards.update');
  Route::delete('/timecards/{timecard}', [TimecardsController::class, 'destroy'])->name('timecards.destroy');
  Route::get('/timecards/{timecard}/edit', [TimecardsController::class, 'edit'])->name('timecards.edit');
  Route::get('/timecards/list', [TimecardsController::class, 'list'])->name('timecards.list');
  Route::get('/timecards/listpdf', [TimecardsController::class, 'listpdf'])->name('timecards.listpdf');
  Route::get('timecards/{any}', function () {
    return abort('404');
  })->where('any', '.*');


  // timecards
  Route::put('/estimates/ajaxgetarticleslist', [EstimatesController::class, 'ajaxgetarticleslist'])->name('estimates.ajaxgetarticleslist');
  Route::put('/estimates/ajaxeditarticle', [EstimatesController::class, 'ajaxeditarticle'])->name('estimates.ajaxeditarticle');
  
  
  Route::put('/estimates/ajaxinsertsessarticle', [EstimatesController::class, 'ajaxinsertsessarticle'])->name('estimates.ajaxinsertsessarticle');
  Route::put('/estimates/ajaxdeletesessarticle', [EstimatesController::class, 'ajaxdeletesessarticle'])->name('estimates.ajaxdeletesessarticle');
  Route::put('/estimates/ajaxeditsessarticle', [EstimatesController::class, 'ajaxeditsessarticle'])->name('estimates.ajaxeditsessarticle');
  Route::put('/estimates/ajaxdeletearticle', [EstimatesController::class, 'ajaxdeletearticle'])->name('estimates.ajaxdeletearticle');
  
  Route::get('/estimates', [EstimatesController::class, 'index'])->name('estimates.index');
  Route::get('/estimates/create', [EstimatesController::class, 'create'])->name('estimates.create');
  Route::post('/estimates/store', [EstimatesController::class, 'store'])->name('estimates.store');
  Route::get('/estimates/{estimate}/edit', [EstimatesController::class, 'edit'])->name('estimates.edit');
  Route::put('/estimates/{estimate}', [EstimatesController::class, 'update'])->name('estimates.update');
  Route::delete('/estimates/{estimate}', [EstimatesController::class, 'destroy'])->name('estimates.destroy');


  Route::get('estimates/{any}', function () {
    return abort('404');
  })->where('any', '.*');

  Route::resource('/categories', CategoriesController::class);

});


use App\Http\Controllers\AjaxrequestsController;
Route::controller(AjaxrequestsController::class)->group(function () {
    Route::post('/ajaxrequests/setdbrowactive', 'setdbrowactive');

    Route::put('/ajaxrequests/getcitiesjsonfromdb', 'getcitiesjsonfromdb');
    Route::put('/ajaxrequests/getcityjsonfromdb', 'getcityjsonfromdb');

    Route::put('/ajaxrequest/getprojecttimecards','getprojecttimecards');
});
