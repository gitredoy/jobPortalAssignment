<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\GeneralUserController;
use App\Http\Controllers\Job\JobController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::prefix('general-user')->group(function (){

    Route::post('/create',[UserController::class,'create'])->name('create');

    Route::get('/u-post',function (){
        return ' User Post';
    });
    Route::middleware(['auth:general-api'])->group(function(){
        Route::view('/home','dashboard.user.home')->name('home');

        //Route::post('/logout',[UserController::class,'logout'])->name('logout');
    });
});



Route::post('/check-login',[GeneralUserController::class,'login']);
Route::post('/check-registration',[GeneralUserController::class,'registration']);
Route::group(['middleware' => 'auth:general-api'], function () {
    Route::get('logout', [GeneralUserController::class,'logout']);
    Route::get('active-jobs', [JobController::class,'activeJob']);
    Route::get('single-job/{id}', [JobController::class,'singleJob']);
    Route::post('job-apply/{id}', [JobController::class,'jobApply']);
});



