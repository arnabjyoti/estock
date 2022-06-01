<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemAddingController;
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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/itemDetails', [ItemController::class, 'index'])->name('itemDetails');
Route::get('/itemReceived', [ItemController::class, 'ReceivedItems'])->name('recievedReport');
Route::get('/itemDisbursed', [ItemController::class, 'DisbursedItems'])->name('disbursedReport');
Route::POST('/addItem', [ItemAddingController::class, 'datasubmit'])->name('addItem');
Route::POST('/addReceivedItem', [ItemAddingController::class, 'AddReceivedItem'])->name('addReceivedItem');
Route::POST('/addDisbursedItem', [ItemAddingController::class, 'AddDisbursedItem'])->name('addDisbursedItem');
Route::POST('/deleteItem', [ItemAddingController::class, 'DeleteItem'])->name('deleteItem');
Route::POST('/deleteRecItem', [ItemAddingController::class, 'DeleteRecItem'])->name('deleteRecItem');
Route::POST('/deleteDisItem', [ItemAddingController::class, 'DeleteDisItem'])->name('deleteDisItem');

Route::get('/addItemForm', [ItemAddingController::class, 'AddItemForm'])->name('addItemForm');
Route::GET('/receivedReport',[ItemController::class, 'ItemReceivedReport'])->name('receivedreport');
Route::GET('/disbursedReport',[ItemController::class, 'ItemDisbursedReport'])->name('disbursedreport');
Route::GET('/itemReceievedForm',[ItemController::class, 'ItemReceievedForm'])->name('itemReceievedForm');
Route::GET('/itemDisbursedForm',[ItemController::class, 'ItemDisbursedForm'])->name('itemDisbursedForm');

Route::GET('/expiryReport',[App\Http\Controllers\HomeController::class, 'expiryReport'])->name('expiryReport');


