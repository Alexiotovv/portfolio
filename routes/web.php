<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatosController;
use App\Http\Controllers\DatosdetailsController;
use App\Http\Controllers\ExperiencesController;
use App\Http\Controllers\CertificatesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;

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
Route::get('/login',function(){
    return view('panel.auth.login');
})->name('login')->middleware('guest');

//Home
Route::get('/', [HomeController::class,'home'])->name('home');
Route::get('/certificates', [HomeController::class,'certificates'])->name('certificates');



//Datos
Route::get('/panel/datos/create',[DatosController::class,'create'])->middleware(['auth'])->name('panel.datos.create');
Route::get('/panel/datos/edit/{id}',[DatosController::class,'edit'])->middleware(['auth'])->name('panel.datos.edit');
Route::post('/panel/datos/store',[DatosController::class,'store'])->middleware(['auth'])->name('panel.datos.store');
Route::post('/panel/datos/update',[DatosController::class,'update'])->middleware(['auth'])->name('panel.datos.update');

//Experience
Route::get('panel/experiences/create',[ExperiencesController::class,'create'])->middleware(['auth'])->name('panel.experiences.create');
Route::post('panel/experiences/store',[ExperiencesController::class,'store'])->middleware(['auth'])->name('panel.experiences.store');
Route::post('panel/experiences/update',[ExperiencesController::class,'update'])->middleware(['auth'])->name('panel.experiences.update');
Route::get('panel/experiences/edit/{id}',[ExperiencesController::class,'edit'])->middleware(['auth'])->name('panel.experiences.edit');
Route::post('panel/experiences/destroy',[ExperiencesController::class,'destroy'])->middleware(['auth'])->name('panel.experiences.destroy');

//Certificates
Route::get('panel/certificates/create',[CertificatesController::class,'create'])->middleware(['auth'])->name('panel.certificates.create');
Route::post('panel/certificates/store',[CertificatesController::class,'store'])->middleware(['auth'])->name('panel.certificates.store');
Route::post('panel/certificates/update',[CertificatesController::class,'update'])->middleware(['auth'])->name('panel.certificates.update');
Route::get('panel/certificates/edit/{id}',[CertificatesController::class,'edit'])->middleware(['auth'])->name('panel.certificates.edit');
Route::post('panel/certificates/destroy',[CertificatesController::class,'destroy'])->middleware(['auth'])->name('panel.certificates.destroy');

//DatosDetails
Route::post('/panel/datosdetails/store',[DatosdetailsController::class,'store'])->middleware(['auth'])->name('panel.datosdetails.store');

//Login
Route::post("/login",[LoginController::class, 'login']);
Route::put('/login', [LoginController::class, 'logout']);

//Panel
Route::get('/panel', function () {
    return view('panel.base');
})->name('panel');


