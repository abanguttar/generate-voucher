<?php

use App\Http\Controllers\MasterPelatihanController;
use App\Http\Controllers\TesterHelperLingkaran;
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Route;

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


Route::get('/home', [TesterHelperLingkaran::class, 'index']);
Route::get('/generateVoucher', [VoucherController::class, 'addVoucher']);
Route::get('/voucher', [VoucherController::class, 'index']);
Route::get('/masterpelatihan', [MasterPelatihanController::class, 'index']);
Route::post('/createPelatihan', [MasterPelatihanController::class, 'create']);
Route::post('/generateVoucher', [VoucherController::class, 'create']);
Route::post('/deleteVoucher', [VoucherController::class, 'delete']);
