<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EstudianteController;
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
    return view('welcome');
});


// Ruta de inicio de sesión con Sanctum
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Ruta de cierre de sesión con Sanctum
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth:sanctum');

Route::get('/home', [MatriculaController::class, 'index'])->name('home');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas para Matriculas
Route::get('/matriculas', [MatriculaController::class, 'index']);
Route::get('/matriculas/{id}', [MatriculaController::class, 'show']);
Route::post('/matriculas', [MatriculaController::class, 'store']);
Route::put('/matriculas/{id}', [MatriculaController::class, 'update']);
Route::delete('/matriculas/{idMatricula}', [MatriculaController::class, 'destroy'])->name('matriculas.destroy');


Route::get('/estudiante', [EstudianteController::class, 'index'])->name('estudiante');
