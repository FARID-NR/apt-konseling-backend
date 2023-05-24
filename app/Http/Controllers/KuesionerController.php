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

        // // Buat subcollection QNA di dalam dokumen yang telah dibuat
        // $subCollectionQna = $subCollection->collection('QNA')->newDocument();

        // Dapatkan subkoleksi 'QNA'
        $subCollectionQna = $subCollection->collection('QNA');

        // Dapatkan jumlah dokumen yang telah ada di subkoleksi 'QNA'
        $existingDocsCount = $subCollectionQna->documents()->size();

        // Tentukan ID berikutnya
        $nextDocId = $existingDocsCount + 1;

        // Buat dokumen baru dengan ID yang ditentukan
        $newDoc = $subCollectionQna->newDocument($nextDocId);

        // Memperbarui index array menjadi "opsi1", "opsi2", dst.
        $opsi = $request->input('opsi');
        $opsiFormatted = [];
        foreach ($opsi as $index => $value) {
            $opsiFormatted['opsi' . ($index + 1)] = $value;
        }

        $newDoc->set([
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
            $data = $document->data();
            $data['id'] = $document->id();
            $dataDiabetes[] = $data;
        }

        foreach ($documentsHipertensi as $document) {
            $data = $document->data();
            $data['id'] = $document->id();
            $dataHipertensi[] = $data;
        }

        return view('pages.kuesioner.kuesioner', compact('dataDiabetes', 'dataHipertensi'));
        // return view('index')->with('data', $data);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $subCollection = $this->firestore->collection('Quiz')->document('Diabetes Melitus');

        // Mengambil referensi dokumen berdasarkan ID yang dikirim
        $documentRef = $subCollection->collection('QNA')->document($id);

        // Memperbarui dokumen dengan data yang baru
        $updates = [];

        // Memeriksa apakah ada input question yang dikirim
        if ($request->has('question' . $id)) {
            $updates['question'] = $data['question' . $id];
        }

        // Memeriksa apakah ada input opsi yang dikirim
        if ($request->has('opsi' . $id)) {
            $opsi = $data['opsi' . $id];

            // Memastikan $opsi adalah array sebelum melakukan iterasi
            if (is_array($opsi)) {
                // Mendapatkan snapshot dokumen
                $snapshot = $documentRef->snapshot();

                // Mengambil nilai opsi yang ada dalam dokumen sebelumnya
                $existingOpsi = $snapshot->get('opsi');

                // Menggabungkan nilai opsi yang diubah dengan opsi yang ada dalam dokumen sebelumnya
                foreach ($opsi as $index => $value) {
                    $existingOpsi[$index] = $value;
                }

                $updates['opsi'] = $existingOpsi;
            }
        }

        // Memperbarui dokumen dengan data yang baru
        $documentRef->set($updates, ['merge' => true]);

        return redirect()->back()->with('successEdit', 'Data berhasil di edit');
    }

    public function updateH(Request $request, $id)
    {
        $data = $request->all();

        $subCollection = $this->firestore->collection('Quiz')->document('Hipertensi');

        // Mengambil referensi dokumen berdasarkan ID yang dikirim
        $documentRef = $subCollection->collection('QNA')->document($id);

        // Memperbarui dokumen dengan data yang baru
        $updates = [];

        // Memeriksa apakah ada input question yang dikirim
        if ($request->has('question' . $id)) {
            $updates['question'] = $data['question' . $id];
        }

        // Memeriksa apakah ada input opsi yang dikirim
        if ($request->has('opsi' . $id)) {
            $opsi = $data['opsi' . $id];

            // Memastikan $opsi adalah array sebelum melakukan iterasi
            if (is_array($opsi)) {
                // Mendapatkan snapshot dokumen
                $snapshot = $documentRef->snapshot();

                // Mengambil nilai opsi yang ada dalam dokumen sebelumnya
                $existingOpsi = $snapshot->get('opsi');

                // Menggabungkan nilai opsi yang diubah dengan opsi yang ada dalam dokumen sebelumnya
                foreach ($opsi as $index => $value) {
                    $existingOpsi[$index] = $value;
                }

                $updates['opsi'] = $existingOpsi;
            }
        }

        // Memperbarui dokumen dengan data yang baru
        $documentRef->set($updates, ['merge' => true]);

        return redirect()->back()->with('successEditH', 'Data berhasil di edit');
    }


    // public function updateH(Request $request, $id)
    // {
    //     $data = $request->all();

    //     $subCollection = $this->firestore->collection('Quiz')->document('Hipertensi');

    //     // Mengambil referensi dokumen berdasarkan ID yang dikirim
    //     $documentRef = $subCollection->collection('QNA')->document($id);

    //     // Memperbarui index array menjadi "opsi1", "opsi2", dst.
    //     $opsi = $request->input('opsi' . $id);
    //     $opsiFormatted = [];
    //     foreach ($opsi as $index => $value) {
    //         $opsiFormatted[($index)] = $value;
    //     }

    //     // Memperbarui dokumen dengan data yang baru
    //     $documentRef->set([
    //         'question' => $data['question' . $id],
    //         'opsi' => $opsiFormatted,

    //     ]);

    //     return redirect()->back()->with('successEditH', 'Data berhasil di edit');
    // }

    public function deletedH(Request $request, $id)
    {
        $subCollection = $this->firestore->collection('Quiz')->document('Hipertensi')->collection('QNA');

        $subCollectionQna = $subCollection->document($id);

        $subCollectionQna->delete();

        return redirect()->back()->with('successDelete', 'Data berhasil dihapus dari Firestore!');
        // return redirect()->back()->with('successDeleteD', 'Data berhasil dihapus dari Firestore!');
    }

    public function deletedD(Request $request, $id)
    {

        $subCollection = $this->firestore->collection('Quiz')->document('Diabetes Melitus')->collection('QNA');


        $subCollectionQna = $subCollection->document($id);

        $subCollectionQna->delete();

        return redirect()->back()->with('successDeleteD', 'Data berhasil dihapus dari Firestore!');
    }


    // public function update(Request $request, $id)
    // {
    //     $data = $request->all();
    //     $questionType = $request->input('questionType'. $id);

    //     if ($questionType == 'diabetes') {
    //         $collectionName = 'Diabetes Melitus';
    //         $subCollectionName = 'QNA';
    //     } else {
    //         $collectionName = 'Hipertensi';
    //         $subCollectionName = 'QNA';
    //     }

    //     // Mengambil referensi dokumen berdasarkan ID yang dikirim
    //     $documentRef = $this->firestore->collection('Quiz')->document($collectionName)->collection($subCollectionName)->document($id);

    //     // Memperbarui index array menjadi "opsi1", "opsi2", dst.
    //     $opsi = $request->input('opsi' . $id);
    //     $opsiFormatted = [];
    //     foreach ($opsi as $index => $value) {
    //         $opsiFormatted[($index)] = $value;
    //     }

    //     // Memperbarui dokumen dengan data yang baru
    //     $documentRef->set([
    //         'question' => $data['question' . $id],
    //         'opsi' => $opsiFormatted,
    //     ]);

    //     return redirect()->back()->with('successEditD', 'Data berhasil di edit');
    //     return redirect()->back()->with('successEdit', 'Data berhasil di edit');
    // }




    public function kuesioner()
    {
        return view('pages.kuesioner.kuesioner');
    }
}
