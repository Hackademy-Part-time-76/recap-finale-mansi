<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'homepage'])->name('homepage');

Route::get('/articoli', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articoli/crea', [ArticleController::class, 'create'])->name('articles.create')->middleware('auth');
Route::post('/articoli/salva', [ArticleController::class, 'store'])->name('articles.store')->middleware('auth');
Route::get('/articoli/{article}/mostra', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/articoli/{article}/modifica', [ArticleController::class, 'edit'])->name('articles.edit')->middleware('auth');
Route::put('/articoli/{article}/aggiorna', [ArticleController::class, 'update'])->name('articles.update')->middleware('auth');
Route::delete('/articoli/{article}/elimina', [ArticleController::class, 'destroy'])->name('articles.destroy')->middleware('auth');
