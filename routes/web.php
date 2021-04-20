<?php

use App\Http\Controllers\CharController;
use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/', [CharController::class, 'list']);
Route::get('/char/add', [CharController::class, 'addForm']);
Route::post('/char/add', [CharController::class, 'add']);
Route::get('/char/detail/{id}', [CharController::class, 'show']);


Route::get('/inventory/add/{charId}/{itemId}', [InventoryController::class, 'add']);
Route::get('/inventory/equip/{charId}/{itemId}', [InventoryController::class, 'equip']);
Route::get('/inventory/unequip/{charId}/{itemId}', [InventoryController::class, 'unequip']);
Route::get('/inventory/remove/{charId}/{itemId}', [InventoryController::class, 'remove']);

Route::get('/history/{CharId}', function () {
    return view('history');
});


Auth::routes();

Route::get('/home', [CharController::class, 'list']);
