<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TheaterController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AdministrativeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PurchaseController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/* ----- PUBLIC ROUTES ----- */

Route::get('/', [MovieController::class, 'index'])
    ->name('home');

Route::get('movies/{movie}', [MovieController::class, 'show'])
    ->name('movies.show');

Route::put('movies/{movie}', [MovieController::class, 'update'])
    ->name('movies.update');

Route::get('movies/{movie}/edit', [MovieController::class, 'edit'])
    ->name('movies.edit');

Route::delete('movies/{movie}',[MovieController::class,'delete'])
->name('movies.delete');

Route::get('movies/', [MovieController::class, 'index'])
    ->name('movies.index');

Route::get('theaters/', [TheaterController::class, 'index'])
    ->name('theaters.index');
    
Route::get('screenings/', [ScreeningController::class, 'index'])
    ->name('screenings.index');

Route::get('tickets/', [TicketController::class, 'handle'])
    ->name('tickets.index');

Route::post('tickets/{ticket}', [TicketController::class, 'validate'])
    ->name('tickets.validate');

Route::get('customers/', [CustomerController::class, 'index'])
    ->name('customers.index');

Route::get('screening/{screening}', [ScreeningController::class, 'seatsIndex'])
    ->name('screening.seats-index');

Route::get('courses/{course}/curriculum', [CourseController::class, 'showCurriculum'])
    ->name('courses.curriculum')
    ->can('viewCurriculum', Course::class);

    
Route::get('/administratives/{administrative}', [AdministrativeController::class, 'show'])
        ->name('administratives.show');
        

Route::get('/employees/{employee}', [EmployeeController::class, 'show'])
        ->name('employees.show');

Route::post('customers/', [CustomerController::class, 'store'])
        ->name('customers.create');

Route::get('/customers/{user}', [CustomerController::class, 'show'])
        ->name('customers.show');

Route::get('/customers/{user}/edit', [CustomerController::class, 'edit'])
        ->name('customers.edit');

Route::delete('/customers/{user}', [CustomerController::class, 'destroy'])
        ->name('customers.destroy');

Route::delete('administratives/{administrative}/photo', [AdministrativeController::class, 'destroyPhoto'])
        ->name('administratives.photo.destroy')
        ->can('update', 'administrative');

Route::resource('administratives', AdministrativeController::class);


Route::post('purchases',[PurchaseController::class,'store'])
    ->name('purchases.store');

Route::get('purchases/{purchase}',[PurchaseController::class, 'show'])
    ->name('purchases.show');

Route::get('tickets/{ticket}',[TicketController::class, 'show'])
    ->name('tickets.show');

Route::get('purchases',[PurchaseController::class, 'index'])
    ->name('purchases.index');

Route::post('cart', [CartController::class, 'confirm'])
    ->name('cart.confirm');

Route::post('cart/{screening}', [CartController::class, 'addToCart'])
    ->name('cart.add');

Route::delete('cart/{screening}/{seat}', [CartController::class, 'removeFromCart'])
    ->name('cart.remove');

Route::get('cart', [CartController::class, 'show'])
    ->name('cart.show');

Route::delete('cart', [CartController::class, 'destroy'])->name('cart.destroy');


/* ----- Non-Verified users ----- */
Route::middleware('auth')->group(function () {

    Route::get('/password', [ProfileController::class, 'editPassword'])->name('profile.edit.password');
    
});


require __DIR__ . '/auth.php';
