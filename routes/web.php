<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PageController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Socialite;

Route::get('/', [PageController::class, 'homepage'])->name('homepage');

Route::get('/articoli', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articoli/crea', [ArticleController::class, 'create'])->name('articles.create')->middleware('auth');
Route::post('/articoli/salva', [ArticleController::class, 'store'])->name('articles.store')->middleware('auth');
Route::get('/articoli/{article}/mostra', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/articoli/{article}/modifica', [ArticleController::class, 'edit'])->name('articles.edit')->middleware('auth');
Route::put('/articoli/{article}/aggiorna', [ArticleController::class, 'update'])->name('articles.update')->middleware('auth');
Route::delete('/articoli/{article}/elimina', [ArticleController::class, 'destroy'])->name('articles.destroy')->middleware('auth');


//Route::resource('article', ArticleController::class);

Route::get('/auth/redirect/{provider}', function ($provider) {
    return Socialite::driver($provider)->redirect();
});

Route::get('/auth/callback', function () {
    $githubUser = Socialite::driver('github')->user();
    dd($githubUser);
    $user = User::updateOrCreate([
        'github_id' => $githubUser->id,
    ], [
        'name' => $githubUser->name,
        'password' => Hash::make($githubUser->name),
        'email' => $githubUser->email,
        'facebook_token' => $githubUser->token,
        'google_refresh_token' => $githubUser->refreshToken,
    ]);

    Auth::login($user);

    return redirect()->route('homepage');
});
