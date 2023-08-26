<?php

use App\Http\Controllers\Extensions\Staking\StakingController;
use Illuminate\Support\Facades\Route;

Route::post('/fetch/staking', [StakingController::class, 'fetch_info'])->name('fetch.staking');
Route::post('/fetch/staking/logs', [StakingController::class, 'fetch_log'])->name('fetch.staking.logs');
Route::group(['prefix' => 'staking', 'as' => 'staking.'], function () {
    Route::post('/store', [StakingController::class, 'store'])->name('store');
    Route::post('/claim', [StakingController::class, 'claim'])->name('claim');
    Route::post('/cancel', [StakingController::class, 'cancel'])->name('cancel');
});
