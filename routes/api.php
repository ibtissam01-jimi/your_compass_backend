<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\Tourist_GuideController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/',function(){
    return 'home api page';
});

Route::post('/register',[AuthController::class,'register']);
Route::post('/registertest',[AuthController::class,'test']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class, 'logout'])->middleware('auth:api');
Route::post('refresh', [AuthController::class, 'refresh']);


Route::post('/new_submission',[SubmissionController::class, 'store']);
Route::post('/new_test',[SubmissionController::class, 'store']);

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/guides',[Tourist_GuideController::class, 'index']);

Route::get('/categories', [CategorieController::class, 'index']);
Route::get('/cities', [CityController::class, 'index']);





// Route::post('/business_submission', [S])