<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\TransactionHeadController;
use App\Http\Controllers\admin\TransactionAccountController;
use App\Http\Controllers\admin\TransactionController;
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

Route::group([
    'middleware' => 'auth'
], function(){
    Route::get('transaction/head/create', [TransactionHeadController::class, 'create'])->name('Transaction.Head.Create');
    Route::post('transaction/head/store', [TransactionHeadController::class, 'store'])->name('Transaction.Head.Store');
    Route::get('transaction/head/list', [TransactionHeadController::class, 'list'])->name('Transaction.Head.List');
    Route::get('transaction/head/{id}/edit', [TransactionHeadController::class, 'edit'])->name('Transaction.Head.Edit');
    Route::post('transaction/head/{id}/update', [TransactionHeadController::class, 'update'])->name('Transaction.Head.Update');

    Route::get('account/create', [TransactionAccountController::class, 'create'])->name('Transaction.Account.Create');
    Route::post('account/store', [TransactionAccountController::class, 'store'])->name('Transaction.Account.Store');
    Route::get('account/list', [TransactionAccountController::class, 'list'])->name('Transaction.Account.List');
    Route::get('account/{id}/edit', [TransactionAccountController::class, 'edit'])->name('Transaction.Account.Edit');
    Route::post('account/{id}/update', [TransactionAccountController::class, 'update'])->name('Transaction.Account.Update');

    Route::get('transaction/create', [TransactionController::class, 'create'])->name('Transaction.CreatePage');
    Route::post('transaction/store', [TransactionController::class, 'store'])->name('Transaction.Store');
    Route::get('transaction/history', [TransactionController::class, 'list'])->name('Transaction.List');
    Route::get('transaction/id/{id}', [TransactionController::class, 'edit'])->name('Transaction.Edit');


});
