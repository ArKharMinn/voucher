<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('home');
    Route::prefix('customer')->group(function () {
        Route::get('detail/{id}', [CustomerController::class, 'detail'])->name('customer#detail');
        Route::get('list', [CustomerController::class, 'list'])->name('customer#list');
        Route::get('delete/{id}', [CustomerController::class, 'delete'])->name('customer#delete');
        Route::get('edit', [CustomerController::class, 'edit'])->name('customer#edit');
        Route::post('update', [CustomerController::class, 'update'])->name('customer#update');
        Route::get('searchCus', [CustomerController::class, 'searchCus'])->name('customer#searchCus');
        Route::get('/export-customers', [CustomerController::class, 'export'])->name('customers#export');
        Route::get('/export-pdf', [CustomerController::class, 'exportPdf'])->name('customer#pdf');
        Route::get('/filter', [CustomerController::class, 'filter'])->name('customer#filter');
    });
    Route::prefix('item')->group(function () {
        Route::get('list', [ItemController::class, 'list'])->name('item#list');
        Route::post('create', [ItemController::class, 'create'])->name('item#create');
        Route::get('delete/{id}', [ItemController::class, 'delete'])->name('item#delete');
        Route::post('customer', [ItemController::class, 'customer'])->name('item#customer');
    });
});
