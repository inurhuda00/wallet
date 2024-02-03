<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

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

Route::post('/deposit', function (Request $request) {
    // Validasi parameter
    $validator = Validator::make($request->all(), [
        'order_id' => 'required|string',
        'amount' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
        'timestamp' => 'required|date',
    ]);

    if ($validator->fails()) {
        return response()->json(['status' => 2, 'error' => $validator->errors()], 400);
    }

    return response()->json([
        'status' => 1,
        'order_id' => $request->input('order_id'),
        'amount' => $request->input('amount'),
        'timestamp' => $request->input('timestamp'),
    ], 200);

})->middleware('auth.base64');

Route::redirect('home', '/')->name('home');

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');
    Route::post('logout', LogoutController::class)
        ->name('logout');
});
