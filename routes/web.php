<?php
use Illuminate\Support\Facades\Route;

//Kontrolery
use App\Http\Controllers\Logowanie;
use App\Http\Controllers\UserSite;   
use App\Http\Controllers\Przekierowanie;    
use App\Http\Controllers\Settings;    
use App\Http\Controllers\InfoZ;    
use App\Http\Controllers\Ai;    
use App\Http\Controllers\kom;    
use App\Http\Controllers\wyslane;    
use App\Http\Controllers\wyslij;    
use App\Http\Controllers\Kom_przekierowania;    
use App\Http\Controllers\wyslany;    
use App\Http\Controllers\komunikat;    
use App\Http\Controllers\Zadania;    


// Strona główna
Route::get('/', function () {
    return view('home');
});

// logowanie
Route::get('/login', function () {
    return view('login')->with('csrf_token', csrf_token());
})->name('logowanie');

// Zalogowany użytkownik
Route::get('/user_site/{id}', action: [UserSite::class, 'info'])->name('user_site')->middleware('authc');

// ustawienia użytkownika
Route::get('/settings/{id}', [Settings::class, 'sinfo'])->name('settings')->middleware('authc');

// ai
Route::get('/ai/{id}', action: [Ai::class, 'start'])->name('ai')->middleware('authc');

// komunikator
Route::get('/komunikator/{id}', action: [kom::class, 'start'])->name('komunikator')->middleware('authc');

// wysłane komunikaty
Route::get('/wyslane/{id}', action: [wyslane::class, 'start'])->name(name: 'wyslane')->middleware('authc');

// Pisanie komunikatu
Route::get('/wyslij/{id}', action: [wyslij::class, 'start'])->name(name: 'wyslij')->middleware('authc');

// konkretny komunikat
Route::get('/komunikat/{id}', action: [komunikat::class, 'start'])->name(name: 'komunikat')->middleware('authc');

// konkretna wiadomość wysłana
Route::get('/wyslany/{id}', action: [wyslany::class, 'start'])->name(name: 'wyslany')->middleware('authc');

// zadania
Route::get('/zadania/{id}', action: [Zadania::class, 'start'])->name(name: 'wyslany')->middleware('authc');

// Obsługa logowania (POST)
Route::post('/conf', [Logowanie::class, 'login'])->name('conf');

// Przekierowanie na wszelkie witryny
Route::post('/a', [Przekierowanie::class, 'przekierowanie'])->name('a')->middleware(middleware: 'postc'); 

Route::post('/a_kom', [Kom_przekierowania::class, 'przekierowanie'])->name('a_k')->middleware(middleware: 'postc'); 

Route::post('/changepass', [InfoZ::class, 'change'])->name('changepass')->middleware(middleware: 'postc'); 
?>