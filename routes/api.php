<?php

use App\Http\Controllers\Api\ContractController;
use App\Models\Contracts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function (Request $request) {
    return "Test GET API Working";
});
Route::post('/test', function (Request $request) {
    return ["Test POST API Working.", $request];
});




Route::get('contractOne', [ContractController::class, 'contractOneIndex']);
Route::post('contractOne', [ContractController::class, 'contractsOneStore']);

Route::get('contractTwo', [ContractController::class, 'contractTwoIndex']);
Route::post('contractTwo', [ContractController::class, 'contractsTwoStore']);

Route::get('contractThree', [ContractController::class, 'contractThreeIndex']);
Route::post('contractThree', [ContractController::class, 'contractsThreeStore']);

Route::get('contractFour', [ContractController::class, 'contractFourIndex']);
Route::post('contractFour', [ContractController::class, 'contractsFourStore']);

Route::get('contractFive', [ContractController::class, 'contractFiveIndex']);
Route::post('contractFive', [ContractController::class, 'contractsFiveStore']);

Route::get('contractSix', [ContractController::class, 'contractSixIndex']);
Route::post('contractSix', [ContractController::class, 'contractsSixStore']);

Route::get('contractSeven', [ContractController::class, 'contractSevenIndex']);
Route::post('contractSeven', [ContractController::class, 'contractsSevenStore']);
