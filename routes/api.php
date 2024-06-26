<?php

use App\Http\Controllers\Api\V1\TransactionController;
use App\Http\Controllers\Api\V1\TransactionInfoController;
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

Route::prefix('v1')->group(function (){
   Route::post('/make_payment', [TransactionController::class, 'makeTransaction'])->name('make_transaction');
   Route::post('/payment', [TransactionInfoController::class, 'transaction'])->name('transaction');
   Route::post('/update_payment_info', [TransactionInfoController::class, 'updatePaymentInfo'])->name('update_payment_info');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


