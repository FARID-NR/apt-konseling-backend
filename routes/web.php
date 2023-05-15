<?php

use App\Http\Controllers\KuesionerController;
use App\Services\Firebase;
use Illuminate\Support\Facades\Route;

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
    return view('pages.dashboard.index');
})->name('index');


Route::get('/kuesioner', [KuesionerController::class, 'kuesioner'])->name('index');

Route::prefix('kuesioner')->group(function(){
    Route::post('/', [KuesionerController::class, 'store'])->name('kuesioner.store');
});


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

Route::get('/user', function () {
    return view('pages.user.users');
});

// Route::get('/kuesioner', function () {
//     return view('pages.kuesioner.kuesioner');
// });

Route::get('/view_answer', function () {
    return view('pages.view_answer.view_answer');
});