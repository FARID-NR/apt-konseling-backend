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

        if ($request->input('questionType') == 'diabetes') {
            $subCollection = $this->firestore->collection('Quiz')->document('Diabetes Melitus');
        } else {
            $subCollection = $this->firestore->collection('Quiz')->document('Hipertensi');
        }

        // Buat subcollection QNA di dalam dokumen yang telah dibuat
        $subCollectionQna = $subCollection->collection('QNA')->newDocument();

        // Memperbarui index array menjadi "opsi1", "opsi2", dst.
        $opsi = $request->input('opsi');
        $opsiFormatted = [];
        foreach ($opsi as $index => $value) {
            $opsiFormatted['opsi' . ($index + 1)] = $value;
        }

        $subCollectionQna->set([
            'question' => $data['question'],
            'opsi' => $data['opsi'],

        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan ke Firestore!');

        // $collection = $this->firestore->collection('users')->document('1');

        // $collection->set($request->all());
        // return response()->json([]);

    }

    public function read()
    {
        $collectionRefDiabetes = $this->firestore->collection('Quiz')->document('Diabetes Melitus')->collection('QNA');
        $documentsDiabetes = $collectionRefDiabetes->documents();

        $collectionRefHipertensi = $this->firestore->collection('Quiz')->document('Hipertensi')->collection('QNA');
        $documentsHipertensi = $collectionRefHipertensi->documents();

        $dataDiabetes = [];
        $dataHipertensi = [];

        foreach ($documentsDiabetes as $document) {
            $dataDiabetes[] = $document->data();
        }

        foreach ($documentsHipertensi as $document) {
            $dataHipertensi[] = $document->data();
        }

        return view('pages.kuesioner.kuesioner', compact('dataDiabetes', 'dataHipertensi'));
        // return view('index')->with('data', $data);      
    }

    public function kuesioner()
    {
        return view('pages.kuesioner.kuesioner');
    }
}
