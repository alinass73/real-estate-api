<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\MessageController;
use App\Http\Controllers\Api\V1\RealEstateController;
use App\Http\Controllers\ScheduleVisitController;
use App\Models\RealEstate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Message;
use App\Models\ScheduleVisit;

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
Route::post('/register',[AuthController::class,'register']);
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
Route::post('/login',[AuthController::class,'login']);
// Route::get('/admin',[RealEstateController::class,'test']);
Route::get('/admin',[RealEstateController::class,'test'])->middleware(['auth:sanctum','admin']);

Route::prefix('/real-estate')->group(function(){
    Route::get('/',[RealEstateController::class,'index'])->middleware(['auth:sanctum']);
    Route::post('/store',[RealEstateController::class,'store'])->middleware(['auth:sanctum','admin']);
    Route::patch('/{real_estate}/update',[RealEstateController::class,'update'])->middleware(['auth:sanctum','admin']);
    Route::delete('/{real_estate}/delete',[RealEstateController::class,'destroy'])->middleware(['auth:sanctum','admin']);
    Route::get('/{real_estate}',[RealEstateController::class,'show'])->middleware(['auth:sanctum']);
});

Route::prefix('/message')->group(function(){
    Route::get('/',[MessageController::class,'index'])->middleware(['auth:sanctum']);
    Route::post('/store',[MessageController::class,'store'])->middleware(['auth:sanctum',]);
    Route::delete('/{message}/delete',[MessageController::class,'destroy'])->middleware(['auth:sanctum',]);
    Route::get('/{message}',[MessageController::class,'show'])->middleware(['auth:sanctum']);
});

Route::prefix('/schedule')->middleware(['auth:sanctum'])->group(function(){
    Route::get('/',[ScheduleVisitController::class,'index']);
    Route::get('/my-schedule',[ScheduleVisitController::class,'indexOfMine']);
    Route::post('/store',[ScheduleVisitController::class,'store']);
    Route::patch('/{schedule}/update',[ScheduleVisitController::class,'update']);
});

