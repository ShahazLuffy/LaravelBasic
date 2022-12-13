<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardQBController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Models\User;




Route::get('/profile', function () {
    // Only verified users may access this route...
})->middleware(['auth', 'verified']);
//**************************************Home***************************/

Route::get('/', function () {
    return view('welcome');
})->name('home');


//**************************************dashboard***************************/
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $users = User::all();
        return view('dashboard', compact('users'));
    })->name('dashboard');
});

// dashboard with query  builder
Route::get('/dashboardqb',[DashboardQBController::class, 'dashboardView'])->name('qb');


//**************************************Brand***************************/
Route::get('/brand/all', [BrandController::class, 'allBrand'])->name('all.Brand');
Route::post('/brand/add', [BrandController::class, 'storeBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'editBrand'])->name('edit.brand');
Route::post('/brand/update/{id}', [BrandController::class, 'updateBrand'])->name('update.brand');
Route::get('/brand/delete/{id}', [BrandController::class, 'deleteBrand'])->name('delete.brand');


//**************************************Category***************************/
Route::get('/category/all', [CategoryController::class, 'allcat'])->name('all.cat');
Route::post('/category/add', [CategoryController::class, 'addcat'])->name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('edit.category');
Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('update.category');
Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete'])->name('softDelete');
Route::get('/category/restore/{id}', [CategoryController::class, 'restore'])->name('cat.restore');
Route::get('/pdelete/category/{id}', [CategoryController::class, 'pdelete'])->name('cat.pdelete');



//**************************************Contact***************************/
Route::get('/contact', [ContactController::class, 'contactView'])->name('cont');


//**************************************Multi Image***************************/
Route::get('/multi/pic', [BrandController::class, 'multiPic'])->name('all.multipic');
Route::post('/multi/add', [BrandController::class, 'sotreImg'])->name('store.image');

