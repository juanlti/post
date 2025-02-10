<?php


use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
Route::get('/categorias',[CategoryController::class,'index'])->name('api.v1.categories.index');
Route::post('/categorias',[CategoryController::class,'store'])->name('api.v1.categories.store');
Route::get('/categorias/{category}',[CategoryController::class,'show'])->name('api.v1.categories.show');
Route::put('/categorias/{category}',[CategoryController::class,'update'])->name('api.v1.categories.update');
Route::delete('/categorias/{category}',[CategoryController::class,'destroy'])->name('api.v1.categories.destroy');
*/
Route::apiResource('categorias',CategoryController::class)->names('api.v1.categories');


