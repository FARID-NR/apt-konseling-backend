<?php

use App\Http\Controllers\DasboardController;
use App\Http\Controllers\KuesionerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\userController;
use App\Http\Middleware\Authenticate;
use App\Services\Firebase;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// Route::middleware(['web', 'guest'])->group(function () {
//     // Rute untuk menampilkan halaman login
//     Route::get('/', [LoginController::class, 'showLogin'])->name('showLogin');
//     Route::post('/', [LoginController::class, 'checkUser'])->name('checkUser');

//     // Route::get('/dashboard', [DasboardController::class, 'dashboard'])->name('dashboard');
//     // Rute untuk halaman dashboard
//     // Route::get('/', [DasboardController::class, 'dashboard'])->name('dashboard');
// });

// Route::middleware(['web'])->group(function () {
//     // Rute untuk menampilkan halaman login
//     Route::get('/', [LoginController::class, 'showLogin'])->name('showLogin');
//     Route::post('/', [LoginController::class, 'checkUser'])->name('checkUser');

//     // Rute untuk halaman dashboard
//     Route::middleware(['auth:dashboard'])->group(function () {
//         Route::get('/dashboard', function () {
//             return view('dashboard');
//         })->name('dashboard');
//     });
// });



    Route::get('/', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/', [LoginController::class, 'checkUser'])->name('checkUser');


// Route::prefix('/')->group(function(){
//     Route::get('dashboard', [DasboardController::class, 'dashboard'])->name('dashboard');
// });

// Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware([])->group(function(){

    Route::get('dashboard', [DasboardController::class, 'dashboard'])->name('dashboard');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::prefix('kuesioner')->group(function(){
        Route::get('/', [KuesionerController::class, 'kuesioner'])->name('kuesioner');
        Route::post('/', [KuesionerController::class, 'store'])->name('kuesioner.store');
        Route::get('/', [KuesionerController::class, 'read'])->name('kuesioner.read');
        Route::post('/edit/{id}', [KuesionerController::class, 'update']);
        Route::post('/editH/{id}', [KuesionerController::class, 'updateH']);
        Route::get('/deletedH/{id}', [KuesionerController::class, 'deletedH'])->name('kuesioner.deletedH');
        Route::get('/deletedD/{id}', [KuesionerController::class, 'deletedD'])->name('kuesioner.deletedD');
    });


    Route::prefix('user')->group(function(){
        Route::get('/', [userController::class, 'read'])->name('user.read');
        Route::get('/export/{userId}', [userController::class, 'export'])->name('user.export');
    });


    Route::get('/view_answer', function () {
        return view('pages.view_answer.view_answer');
    });
});




// Route::get('/', [LoginController::class, 'showLogin'])->name('login');
// Route::post('/', [LoginController::class, 'checkUser'])->name('checkUser');

// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', [DasboardController::class, 'dashboard'])->name('dashboard');
//     Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//     Route::prefix('kuesioner')->group(function () {
//         Route::get('/', [KuesionerController::class, 'kuesioner'])->name('kuesioner');
//         Route::post('/', [KuesionerController::class, 'store'])->name('kuesioner.store');
//         Route::get('/read', [KuesionerController::class, 'read'])->name('kuesioner.read');
//         Route::post('/edit/{id}', [KuesionerController::class, 'update'])->name('kuesioner.update');
//         Route::post('/editH/{id}', [KuesionerController::class, 'updateH'])->name('kuesioner.updateH');
//         Route::get('/deletedH/{id}', [KuesionerController::class, 'deletedH'])->name('kuesioner.deletedH');
//         Route::get('/deletedD/{id}', [KuesionerController::class, 'deletedD'])->name('kuesioner.deletedD');
//     });

//     Route::prefix('user')->group(function () {
//         Route::get('/', [UserController::class, 'read'])->name('user.read');
//         Route::get('/export/{userId}', [UserController::class, 'export'])->name('user.export');
//     });

//     Route::get('/view_answer', function () {
//         return view('pages.view_answer.view_answer');
//     })->name('view_answer');
// });
