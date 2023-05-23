<?php

use App\Http\Controllers\DasboardController;
use App\Http\Controllers\KuesionerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\userController;
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


Route::get('login', [LoginController::class, 'login'])->name('login');

Route::get('/', [DasboardController::class, 'dashboard'])->name('dashboard');

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

// Route::get('/kuesioner', function () {
//     return view('pages.kuesioner.kuesioner');
// });

Route::get('/view_answer', function () {
    return view('pages.view_answer.view_answer');
});

// Route::get('/kuesioner', [KuesionerController::class, 'show']);

// Route::get('/insert', function() {
//     $stuRef = app('firebase.firestore')->database()->collection('Testing_crud')->newDocument();
//     $stuRef->set([
//         'firstname' => 'Chou',
//         'lastname' => 'NR',
//         'age' => 19
//     ]);
// });

// Route::get('/insert', function() {
//     $firestore = app('firebase.firestore');

//     $testingCrudRef = $firestore->database()->collection('Testing_crud')->newDocument();

//     // Tambahkan data ke koleksi pra_quiz di dalam Testing_crud
//     $praQuizRef = $testingCrudRef->collection('Diabetes Melitus')->newDocument();
//     $praQuizRef->set([
//         'Pertanyaan' => 'a',
//         'Opsi' => 17
//     ]);

//     // Tambahkan data ke koleksi  di dalam Testing_crud
//     $finalQuizRef = $testingCrudRef->collection('Hipertensi')->newDocument();
//     $finalQuizRef->set([
//         'Pertanyaan Opsi' => 'b',
//         'Opsi' => 20
//     ]);
// });
