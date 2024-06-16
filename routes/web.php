<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TheaterController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AdministrativeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PurchaseController;
use App\Models\Discipline;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/* ----- PUBLIC ROUTES ----- */

Route::get('/', [MovieController::class, 'index'])
    ->name('home');

Route::get('movies/{movie}', [MovieController::class, 'show'])
    ->name('movies.show');

Route::get('movies/', [MovieController::class, 'index'])
    ->name('movies.index');

Route::get('theaters/', [TheaterController::class, 'index'])
    ->name('theaters.index');
    
Route::get('screenings/', [ScreeningController::class, 'index'])
    ->name('screenings.index');

Route::get('tickets/', [TicketController::class, 'index'])
    ->name('tickets.index');

Route::get('customers/', [CustomerController::class, 'index'])
    ->name('customers.index');

Route::get('screening/{screening}', [ScreeningController::class, 'seatsIndex'])
    ->name('screening.seats-index');

Route::get('courses/{course}/curriculum', [CourseController::class, 'showCurriculum'])
    ->name('courses.curriculum')
    ->can('viewCurriculum', Course::class);

    
Route::get('/administratives/{administrative}/edit', [AdministrativeController::class, 'show'])
        ->name('administratives.show');
        

Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])
        ->name('employees.show');

Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])
        ->name('customers.show');


/* ----- Non-Verified users ----- */
Route::middleware('auth')->group(function () {

    Route::get('/password', [ProfileController::class, 'editPassword'])->name('profile.edit.password');
    
});

/* ----- Verified users ----- */
Route::middleware('auth', 'verified')->group(function () {

    Route::view('/dashboard', 'dashboard')
        ->name('dashboard');

    Route::delete('courses/{course}/image', [CourseController::class, 'destroyImage'])
        ->name('courses.image.destroy')
        ->can('update', Course::class);

    //Course resource routes are protected by CoursePolicy on the controller
    // The route 'show' is public (for anonymous user)
    Route::resource('courses', CourseController::class)
        ->except(['show']);

    //Department resource routes are protected by DepartmentPolicy on the controller
    Route::resource('departments', DepartmentController::class);

    Route::get('disciplines/my', [DisciplineController::class, 'myDisciplines'])
        ->name('disciplines.my')
        ->can('viewMy', Discipline::class);

    //Discipline resource routes are protected by DisciplinePolicy on the controller
    //Disciplines index and show are public
    Route::resource('disciplines', DisciplineController::class)->except(['index', 'show']);

    Route::get('teachers/my', [TeacherController::class, 'myTeachers'])
        ->name('teachers.my')
        ->can('viewMy', Teacher::class);

    Route::delete('teachers/{teacher}/photo', [TeacherController::class, 'destroyPhoto'])
        ->name('teachers.photo.destroy')
        ->can('update', 'teacher');

    //Teacher resource routes are protected by TeacherPolicy on the controller
    Route::resource('teachers', TeacherController::class);

    Route::get('students/my', [StudentController::class, 'myStudents'])
        ->name('students.my')
        ->can('viewMy', Student::class);
    Route::delete('students/{student}/photo', [StudentController::class, 'destroyPhoto'])
        ->name('students.photo.destroy')
        ->can('update', 'student');

    //Student resource routes are protected by StudentPolicy on the controller
    Route::resource('students', StudentController::class);

    Route::delete('administratives/{administrative}/photo', [AdministrativeController::class, 'destroyPhoto'])
        ->name('administratives.photo.destroy')
        ->can('update', 'administrative');

    //Admnistrative resource routes are protected by AdministrativePolicy on the controller
    Route::resource('administratives', AdministrativeController::class);

});

/* ----- OTHER PUBLIC ROUTES ----- */


    Route::post('purchase',[PurchaseController::class,'store'])
        ->name('purchase.store');

    Route::get('purchase/{purchase}',[PurchaseController::class, 'show'])
        ->name('purchase.show');

    Route::post('cart', [CartController::class, 'confirm'])
        ->name('cart.confirm');

    Route::post('cart/{screening}', [CartController::class, 'addToCart'])
        ->name('cart.add');

    Route::delete('cart/{screening}/{seat}', [CartController::class, 'removeFromCart'])
        ->name('cart.remove');

    Route::get('cart', [CartController::class, 'show'])
        ->name('cart.show');

    Route::delete('cart', [CartController::class, 'destroy'])->name('cart.destroy');


require __DIR__ . '/auth.php';
