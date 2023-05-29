<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Services\Firebase;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Row;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Google\Cloud\Firestore\QuerySnapshot;

class userController extends Controller
{
    protected $firestore;

    public function __construct()
    {
        $this->firestore = (new Firebase)->firestoreDb;
    }

    public function read(Request $request)
    {
        $collectUsers = $this->firestore->collection('users');
        $documentUsers = $collectUsers->documents();

        $patientUsers = [];
        $doctorUsers = [];

        foreach ($documentUsers as $document) {
            $userData = $document->data();

            // Retrieve the document ID
            $userId = $document->id();

            // Retrieve the values of email, fullname, and photo fields
            $email = $userData['email'] ?? null;
            $lastTime = $userData['lastTime'] ?? null;
            $fullName = $userData['fullName'] ?? null;
            $photo = $userData['photo'] ?? null;
            $userType = $userData['type'] ?? null;
            $status = $userData['status'] ?? null;
            $spesialis = $userData['spesialis'] ?? null;
            $createAt = $userData['createAt'] ?? null;
            $noTelpon = $userData['noTelpon'] ?? null;
            $pekerjaan = $userData['pekerjaan'] ?? null;


            if ($userType === 'patient') {
                $patientUsers[] = [
                    'id' => $userId,
                    'email' => $email,
                    'lastTime' => $lastTime,
                    'fullName' => $fullName,
                    'photo' => $photo,
                    'type' => $userType,
                    'status' => $status,
                    'spesialis' => $spesialis,
                    'createAt' => $createAt,
                    'noTelpon' => $noTelpon,
                    'pekerjaan' => $pekerjaan
                ];
            } elseif ($userType === 'doctor') {
                $doctorUsers[] = [
                    'id' => $userId,
                    'email' => $email,
                    'lastTime' => $lastTime,
                    'fullName' => $fullName,
                    'photo' => $photo,
                    'type' => $userType,
                    'status' => $status,
                    'spesialis' => $spesialis,
                    'createAt' => $createAt,
                    'noTelpon' => $noTelpon,
                    'pekerjaan' => $pekerjaan
                ];
            }
        }

        return view('pages.user.users', compact('patientUsers', 'doctorUsers'));
    }

    public function getData(Request $request)
    {
        $collectUsers = $this->firestore->collection('users');
        $documentUsers = $collectUsers->documents();

        $userStatus = [
            'patient' => [],
            'doctor' => [],
        ];

        foreach ($documentUsers as $document) {
            $userData = $document->data();

            // Retrieve the values of id, type, and status fields
            $userId = $document->id();
            $userType = $userData['type'] ?? null;
            $status = $userData['status'] ?? false;

            $userStatus[$userType][$userId] = $status;
        }

        return response()->json([
            'userStatus' => $userStatus,
        ]);
    }


    // public function updateData()
    // {
    //     // Dapatkan data terbaru dari sumber data Anda
    //     // Misalnya, menggunakan Firebase Firestore

    //     $collectionRef = $this->firestore->collection('answers');
    //     $documents = $collectionRef->documents();

    //     foreach ($documents as $document) {
    //         // Perbarui data sesuai kebutuhan
    //         $answerData = $document->data();
    //         $documentRef = $document->reference();

    //         // Contoh: Perbarui data dengan menambahkan properti baru
    //         $answerData['updated_at'] = date('Y-m-d H:i:s');

    //         // Simpan pembaruan data ke Firestore
    //         $documentRef->set($answerData);
    //     }
    // }

