<?php

use App\Http\Controllers\MultipicController;
use App\Http\Controllers\CatagoryController;
use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    return view('welcome');
});
// Catagory Controller

Route::get('/catagory/all', [CatagoryController::class, 'AllCat'])->name('all.catagory');
Route::post('/catagory/add', [CatagoryController::class, 'AddCat'])->name('store.catagory');


Route::get('/catagory/edit/{id}', [CatagoryController::class, 'edit']);
Route::post('/catagory/update/{id}', [CatagoryController::class, 'update']);


Route::get('/softdelete/catagory/{id}', [CatagoryController::class, 'softdelete']);
Route::get('/catagory/restore/{id}', [CatagoryController::class, 'restore']);
Route::get('/pdelete/catagory/{id}', [CatagoryController::class, 'pdelete']);

//brand controller

Route::get('/brand/all', [BrandController::class, 'allBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'StoreBrand'])->name('store.brand');


Route::get('/brand/edit/{id}', [BrandController::class, 'edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'update']);


Route::get('/brand/delete/{id}', [BrandController::class, 'delete']);


//multi image

Route::get('/multi/image', [MultipicController::class, 'multipic'])->name('multi.image');
Route::post('/multi/add', [MultipicController::class, 'Storeimg'])->name('store.image');



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all();
    $users = DB::table('users')->get();
    return view('dashboard', compact('users'));
})->name('dashboard');
