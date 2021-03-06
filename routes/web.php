<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\ProductController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
Route::post('types/confirm', [TypeController::class, 'confirm'])->name('types.confirm')->middleware('auth');
Route::resource('types', TypeController::class)->middleware('auth');

Route::post('attributes/confirm', [AttributeController::class, 'confirm'])->name('attributes.confirm')->middleware('auth');
Route::resource('attributes', AttributeController::class)->middleware('auth');

Route::get('get/{id}',[ProductController::class, 'getAttribute'])->name('product.get_get_attribte');
Route::post('products/confirm', [ProductController::class, 'confirm'])->name('products.confirm')->middleware('auth');
Route::resource('products', ProductController::class)->middleware('auth');

Route::get('/export-csv',[ProductController::class, 'exportCsv'])->name('products.export_csv')->middleware('auth');
Route::get('/import_form', [ProductController::class, 'importForm'])->name('products.import_form')->middleware('auth');
Route::post('/import-csv',[ProductController::class, 'importCsv'])->name('products.import_csv')->middleware('auth');
Route::get('/updateStt',[ProductController::class, 'updateStt'])->name('products.updateStt')->middleware('auth'); 