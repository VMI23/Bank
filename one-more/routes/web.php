<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\InvestmentAccountController;
use App\Http\Controllers\InvestmentHistoryController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

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


Route::middleware('auth')->group(function () {
    Route::get('/accounts', [AccountController::class, 'index'])
        ->name('accounts');

    Route::get('/accounts/create', [AccountController::class, 'create'])
        ->name('accounts.create');

    Route::post('/accounts/store', [AccountController::class, 'store'])
        ->name('accounts.store');

    Route::get('/accounts/deposit', [AccountController::class, 'depositView'])
        ->name('accounts.deposit');

    Route::post('/accounts/deposit', [AccountController::class, 'deposit'])
        ->name('accounts.deposit');

    Route::get('/accounts/withdrawal', [AccountController::class, 'withdrawalView'])
        ->name('accounts.withdrawal');

    Route::post('/accounts/withdrawal', [AccountController::class, 'withdrawal'])
        ->name('accounts.withdrawal');

    Route::get('/accounts/transfer', [AccountController::class, 'transferView'])
        ->name('accounts.transfer');

    Route::post('/accounts/transfer', [AccountController::class, 'transfer'])
        ->name('accounts.transfer');

    Route::get('/transactions', [TransactionController::class, 'index'])
        ->name('transactions');

    Route::get('/investments', [InvestmentAccountController::class, 'index'])
        ->name('investments');

    Route::get('/investments/create', [InvestmentAccountController::class, 'create'])
        ->name('investments.create');


    Route::post('/investments/confirm/sell', [InvestmentAccountController::class, 'confirmSell'])
        ->name('investments.confirm.sell');

    Route::post('/investments/store', [InvestmentAccountController::class, 'store'])
        ->name('investments.store');

    Route::get('/investments/confirm/buy', [InvestmentAccountController::class, 'confirmBuyView'])
        ->name('investments.confirm.buy');


    Route::get('/investments/confirm/sell', [InvestmentAccountController::class, 'confirmSellView'])
        ->name('investments.confirm.sell');


    Route::post('/investments/confirm/buy', [InvestmentAccountController::class, 'confirmBuy'])
        ->name('investments.confirm.buy');

    Route::get('/investment/history/{symbol}', [InvestmentHistoryController::class, 'index'])
        ->name('investment.history');
});


require __DIR__ . '/auth.php';
