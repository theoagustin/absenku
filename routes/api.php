<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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


Route::post('loginApi', [ApiController::class, 'login']);
Route::post('absensi', [ApiController::class, 'index']);
Route::post('dataUser', [ApiController::class, 'getDataByIds']);
Route::post('changepass', [ApiController::class, 'changePassword']);
Route::post('changeuser', [ApiController::class, 'changeUsername']);
// Route::post('addPermohonan', [ApiController::class, 'addPermohonanCuti'])->withoutMiddleware('auth:api');
// web.php atau api.php
// Route::get('/addPermohonanCuti', [APiController::class, 'addPermohonanCuti']);
// routes/api.php
Route::post('/addPermohonanCuti', [ApiController::class, 'addPermohonanCuti']);


Route::post('getper', [ApiController::class, 'getper']);
Route::post('deletePermohonanCuti', [ApiController::class, 'deletePermohonanCuti']);
Route::post('/updatePermohonanCuti', [ApiController::class, 'updatePermohonanCuti']);
Route::post('absenMasuk', [ApiController::class, 'absenMasuk']);
Route::post('absenKeluar', [ApiController::class, 'absenKeluar']);
Route::post('checkAbsenMasuk', [ApiController::class, 'checkAbsenMasuk']);
Route::post('checkAbsenKeluar', [ApiController::class, 'checkAbsenKeluar']);