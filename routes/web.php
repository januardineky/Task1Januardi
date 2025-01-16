<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\CompetencyStandardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});
Route::post('/auth', [AuthController::class, 'auth']);

Route::middleware(['\App\Http\Middleware\StatusLogin::class'])->group(function () {

Route::get('/index', [MajorController::class, 'index']);
Route::get('/create', [MajorController::class, 'create']);
Route::post('/create', [MajorController::class, 'store']);
Route::get('/edit/{id}', [MajorController::class, 'edit']);
Route::post('/update/{id}', [MajorController::class, 'update']); 
// Route::get('/delete/{id}', [MajorController::class, 'deletemajors']);
Route::delete('/delete/{id}', [MajorController::class, 'deletemajors']);


Route::get('/detail/{id}', [CompetencyStandardController::class, 'managestandards']);
Route::get('/competency/create', [CompetencyStandardController::class, 'createCompetencyStandard']);
Route::post('/competency/create', [CompetencyStandardController::class, 'addCompetencyStandard']);
Route::get('/edit/standard/{id}', [CompetencyStandardController::class, 'edit']);
Route::post('edit/standard/{id}', [CompetencyStandardController::class, 'update']);
// Route::get('/delete/standard/{id}', [CompetencyStandardController::class, 'deletestandard']);
Route::delete('/delete/standard/{id}', [CompetencyStandardController::class, 'deletestandard']);

Route::get('/logout', [AuthController::class, 'logout']);
});
