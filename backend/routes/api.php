<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// *** Company Controller ***
Route::group(['middleware' => ['api']], function ($router) {
    Route::get('/get_all_companies_with_respective_employees', [CompanyController::class, 'get_all_companies_with_respective_employees']);
    Route::post('/create_company', [CompanyController::class, 'create_company']);
});

// *** Employee Controller ***
Route::group(['middleware' => ['api']], function ($router) {
    Route::post('/create_employee', [EmployeeController::class, 'create_employee']);
});
