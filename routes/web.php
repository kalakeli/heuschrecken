<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [App\Http\Controllers\PagesController::class, 'welcome'] );

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/datenschutz', [App\Http\Controllers\PagesController::class, 'dsgvo'] );
Route::get('/impressum', [App\Http\Controllers\PagesController::class, 'imprint'] );
Route::get('/orthopteraweb', [App\Http\Controllers\PagesController::class, 'orthopteraweb'] );
Route::get('/methodik', [App\Http\Controllers\PagesController::class, 'methods'] );
Route::get('/projekte', [App\Http\Controllers\PagesController::class, 'projects'] );
Route::get('/artenliste', [App\Http\Controllers\PagesController::class, 'species'] );

// ENGLISCHE VERSIONEN 
// Route::get('/en/orthopteraweb', [App\Http\Controllers\PagesController::class, 'en_orthopteraweb'] );
Route::get('/methods', [App\Http\Controllers\PagesController::class, 'en_methods'] );
Route::get('/projects', [App\Http\Controllers\PagesController::class, 'en_projects'] );
Route::get('/species', [App\Http\Controllers\PagesController::class, 'en_species'] );


Route::middleware('auth')->group(function () {
    Route::get('/cms', [App\Http\Controllers\PagesController::class, 'cms'] );
});


// Route::get('/cms/{catchall?}', ['as' => 'start', 'middleware' => 'auth', function() {
//     return view('pages.cms');
// }])->where('catchall', '.*');

Route::get('/cms/{catchall?}', 
    ['as' => 'start', 'middleware' => 'auth', 
        [App\Http\Controllers\PagesController::class, 'cms'] 
    ]
)->where('catchall', '.*');

// Universal-Antwort - fuer alle, die falsch sind
Route::get('/methods/{path}',[App\Http\Controllers\PagesController::class, 'en_methods'])->where( 'path', '.*' );
Route::get('/projects/{path}',[App\Http\Controllers\PagesController::class, 'en_projects'])->where( 'path', '.*' );
Route::get('/species/{path}',[App\Http\Controllers\PagesController::class, 'en_species'])->where( 'path', '.*' );
Route::get('/methodik/{path}',[App\Http\Controllers\PagesController::class, 'methods'])->where( 'path', '.*' );
Route::get('/projekte/{path}',[App\Http\Controllers\PagesController::class, 'projects'])->where( 'path', '.*' );
Route::get('/artenliste/{path}',[App\Http\Controllers\PagesController::class, 'species'])->where( 'path', '.*' );
Route::get('/{path}', [App\Http\Controllers\PagesController::class, 'error'])->where( 'path', '.*' );


// ROUTE::post(uri:'language-switch', action: [App\Http\Controllers\LanguageController::class, 'languageSwitch'])->name(name: 'language-switch');