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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/datenschutz', function () { return view('pages.datenschutz'); });
// Route::get('/impressum', function () { return view('pages.imprint'); });
// Route::get('/orthopteraweb', function () { return view('pages.orthopteraweb'); });
// Route::get('/methodik', function () { return view('pages.methodikliste'); });
// Route::get('/projekte', function () { return view('pages.projektliste'); });
// Route::get('/artenliste', function () { return view('pages.artenliste'); });
Route::get('/datenschutz', [App\Http\Controllers\PagesController::class, 'dsgvo'] );
Route::get('/impressum', [App\Http\Controllers\PagesController::class, 'imprint'] );
Route::get('/orthopteraweb', [App\Http\Controllers\PagesController::class, 'orthopteraweb'] );
Route::get('/methodik', [App\Http\Controllers\PagesController::class, 'methods'] );
Route::get('/projekte', [App\Http\Controllers\PagesController::class, 'projects'] );
Route::get('/artenliste', [App\Http\Controllers\PagesController::class, 'species'] );

Route::middleware('auth')->group(function () {
    Route::get('/cms', function () { return view('pages.cms'); });
});


Route::get('/cms/{catchall?}', ['as' => 'start', 'middleware' => 'auth', function() {
    return view('pages.cms');
}])->where('catchall', '.*');

// Universal-Antwort - fuer alle, die falsch sind
Route::get('/methodik/{path}',[App\Http\Controllers\PagesController::class, 'methods'])->where( 'path', '.*' );
Route::get('/projekte/{path}',[App\Http\Controllers\PagesController::class, 'projects'])->where( 'path', '.*' );
Route::get('/artenliste/{path}',[App\Http\Controllers\PagesController::class, 'species'])->where( 'path', '.*' );
Route::get('/{path}', [App\Http\Controllers\PagesController::class, 'error'])->where( 'path', '.*' );