<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\RealEstateController;
use App\Models\RealEstate;
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
