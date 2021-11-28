<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Job\JobTypeController;
use App\Http\Controllers\Job\JobController;

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

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->group(function(){

    Route::middleware(['guest:admin','preventBackHistory'])->group(function(){
        Route::view('/login','dashboard.admin.login')->name('login');
        Route::post('/check',[AdminController::class,'check'])->name('check');
    });

    Route::middleware(['auth:admin','preventBackHistory'])->group(function(){
        Route::get('/home',[AdminController::class,'home'])->name('home');
        Route::post('/logout',[AdminController::class,'logout'])->name('logout');

        //Job Type Controller
        Route::get('/job-type-list',[JobTypeController::class,'list'])->name('job-type-list');
        Route::get('/job-type-create',[JobTypeController::class,'create'])->name('job-type-create');
        Route::post('/job-type-store',[JobTypeController::class,'store'])->name('job-type-store');
        Route::get('/job-type-edit/{id}',[JobTypeController::class,'edit'])->name('job-type-edit');
        Route::get('/job-type-status/{id}',[JobTypeController::class,'status'])->name('job-type-status');
        Route::get('/job-type-delete/{id}',[JobTypeController::class,'delete'])->name('job-type-delete');

        //Job Controller
        Route::get('/job-list',[JobController::class,'list'])->name('job-list');
        Route::get('/job-create',[JobController::class,'create'])->name('job-create');
        Route::post('/job-store',[JobController::class,'store'])->name('job-store');
        Route::get('/job-edit/{id}',[JobController::class,'edit'])->name('job-edit');
        Route::get('/job-status/{id}',[JobController::class,'status'])->name('job-status');
        Route::get('/job-delete/{id}',[JobController::class,'delete'])->name('job-delete');

        //Applicant List
        Route::get('/applicant-list/{id}',[AdminController::class,'applicantList'])->name('applicant-list');

        //General User List
        Route::get('/general-user',[AdminController::class,'user'])->name('user-list');





    });

});








Route::prefix('user')->name('user.')->group(function (){
    Route::middleware(['guest:web','preventBackHistory'])->group(function(){
        Route::view('/login','dashboard.user.login')->name('login');
        Route::view('/register','dashboard.user.register')->name('register');
        Route::post('/create',[UserController::class,'create'])->name('create');
        Route::post('/check',[UserController::class,'check'])->name('check');
    });

    Route::middleware(['auth:web','preventBackHistory'])->group(function(){
        Route::view('/home','dashboard.user.home')->name('home');
        Route::get('/u-post',function (){
            return ' User Post';
        });
        Route::post('/logout',[UserController::class,'logout'])->name('logout');
    });
});
