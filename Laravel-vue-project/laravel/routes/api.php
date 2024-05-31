<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContactController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('contact', [ContactController::class, 'index']);
Route::post('contact', [ContactController::class, 'store']);
Route::get('contact/{id}', [ContactController::class, 'show']);
Route::get('contact/{id}/edit', [ContactController::class, 'edit']);
Route::put('contact/{id}/edit', [ContactController::class, 'update']);
Route::delete('contact/{id}/delete', [ContactController::class, 'remove']);
// Route::get('contacts', function() {
//     return 'this is from contact API';
// });
