<?php

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


/*
|--------------------------------------------------------------------------
| GETS
|--------------------------------------------------------------------------
*/

// COPYRIGHTS
Route::get('/copyrights', [App\Http\Controllers\CopyrightController::class, 'index']);
Route::get('/copyrights/{id}', [App\Http\Controllers\CopyrightController::class, 'show']);
    
// IMAGES
Route::get('/images', [App\Http\Controllers\ImageController::class, 'index']);
Route::get('/images/nonspecies', [App\Http\Controllers\ImageController::class, 'getNonSpeciesImages']);
Route::get('/images/bannerimages', [App\Http\Controllers\ImageController::class, 'getBannerImages']);
Route::get('/images/{id}', [App\Http\Controllers\ImageController::class, 'show']);
    
// Methodik
Route::get('/methods', [App\Http\Controllers\MethodController::class, 'index']);
Route::get('/methods/by/url/{url}', [App\Http\Controllers\MethodController::class, 'getMethodByURL']);
Route::get('/methods/{id}', [App\Http\Controllers\MethodController::class, 'show']);
    
// PROJECTS
Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index']);
Route::get('/projects/limit/{nr}', [App\Http\Controllers\ProjectController::class, 'getProjects']);
Route::get('/projects/by/url/{url}', [App\Http\Controllers\ProjectController::class, 'getProjectByURL']);
Route::get('/projects/{id}', [App\Http\Controllers\ProjectController::class, 'show']);

// REFERENCES
Route::get('/taxonomies/families', [App\Http\Controllers\ReferenceController::class, 'getFamilies']);
Route::get('/taxonomies/orders', [App\Http\Controllers\ReferenceController::class, 'getOrders']);
Route::get('/taxonomies/subfamilies', [App\Http\Controllers\ReferenceController::class, 'getSubFamilies']);
Route::get('/taxonomies/suborders', [App\Http\Controllers\ReferenceController::class, 'getSubOrders']);

// ORTHOPTERAWEB
Route::get('/orthoptera/occurences/last/{nr}', [App\Http\Controllers\SpeciesController::class, 'getAllOccurences']);

// SPECIES
Route::get('/species', [App\Http\Controllers\SpeciesController::class, 'index']);
Route::get('/species/by/family/{id}', [App\Http\Controllers\SpeciesController::class, 'showByFamily']);
Route::get('/species/by/id/{id}', [App\Http\Controllers\SpeciesController::class, 'show']);
Route::get('/species/by/url/{url}', [App\Http\Controllers\SpeciesController::class, 'getSpeciesByURL']);
Route::get('/species/{id}/images', [App\Http\Controllers\ImageController::class, 'getSpeciesImages']);
Route::get('/species/{id}/occurences/last/{nr}', [App\Http\Controllers\SpeciesController::class, 'getLastOccurences']);

// USERS
Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'getUser']);

/*
|--------------------------------------------------------------------------
| POSTS
|--------------------------------------------------------------------------
*/
Route::post('/methods/friendlyurl', [App\Http\Controllers\MethodController::class, 'getFriendlyURL']);
Route::post('/methods', [App\Http\Controllers\MethodController::class, 'store']);
Route::post('/projects/friendlyurl', [App\Http\Controllers\ProjectController::class, 'getFriendlyURL']);
Route::post('/projects', [App\Http\Controllers\ProjectController::class, 'store']);
Route::post('/species', [App\Http\Controllers\SpeciesController::class, 'store']);


/*
|--------------------------------------------------------------------------
| PUTS
|--------------------------------------------------------------------------
*/
Route::put('/projects/{id}', [App\Http\Controllers\ProjectController::class, 'update']);
Route::put('/species/{id}', [App\Http\Controllers\SpeciesController::class, 'update']);

/*
|--------------------------------------------------------------------------
| DELETES
|--------------------------------------------------------------------------
*/
Route::delete('/images/{id}', [App\Http\Controllers\ImageController::class, 'destroy']);
Route::delete('/methods/{id}', [App\Http\Controllers\MethodController::class, 'destroy']);
Route::delete('/projects/{id}', [App\Http\Controllers\ProjectController::class, 'destroy']);
Route::delete('/species/{id}', [App\Http\Controllers\SpeciesController::class, 'destroy']);
