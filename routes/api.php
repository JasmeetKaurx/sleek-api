<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenCategoryController;
use App\Http\Controllers\WomenCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;

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


Route::get('men/category', [MenCategoryController::class, 'get']);
Route::get('women/category', [WomenCategoryController::class, 'get']);
Route::post('subcategory', [SubcategoryController::class, 'get']);
Route::post('product/category', [ProductController::class, 'getProductsByCategory']);
Route::post('product/subcategory', [ProductController::class, 'getProductsBySubcategory']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
