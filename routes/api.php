<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;



Route::prefix('auth')->group(function () {
    // http://localhost:80000/api/auth/
    //api/auth/register
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::get('/logout', [UserController::class, 'logout'])->middleware('auth:api');
    Route::get('/user', [UserController::class, 'user'])->middleware('auth:api');
    Route::put('/update', [UserController::class, 'update'])->middleware('auth:api');
    Route::get('/auth-failed', [UserController::class, 'authFailed'])->name('auth-failed');
});
// http://localhost:80000/api/Lookup/
Route::group(['prefix' => 'Lookup','middleware' => 'auth:api'], function (){
    Route::resource('opportunity', OpportunityController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('country', CountryController::class);
});

Route::group(['middleware' => 'auth:api'], function (){

    //Opportunitiea
    Route::resource('opportunity', OpportunityController::class);


    //question
    Route::get('questions',[QuestionController::class, 'index']);
    Route::post('question',[QuestionController::class, 'store']);
    Route::put('question/{question}',[QuestionController::class, 'update']);

    //favorit
    Route::get('favorites',[FavoriteController::class,'index']);
    Route::get('favorite',[FavoriteController::class,'store']);
    Route::get('favorite/{favorite}',[FavoriteController::class,'update']);


});




//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

