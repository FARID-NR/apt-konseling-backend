<?php

namespace App\Http\Controllers;

use App\Services\Firebase;
use Illuminate\Http\Request;


class KuesionerController extends Controller
{
    protected $firestore;

    public function __construct()
    {
        $this->firestore = (new Firebase)->firestoreDb;
    }

    public function store(Request $request)
    {

        $data = $request->all();

        // $collection = $this->firestore->collection('Testing_crud')new();

        // $docRef = $this->firestore->collection('Testing_crud')->document($collection->id());

        if ($request->input('questionType') == 'diabetes') {
            $subCollection = $this->firestore->collection('Testing_crud')->document('Diabetes Melitus');
        } else {
            $subCollection = $this->firestore->collection('Testing_crud')->document('Hipertensi');
        }

        // Buat subcollection QNA di dalam dokumen yang telah dibuat
        $subCollectionQna = $subCollection->collection('QNA')->newDocument();
        $subCollectionQna->set([
            'question' => $data['question'],
            'opsi' => $data['opsi']
        ]);

        return redirect()->route('index')->with('success', 'Data berhasil disimpan ke Firestore!');
    }

    public function kuesioner()
    {
        return view('pages.kuesioner.kuesioner');
    }
}