    public function export($userId)
    {
        $collectionRef = $this->firestore->collection('answers');
        $documents = $collectionRef->where('pasien', '=', $userId);
        $documents = $documents->documents();

        // $this->updateData();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Tanggal');
        $sheet->setCellValue('B1', 'User & Apoteker');
        $sheet->setCellValue('C1', 'Pertanyaan & Jawaban (PraQuiz)');
        // $sheet->setCellValue('D1', 'Jawaban-Pra');
        $sheet->setCellValue('E1', 'Pertanyaan & Jawaban (FinalQuiz)');
        // $sheet->setCellValue('F1', 'Jawaban-Final');

        $row = 2;

        foreach ($documents as $document) {
            $answerData = $document->data();
            $rowOffset = $row;

            $finalQuizRef = $document->reference()->collection('finalQuiz');
            $finalQuizDocuments = $finalQuizRef->documents();
            $finalQuizData = [];
            $finalQuizDataJ = [];

            foreach ($finalQuizDocuments as $finalQuizDocument) {
                $finalQuizData[] = $finalQuizDocument->data()['pertanyaan'];
                $finalQuizDataJ[] = $finalQuizDocument->data()['jawaban'];
            }

            $praQuizRef = $document->reference()->collection('praQuiz');
            $praQuizDocuments = $praQuizRef->documents();
            $praQuizData = [];
            $praQuizDataJ = [];

            foreach ($praQuizDocuments as $praQuizDocument) {
                $praQuizData[] = $praQuizDocument->data()['pertanyaan'];
                $praQuizDataJ[] = $praQuizDocument->data()['jawaban'];
            }

            $sheet->setCellValue('A' . ($rowOffset * 2 - 1), $answerData['date_quiz']);
            $sheet->setCellValue('B' . ($rowOffset * 2 - 1), 'User : ' . $answerData['pasien']);
            $sheet->setCellValue('B' . ($rowOffset * 2),     'Apoteker : ' . $answerData['apoteker']);
            $praQuizDataCount = count($praQuizData);
            $praQuizDataJCount = count($praQuizDataJ);
            $finalQuizDataCount = count($finalQuizData);
            $finalQuizDataJCount = count($finalQuizDataJ);

            $maxCount = max($praQuizDataCount, $praQuizDataJCount, $finalQuizDataCount, $finalQuizDataJCount);

            for ($i = 0; $i < $maxCount; $i++) {
                $rowOffset = $row + $i;

                // ini yang di pake kalo mau tidak pake nomor
                /*$sheet->setCellValue('C' . ($rowOffset * 2 - 1), isset($praQuizData[$i]) ? $praQuizData[$i] : '');
                $sheet->setCellValue('C' . ($rowOffset * 2), isset($praQuizDataJ[$i]) ? $praQuizDataJ[$i] : '');
                $sheet->setCellValue('E' . ($rowOffset * 2 - 1), isset($finalQuizData[$i]) ? $finalQuizData[$i] : '');
                $sheet->setCellValue('E' . ($rowOffset * 2), isset($finalQuizDataJ[$i]) ? $finalQuizDataJ[$i] : '');*/

                $cellValueC = ($i + 1) . '. ' . (isset($praQuizData[$i]) ? $praQuizData[$i] : '');
                $cellValueD = 'Jawaban : ' . (isset($praQuizDataJ[$i]) ? $praQuizDataJ[$i] : '');
                $cellValueE = ($i + 1) . '. ' . (isset($finalQuizData[$i]) ? $finalQuizData[$i] : '');
                $cellValueF = 'Jawaban : ' . (isset($finalQuizDataJ[$i]) ? $finalQuizDataJ[$i] : '');

                $sheet->setCellValueExplicit('C' . ($rowOffset * 2 - 1), $cellValueC, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('C' . ($rowOffset * 2), $cellValueD, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('E' . ($rowOffset * 2 - 1), $cellValueE, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('E' . ($rowOffset * 2), $cellValueF, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            }
            $row += $maxCount + 1;
        }

        $writer = new Xlsx($spreadsheet);

        $response = new StreamedResponse(function () use ($writer) {
            $writer->save('php://output');
        });

        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment;filename=answers.xlsx');
        $response->headers->set('Cache-Control', 'max-age=0');

        return $response;
    }
}
